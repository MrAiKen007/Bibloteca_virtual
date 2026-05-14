<?php require_once __DIR__ . '/../layouts/menu.php'; ?>

<h1>Criar Autor</h1>

<form method="POST" action="index.php?url=autores/guardar">

    <label>Nome:</label><br>

    <input
        type="text"
        name="nome"
        required
    >

    <br><br>

    <label>Biografia:</label><br>

    <textarea
        name="biografia"
        rows="5"
        cols="40"
    ></textarea>

    <br><br>

    <button type="submit">
        Guardar
    </button>

</form>