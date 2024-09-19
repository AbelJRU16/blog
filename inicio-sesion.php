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
            <h1 class="mb-3 fw-normal text-center text-white">Inicio de Sesion</h1> 
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
            <p class="text-center text-white">
                No posees un usuario? <a href="registro.php">Registrate</a>
            </p>
            <p class="text-center text-white">
                Para volver a la pagina de inicio <a href="index.php">haz click aqui</a>
            </p>
            <button class="btn btn-primary w-100 py-2" id="btn-form" type="button">
                <i class="fa-solid fa-right-to-bracket"></i> Iniciar sesion
            </button>
        </form>
    </main>
</div>

<?php
    include_once "template/scripts.inc.php";
?>
<script>
    const SERVER = "<?php echo SERVER; ?>";
    $("#btn-form").click(function(e){
        e.preventDefault();
        let data = {
            username: $("#form_name").val(),
            password: $("#form_password").val(),
        }
        let resp;
        log_in("controllers/users.php?action=login", data, function(response){
            resp = response;
            if(resp.code == "200"){
                document.querySelector("form").reset();
                document.location.href = SERVER;
            }
        });
    });
</script>

<?php
    include_once "template/footer.inc.php";
?>
