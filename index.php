<?php
include_once "app/Connection.inc.php";
include_once "app/repositories/UserRepository.inc.php";
//include_once "app/repositories/EntryRepository.inc.php";

//Connection::open_connection();
//$entries = EntryRepository::get_entries(Connection::get_connection());
//$total_entries = EntryRepository::get_entries_count(Connection::get_connection());
//Connection::close_connection();

$title = "Blog";
include_once "template/header.inc.php";
include_once "template/navbar.inc.php";
?>
        
<div class="container">
    <div class="p-5 mb-4 bg-dark rounded-3 mt-90 text-white">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Proyecto de PHP</h1>
            <p class="col-md-8 fs-4">Blog enfocado a un proyecto de programacion en PHP</p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <i class="fa-solid fa-filter"></i> Busqueda
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Busqueda..." aria-label="Username" aria-describedby="basic-addon1">
                                    <button role="button" type="button" class="input-group-text btn btn-dark" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <i class="fa-solid fa-filter"></i> Filtro
                        </div>
                        <div class="card-body">
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <i class="fa-solid fa-calendar"></i> Archivo
                        </div>
                        <div class="card-body">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <div id="entries"></div>
                    <div class="d-flex justify-content-center w-100">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                            </ul>
                        </nav>
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

$("document").ready(function(){
    change_pagination(1);
});

</script>

<?php
    include_once "template/footer.inc.php";
?>