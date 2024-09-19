const change_visibility = (id, btn)=>{
    let status = $("#"+id).attr("type");
    if(status == "password"){
        $("#"+id).attr("type", "text");
        btn.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
    }else{
        $("#"+id).attr("type", "password");
        btn.innerHTML = '<i class="fa-solid fa-eye"></i>';
    }
}