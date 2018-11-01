function showForm(){
    var form = document.querySelector("#formAddArticle");
    if(form.style.display=="block")form.style.display = "none";
    else form.style.display = "block";
  
}

window.onload = function(){
    var form = document.querySelector("#add");
    form.addEventListener("click",showForm);
}