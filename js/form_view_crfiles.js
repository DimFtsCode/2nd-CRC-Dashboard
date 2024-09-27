$(document).ready(function () {
    var i = 0;

    
$(".asma").click(function(){
    var  thisAsma=$(this).text();
    var MyAsma = $("#my_asma").val();   

        var data = {
            thisAsma : thisAsma,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_variables.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                
            }
           
        });
    
    });
    

 
  $(".edit_asma").click(function(){
    var  thisAsma=$(this).text();
    var MyAsma = $("#my_asma").val();   
 
        var data = {
            thisAsma : thisAsma,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_variables.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                                       
            }
           
        });
    
    });
 
 
});

    








