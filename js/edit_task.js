$(document).ready(function () {
    
    $("#form_edit_task").submit(function (e) {
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
        
        var $myTask = $('#myTask').val();

        var data = {
            myTask: $myTask
        };
        //alert($asma);  
        
        
        $.ajax({
            url: '../php_functions/task_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                $("#taskid").val(response.taskid);
                $("#scope").val(response.scope);
                $("#subject").val(response.subject);
                $("#date_start").val(response.date_start);
                $("#date_exp").val(response.date_exp);
                $("#share1").val(response.share1);
                $("#share2").val(response.share2);
                $("#assign1").val(response.assign1);
                $("#assign2").val(response.assign2);
                $("#complete").val(response.complete);
                //alert(response.mjid);
            }
            
        });
       //alert(response.mjid);
    };

