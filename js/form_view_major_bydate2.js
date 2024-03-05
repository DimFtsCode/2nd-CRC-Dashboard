$(document).ready(function () {
    var i = 0;
    
    $(".type").css({"width": "7%"});
    $(".type").css({"font-weight": "bold"});
    $(".type").css({"font-size": "16px"});

    $(".descript").css({"width": "45%"});
    $(".descript").css({"font-weight": "bold"});
    $(".descript").css({"font-size": "16px"});

$('#mdate2').change(function () {        
                
        var MyAsma = $("#my_asma").val();       
        var value1 = $('#mdate').val();
        var value2 = $('#mdate2').val();
        //alert(value1);
        //alert(MyAsma);        
        
        var data = {
            myDate: value1,
            myDate2: value2,  
            myAsma : MyAsma
        };
        
            $.ajax({
            url: '../php_functions/global_date.php',            
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
    
    
    $(".mjid").click(function(){
    var  thisMajor=$(this).text();
    //var row = $(this).parent().index();
    var MyAsma = $("#my_asma").val();   

        //alert(thisMajor); 
        //alert(MyAsma); 
        var data = {
            thisMajor : thisMajor,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_major.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
              //alert(response.r1);  
            }
           
        });        
  
      });
      
    $(".mjid_del").click(function(){
    var  thisMajor=$(this).text();
    //var row = $(this).parent().index();
    var MyAsma = $("#my_asma").val();   

        //alert(thisMajor); 
        //alert(MyAsma); 
        var data = {
            thisMajor : thisMajor,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_major.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
              //alert(response.r1);  
            }
           
        });        
  
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

