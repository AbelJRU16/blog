const PAGINATION_LENGTH = 5;
let count = 0;
let actual_page = 1;
let pages = 0;    
let start_value = 1;

function change_pagination(page){
    const peticion = fetch("controllers/entries.php?action=get", {
        method: 'POST', // Especifica el método HTTP
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ page: page }),
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
            refresh_data(data); 
            create_pagination(); 
        })
        .catch( console.warn );
    
}

function create_pagination(){
    let template = '';

    if((actual_page > 2 && actual_page <= (pages-2))){
        start_value = actual_page - 2;
    }else if(actual_page > 3 && actual_page > (pages-2)){
        start_value = pages - PAGINATION_LENGTH + 1;
    }else{
        start_value = 1;
    }
    
    template += '<li class="page-item">';
    template += '    <a class="page-link" href="#p='+1+'" aria-label="Previous" onclick="change_pagination('+1+')">';
    template += '        <span aria-hidden="true">&laquo;</span>';
    template += '    </a>';
    template += '</li>';
    
    for(i=start_value; i<start_value + PAGINATION_LENGTH; i++){
        if(i == actual_page){
            template += "<li class='page-item disabled' onclick='change_pagination("+i+")'>";
        }else{
            template += "<li class='page-item' onclick='change_pagination("+i+")'>";
        }
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

function refresh_data(data){
    count = data.count;
    actual_page = data.page;
    pages = Math.ceil(count/PAGINATION_LENGTH);
    
    let template = '';
    data.data.forEach(element => {
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