$(document).ready(function () {
    $("#loginForm").submit(function (e) {
        alert("hi");  
        $("#errorDiv").removeClass("errorFeedback");
        $("#errorDiv").html("Errors encountered");
        return false;
        }
    ); 


});








