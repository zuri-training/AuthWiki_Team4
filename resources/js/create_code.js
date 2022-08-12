function enableAndDisableCreateButton(){
    var requiredFields = [document.getElementById('title'), document.getElementById('overview')];
    var create_btn = document.getElementById('create_btn');
    if (requiredFields[0].value != '' && requiredFields[1].value != '') {
        create_btn.disabled = false;
        create_btn.style.setProperty('background-color', '#FFB37C');
        create_btn.style.color = '#1f1f1f';
        create_btn.style.pointerEvents = 'auto';
        
    }
    else{
        create_btn.disabled = true;
        create_btn.style.backgroundColor = ' rgba(255, 179, 124, 0.39)';
        create_btn.style.color = 'rgba(31, 31, 31, 0.19)';
        create_btn.style.setProperty('pointer-events', 'none', 'important');
    }
    
}


function disableInputAndTextFields(){
    var input = [document.getElementsByTagName('input'), document.getElementsByTagName("textarea")];
    var upload = document.getElementById('file');
    var infoText = document.getElementById('info_text');
    var upload_form = document.getElementById("upload_form")
    if (window.document.readyState === "complete" && upload.value == ''){
        infoText.style.display = "flex";
        for (var i = 0; i < input.length; i++){
            for(var x = 0; x < input[i].length; x++){
                if (input[i][x].type != "file" ){
                    input[i][x].disabled = true;
                };
            };
        };
    }else{
        infoText.style.display = "none";
        for (var i = 0; i < input.length; i++){
            for(var x = 0; x < input[i].length; x++){
                input[i][x].disabled = false;
            };
        };
    }
}
