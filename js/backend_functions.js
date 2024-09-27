const add_data_post = (url, data, callback) => {
    $.post(url, data, function(response){
        let resp = JSON.parse(response);
        let icon = "success";
        let html = "";
        if(resp.status != "success"){
            icon = "error";
            html = "<ul>";
            resp.errors.forEach(element =>{
                if(element !== ""){
                    html += "<li>"+element+"</li>"
                }
            });                
            html += "</ul>";
        }else{
            html = resp.text;
        }
        Swal.fire({
            icon: icon,
            title: resp.message,
            html: html,
        });
        callback(resp);
    });      
}

const log_in = (url, data, callback) => {
    $.post(url, data, function(response){
        let resp = JSON.parse(response);
        let icon = "error";
        let html = "";
        if(resp.status !== "OK"){
            html = "<ul>";
            html += "<li>"+resp.errors+"</li>";               
            html += "</ul>";
            Swal.fire({
                icon: icon,
                title: resp.message,
                html: html,
            });
        }
        callback(resp);
    });      
}

const getData = (url, callback) => {
    $.get(url, function(response){
        let resp = JSON.parse(response);
        let icon = "error";
        let html = "";
        if(resp.status !== "OK"){
            html = "<ul>";
            html += "<li>"+resp.errors+"</li>";               
            html += "</ul>";
            Swal.fire({
                icon: icon,
                title: resp.message,
                html: html,
            });
        }
        callback(resp);
    });
}