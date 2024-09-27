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
    
    $(".secid").click(function(){
    var  thisSecData=$(this).text();
    var row = $(this).parent().index();
    var MyAsma = $("#my_asma").val();   

        //alert(thisSecData); 
        //alert(MyAsma); 
        var data = {
            thisSecData : thisSecData,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_security.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
              //alert(response.r1);  
            }
           
        });        
               
        //  set global asma        
        var  thisAsma=$(".asma").eq(row).text();
       // var  thisAsma=$("#userAsma").val();
      
      //alert(thisAsma); 
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
    
    
    
    $(".expdate").each(function () {
        var today = new Date();
        var myDate = new Date($(this).text());        
        //var test = 0;
        var diffDays = parseInt((myDate - today) / (1000 * 60 *60 *24), 10 );
        if (today > myDate) {
            $(this).css({"background-color": "red"});           
        } else if (diffDays < 30) {
             test = today - myDate;
            $(this).css({"background-color": "orange"});
        }            
        //alert(diffDays);
       
    }
    );
 

 
});

    






