$(document).ready(function () {
    var i = 0;
    //$("#status").css({backgroundColor: 'blue'});

        $(".status1").each(function () {
        //var existingText = $(this).text();
        //$(this).css({"background-color" : "red"}); 
        if ($(this).text() == " RS-1") {
            $(this).css({"background-color": "green"});
            
        }
        
        if ($(this).text() == " RS-3") {
            $(this).css({"background-color": "green"});
            
        }
                
        if ($(this).text() == " RS-5") {
            $(this).css({"background-color": "green"});
            
        }
        i = i + 1;
    }
    );

    $(".user_reg1").click(function () {
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

    $(".user_reg2").click(function () {
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
    
    $(".user_reg3").click(function () {
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


});