$(document).ready(function () {
    var i = 0;
    
    $(".descript").css({"width": "35%"});
    $(".descript").css({"font-weight": "bold"});
    $(".descript").css({"font-size": "16px"});
    
   $(".doc").css({"width": "25%"});


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
    
    
    $(".evid").click(function(){
    var  thisEvent=$(this).text();
    var row = $(this).parent().index();
    var MyAsma = $("#my_asma").val();   

        //alert(thisEvent); 
        //alert(MyAsma); 
        var data = {
            thisEvent : thisEvent,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_event.php',
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
      
      
      
    $(".devid").click(function(){
    var  thisEvent=$(this).text();
    var row = $(this).parent().index();
    var MyAsma = $("#my_asma").val();   

        //alert(thisEvent); 
        //alert(MyAsma); 
        var data = {
            thisEvent : thisEvent,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_event.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
              //alert(response.r1);  
            }
           
        });        
               
        //  set global asma        
        //var  thisAsma=$(".asma").eq(row).text();
       var  thisAsma=$("#userAsma").val();
      
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
         //document.getElementById("asma").setAttribute("readonly", true);
        
        var $asma = $('#userAsma').val();

        var data = {
            myAsma: $asma
        };
        //alert($asma);    
        $.ajax({
            url: '../php_functions/personnel_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.city);
                //alert(response.branch);
                $("#Head_asma").text(response.asma); 
                $("#Head_rank").text(response.rank);
                $("#Head_specialty").text(response.specialty);
                $("#Head_last_name").text(response.last_name);
                $("#Head_first_name").text(response.first_name);
            }

        });
    };
