$(document).ready(function () {
    
    
    //$("#btn_delete").attr("disabled", true);
    //$("#location").css({backgroundColor: 'blue'});
    
    $("#form_edit_sam_static").submit(function (e) {  
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

    $('#static_id').change(function () {
        //Use $option (with the "$") to see that the variable is a jQuery object
        var $option = $(this).find('option:selected');
        //Added with the EDIT
        var value1 = $option.val();//to get content of "value" attrib
        
        //$("#btn_delete").removeAttr("disabled");
        //$("#btn_delete").css({backgroundColor: 'red'});
        //
        var data = {
            myID: value1
        };
        //alert(value1);
        $.ajax({
            url: '../php_functions/sam_static_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.location);
                $("#rs1").val(response.rs1);                
                $("#rs4").val(response.rs4);
                $("#rs4a").val(response.rs4a);
                $("#rs5").val(response.rs5);
                $("#rs5a").val(response.rs5a);
                $("#rs5b").val(response.rs5b);
                $("#rs6").val(response.rs6);
                $("#rs11").val(response.rs11);
                $("#rs12").val(response.rs12);
                $("#remark").val(response.remark);
            }
            
        });

    });
        
    
        function validateForm() {
        var errorFields = new Array();
       
        //var letters = /^[A-Z]+$/;  
        var upperCase = new RegExp('[A-ZΑ-Ω]');
        //var Mylast_name = $('#last_name').val();
        if (!($('#location').val().match(upperCase))) {
            //if (Mylast_name.length < 6){
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