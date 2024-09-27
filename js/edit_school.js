$(document).ready(function () {
    
   // $("#division_info").css({backgroundColor: 'yellow'});
    //$("#branch_info").css({backgroundColor: 'green'});
    //$("#branch_info2").css({backgroundColor: 'yellow'});
    
    $("#form_edit_school").submit(function (e) {
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


window.onload = function () {
         //document.getElementById("asma").setAttribute("readonly", true);
        
        var $school = $('#mySchool').val();

        var data = {
            mySchool: $school
        };
        //alert($asma);    
        $.ajax({
            url: '../php_functions/school_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.city);
                //alert(response.branch);
                $("#shid").val(response.shid);
                $("#shtype").val(response.shtype);
                $("#shname").val(response.shname);
                $("#shname_old").val(response.shname);
                $("#location").val(response.location);
                $("#description").val(response.description);             
            }

        });
    };







