$(document).ready(function () {
    var i = 0;


    $(".user_reg").click(function () {
        //alert($(this).text());
        var UserAsma = $(this).text();        

        var data = {
            myAsma: UserAsma 
        };

        $.ajax({
            url: '../php_functions/personnel_setUser.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
               //alert(response.rank);
               //location.reload();
            }

        });

    });


    $("#displayUser").on('hidden.bs.modal', function () {
         window.location.reload(true);
         
         window.setTimeout(window.location.reload(true), 1000);
    });


    $(".scope").each(function () {
        //var existingText = $(this).text();
        //$(this).css({"background-color" : "red"}); 
        if ($(this).text() == " SIM") {
            $(this).css({"background-color": "#ff00ff"});
            
        } else if ($(this).text() == " LIVE") {
            $(this).css({"background-color": "green"});
        }
    }
    );


    $(".mission").each(function () {
        //var existingText = $(this).text();
        //$(this).css({"background-color" : "red"}); 
        
        if ($(this).text() == " ΚΑΤΑΡΡΙΨΗ") {
            $(this).css({"background-color": "red"});
           //alert(response.rank); 
        }        
       
    }                        
    );
    
    $("#btn_check").click(function () {
        var myVar = "REAL" + ($("#mission3").text());
        //alert($("#mission1").text());
        alert(myVar);
        //if ($("#status11").text() == 'RS1') {
            $("#mission3").css({backgroundColor: '#ff00ff'});
        //}
    }
    );
    
    });