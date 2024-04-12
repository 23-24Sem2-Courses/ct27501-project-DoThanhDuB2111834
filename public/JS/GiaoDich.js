function toogleDisplayTableCTHD (id){
    table = document.getElementById(id);
    if (table.classList.contains("visually-hidden"))
        table.classList.remove("visually-hidden");
    else table.classList.add("visually-hidden");
}