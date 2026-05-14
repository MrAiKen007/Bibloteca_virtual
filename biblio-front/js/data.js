const GENRES = [
  "Ficção", "Romance", "Mistério", "Fantasia", "Ficção Científica",
  "Biografia", "História", "Autoajuda", "Negócios", "Tecnologia",
  "Poesia", "Infantil",
];

const TAGS = [
  "bestseller", "novidade", "clássico", "premiado", "português",
  "tradução", "ilustrado", "audiolivro", "saga",
];

const authors = [
  { id: "a1", name: "José Saramago", bio: "Escritor português laureado com o Nobel da Literatura em 1998.", photo: "https://i.pravatar.cc/200?img=12" },
  { id: "a2", name: "Mia Couto", bio: "Romancista moçambicano, vencedor do Prémio Camões.", photo: "https://i.pravatar.cc/200?img=15" },
  { id: "a3", name: "Clarice Lispector", bio: "Uma das escritoras mais influentes do século XX.", photo: "https://i.pravatar.cc/200?img=23" },
  { id: "a4", name: "Fernando Pessoa", bio: "Poeta, escritor e filósofo português.", photo: "https://i.pravatar.cc/200?img=33" },
  { id: "a5", name: "Pepetela", bio: "Escritor angolano premiado pela sua obra histórica.", photo: "https://i.pravatar.cc/200?img=51" },
  { id: "a6", name: "Chimamanda Adichie", bio: "Romancista nigeriana, autora de Americanah.", photo: "https://i.pravatar.cc/200?img=49" },
];

const publishers = [
  { id: "p1", name: "Caminho", country: "Portugal" },
  { id: "p2", name: "Companhia das Letras", country: "Brasil" },
  { id: "p3", name: "Tinta-da-China", country: "Portugal" },
  { id: "p4", name: "Editorial Nzila", country: "Angola" },
];

const cover = (seed) => `https://picsum.photos/seed/${seed}/400/600`;
const synopsis = "Uma narrativa envolvente que mistura realismo e poesia, conduzindo o leitor por personagens memoráveis e paisagens vívidas. Uma obra que permanece muito além da última página.";

const titles = [
  "O Eco do Silêncio", "Cidades Invisíveis", "Sob o Céu de Cinzas", "Memórias do Vento",
  "A Casa de Papel", "Antes do Amanhecer", "O Último Capítulo", "Cartas Sem Resposta",
  "Mar de Estrelas", "A Hora Certa", "Dança das Sombras", "O Jardim Secreto",
  "Vidas Cruzadas", "Caminho de Pedras", "O Silêncio dos Anjos", "Eternamente Tu",
  "Quando o Sol Cai", "A Voz da Floresta", "Estrangeiros em Casa", "Os Dias Longos",
  "Pássaros de Aço", "A Promessa Quebrada", "Outono em Flor", "O Mapa do Tempo",
];

const books = Array.from({ length: 24 }).map((_, i) => {
  const accessChoices = ["comprar", "ler", "ambos"];
  const access = accessChoices[i % 3];
  const oldPrice = i % 4 === 0 ? +(24.9 + (i % 5)).toFixed(2) : undefined;
  const price = oldPrice ? +(oldPrice - 5).toFixed(2) : +(14.9 + (i % 8)).toFixed(2);
  const author = authors[i % authors.length];
  const publisher = publishers[i % publishers.length];
  return {
    id: `b${i + 1}`,
    title: titles[i],
    authorId: author.id,
    publisherId: publisher.id,
    cover: cover(`book${i + 1}`),
    synopsis,
    isbn: `978-989-${1000 + i}-${10 + i}-${i % 10}`,
    language: i % 5 === 0 ? "Inglês" : "Português",
    pages: 180 + (i * 13) % 300,
    year: 2015 + (i % 10),
    genres: [GENRES[i % GENRES.length], GENRES[(i + 3) % GENRES.length]],
    tags: [TAGS[i % TAGS.length], TAGS[(i + 2) % TAGS.length]],
    access,
    price,
    oldPrice,
    rating: +(3.5 + (i % 3) * 0.5).toFixed(1),
    reviewsCount: 12 + (i * 7) % 80,
    reviews: [
      { id: "r1", user: "Ana M.", rating: 5, comment: "Adorei do início ao fim!", date: "2025-09-12" },
      { id: "r2", user: "Carlos P.", rating: 4, comment: "Muito bem escrito, recomendo.", date: "2025-08-30" },
      { id: "r3", user: "Inês T.", rating: 4, comment: "Uma leitura envolvente.", date: "2025-07-22" },
    ],
    status: i % 7 === 0 ? "rascunho" : i % 11 === 0 ? "arquivado" : "publicado",
    createdAt: new Date(2025, (i * 2) % 12, 1 + (i % 27)).toISOString(),
    pdfUrl: "https://www.africau.edu/images/default/sample.pdf",
  };
});

const users = [
  { id: "u1", name: "Admin Geral", email: "admin@biblio.pt", role: "admin", active: true, createdAt: "2025-01-15", avatar: "https://i.pravatar.cc/100?img=1" },
  { id: "u2", name: "Operador BO", email: "bo@biblio.pt", role: "backoffice", active: true, createdAt: "2025-02-10", avatar: "https://i.pravatar.cc/100?img=8" },
  { id: "u3", name: "Maria Silva", email: "maria@cliente.pt", role: "cliente", active: true, createdAt: "2025-03-05", avatar: "https://i.pravatar.cc/100?img=20" },
  { id: "u4", name: "João Costa", email: "joao@cliente.pt", role: "cliente", active: true, createdAt: "2025-04-18", avatar: "https://i.pravatar.cc/100?img=22" },
  { id: "u5", name: "Beatriz Nunes", email: "bea@cliente.pt", role: "cliente", active: false, createdAt: "2025-05-22", avatar: "https://i.pravatar.cc/100?img=24" },
  { id: "u6", name: "Pedro Lopes (BO pendente)", email: "pedro@biblio.pt", role: "backoffice", active: false, createdAt: "2026-04-30", avatar: "https://i.pravatar.cc/100?img=25" },
];

const orders = [
  { id: "o1", userId: "u3", date: "2026-04-20", items: [{ bookId: "b1", price: 19.9 }, { bookId: "b3", price: 14.9 }], total: 34.8, status: "pago" },
  { id: "o2", userId: "u4", date: "2026-04-22", items: [{ bookId: "b5", price: 19.9 }], total: 19.9, status: "pago" },
  { id: "o3", userId: "u3", date: "2026-04-28", items: [{ bookId: "b8", price: 22.9 }], total: 22.9, status: "pago" },
  { id: "o4", userId: "u5", date: "2026-05-01", items: [{ bookId: "b2", price: 18.9 }], total: 18.9, status: "pendente" },
];

const salesByMonth = [
  { month: "Nov", vendas: 1200 },
  { month: "Dez", vendas: 1800 },
  { month: "Jan", vendas: 1500 },
  { month: "Fev", vendas: 2100 },
  { month: "Mar", vendas: 2500 },
  { month: "Abr", vendas: 3100 },
];

const topSelling = books.slice(0, 6).map((b, i) => ({ titulo: b.title.split(" ").slice(0, 2).join(" "), vendas: 120 - i * 14 }));

const getAuthor = (id) => authors.find(a => a.id === id);
const getPublisher = (id) => publishers.find(p => p.id === id);
const getBook = (id) => books.find(b => b.id === id);

const formatAOA = (v) => new Intl.NumberFormat("pt-AO", { style: "currency", currency: "AOA" }).format(v);
const formatDate = (iso) => new Intl.DateTimeFormat("pt-PT", { dateStyle: "medium" }).format(new Date(iso));
