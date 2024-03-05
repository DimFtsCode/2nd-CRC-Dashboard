$(document).ready(function() {
    $("#initDate").datetimepicker({
        pickTime: false

    });
    $("#endDate").datetimepicker();
    $("button").click(function() {
    	var selected = $("#dropdown option:selected").text();
        var departing = $("#initDate").val();
        var returning = $("#endDate").val();
        
    });
});


