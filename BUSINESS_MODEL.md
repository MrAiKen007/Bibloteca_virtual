# Modelo de Negócio - Biblioteca Virtual

## Visão Geral

A **Biblioteca Virtual** é uma plataforma digital de compra, gestão e leitura de livros online. Funciona como uma livraria digital com painel administrativo, permitindo que utilizadores comprem livros, leiam online (PDF) e geram a sua biblioteca pessoal, enquanto administradores e equipa de backoffice gerem o catálogo, utilizadores e acompanham as vendas.

---

## O Que o App Faz

### Para Clientes (Utilizadores Finais)
- **Registo e Login** - Criação de conta com autenticação por email
- **Explorar Catálogo** - Navegar por livros com capas, sinopses, autores, editoras e avaliações
- **Comprar Livros** - Compra individual ou em lote (checkout de carrinho)
- **Minha Biblioteca** - Acervo pessoal de livros comprados
- **Leitura Online** - Ler livros diretamente no navegador (se disponíveis em PDF)
- **Avaliar Livros** - Sistema de rating/notas para livros
- **Registo de Leitura** - Histórico de livros lidos/acessados

### Para Administradores
- **Dashboard** - Estatísticas de vendas, receita total, livros mais vendidos, vendas por mês
- **Gestão de Livros** - CRUD completo (criar, editar, eliminar soft-delete)
- **Gestão de Autores** - CRUD de autores
- **Gestão de Editoras** - CRUD de editoras
- **Gestão de Utilizadores** - CRUD de utilizadores com papéis (admin, backoffice, cliente)
- **Auditoria** - Registos de atividade recente no sistema

### API REST
O sistema expõe uma API completa para operações de:
- Autenticação e registo
- Livros (listar, detalhes, PDF, CRUD, avaliações)
- Autores e Editoras (CRUD)
- Utilizadores
- Biblioteca pessoal (checkout, compra, leitura, verificação de posse)
- Estatísticas do dashboard
- Auditoria

---

## Modelo de Negócio

### Tipo
**E-commerce de Conteúdo Digital** - Venda de livros digitais (e-books/PDF) com acesso online.

### Fonte de Receita
- **Venda direta de livros digitais** - Cada livro tem um preço definido e o utilizador compra acesso permanente
- **Leitura online** - Livros marcados como `legivel_no_site` podem ser lidos no navegador
- **Download de PDF** - Livros com `caminho_pdf` permitem download/apresentação do ficheiro

### Segmentos de Clientes
| Papel | Descrição |
|-------|-----------|
| **Cliente** | Utilizador final que compra e lê livros |
| **Admin** | Gestor total do sistema - catálogo, utilizadores, finanças |
| **Backoffice** | Equipa operacional - gestão de conteúdo e monitorização |

### Proposta de Valor
- **Centralização** - Todo o catálogo num único lugar
- **Acesso imediato** - Compra e leitura instantânea
- **Gestão eficiente** - Painel admin com dados de vendas e métricas
- **Experiência de leitura** - Leitura online sem necessidade de download

---

## Arquitetura Técnica

### Stack
- **Backend**: PHP puro com padrão MVC
- **Base de Dados**: MySQL (PDO)
- **Frontend**: Aplicação separada (`biblio-front/`) - provavelmente React/Vue
- **Servidor**: XAMPP (Apache + MySQL)

### Estrutura MVC
```
biblioteca/
├── app/
│   ├── core/          # Router, BaseDados, Resposta
│   ├── controladores/ # Lógica de negócio (8 controladores)
│   ├── modelos/       # Acesso a dados (6 modelos)
│   ├── middlewares/   # Autorização por papéis
│   └── views/         # Templates PHP
├── rotas/             # Definição de rotas (web.php)
├── config/            # Configuração da base de dados
├── migrations/        # Migrações e seeds
└── public/            # Entry point (index.php)
```

### Entidades Principais
| Entidade | Função |
|----------|--------|
| **Utilizadores** | Utilizadores do sistema com papéis e autenticação |
| **Livros** | Catálogo com preço, ISBN, autor, editora, PDF, capa |
| **Autores** | Autores dos livros |
| **Editoras** | Editoras/publicadoras |
| **Pedidos** | Registo de compras com preço pago e estado |
| **Avaliações** | Ratings/notas dos utilizadores nos livros |
| **Auditoria** | Log de atividades do sistema |

---

## Análise SWOT

### Forças
- Arquitetura MVC organizada e separada
- API REST completa para frontend independente
- Sistema de papéis (RBAC) para controlo de acesso
- Soft-delete para preservação de dados
- Sistema de avaliação de livros
- Dashboard com métricas de vendas

### Fraquezas
- README praticamente vazio (documentação fraca)
- Sem sistema de pagamento real (checkout simula compra direta)
- Sem proteção CSRF visível
- Sem paginação nas listagens
- Código em português misturado com termos técnicos em inglês
- Sem testes automatizados visíveis

### Oportunidades
- Integração com gateway de pagamento real (Stripe, PayPal)
- Sistema de subscrição/membership
- Recomendações baseadas em histórico de leitura
- App mobile com a mesma API
- Sistema de wishlist/favoritos
- Cupões de desconto e promoções

### Ameaças
- Concorrência com plataformas estabelecidas (Kindle, Kobo, Google Books)
- Pirataria de conteúdo digital
- Escalabilidade limitada pela arquitetura PHP puro
- Sem rate limiting na API

---

## Fluxo de Negócio Principal

```
1. Utilizador regista-se → Login
2. Explora catálogo de livros → Visualiza detalhes
3. Adiciona ao carrinho → Checkout
4. Compra realizada → Registo em `pedidos`
5. Livro aparece em "Minha Biblioteca"
6. Pode ler online (se legivel_no_site = 1)
7. Pode avaliar o livro
8. Admin vê métricas no dashboard
```

---

## Conclusão

A Biblioteca Virtual é um **MVP funcional de uma livraria digital** com as funcionalidades essenciais: catálogo, compra, leitura e gestão administrativa. O modelo de negócio baseia-se na **venda direta de e-books**, com potencial para evoluir para subscrições, recomendações inteligentes e integração com pagamentos reais. A arquitetura MVC com API REST permite escalar o frontend independentemente do backend, o que é uma decisão técnica sólida.
