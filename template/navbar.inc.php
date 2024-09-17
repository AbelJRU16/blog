<?php
Connection::open_connection();
$total_users = UserRepository::get_users_count(Connection::get_connection());
Connection::close_connection();
?>
<nav class="navbar navbar-expand-lg fixed-top bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa-solid fa-list-ul"></i> Entradas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa-solid fa-star"></i> Favoritos 
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa-solid fa-graduation-cap"></i> Autores
                    </a>
                </li>
            </ul>
            <div class="d-flex" role="right">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-user"></i> <?php echo $total_users; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-right-to-bracket"></i> Iniciar sesion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registro.php">
                            <i class="fa-solid fa-plus"></i> Registro
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>