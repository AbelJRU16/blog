<?php
include_once "app/Connection.inc.php";
include_once "app/repositories/UserRepository.inc.php";

$id = (isset($_GET["id"]) && !empty($_GET["id"])) ? $_GET["id"] : '';

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
                        <div class="card-header bg-dark text-white">
                            <h3><i class="fa-solid fa-book"></i> Entrada</h3>
                        </div>
                        <div class="card-body">
                            Contenido
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
let entry = 

$("document").ready(function(){
    getEntry();
});

const getEntry = () => {
    isLoading = true;
    const data = getData("controllers/entries.php?action=show&id=<?php echo $id ?>", function(response){
        let {entry} = response;
        let template = '<p>'+entry.fecha+'</p>';
        template += '<p>'+entry.content+'</p>';

        document.querySelector('h3').innerHTML = '<h3><i class="fa-solid fa-book"></i> '+entry.title+'/h3';
        document.querySelector('.card-body').innerHTML = template;
    });
} 

</script>

<?php
    include_once "template/footer.inc.php";
?>