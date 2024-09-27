$(document).ready(function () {
    
    $("#form_edit_job").submit(function (e) {
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
        
        var $myJob = $('#myJob').val();
        var MyAsma = $("#my_asma").val();
        var $myTask = $('#myTask').val();

        var data = {
            myJob: $myJob,
            myAsma : MyAsma
        };
        //alert($myJob);  
        
        
        $.ajax({
            url: '../php_functions/job_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                $("#jobid").val(response.jobid);
                
                $("#description").val(response.description);
                $("#link").val(response.link);
                $("#date_init").val(response.date_init);
                //$("#user_reg").val(response.user_reg);
             // alert(response.jobid);
            }
            
        });
       //alert(response.mjid);
       
       var data1 = {
            myTask: $myTask
        };
        //alert($myJob);  
        
        
        $.ajax({
            url: '../php_functions/task_select.php',
            type: 'post',
            data: data1,
            dataType: 'JSON',
            success: function (response) {
                $("#taskid").val(response.taskid);
                
                $("#subject").val(response.subject);
                
             // alert(response.jobid);
            }
            
        });
       //alert(response.mjid);
       
    };


