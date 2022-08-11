
function openNav() {
    document.getElementById("mySidemenu").style.width = "322px";
    document.getElementById("mySidemenu").style.opacity = "1";
}

function closeNav() {
    document.getElementById("mySidemenu").style.width = "0px";
    document.getElementById("mySidemenu").style.opacity= "0";
}

function submit_form(){
    var form = document.getElementById("menu_search_form");
    form.submit();
}

function showHoverMenu() {
    document.getElementById("myHovermenu").style.display = "flex";
}

function hideHoverMenu() {
    document.getElementById("myHovermenu").style.display = "none";
}

function moveToPosition(id) {
    const section = document.getElementById(id);
    section.scrollIntoView({behavior: "smooth", block: "nearest", inline: "nearest"})
}
