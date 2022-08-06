

function openNav() {
    var mySidemenu = document.getElementById("mySidemenu");
    mySidemenu.style.width = "322px";
    mySidemenu.style.opacity = "1";

}

function closeNav() {
    var mySidemenu = document.getElementById("mySidemenu");
    mySidemenu.style.width = "0px";
    mySidemenu.style.opacity= "0";

}


function closeNavOnOutsideClick(){
    var ignoreClickOnMeElement = document.getElementById('mySidemenu');
    var ignoreClickOnMeElement1 = document.getElementById('menu_button');
    document.addEventListener('click', function(event) {
        var isClickInsideElement = ignoreClickOnMeElement.contains(event.target);
        var isClickInsideElement1 = ignoreClickOnMeElement1.contains(event.target);
        if (!isClickInsideElement && !isClickInsideElement1) {
            closeNav()
        }
});
}

function closeHoverMenuOnOutsideClick(){
    var ignoreClickOnMeElement = document.getElementById('myHovermenu');
    var ignoreClickOnMeElement1 = document.getElementById('icon');
    document.addEventListener('click', function(event) {
        var isClickInsideElement = ignoreClickOnMeElement.contains(event.target);
        var isClickInsideElement1 = ignoreClickOnMeElement1.contains(event.target);
        if (!isClickInsideElement && !isClickInsideElement1) {
            hideHoverMenu()
        }
});
}


function submit_form(){
    var form = document.getElementById("menu_search_form");
    form.submit();
}

function showHoverMenu() {
    var myHovermenu = document.getElementById("myHovermenu");
    myHovermenu.style.display = "flex";
}

function hideHoverMenu() {
    var myHovermenu = document.getElementById("myHovermenu");
    myHovermenu.style.display = "none";
}

function moveToPosition(id) {
    const section = document.getElementById(id);
    section.scrollIntoView({behavior: "smooth", block: "nearest", inline: "nearest"})
}
