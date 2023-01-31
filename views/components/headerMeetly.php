<header class="p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-between justify-content-lg-between">
        <a href="show" class="d-flex align-items-center mb-2 mb-lg-0 text-primary fs-3 fw-bold text-decoration-none">Meetly</a>

        <!-- <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 link-secondary">Overview</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">Inventory</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">Customers</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">Products</a></li>
        </ul> -->

        <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle text-capitalize" data-bs-toggle="dropdown" aria-expanded="false"><?= $_SESSION['username'] ?></a>
          <ul class="dropdown-menu text-small">
            <li><a class="dropdown-item" href="create">Nuevo evento</a></li>
            <li><a class="dropdown-item" href="myevents">Mis eventos</a></li>
            <li><a class="dropdown-item" href="events">Asistiré</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../logout">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
</header>