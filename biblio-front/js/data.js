// Configurações Globais
const GENRES = [
  "Ficção", "Romance", "Mistério", "Fantasia", "Ficção Científica",
  "Biografia", "História", "Autoajuda", "Negócios", "Tecnologia",
  "Poesia", "Infantil",
];

const TAGS = [
  "bestseller", "novidade", "clássico", "premiado", "português",
  "tradução", "ilustrado", "audiolivro", "saga",
];

// Estas variáveis serão preenchidas pelo app.js via API
let authors = [];
let publishers = [];
let books = [];
let users = [];
let orders = [];
let topSelling = [];
let salesByMonth = [];
let currentUser = JSON.parse(localStorage.getItem("biblio_user")) || null;

// Adicionar campos de compatibilidade se o usuário existir
if (currentUser) {
    currentUser.role = currentUser.papel || currentUser.role;
    currentUser.name = currentUser.nome_completo || currentUser.name;
}

// Funções Utilitárias
const getAuthor = (id) => authors.find(a => String(a.id) === String(id)) || { name: "Autor Desconhecido" };
const getPublisher = (id) => publishers.find(p => String(p.id) === String(id)) || { name: "Editora Desconhecida" };
const getBook = (id) => books.find(b => String(b.id) === String(id));

const formatAOA = (v) => new Intl.NumberFormat("pt-AO", { style: "currency", currency: "AOA" }).format(v);
const formatEUR = (v) => new Intl.NumberFormat("pt-PT", { style: "currency", currency: "EUR" }).format(v);
const formatDate = (iso) => iso ? new Intl.DateTimeFormat("pt-PT", { dateStyle: "medium" }).format(new Date(iso)) : "---";
