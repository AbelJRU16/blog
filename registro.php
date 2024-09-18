<?php
$title = "Blog - Registro";
include_once "template/header.inc.php";
if(SessionControl::session_init()){
    Redirection::redirect(SERVER);
}
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
                    <input type="password" class="form-control br-none" placeholder="Clave" id="form_password" name="form_password">
                    <label for="form_password">Clave</label>
                </div>
                <div class="input-group-text btn-visibility" type="button" onclick="change_visibility('form_password', this)">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <span class="input-group-text" id="basic-addon1">
                    <i class="fa-solid fa-key"></i>
                </span>
            </div>   
            <div class="input-group mb-3">
                <div class="form-floating">
                    <input type="password" class="form-control br-none" id="form_password_confirmation" placeholder="Repetir clave" name="form_password_confirmation">
                    <label for="form_password_confirmation">Repetir clave</label>
                </div>
                <div class="input-group-text btn-visibility" type="button" onclick="change_visibility('form_password_confirmation', this)">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <span class="input-group-text" id="basic-addon1">
                    <i class="fa-solid fa-lock"></i>
                </span>
            </div>
            <p class="text-center text-white">
                Ya posees un usuario? <a href="inicio-sesion.php">Inicia sesion</a>
            </p>
            <p class="text-center text-white">
                Para volver a la pagina de inicio <a href="index.php">haz click aqui</a>
            </p>
            <button class="btn btn-primary w-100 py-2" id="btn-form" type="button">
                <i class="fa-solid fa-right-to-bracket"></i> Registrate
            </button>
        </form>
    </main>
</div>

<?php
    include_once "template/scripts.inc.php";
?>
<script>    
    $("#btn-form").click(function(e){
        e.preventDefault();
        let data = {
            username: $("#form_name").val(),
            email: $("#form_email").val(),
            password: $("#form_password").val(),
            password_confirmation: $("#form_password_confirmation").val(),
        }
        let resp;
        add_data_post("controllers/users.php?action=create", data, function(response){
            resp = response;
            if(resp.code == "201"){
                document.querySelector("form").reset();
            }
        });
    });
</script>

<?php
    include_once "template/footer.inc.php";
?>
