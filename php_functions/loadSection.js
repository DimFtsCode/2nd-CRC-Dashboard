/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function loadSection(){
    
    var formName = 'register_user';
    var epistasia = document[formName]['epistasia'].value;
    
    var xmlhttp = null;
    if(typeof XMLHttpRequest != 'udefined'){
        xmlhttp = new XMLHttpRequest();
    }else if(typeof ActiveXObject != 'undefined'){
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }else 
        throw new Error('You browser doesn\'t support ajax');
        
    xmlhttp.open('GET', '../php_functions/load_section.php?epistasia='+epistasia, true);
    xmlhttp.onreadystatechange = function (){
        if(xmlhttp.readyState == 4)
            window.insertStates(xmlhttp);
    };
    xmlhttp.send(null);
}

function insertStates(xhr){
    if(xhr.status == 200){
        document.getElementById('section_container').innerHTML = xhr.responseText;
    }else 
        throw new Error('Server has encountered an error\n'+
                         'Error code = '+xhr.status);
}

