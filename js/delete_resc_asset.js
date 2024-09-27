$(document).ready(function () {
    //var rec_to_delete = 0;
    
    //$("#btn_delete").attr("disabled", true);
    
    $("#form_delete_resc_asset").submit(function (e) {    
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

    $('#resc_id').change(function () { 
        //Use $option (with the "$") to see that the variable is a jQuery object
        var $option = $(this).find('option:selected');
        //Added with the EDIT
        var value1 = $option.val();//to get content of "value" attrib
        //rec_to_delete = value1;
        
        //
        var data = {
            myID: value1
        };
        //alert(value1);
        $.ajax({
            url: '../php_functions/resc_asset_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.tdl_name);
                $("#airport").val(response.airport);                
                $("#numof").val(response.numof);
                $("#aftype").val(response.aftype);

            }

        });

    });
    
    function validateForm() {
        var errorFields = new Array();

        //var letters = /^[A-Z]+$/;  
        //var upperCase = new RegExp('[A-ZΑ-Ω]');
        //var Mylast_name = $('#last_name').val();
//        if (!($('#line_name').val().match(upperCase))) {
//            //if (Mylast_name.length < 6){
//            errorFields.push("line_name");
//        }

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