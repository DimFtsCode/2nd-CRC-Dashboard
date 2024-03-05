$(document).ready(function () {
    var $myDIV = null;

$('#directorate').change(function () {        
                
        var MyAsma = $("#my_asma").val();       
        var $option = $(this).find('option:selected');
        //Added with the EDIT
        var value1 = $option.val();//to get content of "value" attrib
        $myDIV = value1;
        //alert(value1);
        //alert(MyAsma);        
        
        var data = {
            myDivID: value1,
            myAsma : MyAsma
        };
        
            $.ajax({
            url: '../php_functions/global_division.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
             //alert(response.r1);
             //alert(response.r2);
            }
           
        });
                
    });
    
    
    $('#fileID').change(function () {                
        
        var MyAsma = $("#my_asma").val();       
        var $option = $(this).find('option:selected');
      
        var value1 = $option.val();//to get content of "value" attrib
        //
        //alert(value1);
        //alert("DIV is : " + $myDIV);        
        
        var data = {
            myAsma : MyAsma,
            crfID : value1
        };
        
            $.ajax({
            url: '../php_functions/global_crf.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
            //alert(response.r1);
            //alert(response.r2);
            }
           
        });
        
        setTimeout(function () {     location.reload(true); }, 500);
        
    });
                       
    
     $(".asma").click(function(){
    var  thisAsma=$(this).text();
    var MyAsma = $("#my_asma").val();   

        var data = {
            thisAsma : thisAsma,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_asma.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                         
            }
           
        });
    
    });
    
});

    
window.onload = function () {
        
       var MyAsma = $("#my_asma").val(); 
       value1 = 0;  // in order to clear the form 

        var data = {
            myDivID: value1,
            myAsma : MyAsma
        };
        
            $.ajax({
            url: '../php_functions/global_crf.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.rank);
               
            }
            
        });
        
    };



