<?php require_once __DIR__ . '/../layouts/menu.php'; ?>

<h1>Biblioteca</h1>

<hr>

<?php if (empty($livros)): ?>

    <p>Nenhum livro disponível.</p>

<?php else: ?>

    <?php foreach ($livros as $livro): ?>

        <div style="margin-bottom: 30px;">

            <?php if (!empty($livro['url_imagem_capa'])): ?>

                <img 
                    src="<?= $livro['url_imagem_capa']; ?>" 
                    width="120"
                >

                <br><br>

            <?php endif; ?>

            <strong>
                <?= htmlspecialchars($livro['titulo']); ?>
            </strong>

            <br>

            ISBN:
            <?= htmlspecialchars($livro['isbn']); ?>

            <br>

            Idioma:
            <?= htmlspecialchars($livro['idioma']); ?>

            <br>

            Preço:
            <?= number_format($livro['preco'], 2, ',', '.'); ?> kz

        </div>

        <hr>

    <?php endforeach; ?>

<?php endif; ?>