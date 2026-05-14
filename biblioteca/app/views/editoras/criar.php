<?php require_once __DIR__ . '/../layouts/menu.php'; ?>

<h1>Criar Editora</h1>

<form method="POST" action="index.php?url=editoras/guardar">

    <label>Nome:</label><br>
    <input type="text" name="nome" required> <br><br>


    <label>País:</label><br>

<select name="pais" required>

    <option value="">Selecione o país</option>

    <!-- África -->
    <option value="Angola">Angola</option>
    <option value="Moçambique">Moçambique</option>
    <option value="Cabo Verde">Cabo Verde</option>
    <option value="São Tomé e Príncipe">São Tomé e Príncipe</option>
    <option value="Guiné-Bissau">Guiné-Bissau</option>
    <option value="África do Sul">África do Sul</option>
    <option value="Nigéria">Nigéria</option>
    <option value="Quénia">Quénia</option>
    <option value="Egito">Egito</option>

    <!-- Europa -->
    <option value="Portugal">Portugal</option>
    <option value="Brasil">Brasil</option>
    <option value="Espanha">Espanha</option>
    <option value="França">França</option>
    <option value="Alemanha">Alemanha</option>
    <option value="Itália">Itália</option>
    <option value="Reino Unido">Reino Unido</option>

    <!-- América -->
    <option value="Estados Unidos">Estados Unidos</option>
    <option value="Canadá">Canadá</option>
    <option value="México">México</option>
    <option value="Argentina">Argentina</option>
    <option value="Colômbia">Colômbia</option>
    <option value="Chile">Chile</option>
    <option value="Peru">Peru</option>

    <!-- Ásia -->
    <option value="China">China</option>
    <option value="Japão">Japão</option>
    <option value="Coreia do Sul">Coreia do Sul</option>
    <option value="Índia">Índia</option>
    <option value="Arábia Saudita">Arábia Saudita</option>
    <option value="Emirados Árabes Unidos">Emirados Árabes Unidos</option>

    <!-- Oceania -->
    <option value="Austrália">Austrália</option>
    <option value="Nova Zelândia">Nova Zelândia</option>

</select>

    <br><br>

    <button type="submit">
        Guardar
    </button>

</form>