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
                    <span class="fw-bold">¡Vaya!</span>
                    Parace que no hay eventos disponibles
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
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require_once(__DIR__ . '/../components/footer.php') ?>