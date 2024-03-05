$(document).ready(function () {
    $("#btn_passwd").click(function () {
        var myVar = "REALITY";
        //myVar = "R"+$("#status11").text().toString()+"T" ;
        myVar = $("#status11").text();
        var myVar2 = $("#status11").text().toString();
        alert(myVar);
        //if ($("#status11").text() == 'RS1') {
        if (myVar == " RS-1") {
            alert("YES IT IS");
            $("#status11").css({backgroundColor: 'green'});
        }
    }
    );
});