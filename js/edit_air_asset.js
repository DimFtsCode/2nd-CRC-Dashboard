$(document).ready(function () {
    
    
    //$("#btn_delete").attr("disabled", true);
    //$("#callsign").css({backgroundColor: 'blue'});
    
    $("#form_edit_air_asset").submit(function (e) {  
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

    $('#air_id').change(function () {
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
            url: '../php_functions/air_asset_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.sensor_name);
                $("#base").val(response.base);
                $("#squadron").val(response.squadron);
                $("#numof").val(response.numof);
                $("#aftype").val(response.aftype);
                $("#callsign").val(response.callsign);
                $("#iff1").val(response.iff1);
                $("#iff3").val(response.iff3);
                $("#status").val(response.status);
                $("#daynight").val(response.daynight);
                $("#scope").val(response.scope);
                $("#track").val(response.track);
                $("#remark").val(response.remark);
            }
            
        });

    });
        
    
        function validateForm() {
        var errorFields = new Array();

        //Check IFF1 to be only numbers                
        var MyIFF1 = $('#iff1').val();
        if (!($.isNumeric(MyIFF1))) {
            errorFields.push("iff1");
        }
        
        //Check IFF3 to be only numbers                
        var MyIFF3 = $('#iff3').val();
        if (!($.isNumeric(MyIFF3))) {
            errorFields.push("iff3");
        }

        //var letters = /^[A-Z]+$/;  
        var upperCase = new RegExp('[A-ZΑ-Ω]');
        //var Mylast_name = $('#last_name').val();
        if (!($('#track').val().match(upperCase))) {
            //if (Mylast_name.length < 6){
            errorFields.push("track");
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