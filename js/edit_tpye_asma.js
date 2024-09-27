$(document).ready(function () {
    
    $("#form_edit_tpye_asma").submit(function (e) {
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
        
        var myrmknum = $('#rmknum').val();
        //if (!($.isNumeric(myrmknum))) {
            
        if (('#rmknum').length > 0 && !($.isNumeric(myrmknum))) {   
            errorFields.push("rmknum");
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
        var $tpye = $('#myTpye').val();

        var data = {
            myAsma: $asma
        };
        
        var data1 = {
            myTpye: $tpye
        };
        
        
        //alert($asma);    
        $.ajax({
            url: '../php_functions/personnel_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                $("#asma").val(response.asma);
                $("#rank").val(response.rank);
                $("#specialty").val(response.specialty);
                $("#last_name").val(response.last_name);
                $("#first_name").val(response.first_name);
             
            }
        });
        
        //alert($asma); 
        //var $test = "test";
        $.ajax({
            url: '../php_functions/tpye_select.php',
            type: 'post',
            data: data1,
            dataType: 'JSON',
            success: function (response) {
                $("#tpid").val(response.tpid);
                $("#hospital").val(response.hospital);
                $("#exam_type").val(response.exam_type);
                $("#date_start").val(response.date_start);
                $("#date_end").val(response.date_end);
                $("#aea").val(response.aea);
                $("#rmknum").val(response.rmknum);
                //$("#remark").html(response.remark);
                //$("#remark").replaceWith(response.remark);
            }
        });
        
        
    };

