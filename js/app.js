const API_URL = "https://corsproxy.io/?" + encodeURIComponent("https://biblioipil.infinityfreeapp.com/index.php?url=api");

// --- WRAPPER GLOBAL DE API ---
async function apiFetch(endpoint, options = {}) {
    const isPost = options.method && ['POST', 'PUT', 'DELETE'].includes(options.method.toUpperCase());
    
    const config = {};
    
    if (isPost) {
        config.headers = { 'Content-Type': 'text/plain' };
    }
    
    if (options.method) config.method = options.method;
    if (options.body && typeof options.body === 'object') {
        config.body = JSON.stringify(options.body);
    }

    try {
        const response = await fetch(`${API_URL}/${endpoint}`, config);
        
        if (response.status === 401) {
            console.warn("Sessão expirada ou não autenticado.");
            logout();
            return { sucesso: false, mensagem: "Sessão expirada." };
        }

        const data = await response.json();
        return data;
    } catch (err) {
        console.error(`Erro na chamada API (${endpoint}):`, err);
        return { sucesso: false, mensagem: "Erro de ligação ao servidor." };
    }
}

// --- VERIFICAR USUÁRIO NA URL (REDIRECIONAMENTO DO BACKEND) ---
(function checkUserFromURL() {
    const urlParams = new URLSearchParams(window.location.search);
    const userParam = urlParams.get('user');
    
    // Tenta recuperar do storage primeiro
    let storedUser = localStorage.getItem("biblio_user");
    if (storedUser) {
        currentUser = JSON.parse(storedUser);
    }

    if (userParam) {
        try {
            const userData = JSON.parse(decodeURIComponent(userParam));
            // Normalização robusta
            userData.role = userData.papel || userData.role;
            userData.name = userData.nome_completo || userData.name;
            localStorage.setItem("biblio_user", JSON.stringify(userData));
            currentUser = userData;
            // Limpar o parâmetro da URL
            window.history.replaceState({}, document.title, window.location.pathname);
            console.log("Usuário carregado do backend:", userData);
        } catch (e) {
            console.error("Erro ao carregar usuário da URL:", e);
        }
    }
})();

// --- CONTROLO DE ACESSO (RBAC) ---
function enforceRoleAccess() {
    const path = window.location.pathname.toLowerCase();
    const isAdminPath = path.includes('/admin/');
    const isBackofficePath = path.includes('/backoffice/');
    const isLoginPage = path.includes('login.html') || path.includes('registo.html');
    const isInPages = path.includes('/pages/');

    if (!currentUser) {
        if (isAdminPath || isBackofficePath) {
            console.log("Acesso restrito: Redirecionando para login...");
            window.location.href = isInPages ? "../login.html" : "./pages/login.html";
        }
        return;
    }

    // Normalização rigorosa
    const role = (currentUser.role || currentUser.papel || "").toLowerCase();
    console.log("Verificando acesso para role:", role, "em:", path);

    const base = isInPages ? "./" : "./pages/";

    if (role === 'admin') {
        if (!isAdminPath && !isLoginPage && !path.includes('dashboard.html')) {
            console.log("Admin detectado em área pública. Redirecionando...");
            window.location.href = base + "admin/dashboard.html";
        }
    } else if (role === 'backoffice') {
        if (!isBackofficePath && !isLoginPage && !path.includes('dashboard.html')) {
            console.log("Backoffice detectado em área pública. Redirecionando...");
            window.location.href = base + "backoffice/dashboard.html";
        }
    } else {
        // Cliente ou outros
        if (isAdminPath || isBackofficePath) {
            console.warn("Acesso negado: Redirecionando para biblioteca...");
            window.location.href = isInPages ? "../biblioteca.html" : "./pages/biblioteca.html";
        }
    }
}

// --- INICIALIZAÇÃO ---
document.addEventListener("DOMContentLoaded", async () => {
    console.log("Inicializando aplicação dinâmica...");
    
    // Executar controlo de acesso imediatamente
    enforceRoleAccess();

    // 1. Renderizar a estrutura da UI imediatamente (Shell)
    renderHeader();
    renderFooter();
    renderCartBadge();
    
    try {
        // 2. Carregar Dados de forma assíncrona
        const loaders = [
            fetchAutores(),
            fetchEditoras(),
            fetchBooks()
        ];

        // Carregar dados de admin se necessário
        if (currentUser && ['admin', 'backoffice'].includes(currentUser.role)) {
            loaders.push(fetchUsers());
            loaders.push(fetchStats());
        }

        await Promise.all(loaders);

        // 3. Notificar a página que os dados estão prontos para renderizar
        if (typeof render === "function") {
            render();
        }
        
    } catch (err) {
        console.error("Erro crítico na inicialização:", err);
    }
});

// --- FUNÇÕES DE API ---

async function fetchUsers() {
    const data = await apiFetch('utilizadores');
    if (data.sucesso) users = data.dados;
}

async function fetchStats() {
    const data = await apiFetch('stats');
    if (data.sucesso) {
        orders = data.dados.pedidos;
        topSelling = data.dados.mais_vendidos;
        // Se salesByMonth for dinâmico, atualizamos também
        if (data.dados.vendas_por_mes && data.dados.vendas_por_mes.length > 0) {
            // Limpar mockups e usar dados reais
            salesByMonth.length = 0;
            salesByMonth.push(...data.dados.vendas_por_mes);
        }
    }
}

async function fetchAutores() {
    const data = await apiFetch('autores');
    if (data.sucesso) authors = data.dados.map(a => ({ id: a.id, name: a.nome, biografia: a.biografia }));
}

async function fetchEditoras() {
    const data = await apiFetch('editoras');
    if (data.sucesso) publishers = data.dados.map(p => ({ id: p.id, name: p.nome }));
}

async function fetchBooks() {
    const data = await apiFetch('livros');
    if (data.sucesso) {
        books = data.dados.map(b => ({
            id: b.id,
            title: b.titulo,
            authorId: b.autor_id,
            publisherId: b.editora_id,
            author: b.autor,
            publisher: b.editora,
            cover: b.cover || "https://picsum.photos/seed/book/400/600",
            synopsis: b.sinopse || "Sem sinopse disponível.",
            price: parseFloat(b.preco),
            rating: b.rating_media || 0,
            ratingTotal: b.rating_total || 0,
            genres: b.generos || [],
            tags: b.tags || [],
            status: b.estado,
            access: (b.compravel && b.legivel_no_site) ? 'ambos' : (b.compravel ? 'comprar' : 'ler'),
            createdAt: b.criado_em,
            pdf_url: b.pdf_url || null,
            legivel_no_site: b.legivel_no_site || 0,
            caminho_pdf: b.caminho_pdf || null
        }));

        if (typeof renderCatalog === "function") renderCatalog();
        if (typeof renderBookDetails === "function") renderBookDetails();
    }
}

async function fetchBiblioteca() {
    const data = await apiFetch('biblioteca');
    if (data.sucesso) {
        const meusLivros = data.dados.map(b => ({
            id: b.id,
            title: b.titulo,
            authorId: b.autor_id,
            publisherId: b.editora_id,
            author: b.autor,
            publisher: b.editora,
            cover: b.cover || "https://picsum.photos/seed/book/400/600",
            synopsis: b.sinopse || "Sem sinopse disponível.",
            price: parseFloat(b.preco),
            rating: b.rating_media || 0,
            ratingTotal: b.rating_total || 0,
            genres: b.generos || [],
            status: b.estado,
            access: (b.compravel && b.legivel_no_site) ? 'ambos' : (b.compravel ? 'comprar' : 'ler'),
            createdAt: b.criado_em,
            pdf_url: b.pdf_url || null,
            legivel_no_site: b.legivel_no_site || 0,
            caminho_pdf: b.caminho_pdf || null,
            tipo_acesso: b.tipo_acesso || 'lido',
            data_aquisicao: b.data_aquisicao
        }));
        return meusLivros;
    }
    return [];
}

async function comprarLivro(livroId) {
    const data = await apiFetch('biblioteca/comprar', {
        method: 'POST',
        body: { livro_id: livroId }
    });
    if (data.sucesso) {
        toast("Livro comprado com sucesso!");
        return true;
    } else {
        toast(data.mensagem || "Erro ao comprar livro", "error");
        return false;
    }
}

async function registarLeitura(livroId) {
    await apiFetch('biblioteca/ler', {
        method: 'POST',
        body: { livro_id: livroId }
    });
}

async function deleteBook(id) {
    const data = await apiFetch(`livros/eliminar?id=${id}`, { method: 'DELETE' });
    if (data.sucesso) {
        books = books.filter(b => b.id !== id);
        toast("Livro eliminado com sucesso!", "success");
        if (typeof renderCatalog === "function") renderCatalog();
    } else {
        toast(data.mensagem || "Erro ao eliminar livro", "error");
    }
}

async function deleteAuthor(id) {
    const data = await apiFetch(`autores/eliminar?id=${id}`, { method: 'DELETE' });
    if (data.sucesso) {
        authors = authors.filter(a => a.id !== id);
        toast("Autor eliminado com sucesso!", "success");
    } else {
        toast(data.mensagem || "Erro ao eliminar autor", "error");
    }
}

async function deletePublisher(id) {
    const data = await apiFetch(`editoras/eliminar?id=${id}`, { method: 'DELETE' });
    if (data.sucesso) {
        publishers = publishers.filter(p => p.id !== id);
        toast("Editora eliminada com sucesso!", "success");
    } else {
        toast(data.mensagem || "Erro ao eliminar editora", "error");
    }
}

// --- CARRINHO ---
let cartItems = JSON.parse(localStorage.getItem("biblio_cart")) || [];

function cartSave() {
    localStorage.setItem("biblio_cart", JSON.stringify(cartItems));
}

function cartAdd(bookId) {
    console.log("cartAdd called with:", bookId);
    if (!currentUser) {
        toast("Faça login para adicionar ao carrinho", "error");
        window.location.href = "./pages/login.html";
        return;
    }
    const exists = cartItems.find(i => i.bookId === bookId);
    if (exists) {
        toast("Este livro já está no carrinho");
        return;
    }
    cartItems.push({ bookId, qty: 1 });
    cartSave();
    toast("Adicionado ao carrinho!", "success");
    if (typeof renderCartBadge === "function") renderCartBadge();
}

function cartRemove(bookId) {
    cartItems = cartItems.filter(i => i.bookId !== bookId);
    cartSave();
    toast("Removido do carrinho");
    if (typeof renderCartBadge === "function") renderCartBadge();
}

function cartClear() {
    cartItems = [];
    cartSave();
    if (typeof renderCartBadge === "function") renderCartBadge();
}

function cartSubtotal() {
    return cartItems.reduce((sum, i) => {
        const b = getBook(i.bookId);
        return sum + (b ? b.price : 0);
    }, 0);
}

function cartCount() {
    return cartItems.length;
}

function renderCartBadge() {
    const badge = document.getElementById('cart-badge');
    if (badge) {
        const count = cartCount();
        badge.textContent = count > 0 ? count : '';
        badge.style.display = count > 0 ? 'inline-flex' : 'none';
    }
}

async function checkoutCart() {
    if (cartItems.length === 0) {
        toast("Carrinho vazio", "error");
        return false;
    }

    if (!currentUser) {
        toast("Faça login para finalizar a compra", "error");
        return false;
    }

    const items = cartItems.map(i => ({ livro_id: parseInt(i.bookId) }));
    const payload = { items, user_id: parseInt(currentUser.id) };
    console.log("Checkout payload:", JSON.stringify(payload));
    console.log("currentUser:", currentUser);

    try {
        const response = await fetch(`${API_URL}/biblioteca/checkout`, {
            method: 'POST',
            headers: {
                'Content-Type': 'text/plain',
                'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        console.log("Checkout response status:", response.status);
        const text = await response.text();
        console.log("Checkout raw response:", text);

        let data;
        try {
            data = JSON.parse(text);
        } catch (e) {
            console.error("Failed to parse response:", text);
            toast("Erro no servidor: " + text.substring(0, 100), "error");
            return false;
        }

        if (data.sucesso) {
            cartClear();
            toast("Compra realizada com sucesso!");
            return true;
        } else {
            toast(data.mensagem || "Erro ao finalizar compra", "error");
            return false;
        }
    } catch (err) {
        console.error("Checkout fetch error:", err);
        toast("Erro de ligação ao servidor", "error");
        return false;
    }
}

// --- AUTENTICAÇÃO ---

async function login(email, password) {
    const data = await apiFetch('login', {
        method: "POST",
        body: { email, password }
    });
    
    if (data.sucesso) {
        const user = data.dados;
        // Normalização de campos
        user.role = user.papel;
        user.name = user.nome_completo;
        localStorage.setItem("biblio_user", JSON.stringify(user));
        currentUser = user;
        return currentUser;
    } else {
        toast(data.mensagem || "Erro ao fazer login", "error");
        return false;
    }
}

async function register(nome, email, password) {
    const data = await apiFetch('registo', {
        method: "POST",
        body: { nome, email, password }
    });
    
    if (data.sucesso) return true;
    toast(data.mensagem || "Erro ao criar conta", "error");
    throw new Error(data.mensagem);
}

function logout() {
    localStorage.removeItem("biblio_user");
    const path = window.location.pathname;
    if (path.includes('/admin/') || path.includes('/backoffice/')) {
        location.href = "../login.html";
    } else if (path.includes('/pages/')) {
        location.href = "./login.html";
    } else {
        location.href = "./pages/login.html";
    }
}

// --- UI HELPERS ---

function toast(msg, type = "success") {
    const existing = document.querySelector('.toast-notification');
    if (existing) existing.remove();

    const el = document.createElement("div");
    el.className = `toast-notification fixed bottom-4 right-4 p-4 rounded-xl shadow-2xl z-[9999] transition-all transform translate-y-10 opacity-0 font-bold ${
        type === "success" ? "bg-green-600 text-white" : "bg-red-600 text-white"
    }`;
    el.textContent = msg;
    document.body.appendChild(el);
    requestAnimationFrame(() => {
        el.classList.remove("translate-y-10", "opacity-0");
    });
    setTimeout(() => {
        el.classList.add("translate-y-10", "opacity-0");
        setTimeout(() => el.remove(), 500);
    }, 3000);
}

// --- UI RENDERING ---

function renderHeader() {
    const header = document.getElementById("header") || document.getElementById("main-header");
    if (!header) return;

    const isInPages = window.location.pathname.includes('/pages/');
    const isLoggedIn = !!currentUser;
    const userRole = currentUser?.role || 'cliente';
    const userName = currentUser?.name || '';
    const basePath = isInPages ? './' : './pages/';
    const currentPage = window.location.pathname.split('/').pop() || 'catalogo.html';

    const navLinks = `
        <a href="${basePath}catalogo.html" class="${currentPage === 'catalogo.html' ? 'active' : ''}">Catálogo</a>
        <a href="${basePath}biblioteca.html" class="${currentPage === 'biblioteca.html' ? 'active' : ''}">Biblioteca</a>
        ${isLoggedIn && userRole === 'admin' ? `<a href="${basePath}admin/dashboard.html" class="${currentPage === 'dashboard.html' ? 'active' : ''}">Admin</a>` : ''}
        ${isLoggedIn && userRole === 'backoffice' ? `<a href="${basePath}backoffice/dashboard.html" class="${currentPage === 'dashboard.html' ? 'active' : ''}">Backoffice</a>` : ''}
    `;

    const actions = isLoggedIn ? `
        <button class="icon-btn" aria-label="Carrinho" onclick="location.href='${basePath}carrinho.html'" style="position:relative;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
            <span class="cart-badge" id="cart-badge" style="position:absolute;top:-6px;right:-6px;min-width:18px;height:18px;border-radius:9px;background:#e84848;color:white;font-size:10px;font-weight:700;display:inline-flex;align-items:center;justify-content:center;padding:0 4px;box-shadow:0 1px 3px rgba(0,0,0,0.3);">${cartCount() > 0 ? cartCount() : ''}</span>
        </button>
        <button class="icon-btn" aria-label="Pesquisar" onclick="toggleSearch()">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
        </button>
        <a href="${basePath}perfil.html" class="user-pill">
            <span class="user-name">${userName}</span>
        </a>
        <button class="btn-logout" onclick="logout()">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
            Sair
        </button>
    ` : `
        <button class="icon-btn" aria-label="Pesquisar" onclick="toggleSearch()">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
        </button>
        <a href="${basePath}login.html" class="btn-signin">Entrar</a>
    `;

    header.innerHTML = `
        <div class="container">
            <a href="${isInPages ? '../index.html' : './index.html'}" class="logo">BIBLIO</a>
            <nav class="nav-links">${navLinks}</nav>
            <div class="header-actions">
                ${actions}
                <button class="mobile-menu-btn" aria-label="Menu" onclick="toggleMobileMenu()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
                </button>
            </div>
        </div>
    `;
}

function toggleSearch() {
    const searchBar = document.getElementById('search-bar');
    if (!searchBar) {
        const isInPages = window.location.pathname.includes('/pages/');
        const basePath = isInPages ? './' : './pages/';
        window.location.href = basePath + 'catalogo.html';
        return;
    }
    searchBar.classList.toggle('open');
    if (searchBar.classList.contains('open')) {
        const input = document.getElementById('global-search');
        if (input) {
            input.focus();
            const currentQ = new URLSearchParams(window.location.search).get('q') || '';
            input.value = currentQ;
        }
    }
}

function closeSearch() {
    const searchBar = document.getElementById('search-bar');
    if (searchBar) searchBar.classList.remove('open');
    const input = document.getElementById('global-search');
    if (input) input.value = '';
    handleGlobalSearch('');
}

function handleGlobalSearch(query) {
    const url = new URL(window.location.href);
    if (query) {
        url.searchParams.set('q', query);
    } else {
        url.searchParams.delete('q');
    }
    window.history.replaceState({}, '', url);

    if (typeof renderCatalog === 'function') {
        page = 1;
        renderCatalog();
    }
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const searchBar = document.getElementById('search-bar');
        if (searchBar && searchBar.classList.contains('open')) {
            closeSearch();
        }
        const mobileNav = document.getElementById('mobile-nav');
        if (mobileNav && mobileNav.classList.contains('open')) {
            toggleMobileMenu();
        }
    }
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        toggleSearch();
    }
});

function toggleMobileMenu() {
    const nav = document.getElementById('mobile-nav');
    if (!nav) return;
    nav.classList.toggle('open');
    renderMobileUserSection();
}

function renderMobileUserSection() {
    const section = document.getElementById('mobile-user-section');
    if (!section) return;

    if (currentUser) {
        const userInitial = currentUser.name.charAt(0).toUpperCase();
        section.innerHTML = `
            <div class="mobile-user-info">
                <span class="mobile-user-avatar">${userInitial}</span>
                <div>
                    <div class="mobile-user-name">${currentUser.name}</div>
                    <div class="mobile-user-email">${currentUser.email || ''}</div>
                </div>
            </div>
            <button class="mobile-logout" onclick="logout()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                Terminar Sessão
            </button>
        `;
    } else {
        section.innerHTML = `
            <a href="./login.html" style="display:block;text-align:center;padding:0.625rem;border-radius:8px;background:var(--foreground);color:var(--background);font-weight:600;font-size:0.875rem;margin-bottom:0.5rem;">Iniciar sessão</a>
            <a href="./registo.html" style="display:block;text-align:center;padding:0.625rem;border-radius:8px;border:1px solid var(--border);font-weight:600;font-size:0.875rem;">Criar conta</a>
        `;
    }
}

function renderFooter() {
    const footer = document.getElementById("footer") || document.getElementById("main-footer");
    if (!footer) return;
    const isInPages = window.location.pathname.includes('/pages/');
    const basePath = isInPages ? './' : './pages/';

    footer.innerHTML = `
        <div class="container">
            <div class="footer-grid">
                <div>
                    <h4>BIBLIO</h4>
                    <ul>
                        <li><a href="${basePath}catalogo.html">Catálogo</a></li>
                        <li><a href="${basePath}biblioteca.html">Biblioteca</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Conta</h4>
                    <ul>
                        <li><a href="${basePath}login.html">Iniciar sessão</a></li>
                        <li><a href="${basePath}registo.html">Criar conta</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Informações</h4>
                    <ul>
                        <li>Sobre nós</li>
                        <li>Contacto</li>
                    </ul>
                </div>
                <div>
                    <h4>Legal</h4>
                    <ul>
                        <li>Termos de uso</li>
                        <li>Privacidade</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copy">&copy; 2026 BIBLIO. Todos os direitos reservados.</div>
    `;
}

function ratingStarsHTML(rating, size = 14) {
    let html = '';
    for (let i = 1; i <= 5; i++) {
        html += i <= Math.round(rating)
            ? `<svg style="width:${size}px;height:${size}px;color:var(--primary);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>`
            : `<svg style="width:${size}px;height:${size}px;color:var(--border);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>`;
    }
    return html;
}

function bookCardHTML(book) {
    const canRead = book.legivel_no_site && book.pdf_url;
    const canBuy = book.access === 'comprar' || book.access === 'ambos';
    const isLoggedIn = !!currentUser;
    const inCart = cartItems.some(i => i.bookId === book.id);
    const rating = book.rating || 0;
    const ratingTotal = book.ratingTotal || 0;
    return `
        <div class="card overflow-hidden p-0 hover-shadow" style="cursor:pointer;" onclick="location.href='./livro.html?id=${book.id}'">
            <img src="${book.cover}" alt="${book.title}" class="aspect-3-4 w-full object-cover" onerror="this.src='https://picsum.photos/seed/${book.id}/400/600'">
            <div class="p-3">
                <div class="line-clamp-1 font-medium">${book.title}</div>
                <div class="text-xs text-muted">${book.author || getAuthor(book.authorId)?.name || ''}</div>
                <div class="mt-2 flex items-center justify-between">
                    <span class="font-bold text-primary">${formatAOA(book.price)}</span>
                    <span class="flex items-center gap-1">${ratingStarsHTML(rating, 12)}<span class="text-xs text-muted ml-1">${rating > 0 ? rating.toFixed(1) : ''}</span></span>
                </div>
                <div class="mt-2 flex flex-col gap-1">
                    ${canBuy && isLoggedIn && !inCart ? `<button class="btn btn-sm btn-w-full" onclick="event.stopPropagation(); cartAdd('${book.id}')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:4px;"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                        Adicionar ao carrinho
                    </button>` : ''}
                    ${canBuy && isLoggedIn && inCart ? `<span class="btn btn-sm btn-w-full" style="opacity:0.6;cursor:default;">No carrinho</span>` : ''}
                    ${canRead && isLoggedIn ? `<button class="btn btn-sm btn-w-full btn-outline" onclick="event.stopPropagation(); handleLer('${book.id}')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:4px;"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                        Ler
                    </button>` : ''}
                    ${!isLoggedIn ? `<a href="./login.html" class="btn btn-sm btn-w-full" onclick="event.stopPropagation();">Entrar para comprar</a>` : ''}
                </div>
            </div>
        </div>
    `;
}
