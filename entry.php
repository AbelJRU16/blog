<?php
include_once "app/Connection.inc.php";
include_once "app/repositories/UserRepository.inc.php";

$id = (isset($_GET["id"]) && !empty($_GET["id"])) ? $_GET["id"] : 0;

$mode = (isset($_GET["mode"]) && !empty($_GET["mode"])) ? $_GET["mode"] : 'view';

$title = "Blog";
include_once "template/header.inc.php";
include_once "template/navbar.inc.php";

SessionControl::session_init();
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-5">
                        <div class="card-header bg-dark text-white d-flex justify-content-center">
                            <?php
                                if($mode == 'view') echo '<h3><i class="fa-solid fa-book"></i> Entrada</h3>';
                                if($mode == 'create') echo '<h3><i class="fa-solid fa-new"></i> Agregar Entrada</h3>';
                                if($mode == 'edit') echo '<h3><i class="fa-solid fa-book"></i> Actualizar entrada</h3>';
                            ?>               
                        </div>
                        <div class="card-body">
                            <?php
                                if($mode == 'view') echo '<div class="text-justify" id="content"></div>';
                                else{
                                    ?>
                                    <div class="text-justify" id="content">
                                        <div class="row">
                                            <form>
                                                <div class="col-md-10 offset-md-1">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <i class="fa-solid fa-user"></i>
                                                        </span>
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="title">
                                                            <label for="form_name">Titulo</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-10 offset-md-1">
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-file-text" aria-hidden="true"></i>
                                                        </span>
                                                        <textarea class="form-control custom-textarea" placeholder="Contenido..." id="entry_content"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 offset-md-5 mt-3">
                                                    <div class="mb-3 d-flex justify-content-center align-items-center gap-2">
                                                        <input class="form-check-input mt-0" type="checkbox" value="" id="active">
                                                        <label for="active" class="">Activo?</label>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="w-100 d-flex justify-content-center">
                                            <button class="btn btn-dark" onclick="saveEntry()">
                                                <i class="fa fa-save" aria-hidden="true"></i> Guardar
                                            </button>
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include_once "template/scripts.inc.php";
?>

<script>

let isLoading = false;

$("document").ready(function(){
    let id = <?php echo $id; ?>;
    let mode = '<?php echo $mode; ?>';
    if(id) getEntry(id, mode);
});

const getEntry = (id, mode) => {
    isLoading = true;
    const data = getData("controllers/entries.php?action=show&id=<?php echo $id ?>", function(response){
        let {entry} = response;
        if(mode == 'view'){
            let template = '';
            template += '<h4>'+entry.title+'</h4>'
            template += '<p><i class="fa fa-calendar" aria-hidden="true"></i> '+entry.fecha;
            template +=' | <i class="fa fa-comment" aria-hidden="true"></i> 23</p>';
            template += '<p>'+entry.content+'</p>';
            document.querySelector('#content').innerHTML = template;
        }else{
            document.querySelector("#title").value = entry.title;
            document.querySelector("#entry_content").value = entry.content;
            document.querySelector("#active").checked = entry.active;
        }
    });
}

const saveEntry = () => {    
    let id = <?php echo $id; ?>;
    let mode = '<?php echo $mode; ?>';
    let data = {
        author_id: 101,
        title: document.querySelector("#title").value,
        content: document.querySelector("#entry_content").value,
        active: (document.querySelector("#active").checked) ? 1 : 0,
    }
    if(mode == 'create'){
        add_data_post("controllers/entries.php?action=create", data, function(response){
            resp = response;
            if(resp.code == "201"){
                document.querySelector("form").reset();
            }
        });
    }
}
</script>

<?php
    include_once "template/footer.inc.php";
?>