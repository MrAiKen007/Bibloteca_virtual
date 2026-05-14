const STORAGE = { AUTH: "biblio.auth.user", CART: "biblio.cart", LIB: "biblio.library" };

let currentUser = null;
try {
  const raw = localStorage.getItem(STORAGE.AUTH);
  currentUser = raw ? JSON.parse(raw) : null;
} catch { currentUser = null; }

function saveUser() {
  if (currentUser) localStorage.setItem(STORAGE.AUTH, JSON.stringify(currentUser));
  else localStorage.removeItem(STORAGE.AUTH);
}

function login(email, password) {
  let role = "cliente";
  if (email.toLowerCase().startsWith("admin")) role = "admin";
  else if (email.toLowerCase().startsWith("bo")) role = "backoffice";
  const existing = users.find(u => u.email.toLowerCase() === email.toLowerCase());
  currentUser = existing ?? {
    id: "u" + Math.random().toString(36).slice(2, 8),
    name: email.split("@")[0],
    email, role, active: true,
    createdAt: new Date().toISOString(),
    avatar: `https://i.pravatar.cc/100?u=${email}`,
  };
  saveUser();
  return currentUser;
}

function register(name, email, password) {
  currentUser = {
    id: "u" + Math.random().toString(36).slice(2, 8),
    name, email, role: "cliente", active: true,
    createdAt: new Date().toISOString(),
    avatar: `https://i.pravatar.cc/100?u=${email}`,
  };
  saveUser();
  return currentUser;
}

function logout() { currentUser = null; saveUser(); }
function isAuthenticated() { return !!currentUser; }
function getRole() { return currentUser?.role ?? null; }

let cartItems = [];
let library = [];
try { cartItems = JSON.parse(localStorage.getItem(STORAGE.CART) || "[]"); } catch { cartItems = []; }
try { library = JSON.parse(localStorage.getItem(STORAGE.LIB) || "[]"); } catch { library = []; }

function saveCart() { localStorage.setItem(STORAGE.CART, JSON.stringify(cartItems)); }
function saveLibrary() { localStorage.setItem(STORAGE.LIB, JSON.stringify(library)); }

function cartAdd(bookId) {
  if (!cartItems.find(i => i.bookId === bookId)) { cartItems.push({ bookId, qty: 1 }); saveCart(); }
}
function cartRemove(bookId) { cartItems = cartItems.filter(i => i.bookId !== bookId); saveCart(); }
function cartClear() { cartItems = []; saveCart(); }
function cartCount() { return cartItems.length; }
function cartSubtotal() { return cartItems.reduce((s, i) => s + (getBook(i.bookId)?.price ?? 0) * i.qty, 0); }
function cartPurchase() {
  library = Array.from(new Set([...library, ...cartItems.map(i => i.bookId)]));
  cartItems = []; saveCart(); saveLibrary();
}
function isInLibrary(bookId) { return library.includes(bookId); }

function toast(message, type = "success") {
  const container = document.getElementById("toast-container") || (() => {
    const el = document.createElement("div"); el.id = "toast-container"; el.className = "toast-container";
    document.body.appendChild(el); return el;
  })();
  const t = document.createElement("div"); t.className = `toast toast-${type}`; t.textContent = message;
  container.appendChild(t);
  setTimeout(() => { t.style.opacity = "0"; setTimeout(() => t.remove(), 300); }, 3000);
}

function renderNavbar() {
  const header = document.getElementById("header");
  if (!header) return;
  const count = cartCount();
  const user = currentUser;
  header.innerHTML = `
    <div class="container">
      <div class="flex items-center gap-8">
        <a href="./catalogo.html" class="logo">BIBLIO</a>
        <nav class="nav-links">
          <a href="./catalogo.html" class="${isActive('catalogo') ? 'active' : ''}">Catálogo</a>
          <a href="./biblioteca.html" class="${isActive('biblioteca') ? 'active' : ''}">Minha Biblioteca</a>
        </nav>
      </div>
      <div class="header-actions">
        <button class="icon-btn" onclick="toggleSearch()" aria-label="Pesquisar"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg></button>
        <button class="icon-btn relative" aria-label="Favoritos"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg></button>
        <a href="./carrinho.html" class="icon-btn relative" aria-label="Carrinho">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
          ${count > 0 ? `<span class="cart-badge">${count}</span>` : ""}
        </a>
        <div class="dropdown" id="user-dropdown">
          <button class="icon-btn" onclick="toggleDropdown()" aria-label="Conta"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></button>
          <div class="dropdown-menu">
            ${user ? `
              <div class="dropdown-item text-muted truncate">${user.name}</div>
              <div class="dropdown-sep"></div>
              <a href="./perfil.html" class="dropdown-item">Perfil</a>
              <a href="./biblioteca.html" class="dropdown-item">Minha Biblioteca</a>
              ${user.role === "backoffice" ? `<a href="./backoffice/dashboard.html" class="dropdown-item">Backoffice</a>` : ""}
              ${user.role === "admin" ? `<a href="./admin/dashboard.html" class="dropdown-item">Admin</a>` : ""}
              <div class="dropdown-sep"></div>
              <a href="#" class="dropdown-item" onclick="handleLogout(); return false;">Terminar sessão</a>
            ` : `
              <a href="./login.html" class="dropdown-item">Iniciar sessão</a>
              <a href="./registo.html" class="dropdown-item">Criar conta</a>
              <div class="dropdown-sep"></div>
              <a href="./backoffice-login.html" class="dropdown-item">Acesso Backoffice</a>
            `}
          </div>
        </div>
        <button class="icon-btn mobile-menu-btn" onclick="toggleMobileMenu()" aria-label="Menu"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg></button>
      </div>
    </div>
    <div class="search-bar" id="search-bar">
      <div class="container">
        <input type="text" class="input" id="search-input" placeholder="Procurar livros, autores..." onkeydown="if(event.key==='Enter') doSearch()">
        <button class="btn btn-sm" onclick="doSearch()">Procurar</button>
      </div>
    </div>
  `;
}

function renderFooter() {
  const footer = document.getElementById("footer");
  if (!footer) return;
  footer.innerHTML = `
    <div class="container">
      <div class="footer-grid">
        <div>
          <div class="logo">BIBLIO</div>
          <p class="text-sm text-muted mt-3">A sua biblioteca digital — leia, descubra e adquira livros de autores lusófonos e do mundo.</p>
        </div>
        <div>
          <h4>Catálogo</h4>
          <ul><li>Novidades</li><li>Promoções</li><li>Géneros</li><li>Autores</li></ul>
        </div>
        <div>
          <h4>Sobre</h4>
          <ul><li>A biblioteca</li><li>Blog</li><li>Políticas</li><li>Contacto</li></ul>
        </div>
        <div>
          <h4>Redes</h4>
          <ul><li>Instagram</li><li>Facebook</li><li>Twitter</li></ul>
        </div>
      </div>
      <div class="footer-copy">© ${new Date().getFullYear()} BIBLIO — Todos os direitos reservados.</div>
    </div>
  `;
}


function toggleDropdown() { document.getElementById("user-dropdown")?.classList.toggle("open"); }
function toggleSearch() { document.getElementById("search-bar")?.classList.toggle("open"); }
function doSearch() {
  const q = document.getElementById("search-input")?.value;
  if (q) { location.href = `./catalogo.html?q=${encodeURIComponent(q)}`; }
}
function toggleMobileMenu() { document.getElementById("mobile-nav")?.classList.toggle("open"); }
function handleLogout() { logout(); location.href = "./login.html"; }
function isActive(page) { return location.pathname.includes(page); }

function ratingStarsHTML(value, size = 14) {
  const full = Math.floor(value);
  const half = value - full >= 0.25 && value - full < 0.75;
  let html = `<span class="rating-stars" aria-label="Avaliação ${value} de 5">`;
  for (let i = 0; i < 5; i++) {
    const filled = i < full || (i === full && half);
    html += `<svg class="rating-star ${filled ? 'filled' : 'empty'}" width="${size}" height="${size}" viewBox="0 0 24 24" fill="${filled ? 'currentColor' : 'none'}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>`;
  }
  html += "</span>";
  return html;
}

function bookCardHTML(book) {
  const author = getAuthor(book.authorId);
  const onSale = !!book.oldPrice;
  const canBuy = book.access !== "ler";
  const canRead = book.access !== "comprar";
  return `
    <div class="card overflow-hidden hover-shadow" style="display:flex;flex-direction:column;height:100%;">
      <a href="./livro.html?id=${book.id}" class="relative block aspect-3-4 overflow-hidden bg-secondary">
        <img src="${book.cover}" alt="${book.title}" class="w-full h-full object-cover transition-transform group-hover-scale" />
        ${onSale ? `<span class="badge badge-primary absolute" style="right:8px;top:8px;">SALE</span>` : ""}
        <div class="absolute" style="left:8px;top:8px;display:flex;gap:4px;">
          ${canBuy ? `<span class="badge" style="font-size:10px;text-transform:uppercase;">Comprar</span>` : ""}
          ${canRead ? `<span class="badge" style="font-size:10px;text-transform:uppercase;">Ler</span>` : ""}
        </div>
      </a>
      <div class="p-4" style="display:flex;flex-direction:column;flex:1;gap:0.5rem;">
        <a href="./livro.html?id=${book.id}" class="line-clamp-2 font-medium hover-text-primary">${book.title}</a>
        <div class="text-xs text-muted">${author?.name || ""}</div>
        ${ratingStarsHTML(book.rating)}
        <div style="margin-top:auto;display:flex;align-items:flex-end;justify-content:space-between;gap:0.5rem;padding-top:0.5rem;">
          <div>
            ${onSale ? `<span class="text-xs text-muted line-through" style="margin-right:0.5rem;">${formatAOA(book.oldPrice)}</span>` : ""}
            <span class="font-semibold text-primary">${formatAOA(book.price)}</span>
          </div>
          ${canBuy
            ? `<button class="btn btn-sm btn-outline" onclick="cartAdd('${book.id}'); toast('Adicionado ao carrinho'); renderNavbar();"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg></button>`
            : `<a href="./livro.html?id=${book.id}" class="btn btn-sm btn-outline"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg></a>`}
        </div>
      </div>
    </div>
  `;
}

document.addEventListener("DOMContentLoaded", () => {
  renderNavbar();
  renderFooter();
  renderAdminMobileHeader();

  document.addEventListener("click", (e) => {
    if (!e.target.closest("#user-dropdown")) document.getElementById("user-dropdown")?.classList.remove("open");
    if (!e.target.closest("#mobile-nav") && !e.target.closest(".mobile-menu-btn")) document.getElementById("mobile-nav")?.classList.remove("open");
  });
});

function renderAdminMobileHeader() {
  const mainContent = document.querySelector(".admin-layout .main-content");
  const sidebar = document.querySelector(".sidebar");
  if (!mainContent || !sidebar) return;

  const header = document.createElement("div");
  header.className = "admin-mobile-header md-hidden p-4 border-b bg-card flex items-center gap-3";
  header.innerHTML = `
    <button class="icon-btn" onclick="toggleAdminSidebar()" aria-label="Menu">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
    </button>
    <div class="font-serif font-bold" style="font-size: 1.125rem;">${sidebar.querySelector('.sidebar-logo')?.textContent || 'BIBLIO'}</div>
  `;
  mainContent.insertBefore(header, mainContent.firstChild);

  const overlay = document.createElement("div");
  overlay.className = "sidebar-overlay";
  overlay.onclick = toggleAdminSidebar;
  document.body.appendChild(overlay);
}

function toggleAdminSidebar() {
  document.querySelector(".sidebar")?.classList.toggle("open");
  document.querySelector(".sidebar-overlay")?.classList.toggle("open");
}
