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
    //var MyAsma = $("#pl_asma").text();
    //alert(thisAsma);//check the id if you are getting current id or not
    //alert(MyAsma);
    //alert("test");
    //var value1 = id;
    // var value1 = "check";
    //alert(value1);  
        //
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
            //setTimeout(function () {     location.reload(true); }, 5000);
            //alert(response.r3);
            //setTimeout(function () {     location.reload(true); }, 5000);
            
                
            }
           
        });
    
    });
 
 
});

    






