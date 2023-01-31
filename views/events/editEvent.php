<?php require_once(__DIR__ . '/../components/header.php') ?>

<form action="../event/store" method="post" class="m-4">
    <input type="text" name="name" id="name" placeholder="Nombre del evento"><br>
    <input type="text" name="description" id="description" placeholder="Descripcion"><br>
    <input type="text" name="place" id="place" placeholder="Lugar"><br>
    <input type="date" name="date" id="date" placeholder="Fecha"><br>
    <button type="submit">Crear</button>
</form>

<?php require_once(__DIR__ . '/../components/footer.php') ?>