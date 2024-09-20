<?php
if(isset($total_entries)){
    $total_pages = ceil($total_entries/5);
}
$actual_page = 1;
define("PAGINATION_LENGTH", 5)

?>

<div class="d-flex justify-content-center w-100">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link <?php echo ($actual_page == 1) ? "disabled" : ""; ?>" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>        
        </ul>
    </nav>
</div>

<script>
    const PAGINATION_LENGTH = 5;
    let count = <?php echo $total_entries; ?>;
    let actual_page = 1;
    let pages = <?php echo $total_pages; ?>;    
    let start_value = 1;

    function change_pagination(action){
        const peticion = fetch("controllers/entries.php?action=get", {
            method: 'POST', // Especifica el método HTTP
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ page: action }),
        });

        peticion
            .then(response => {
                // Verifica si la respuesta fue exitosa
                if (!response.ok) {
                    throw new Error('Error en la petición');
                }
                return response.json(); // Si la respuesta es JSON
            })
            .then(data => {
                // Maneja los datos obtenidos de la respuesta
                refrest_data(data.data); 
            })
            .catch( console.warn );
        
        create_pagination(action); 
    }

    function create_pagination(page = 1){
        let template = '';
        actual_page = page;
        if(pages > 5) start_value = (actual_page + PAGINATION_LENGTH > pages) ? pages - PAGINATION_LENGTH: actual_page;
        else start_value = actual_page;
    
        template += '<li class="page-item">';
        template += '    <a class="page-link" href="#p='+1+'" aria-label="Previous" onclick="change_pagination('+1+')">';
        template += '        <span aria-hidden="true">&laquo;</span>';
        template += '    </a>';
        template += '</li>';
    
        for(i=start_value; i<start_value + PAGINATION_LENGTH; i++){
            template += "<li class='page-item' onclick='change_pagination("+i+")'>";
            template += "<a class='page-link' href='#p="+i+"'>";
            template += i;
            template += "</a>";
            template += "</li>";
        }
    
        template += '<li>';
        template += '    <a class="page-link" href="#p='+pages+'" aria-label="Next" onclick="change_pagination('+pages+')">';
        template += '        <span aria-hidden="true">&raquo;</span>';
        template += '    </a>';
        template += '</li>';

        document.querySelector("ul.pagination").innerHTML = template;
    }

    function refrest_data(data){
        let template = '';
        data.forEach(element => {
            template += '<div class="card bg-body-tertiary">';
            template += '    <div class="card-header bg-dark text-white">';
            template += '        <i class="fa-regular fa-clock"></i> '+element.title;
            template += '    </div>';
            template += '    <div class="card-body">';
            template += '        <p>'+element.fecha+'</p>';
            template += '        <p>';
            template += '           '+element.content.substr(0, 200);
            template += '           <a href=entry/'+element.id+' class="see-more">... Ver mas.</a>';
            template += '       </p>';
            template += '    </div>';
            template += '</div>';
            template += '<br>';            
        });
        document.querySelector("#entries").innerHTML = template;
    }

    create_pagination();
</script>