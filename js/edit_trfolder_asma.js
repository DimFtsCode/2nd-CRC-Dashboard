$(document).ready(function () {
    
   // $("#division_info").css({backgroundColor: 'yellow'});
    //$("#branch_info").css({backgroundColor: 'green'});
    //$("#branch_info2").css({backgroundColor: 'yellow'});
    
    $("#form_edit_trfolder_asma").submit(function (e) {
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
            url: '../php_functions/personnel_select5_medata.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.city);
                //alert(response.vaccin);
                $("#asma").val(response.asma);
                $("#rank").val(response.rank);
                $("#specialty").val(response.specialty);
                $("#last_name").val(response.last_name);
                $("#first_name").val(response.first_name);
                
                $("#trfolder_yn").val(response.trfolder_yn);
                $("#trfolder_loc").val(response.trfolder_loc);
               
            }

        });
    };




