$(document).ready(function () {
  
    //$(".pl_asma").css({backgroundColor: 'blue'});

      
    $(".pl_id").css({"width": "10%"});
    $(".pl_id").css({"font-weight": "bold"});
    
    $(".pl_asma").css({"width": "6%"}); 
    
    $(".start_date").css({"width": "8%"});  
    $(".start_date").css({"font-size": "16px"});
    $(".start_date").css({"font-weight": "bold"});
    
    $(".numofdays").css({"width": "4%"});  
    $(".numofdays").css({"font-size": "16px"});
    $(".numofdays").css({"font-weight": "bold"});
  
    $(".leave_type").css({"font-weight": "bold"});
     $(".leave_type").css({"font-size": "16px"});
    $(".leave_type").css({"width": "20%"});
    
    $(".location").css({"font-weight": "bold"});
    $(".location").css({"font-size": "16px"});
    
    $(".date_reg").css({"width": "10%"});
    $(".date_reg").css({"font-weight": "bold"});
    
    $(".table_head").css({"font-weight": "bold"});
     $(".table_head").css({"font-size": "16px"});

   
       
    $(".pl_id").click(function(){
    var  id=$(this).text();
    var MyAsma = $("#pl_asma").text();
    //alert(id);//check the id if you are getting current id or not
    //alert(MyAsma);
    //alert("test");
    var value1 = id;
    // var value1 = "check";
    //alert(value1);  
        //
        var data = {
            myID: value1,
            myCC : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_variables.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.radio_name);
                
            }
           
        });
    
    });
   
   
   $(".del_id").click(function(){
    var  id=$(this).text();
    var MyAsma = $("#pl_asma").text();
    //alert(id);//check the id if you are getting current id or not
    //alert(MyAsma);
    //alert("test");
    var value1 = id;
    // var value1 = "check";
    //alert(value1);  
        //
        var data = {
            myID: value1,
            myCC : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_variables.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.radio_name);
                
            }
           
        });
    
    });
   
});