$(document).ready(function () {
    
    // $("#division_info").css({backgroundColor: 'yellow'});
    //$("#branch_info").css({backgroundColor: 'green'});
    //$("#branch_info2").css({backgroundColor: 'yellow'});
    
    $("#form_add_duty").submit(function (e) {
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

        //Check asma to be only numbers                
        var MyAsma = $('#asma').val();
        if (!($.isNumeric(MyAsma))) {
            errorFields.push("asma");
        }        

        //var letters = /^[A-Z]+$/;  
        var upperCase = new RegExp('[A-ZΑ-Ω]');
        //var Mylast_name = $('#last_name').val();
        if (!($('#last_name').val().match(upperCase))) {
            //if (Mylast_name.length < 6){
            errorFields.push("last_name");
        }
        if (!($('#first_name').val().match(upperCase))) {
            //if (Mylast_name.length < 6){
            errorFields.push("first_name");            
        }
        
         if (!($('#specialty').val().match(upperCase))) {
            errorFields.push("specialty");
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
        
        var $asma = $('#userAsma').val();

        var data = {
            myAsma: $asma
        };
        //alert($asma);    
        $.ajax({
            url: '../php_functions/personnel_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.city);
                //alert(response.branch);
                $("#asma").val(response.asma);
                $("#rank").val(response.rank);
                $("#specialty").val(response.specialty);
                $("#last_name").val(response.last_name);
                $("#first_name").val(response.first_name);
                $("#division").val(response.directorate);
            }

        });
    };

