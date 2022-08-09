

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

function openNav() {
    var mySidemenu = document.getElementById("mySidemenu");
    var screenWidth = window.innerWidth;
    mySidemenu.style.paddingLeft = "32px";
    mySidemenu.style.boxShadow = "0px 0px 100px 100vw  rgba(0, 0, 0, 0.2), 0px 4px 100px 20px rgba(0, 0, 0, 0.2)";
    if (screenWidth < 768) {
        mySidemenu.style.width = screenWidth * 0.8 + "px";
    }
    else {
        mySidemenu.style.width = '322px' ;
    }
    mySidemenu.style.opacity = "1";
}

  

function closeNav() {
    var mySidemenu = document.getElementById("mySidemenu");
    mySidemenu.style.width = "0px";
    mySidemenu.style.paddingLeft = "0px";
    mySidemenu.style.opacity = "0";
    mySidemenu.style.boxShadow = "none"

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
