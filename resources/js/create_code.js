function enableAndDisableCreateButton(){
    var requiredFields = [document.getElementById('title'), document.getElementById('overview')];
    var button = document.getElementById('create_btn');
    if (requiredFields[0].value != '' && requiredFields[1].value != '') {
        button.disabled = false;
        button.style.setProperty('background-color', '#FFB37C');
        button.style.color = '#1f1f1f';
        button.style.pointerEvents = 'auto';
        
    }
    else{
        button.disabled = true;
        button.style.backgroundColor = ' rgba(255, 179, 124, 0.39)';
        button.style.color = 'rgba(31, 31, 31, 0.19)';
        button.style.setProperty('pointer-events', 'none', 'important');
    }
    
}
