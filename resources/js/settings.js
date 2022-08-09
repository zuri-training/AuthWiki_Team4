function displayPopup(id) {
    var body = document.getElementsByTagName('body');
    var popup = document.getElementById(id);
    body[0].style.height = '100%';
    body[0].style.overflow = 'hidden';
    disableInputsAndButtons()
    popup.style.display = 'flex';
}

function hidePopup(id) {
    var body = document.getElementsByTagName('body');
    var popup = document.getElementById(id);
    body[0].style.height = 'auto';
    body[0].style.overflow = 'auto';
    enableInputsAndButtons()
    popup.style.display = 'none';
}


function showOrHideSaveButton () {
    if (window.innerWidth <= 600){
        var input = document.getElementById('p_form').getElementsByTagName('input');
        for(var i = 0; i < input.length; i++) {
            if (input[i].value != '') {
                document.getElementById('save_button').style.display = 'block';
                break;
            }
            else{
                document.getElementById('save_button').style.display = 'none';
            }
        }
    }
    else{}
   
}




function submitForm(id) {
    var form = document.getElementById(id);
    var input = document.getElementById('p_form').getElementsByTagName('input');
    var status = false
    for(var i = 0; i < input.length; i++) {
        if (input[i].value != '') {
            // form.submit();
            displaySuccess();
            enableInputsAndButtons();
            status = true;   
        };
        enableInputsAndButtons();
    };

    if (status != true) {
        alert('Please fill in fields');
    };

    function displaySuccess(){
       var  data = window.performance.getEntriesByType("navigation")[0].type
        if (data == "reload") {
            if(window.document.readyState === 'complete') {
                var loaded = 'true';
            };
        }
        else{
            var loaded = 'true';
        }
        if (loaded === 'true') {displayPopup('popup_success')};
    };    
}




function disableInputsAndButtons() {
    var input = document.getElementsByTagName('input'); 
    var button = document.getElementsByTagName('button');
    for(var i = 0; i < input.length; i++) {
        input[i].disabled = true;
    }
    for(var i = 0; i < button.length; i++) {
        var exclude = ['delete_button', 'close_button'];
        if (exclude.includes(button[i].id) == false) {
            button[i].disabled = true;
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
    }
}



