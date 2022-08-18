

function resizeCard(){
    var windowWidth = window.innerWidth;
    var windowHeight = window.innerHeight;
    var card = document.getElementById('cat_card');
    if (windowWidth < 768){
        card.style.width = windowWidth * 0.8 + 'px' ;
        card.style.height = windowHeight * 0.9 + 'px';
        card.style.borderRadius = '4px';
        card.style.padding = "5%"
    }else{
        card.style.width = windowWidth * 0.6 + 'px';
        card.style.height = windowHeight * 0.9 + 'px';
        card.style.borderRadius = '8px';
        card.style.padding = "3%"
    }
    var cardWidth = parseInt(card.style.width.replace('px', ''));
    var cardHeight = parseInt(card.style.height.replace('px', ''));
    card.style.top = windowHeight/2 - cardHeight/2 + 'px';
    card.style.left = windowWidth/2 - cardWidth/2 + 'px';

}



function displayPopup(id) {
    var body = document.getElementsByTagName('body');
    var popup = document.getElementById(id);
    body[0].style.setProperty('height', '100%', 'important')
    body[0].style.setProperty('overflow', 'hidden', 'important');
    disableInputsAndButtons()
    popup.style.display = 'block';
}


function hidePopup(id) {
    var body = document.getElementsByTagName('body');
    var popup = document.getElementById(id);
    body[0].style.height = 'auto';
    body[0].style.overflow = 'auto';
    enableInputsAndButtons()
    popup.style.display = 'none';
}


function closeCardOnOutsideClick(){
    var ignoreClickOnMeElement = document.getElementById('cat_card');
    var ignoreClickOnMeElement1 = document.getElementById('add_btn');
    document.addEventListener('click', function(event) {
        var isClickInsideElement = ignoreClickOnMeElement.contains(event.target);
        var isClickInsideElement1 = ignoreClickOnMeElement1.contains(event.target);
        if (!isClickInsideElement && !isClickInsideElement1) {
            hidePopup('cat_card');
        }
});
    
}


function disableInputsAndButtons() {
    var input = document.getElementsByTagName('input'); 
    var button = document.getElementsByTagName('button');
    for(var i = 0; i < input.length; i++) {
        var exclude = ['cat_name', 'cat_image', 'cat_description'];
        if(exclude.includes(input[i].id) == false) {
        input[i].disabled = true;
        }
    }
    for(var i = 0; i < button.length; i++) {
        var exclude = ['create_cat_btn'];
        if (exclude.includes(button[i].id) == false) {
            button[i].disabled = true;
            button[i].style.pointerEvents = 'none';
        }
    }
}


function enableInputsAndButtons() {
    var input = document.getElementsByTagName('input');
    var button = document.getElementsByTagName('button');
    for(var i = 0; i < input.length; i++) {
        input[i].disabled = false;
    }
    for(var i = 0; i < button.length; i++) {
        button[i].disabled = false;
        button[i].style.pointerEvents = 'auto';
    }
}




function displayInfoText(){
    var infoText = document.getElementById('info_text');
    if (window.location.href.includes("file")) {
        infoText.style.display = "none";
    }
    else{
        infoText.style.display = "flex";
    }
}
