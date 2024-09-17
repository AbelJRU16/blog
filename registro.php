<?php
include_once "app/Connection.inc.php";
include_once "app/UserRepository.php";

$title = "Blog - Registro";

include_once "template/header.inc.php";
//include_once "template/navbar.inc.php";
?>

<div class="d-flex align-items-center h-100vh py-4 m-3">
    <main class="form-signin w-100 m-auto bg-dark rounded-3">
        <form>
            <h1 class="mb-3 fw-normal text-center text-white">Registro de usuario</h1> 
            <div class="input-group mb-3">
                <div class="form-floating">
                    <input type="text" class="form-control" id="form_name" name="form_name" placeholder="Nombre de Usuario">
                    <label for="form_name">Nombre de Usuario</label>
                </div>
                <span class="input-group-text" id="basic-addon1">
                    <i class="fa-solid fa-user"></i>
                </span>
            </div>   
            <div class="input-group mb-3">
                <div class="form-floating">
                    <input type="email" class="form-control" placeholder="Email" id="form_email" name="form_email">
                    <label for="form_email">Email</label>
                </div>
                <span class="input-group-text" id="basic-addon1">
                    <i class="fa-solid fa-envelope"></i>
                </span>
            </div>   
            <div class="input-group mb-3">
                <div class="form-floating">
                    <input type="email" class="form-control" placeholder="Clave" id="form_password" name="form_password">
                    <label for="form_password">Clave</label>
                </div>
                <span class="input-group-text" id="basic-addon1">
                    <i class="fa-solid fa-key"></i>
                </span>
            </div>   
            <div class="input-group mb-3">
                <div class="form-floating">
                    <input type="password" class="form-control" id="form_password_confirmation" placeholder="Repetir clave" name="form_password_confirmation">
                    <label for="form_password_confirmation">Repetir clave</label>
                </div>
                <span class="input-group-text" id="basic-addon1">
                    <i class="fa-solid fa-lock"></i>
                </span>
            </div>    
            <!-- <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Remember me
                </label>
            </div> -->
            <p class="text-center text-white">
                Ya posees un usuario? <a href="#">Inicia sesion</a>
            </p>
            <p class="text-center text-white">
                Para volver a la pagina de inicio <a href="index.php">haz click aqui</a>
            </p>
            <button class="btn btn-primary w-100 py-2" type="submit">
                <i class="fa-solid fa-right-to-bracket"></i> Registrate
            </button>
        </form>
    </main>
</div>

<!-- <div class="container">
    <div class="p-5 mb-4 bg-dark rounded-3 mt-90 text-white">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold text-center">Formulario de Registro</h1>
        </div>
    </div>
</div> -->

<?php
    include_once "template/footer.inc.php";
?>