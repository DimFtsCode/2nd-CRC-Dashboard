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


    $(".status").each(function () {
        //var existingText = $(this).text();
        //$(this).css({"background-color" : "red"}); 
        if ($(this).text() == "MANDATORY") {
            $(this).css({"background-color": "orange"});
            $(".base").eq(i).css({"background-color": "orange"});
             $(".weather").eq(i).css({"background-color": "orange"});
            
        }
        
        if ($(this).text() == "NORMAL") {
            //$(this).css({"background-color": "orange"});
            $(".weather").eq(i).css({"background-color": "cyan"});
            
        }
        
        if ($(this).text() == "PROHIBITED") {
            $(this).css({"background-color": "red"});
            // $(this).next().css({"background-color": "red"});
            $(".base").eq(i).css({"background-color": "red"});
             $(".weather").eq(i).css({"background-color": "red"});
        }
        i = i + 1;
    }
    );
});

window.onload = function () {
        
   setTimeout(function () {     location.reload(true); }, 15000);
    }; 