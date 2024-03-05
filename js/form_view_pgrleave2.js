$(document).ready(function () {
  
    //$(".pl_asma").css({backgroundColor: 'blue'});

      
    $(".tbl_id").css({"width": "8%"});
    $(".tbl_id").css({"font-weight": "bold"});
    
    $(".asma").css({"width": "6%"});  
    $(".start_date").css({"width": "6%"});  
    
    $(".start_date").css({"font-weight": "bold"});
     $(".start_date").css({"font-size": "16px"});
    $(".start_date").css({"width": "20%"});
    //$(".start_date").css({"background-color": "red"});
    
    $(".numofdays").css({"width": "4%"});
    $(".numofdays").css({"font-weight": "bold"});
    $(".numofdays").css({"font-size": "18px"});
  
    $(".leave_type").css({"font-weight": "bold"});
     $(".leave_type").css({"font-size": "16px"});
    $(".leave_type").css({"width": "20%"});
    
    $(".location").css({"font-weight": "bold"});
    $(".location").css({"font-size": "16px"});
    
    $(".date_reg").css({"width": "10%"});
    $(".date_reg").css({"font-weight": "bold"});
    
    $(".sum").css({"width": "10%"});
    $(".sum").css({"font-weight": "bold"});
    $(".sum").css({"font-size": "20px"});
    
    $(".sum1").css({"width": "10%"});
    $(".sum1").css({"font-weight": "bold"});
    $(".sum1").css({"font-size": "20px"});
    $(".sam1").css({"background-color": "red"});

    $(".table_head").css({"font-weight": "bold"});
    $(".table_head").css({"font-size": "14px"});

    // ***********************************************
       $(".sam1").each(function () {
        if ($(this).text() == "15") {
            $(this).css({"background-color": "yellow"});
        }
    });
    
    // ***********************************************
    
    $(".tbl_id").click(function(){
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



