$(document).ready(function () {
    var rec_to_delete = 0;
    
    //$("#btn_delete").attr("disabled", true);
    //$("#tdl_name").css({backgroundColor: 'red'});
    //$("#tdl_type").css({backgroundColor: 'red'});
    
    $("#form_edit_tdl").submit(function (e) {  
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

    $('#tdl_id').change(function () {
        //Use $option (with the "$") to see that the variable is a jQuery object
        var $option = $(this).find('option:selected');
        //Added with the EDIT
        var value1 = $option.val();//to get content of "value" attrib
        //rec_to_delete = value1;
        //$("#btn_delete").removeAttr("disabled");
        //$("#tdl_name").css({backgroundColor: 'red'});
        //
        var data = {
            myID: value1
        };
        //alert(value1);
        $.ajax({
            url: '../php_functions/tdl_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.tdl_name);
                $("#tdl_name").val(response.tdl_name);
                $("#tdl_type").val(response.tdl_type);
                $("#direct").val(response.direct);
            }

        });

    });

    function validateForm() {
        var errorFields = new Array();

        //var letters = /^[A-Z]+$/;  
        var upperCase = new RegExp('[A-ZΑ-Ω]');
        //var Mylast_name = $('#last_name').val();
        if (!($('#radio_name').val().match(upperCase))) {
            //if (Mylast_name.length < 6){
            errorFields.push("radio_name");
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