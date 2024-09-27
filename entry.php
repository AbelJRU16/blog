<?php
include_once "app/Connection.inc.php";
include_once "app/repositories/UserRepository.inc.php";

$id = (isset($_GET["id"]) && !empty($_GET["id"])) ? $_GET["id"] : 0;

$mode = (isset($_GET["mode"]) && !empty($_GET["mode"])) ? $_GET["mode"] : 'view';

$title = "Blog";
include_once "template/header.inc.php";
include_once "template/navbar.inc.php";
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
                                    <div class="input-group mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="form_name" name="form_name" placeholder="Nombre de Usuario">
                                                <label for="form_name">Titulo</label>
                                            </div>
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa-solid fa-user"></i>
                                            </span>
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
    let mode = <?php echo $mode; ?>;
    if(id) getEntry(id, mode);
});

const getEntry = (id, mode) => {
    isLoading = true;
    const data = getData("controllers/entries.php?action=show&id=<?php echo $id ?>", function(response){
        if(mode == 'view'){
            let {entry} = response;
            let template = '';
            template += '<h4>'+entry.title+'</h4>'
            template += '<p><i class="fa fa-calendar" aria-hidden="true"></i> '+entry.fecha;
            template +=' | <i class="fa fa-comment" aria-hidden="true"></i> 23</p>';
            template += '<p>'+entry.content+'</p>';
            document.querySelector('#content').innerHTML = template;
        }else{

        }
    });
} 

</script>

<?php
    include_once "template/footer.inc.php";
?>