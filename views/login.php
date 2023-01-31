<?php require_once('components/header.php') ?>

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

                        <h2 class="fw-bold mb-5">Inicia sesión</h2>

                        <div class="text-bg-danger rounded-2 mb-3 text-center"><?= $errorMsg ?? '' ?></div>

                        <form action="login" method="post">
                            <div class="form-outline mb-4">
                                <input type="email" name="email" id="email" class="form-control" value="<?= $_POST['email'] ?? '' ?>" />
                                <label class="form-label" for="form3Example3">Email</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" name="password" id="password" class="form-control" />
                                <label class="form-label" for="password">Password</label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="user/create" class="text-decoration-none">¿Aún no tienes cuenta? Registrate</a>
                                <button type="submit" class="btn btn-primary btn-block mb-4">Accede</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-5 mb-lg-0">
                <img src="../assets/media/meetly_login.jpg" class="w-100 rounded-4 shadow-4" alt="" />
            </div>
        </div>
    </div>
</section>

<?php require_once('components/footer.php') ?>