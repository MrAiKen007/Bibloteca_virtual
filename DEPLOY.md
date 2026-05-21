# Guia de Deploy - Biblioteca Virtual

## Pré-requisitos
- Conta em uma plataforma de hospedagem gratuita
- Arquivo do banco de dados (`biblioteca_virtual_completo.sql`)

## Plataformas Recomendadas

### 1. InfinityFree (Recomendada)
**URL:** https://www.infinityfree.com/

**Vantagens:**
- PHP + MySQL gratuitos
- Sem expiração
- Painel de controle fácil (cPanel-like)
- 5GB de armazenamento
- Tráfego ilimitado

**Limitações:**
- Sem acesso SSH
- Recursos limitados (CPU/RAM)
- Subdomínio gratuito (seu-site.rf.gd)

### 2. 000webhost
**URL:** https://www.000webhost.com/

**Vantagens:**
- PHP + MySQL gratuitos
- Fácil de usar
- Subdomínio gratuito

**Limitações:**
- Marca d'água no rodapé
- 300MB de armazenamento
- 3GB de tráfego mensal

### 3. AwardSpace
**URL:** https://www.awardspace.com/

**Vantagens:**
- PHP + MySQL
- Sem anúncios forçados
- 1GB de armazenamento

---

## Passo a Passo - InfinityFree

### Passo 1: Criar Conta
1. Acesse https://www.infinityfree.com/
2. Clique em "Register"
3. Crie sua conta com email e senha
4. Verifique seu email

### Passo 2: Criar Site
1. No painel, clique em "Create Account"
2. Escolha um subdomínio (ex: `biblioteca-virtual.rf.gd`)
3. Ou use um domínio próprio se tiver
4. Clique em "Create Account"

### Passo 3: Acessar Painel de Controle
1. Clique em "Open Control Panel" no seu site
2. Você será redirecionado para o painel (similar ao cPanel)

### Passo 4: Configurar Banco de Dados
1. No painel, clique em "MySQL"
2. Clique em "Create Database"
3. Anote as credenciais:
   - **Host:** (ex: `sql123.infinityfree.com`)
   - **Database Name:** (ex: `if0_12345678_biblioteca`)
   - **Username:** (ex: `if0_12345678`)
   - **Password:** (a que você definiu)

### Passo 5: Importar Banco de Dados
1. No painel, clique em "phpMyAdmin"
2. Selecione seu banco de dados no menu lateral
3. Clique na aba "Import"
4. Clique em "Choose File"
5. Selecione o arquivo: `biblioteca/Dump20260514/biblioteca_virtual_completo.sql`
6. Clique em "Go" ou "Executar"
7. Aguarde a importação completar

### Passo 6: Configurar Arquivo .env
1. No painel, vá para "File Manager" ou use FTP
2. Navegue até `htdocs/`
3. Renomeie `.env.example` para `.env`
4. Edite o arquivo `.env` com suas credenciais:

```env
DB_HOST=sql123.infinityfree.com
DB_PORT=3306
DB_NAME=if0_12345678_biblioteca
DB_USER=if0_12345678
DB_PASSWORD=sua_senha_aqui

APP_ENV=production
APP_DEBUG=false
APP_URL=https://biblioipil.infinityfreeapp.com
```

### Passo 7: Upload dos Arquivos
1. No File Manager, navegue até `htdocs/`
2. Delete o arquivo `index.php` padrão (se existir)
3. Faça upload de **todo o conteúdo** da pasta `biblioteca/` para `htdocs/`
4. Certifique-se de que a estrutura fique assim:
   ```
   htdocs/
   ├── .env
   ├── .htaccess
   ├── app/
   ├── config/
   ├── public/
   │   └── index.php  (este é o ponto de entrada)
   ├── rotas/
   └── ...
   ```

**IMPORTANTE:** O arquivo `public/index.php` deve ser movido para a raiz do `htdocs/` ou configure o `.htaccess` para apontar para ele.

### Passo 8: Ajustar Estrutura de Pastas
Como o InfinityFree serve arquivos diretamente do `htdocs/`, você tem duas opções:

**Opção A - Mover index.php para a raiz:**
1. Mova `public/index.php` para `htdocs/index.php`
2. Atualize os caminhos no `index.php` se necessário

**Opção B - Usar .htaccess para redirecionar:**
1. Crie um `.htaccess` na raiz do `htdocs/` com:
   ```apache
   RewriteEngine On
   RewriteRule ^$ public/index.php [L]
   RewriteRule (.*) public/index.php?url=$1 [QSA,L]
   ```

### Passo 9: Testar
1. Acesse seu site: `https://biblioteca-virtual.rf.gd`
2. Teste o login com:
   - **Email:** `admin@biblioteca.com`
   - **Senha:** `admin123` (ou a senha do admin no banco)
3. Verifique se todas as páginas carregam corretamente

---

## Passo a Passo - 000webhost

### Passo 1: Criar Conta
1. Acesse https://www.000webhost.com/
2. Clique em "Sign Up"
3. Crie sua conta

### Passo 2: Criar Site
1. Clique em "Create new site"
2. Escolha um nome para o site
3. Defina uma senha para o painel

### Passo 3: Configurar Banco de Dados
1. No painel, vá para "Databases"
2. Clique em "Create Database"
3. Anote as credenciais

### Passo 4: Importar Banco
1. Clique em "Manage" no banco de dados
2. Isso abrirá o phpMyAdmin
3. Vá para "Import" e selecione o arquivo SQL

### Passo 5: Upload dos Arquivos
1. No painel, vá para "File Manager"
2. Navegue até `public_html/`
3. Faça upload dos arquivos da pasta `biblioteca/`

### Passo 6: Configurar .env
1. Edite o arquivo `.env` com as credenciais do banco
2. Defina `APP_ENV=production` e `APP_DEBUG=false`

---

## Configurações Pós-Deploy

### Segurança
1. **Remova scripts de debug:** Certifique-se de que os arquivos `debug_*.php` e `test_*.php` não estão no servidor
2. **Desative debug:** No `.env`, defina `APP_DEBUG=false`
3. **Troque senhas padrão:** Altere a senha do admin após o primeiro login
4. **HTTPS:** A maioria das plataformas já fornece HTTPS gratuito

### Permissões de Pastas
Defina as seguintes permissões (via FTP ou File Manager):
- `public/uploads/` → 755 (ou 777 se necessário)
- `storage/logs/` → 755
- `.env` → 644 (nunca 777)

### Logs de Erro
Se algo der errado:
1. Verifique os logs de erro no painel da hospedagem
2. Ative temporariamente `APP_DEBUG=true` para ver erros detalhados
3. Verifique se o `.htaccess` está sendo lido (algumas hospedagens precisam ativar mod_rewrite)

---

## Solução de Problemas

### Erro 500 - Internal Server Error
- Verifique se o `.htaccess` está correto
- Verifique as permissões dos arquivos
- Verifique os logs de erro

### Erro de Conexão com Banco
- Verifique as credenciais no `.env`
- Verifique se o banco foi importado corretamente
- Verifique se o host do banco está correto

### Páginas não Carregam (404)
- Verifique se o mod_rewrite está ativado
- Verifique se o `.htaccess` está na pasta correta
- Verifique se o `index.php` está sendo usado como ponto de entrada

### CSS/JS não Carregam
- Verifique os caminhos relativos nos arquivos HTML/PHP
- Verifique se os arquivos estão na pasta correta
- Verifique o cache do navegador

---

## FTP (Alternativa ao File Manager)

Se preferir usar FTP:
1. **Host:** ftp.seu-site.rf.gd (ou o fornecido pela plataforma)
2. **Usuário:** fornecido pela plataforma
3. **Senha:** fornecida pela plataforma
4. **Porta:** 21
5. Use FileZilla ou similar

---

## Domínio Personalizado (Opcional)

Se quiser usar seu próprio domínio:
1. Compre um domínio (ex: Namecheap, GoDaddy)
2. No painel da hospedagem, vá para "Custom Domain"
3. Adicione seu domínio
4. Configure os DNS no registrador do domínio:
   - **Nameservers:** fornecidos pela plataforma de hospedagem
5. Aguarde a propagação DNS (até 48h)

---

## Checklist Final

- [ ] Conta criada na plataforma
- [ ] Banco de dados criado
- [ ] SQL importado com sucesso
- [ ] Arquivos uploadados
- [ ] `.env` configurado
- [ ] `APP_DEBUG=false` em produção
- [ ] HTTPS ativado
- [ ] Login testado
- [ ] Páginas principais testadas
- [ ] Permissões de pastas configuradas
- [ ] Scripts de debug removidos

---

## Suporte

Se precisar de ajuda:
- InfinityFree: https://forum.infinityfree.com/
- 000webhost: https://forum.000webhost.com/
