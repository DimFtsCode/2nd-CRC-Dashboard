$(document).ready(function () {
    
    $("#form_delete_school").submit(function (e) { 
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
    
      $("#btn_passwd").click(function () {
         $("#password").val("123456"); 
         $("#description").css({backgroundColor: 'blue'});
     });
     
    
    $('#shcoolid').change(function () { 
        //Use $option (with the "$") to see that the variable is a jQuery object
        var $option = $(this).find('option:selected');
        //Added with the EDIT
        var value1 = $option.val();//to get content of "value" attrib
                
        //
        var data = {
            mySchool: value1
        };
        //alert(value1);
        $.ajax({
            url: '../php_functions/school_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.sensor_name);
                $("#shname").val(response.shname);
                $("#location").val(response.location);
                $("#description").val(response.description);
            }

        });

    });


      function validateForm() {
        var errorFields = new Array();

       //var letters = /^[A-Z]+$/;  
        var upperCase = new RegExp('[A-ZΑ-Ω]');
                
        if (('#description').length > 0 && $('#description').val() !== "") {
            if (!($('#description').val().match(upperCase))) {
                errorFields.push("description");
            }
        }
        
        if (!($('#shname').val().match(upperCase))) {
            errorFields.push("shname");
        }
        
        if (!($('#location').val().match(upperCase))) {
            errorFields.push("location");
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