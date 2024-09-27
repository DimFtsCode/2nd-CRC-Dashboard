$(document).ready(function () {
    
    
    //$("#btn_delete").attr("disabled", true);
    //$("#callsign").css({backgroundColor: 'blue'});
    
    $("#form_edit_missions").submit(function (e) {  
        removeFeedback();
        var errors = validateForm(); 
        if (errors == "") {
            return true;
        } else {
            provideFeedback(errors); 
            e.preventDefault();
            return false;
        }
    }
    );

    $('#mis_id').change(function () {
        //Use $option (with the "$") to see that the variable is a jQuery object
        var $option = $(this).find('option:selected');
        //Added with the EDIT
        var value1 = $option.val();//to get content of "value" attrib
        
        //$("#btn_delete").removeAttr("disabled");
        //$("#btn_delete").css({backgroundColor: 'red'});
        //
        var data = {
            myID: value1
        };
        //alert(value1);
        $.ajax({
            url: '../php_functions/missions_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.sensor_name);
                $("#asset").val(response.asset);
                $("#callsign").val(response.callsign);
                $("#track").val(response.track);
                $("#mission").val(response.mission);
                $("#track2").val(response.track2);
                $("#result").val(response.result);
                $("#area").val(response.area);
                $("#mdate").val(response.mdate);
                $("#mtime").val(response.mtime);
                $("#scope").val(response.scope);                
                $("#remark").val(response.remark);
            }
            
        });

    });
        
    
        function validateForm() {
        var errorFields = new Array();

        //var letters = /^[A-Z]+$/;  
        var upperCase = new RegExp('[A-ZΑ-Ω0-9]');
        
        
        //var Mylast_name = $('#last_name').val();
        if (!($('#track').val().match(upperCase))) {
            //if (Mylast_name.length < 6){
            errorFields.push("track");
        }
        
        //var letters = /^[A-Z]+$/;          
        //var Mylast_name = $('#last_name').val();
        if (!($('#track2').val().match(upperCase))) {
            //if (Mylast_name.length < 6){
            errorFields.push("track2");
        }
        
        
        if (!($('#asset').val().match(upperCase))) {
            //if (Mylast_name.length < 6){
            errorFields.push("asset");
        }
        
        if (!($('#callsign').val().match(upperCase))) {
            //if (Mylast_name.length < 6){
            errorFields.push("callsign");
        }
                                                
        return errorFields;
    } //end function validateForm


    function provideFeedback(incomingErrors) {
        for (var i = 0; i < incomingErrors.length; i++)
        {
            $("#" + incomingErrors[i]).
                    addClass("errorClass");
            $("#" + incomingErrors[i] + "Error").removeClass("errorFeedback");
        }
        $("#errorDiv").html("Errors encountered");
    } //end function provideFeedback

    function removeFeedback() {
        $("#errorDiv").html("");
        $('input').each(function () {
            $(this).removeClass("errorClass");
        });
        $('.errorSpan').each(function () {
            $(this).addClass("errorFeedback");
        });
    }


});