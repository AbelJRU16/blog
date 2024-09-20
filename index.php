<?php
include_once "app/Connection.inc.php";
include_once "app/repositories/UserRepository.inc.php";
include_once "app/repositories/EntryRepository.inc.php";

Connection::open_connection();
$entries = EntryRepository::get_entries(Connection::get_connection());
$total_entries = EntryRepository::get_entries_count(Connection::get_connection());
Connection::close_connection();

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
                    <?php
                        if(count($entries)){
                            ?>
                            <div id="entries">
                            <?php
                            foreach($entries as $entry){
                            ?>
                            <div class="card bg-body-tertiary">
                                <div class="card-header bg-dark text-white">
                                    <i class="fa-regular fa-clock"></i> <?php echo $entry->get_title(); ?>
                                </div>
                                <div class="card-body">
                                    <p><?php echo $entry->get_fecha(); ?></p>
                                    <p>
                                        <?php
                                        $content = substr($entry->get_content() , 0, 200);
                                        $link = "<a href=entry/".$entry->get_id()." class='see-more'>... Ver mas.</a>";
                                        echo $content.$link; 
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <br>                       
                            <?php
                            }
                            ?>
                            </div>
                            <?php
                            if($total_entries > 5){
                                include_once "template/pagination.inc.php";
                            }
                        }else{
                            ?>
                            <div class="card bg-body-tertiary">
                                <div class="card-header bg-dark text-white">
                                    <i class="fa-regular fa-clock"></i> Ultimas entradas
                                </div>
                                <div class="card-body">
                                    <p>Aun no hay entradas disponibles</p>
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

<?php
    include_once "template/scripts.inc.php";
    include_once "template/footer.inc.php";
?>