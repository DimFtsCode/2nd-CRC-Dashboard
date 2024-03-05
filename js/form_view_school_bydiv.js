$(document).ready(function () {
    var i = 0;

$('#directorate').change(function () {        
        
        
        var MyAsma = $("#my_asma").val();       
        //$("#my_asma").css({backgroundColor: 'yellow'});
        //Use $option (with the "$") to see that the variable is a jQuery object
        var $option = $(this).find('option:selected');
        //Added with the EDIT
        var value1 = $option.val();//to get content of "value" attrib
        //
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
            //  alert(response.r1);

            }
           
        });
        //window.location.reload();
        //setTimeout(function(){location.reload()}, 3000);
        
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
            url: '../php_functions/global_division.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.rank);
               
            }
            
        });
    };




