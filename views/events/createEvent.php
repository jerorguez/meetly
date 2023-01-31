<?php require_once(__DIR__ . '/../components/header.php') ?>

<?php if (isset($editMode)): ?>

    <form action="../event/update" method="post" class="m-4">
        <input type="text" name="name" id="name" placeholder="Nombre del evento" value="<?= $data['name'] ?>"><br>
        <input type="text" name="description" id="description" placeholder="Descripcion" value="<?= $data['description'] ?>"><br>
        <input type="text" name="place" id="place" placeholder="Lugar" value="<?= $data['place'] ?>"><br>
        <input type="date" name="date" id="date" placeholder="Fecha" value="<?= $data['date'] ?>"><br>
        <input type="hidden" name="id" id="id" value="<?= $data['event_id'] ?>"><br>
        <button type="submit">Edit</button>
    </form>

<?php else: ?>

    <form action="../event/store" method="post" class="m-4">
        <input type="text" name="name" id="name" placeholder="Nombre del evento"><br>
        <input type="text" name="description" id="description" placeholder="Descripcion"><br>
        <input type="text" name="place" id="place" placeholder="Lugar"><br>
        <input type="date" name="date" id="date" placeholder="Fecha"><br>
        <button type="submit">Crear</button>
    </form>

<?php endif; ?>


<?php require_once(__DIR__ . '/../components/footer.php') ?>