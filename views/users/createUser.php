<?php require_once(__DIR__ . '/../components/header.php') ?>

<section class="text-center text-lg-start">

    <style>
        
        .cascading-right { margin-right: -50px; }

        @media (max-width: 991.98px) {
        .cascading-right { margin-right: 0; }
        }

    </style>

    <div class="container py-4">
        <div class="row g-0 align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="card cascading-right" style="
                    background: hsla(0, 0%, 100%, 0.55);
                    backdrop-filter: blur(30px);
                ">
                    <div class="card-body p-5 shadow-5">

                    <h2 class="fw-bold mb-2">Registrate en Meetly</h2>

                    <div class="text-bg-danger rounded-2 mb-3 text-center"><?= $errorMsg ?? '' ?></div>

                    <form action = "../user/create" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="text" name="name" id="name" class="form-control" value="<?= $_POST['name'] ?? '' ?>"/>
                                    <label class="form-label" for="name">Nombre</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="text" name="surname_1" id="surname_1" class="form-control" value="<?= $_POST['surname_1'] ?? '' ?>" />
                                    <label class="form-label" for="surname_1">Apellido</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="text" name="surname_2" id="surname_2" class="form-control" value="<?= $_POST['surname_2'] ?? '' ?>"/>
                                    <label class="form-label" for="surname_2">Segundo Apellido <sup class="text-primary">( Opcional )</sup></label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="email" name="email" id="email" class="form-control"  value="<?= $_POST['email'] ?? '' ?>"/>
                                    <label class="form-label" for="email">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="password" name="password" id="password" class="form-control"/>
                                    <label class="form-label" for="password">Contraseña</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="password" name="password_check" id="password_check" class="form-control" />
                                    <label class="form-label" for="password_check">Confirmar contraseña</label>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary btn-block mb-4" id="create_user">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

      <div class="col-lg-6 mb-5 mb-lg-0">
        <img src="../../assets/media/meetly_signin.jpg" class="w-100 rounded-4 shadow-4 img-fluid"
          alt="" />
      </div>
    </div>
  </div>
</section>

<?php require_once(__DIR__ . '/../components/footer.php') ?>