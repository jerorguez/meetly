<?php require_once('components/header.php') ?>

<section class="container vh-100">

    <header class="d-flex justify-content-between py-3 mb-4 border-bottom">
        <a href="index" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <span class="fs-3 fw-bold">Meetly</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="login" class="nav-link active rounded-4">Accede</a></li>
        </ul>
    </header>

    <main class="container col-xxl-8 px-4 py-2">
        <div class="row flex-lg-row-reverse align-items-center justify-content-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="../assets/media/meetly.jpg" class="d-block mx-lg-auto img-fluid rounded-4 shadow-4" alt="Hero IMG" height="1200" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-3">Organiza, invita, <br> crea.</h1>
                <p class="lead">
                    Meetly te ayuda a planificar eventos con facilidad, conectando a
                    personas y comunidades. Conoce y crea eventos en tu zona.
                </p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a href="user/create" class="btn btn-outline-primary btn-lg px-4 rounded-4" role="button">Registrate</a>
                </div>
            </div>
        </div>
  </main>

</section>

<?php require_once('components/footer.php') ?>