$(document).ready(function () {
    var i = 0;
    //$("#status").css({backgroundColor: 'blue'});

        $(".status1").each(function () {
        //var existingText = $(this).text();
        //$(this).css({"background-color" : "red"}); 
        if ($(this).text() == "12") {
            $(this).css({"background-color": "green"});
            
        }
                        
        i = i + 1;
    }
    );

    $("#btn_passwd").click(function () {
        alert($("#status11").text());
        //if ($("#status11").text() == 'RS1') {
            $("#status11").css({backgroundColor: 'green'});
        //}
    }
    );
    
    
//    for (i=1 ; i<3;i++) {
//        var myID = "status1" + i;
//        alert($("#"+myID).text());
//        if ($("#"+myID).text() == "RS-1") {
//            $("#"+myID).css({backgroundColor: 'green'});
//            
//        }
//    }

    
});