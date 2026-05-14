<nav>

<?php if (!isset($_SESSION['user_papel'])): ?>

    <!-- Não autenticado -->
    <a href="index.php?url=login">Login</a>

<?php else: ?>

    <!-- ADMIN -->
    <?php if ($_SESSION['user_papel'] === 'admin'): ?>

        <a href="index.php?url=utilizadores">Utilizadores</a> |
        <a href="index.php?url=livros">Livros</a> |
        <a href="index.php?url=autores">Autores</a> |
        <a href="index.php?url=editoras">Editoras</a>

    <!-- BACKOFFICE -->
    <?php elseif ($_SESSION['user_papel'] === 'backoffice'): ?>

        <a href="index.php?url=livros">Livros</a> |
        <a href="index.php?url=autores">Autores</a> |
        <a href="index.php?url=editoras">Editoras</a>

    <!-- CLIENTE -->
    <?php else: ?>

        <a href="index.php?url=biblioteca">Biblioteca</a>

    <?php endif; ?>

    |

    <!-- Sair sempre visível -->
    <a href="index.php?url=logout">Sair</a>

<?php endif; ?>

</nav>

<hr>