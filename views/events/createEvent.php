<?php 
    require_once(__DIR__ . '/../components/header.php');
    require_once(__DIR__ . '/../components/headerMeetly.php');
?>

<div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
            <div class="card text-black border-0">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                            
                            <p class="text-center h1 fw-bold mb-3 mx-1 mx-md-4 mt-4 text-primary"><?= isset($editMode) ? 'Edita tu evento' : '¡Crea tu evento!' ?></p>

                            <div class="text-bg-danger rounded-2 mb-3 text-center"><?= $errorMsg ?? '' ?></div>

                            <?php if (isset($editMode)): ?>

                                <form action="edit" method="post" class="mx-1 mx-md-4">

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?= $data['name'] ?>">
                                        <label for="name" class="text-secondary">¿Cómo se llama tu evento?</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="<?= $data['description'] ?>">
                                        <label for="description" class="text-secondary">Añade una pequeña descripción</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="place" id="place" placeholder="Place" value="<?= $data['place'] ?>">
                                        <label for="place" class="text-secondary">¿Donde se realizará?</label> 
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control" name="date" id="date" placeholder="Date" value="<?= $data['date']?>">
                                        <label for="date" class="text-secondary">¿Cuándo?</label>
                                    </div>

                                    <div class="text-end">
                                        <input type="hidden" name="id" value="<?= $data['event_id'] ?>">
                                        <input type="hidden" name="edit" value="edit">
                                        <button type="submit"class="btn btn-primary">Editar</button>
                                    </div>

                                </form>

                            <?php else: ?>

                                <form action="create" method="post" class="mx-1 mx-md-4">
    
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?= $_POST['name'] ?? '' ?>" >
                                        <label for="name" class="text-secondary">¿Cómo se llama tu evento?</label>
                                    </div>
    
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="<?= $_POST['description'] ?? '' ?>" >
                                        <label for="description" class="text-secondary">Añade una pequeña descripción</label>
                                    </div>
    
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="place" id="place" placeholder="Place" value="<?= $_POST['place'] ?? '' ?>" >
                                        <label for="place" class="text-secondary">¿Donde se realizará?</label> 
                                    </div>
    
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control" name="date" id="date" placeholder="Date" value="<?= $_POST['date'] ?? '' ?>" >
                                        <label for="date" class="text-secondary">¿Cuándo?</label>
                                    </div>
    
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </div>
    
                                </form>
                            <?php endif; ?>

                        </div>
                        <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items order-1 order-lg-2 d-none-md">
                            <img src="../../assets/media/event_create.svg" class="img-fluid" alt="Meetly">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once(__DIR__ . '/../components/footer.php') ?>