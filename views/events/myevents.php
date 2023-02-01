<?php 
require_once(__DIR__ . '/../components/header.php');
require_once(__DIR__ . '/../components/headerMeetly.php');
?>

    <div class="container">
        <?php if (empty($response)): ?>
            <section class="d-flex align-items-center justify-content-center">
                <div class="text-center">
                    <h1 class="display-1 fw-bold text-primary">:[</h1>
                    <p class="lead">
                        <span class="fw-bold">¡Ups!</span>
                        Parace que no has creado eventos
                    </p>
                </div>
            </section>
        <?php else: ?>
            <?php foreach ($response as $data): ?>    
                <div class="card m-3">
                    <div class="card-header">
                        <h5 class="text-capitalize"><?= $data['name'] ?></h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><span class="fw-bold">Descripción:</span><br><?= $data['description'] ?></p>
                        <p class="card-text"><span class="fw-bold">Asistentes:</span> <?= $data['participants'] ?></p>
                        <p class="card-text"><span class="fw-bold">Lugar:</span> <?= $data['place'] ?></p>
                        <p class="card-text text-capitalize"><span class="fw-bold">Organizador:</span> <?= $data['creator'] ?></p>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <p class="m-0"><span class="fw-bold">Fecha: </span><?= $data['date'] ?></p>
                        <div class="d-flex">
                            <form action="edit" method="post">
                                <input type="hidden" name="id" value="<?= $data['event_id'] ?>">
                                <button type="submit" class="btn btn-primary">Editar</button>
                            </form>
                            <form action="<?= $data['event_id'] ?>" method="post">
                                <input type="hidden" name="_method" value="delete">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

<?php require_once(__DIR__ . '/../components/footer.php') ?>