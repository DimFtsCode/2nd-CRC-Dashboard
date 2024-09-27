$(document).ready(function () {
    $("#userForm").submit(function (e) {
//alert("you are here!");
        var errors = validateForm();
        removeFeedback();
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
        if ($('#name').val() == "") {
            errorFields.push('name');
        }
        if ($('#email').val() == "") {
            errorFields.push('email');
        }
        if ($('#password1').val() == "") {
        errorFields.push('password1');
        }

        //very basic e-mail check, just an @ symbol
        if (!($('#email').val().indexOf(".") > 2) && ($('#email').val().indexOf("@"))) {
                errorFields.push("email");
        }


        //check  the phone format 
        if ($('#phone').val() != "") {
            var phoneNum = $('#phone').val();
            phoneNum.replace(/[^0-9]/g, "");
            if (phoneNum.length != 10) {
                errorFields.push("phone");
            }
            if (!$('input[name = phonetype]:checked').val()) {
                errorFields.push("phonetype");
            }
        }

        // check if passwords match
        if ($('#password2').val() !== $('#password1').val()) {
            errorFields.push('password2');
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