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


    $(".load").each(function () {
        //var existingText = $(this).text();
        //$(this).css({"background-color" : "red"}); 
        if ($(this).text() == " 2") {
            $(this).css({"background-color": "green"});
            $(".description").eq(i).css({"background-color": "green"});
            $(".description").eq(i).css("font-weight", "bold");
            $(".description").eq(i).css("font-size","18px");
            $(".mdate").eq(i).css({"background-color": "green"});
            $(".mdate").eq(i).css("font-weight", "bold");
            $(".mdate").eq(i).css("font-size","18px")
            $(".mtime").eq(i).css({"background-color": "green"});
            $(".mtime").eq(i).css("font-weight", "bold");
            $(".mtime").eq(i).css("font-size","18px");
//        } else if ($(this).text() == " 7") {
//            $(this).css({"background-color": "yellow"});
//            $(".description").eq(i).css({"background-color": "yellow"});
//            $(".description").eq(i).css("font-weight", "bold");
//            $(".mdate").eq(i).css({"background-color": "yellow"});
//            $(".mtime").eq(i).css({"background-color": "yellow"});        
        } else if ($(this).text() == " 3") {
            $(this).css({"background-color": "red"});
            $(".description").eq(i).css({"background-color": "red"});
            $(".description").eq(i).css("font-weight", "bold");
            $(".description").eq(i).css("font-size","18px");
            $(".mdate").eq(i).css({"background-color": "red"});
            $(".mdate").eq(i).css("font-weight", "bold");
            $(".mdate").eq(i).css("font-size","18px");
            $(".mtime").eq(i).css({"background-color": "red"});
            $(".mtime").eq(i).css("font-weight", "bold");
            $(".mtime").eq(i).css("font-size","18px");
        }
        i = i + 1;
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