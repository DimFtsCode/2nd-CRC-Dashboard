$(document).ready(function () {
    var i = 0;


    $(".user_reg").click(function () {
        //alert($(this).text());
        //var UserAsma = $(this).text();
        var thisAsma = $(this).text();
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
        if ($(this).text() == "5'") {
            $(this).css({"background-color": "green"});
            
        }
        
        var j = $(this).parent().index();
        if ($(this).text() == "AIRBORNE") {
            $(this).css({"background-color": "cyan"});            
            $(".base").eq(j).css({"background-color": "cyan"});
            $(".squadron").eq(j).css({"background-color": "cyan"});
            $(".numof").eq(j).css({"background-color": "cyan"});
            $(".aftype").eq(j).css({"background-color": "cyan"});
            $(".iff1").eq(j).css({"background-color": "cyan"});
            $(".iff3").eq(j).css({"background-color": "cyan"});
            $(".callsign").eq(j).css({"background-color": "cyan"});
            $(".track").eq(j).css({"background-color": "cyan"});
        }
       
    }
    );
    
    
    
    $(".night_status").each(function () {
      
        //var existingText = $(this).text();
        //$(this).css({"background-color" : "red"}); 
        if ($(this).text() == "5'") {
            $(this).css({"background-color": "green"});
            
        }
        
        var j = $(this).parent().index();
        if ($(this).text() == "AIRBORNE") {
            $(this).css({"background-color": "cyan"});            
            $(".night_base").eq(j).css({"background-color": "cyan"});
            $(".night_squadron").eq(j).css({"background-color": "cyan"});
            $(".night_numof").eq(j).css({"background-color": "cyan"});
            $(".night_aftype").eq(j).css({"background-color": "cyan"});
            $(".night_iff1").eq(j).css({"background-color": "cyan"});
            $(".night_iff3").eq(j).css({"background-color": "cyan"});
            $(".night_callsign").eq(j).css({"background-color": "cyan"});
            $(".night_track").eq(j).css({"background-color": "cyan"});
        }
        
    }
    );
    
    
    $(".nato_status").each(function () {
      
        //var existingText = $(this).text();
        //$(this).css({"background-color" : "red"}); 
        if ($(this).text() == "5'") {
            $(this).css({"background-color": "green"});
            
        }
        
        var j = $(this).parent().index();
        if ($(this).text() == "AIRBORNE") {
            $(this).css({"background-color": "cyan"});            
            $(".nato_base").eq(j).css({"background-color": "cyan"});
            $(".nato_squadron").eq(j).css({"background-color": "cyan"});
            $(".nato_numof").eq(j).css({"background-color": "cyan"});
            $(".nato_aftype").eq(j).css({"background-color": "cyan"});
            $(".nato_iff1").eq(j).css({"background-color": "cyan"});
            $(".nato_iff3").eq(j).css({"background-color": "cyan"});
            $(".nato_callsign").eq(j).css({"background-color": "cyan"});
            $(".nato_track").eq(j).css({"background-color": "cyan"});
        }
        
    }
    );
    
    
      $(".remark3").each(function () {
        //var existingText = $(this).text();
        //$(this).css({"background-color" : "red"}); 
        
        if ($(this).text.contains("SCR")  ) {
            $(this).css({"background-color": "cyan"});
           //alert(response.rank); 
        }        
        i = i + 1;
    }
    );
    
    
});

 
window.onload = function () {
        
   setTimeout(function () {     location.reload(true); }, 15000);
    }; 