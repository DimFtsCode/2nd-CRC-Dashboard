$(document).ready(function () {
    var i = 0;
    
    $(".subject").css({"width": "50%"});
    $(".subject").css({"font-weight": "bold"});
    
    
$(".share1").click(function(){
    
    var  thisAsma=$(this).text();
    var MyAsma = $("#my_asma").val();   

        //alert(thisAsma); 
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
    setTimeout(function () {location.reload(true); }, 2000);
    });    
    
$(".share2").click(function(){
    var  thisAsma=$(this).text();
    var MyAsma = $("#my_asma").val();   

        //alert(thisAsma); 
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
   setTimeout(function () {location.reload(true); }, 2000); 
    }); 
    
$(".assign1").click(function(){
    var  thisAsma=$(this).text();
    var MyAsma = $("#my_asma").val();   

        //alert(thisAsma); 
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
    setTimeout(function () {location.reload(true); }, 2000);
    });
    
    
    $(".assign2").click(function(){
    var  thisAsma=$(this).text();
    var MyAsma = $("#my_asma").val();   

        //alert(thisAsma); 
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
    setTimeout(function () {location.reload(true); }, 2000);
    });
    
    $(".taskid").click(function(){
    var  thisTask=$(this).text();
    var row = $(this).parent().index();
    var MyAsma = $("#my_asma").val();     

        //alert(thisTask); 
        //alert(MyAsma); 
        var data = {
            thisTask : thisTask,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_task.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
              //alert(response.r1);  
            }
           
        });        
               
  
      });
 
    $(".detail").click(function(){
    var  thisTask=$(this).text();
    var row = $(this).parent().index();    
    var MyAsma = $("#my_asma").val();     

        //alert(thisTask); 
        //alert(MyAsma); 
        var data = {
            thisTask : thisTask,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_task.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
              //alert(response.r1);  
            }
           
        });  
        
        
        
      var  thisAssign1=$(".assign1").eq(row).text();
       // var  thisAsma=$("#userAsma").val();
      
      //alert(thisAssign1); 
      var data1 = {
            thisAssign1 : thisAssign1,
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

    






