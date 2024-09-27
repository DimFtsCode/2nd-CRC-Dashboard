$(document).ready(function () {
    $(".user_reg").css({"width": "5%"});
    $(".date_reg").css({"width": "7%"});
    $(".tbc").css({"width": "5%"});
    
    var i = 0;
    $(".status").each(function () {
        //var existingText = $(this).text();
        //$(this).css({"background-color" : "red"});
        if ($(this).text() == "ΕΚ/ΕΝ") {
            $(this).css({"background-color": "red"});
           // $(this).next().css({"background-color": "red"});
            $(".sensor_name").eq(i).css({"background-color": "red"});
            $(".sensor_type").eq(i).css({"background-color": "red"});
        } else if ($(this).text() == "ΕΝ/ΕΝ") {
            $(this).css({"background-color": "green"});

        } else if ($(this).text() == "ΕΚ/ΛΕΙΤ") {
            $(this).css({"background-color": "yellow"});
            $(".sensor_name").eq(i).css({"background-color": "yellow"});
            $(".sensor_type").eq(i).css({"background-color": "yellow"});
        }  else if ($(this).text() == "LIMITED") {
            $(this).css({"background-color" : "#ff00ff"});
            $(".sensor_name").eq(i).css({"background-color": "#ff00ff"});
            $(".sensor_type").eq(i).css({"background-color": "#ff00ff"});
        }  
        
        i = i + 1;
    }
    );
    
    
    $(".sensor_id").click(function(){
    var  thisSensor=$(this).text();
    //var MyAsma = $("#my_asma").val();   
          
        var data = {
            thisSensor : thisSensor
            
        };
           $.ajax({
            url: '../php_functions/global_radar.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {            
                            
            }
           
        });
    
    });
    
});


window.onload = function () {
        
   setTimeout(function () {     location.reload(true); }, 100000);
    };