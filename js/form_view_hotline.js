$(document).ready(function () {
    var i = 0;
    $(".status").each(function () {
        //var existingText = $(this).text();
        //$(this).css({"background-color" : "red"}); 
        if ($(this).text() == "ΕΚ/ΕΝ") {
            $(this).css({"background-color": "red"}); 
            // $(this).next().css({"background-color": "red"});
            $(".line_name").eq(i).css({"background-color": "red"});
            $(".line_type").eq(i).css({"background-color": "red"});
        } else if ($(this).text() == "ΕΝ/ΕΝ") {
            $(this).css({"background-color": "green"});

        } else if ($(this).text() == "ΕΚ/ΛΕΙΤ") {
            $(this).css({"background-color": "yellow"});
            $(".line_name").eq(i).css({"background-color": "yellow"});
            $(".line_type").eq(i).css({"background-color": "yellow"});
        } else if ($(this).text() == "STAND-BY") {
            $(this).css({"background-color": "#ff00ff"});
            $(".line_name").eq(i).css({"background-color": "#ff00ff"});
            $(".line_type").eq(i).css({"background-color": "#ff00ff"});
        }

        i = i + 1;
    }
    );
        
    
});