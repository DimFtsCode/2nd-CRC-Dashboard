$(document).ready(function () {
    var i = 0;
    
    $(".description").css({"width": "50%"});
    $(".description").css({"font-weight": "bold"});
    
   
$(".user").click(function(){
    
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
    
    
    
    $(".jobid").click(function(){
    var  thisJob=$(this).text();
    var row = $(this).parent().index();
    var thisTask = $("#my_task").val(); 
    var MyAsma = $("#my_asma").val();     

        //alert(thisJob); 
        //alert(MyAsma); 
        var data = {
            thisJob : thisJob,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_job.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
              //alert(response.r1);  
            }
           
        });        
       
        var data1 = {
            thisTask : thisTask,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_task.php',
            type: 'post',
            data: data1,
            dataType: 'JSON',
            success: function (response) {
              //alert(response.r1);  
            }
           
        }); 
  
      });
 
});

    






