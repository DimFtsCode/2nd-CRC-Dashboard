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
    
$(".tpid").click(function(){
    var  thisTpye=$(this).text();
    var row = $(this).parent().index();  
    var MyAsma = $("#my_asma").val();   

        var data = {
            thisTpye : thisTpye,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_tpye.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                
            }
           
        });
        
        
      //  set global asma  
      var thisAsma = $(".asma").eq(row).text();
      
      var data1 = {
            thisAsma : thisAsma,
            myAsma : MyAsma
        };
                
            $.ajax({
            url: '../php_functions/global_asma.php',
            type: 'post',
            data: data1,
            dataType: 'JSON',
            success: function (response) {                           
            }           
        });
                        
    });
 
});



