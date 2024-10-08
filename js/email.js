$(document).ready(function () {
    $("#emailForm").submit(function (e) {
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

    function validateForm() {
        var errorFields = new Array();
        //Check required fields have something in them

        if ($('#email').val() == "") {
            errorFields.push('email');
        }

        //very basic e-mail check, just an @ symbol
        if (!($('#email').val().indexOf(".") > 2) && ($('#email').val().indexOf("@"))) {
            errorFields.push('email');
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