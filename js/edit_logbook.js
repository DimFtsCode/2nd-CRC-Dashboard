$(document).ready(function () {
    
    
    //$("#btn_delete").attr("disabled", true);
    //$("#callsign").css({backgroundColor: 'blue'});
    
    $("#form_edit_logbook").submit(function (e) {  
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

    $('#log_id').change(function () {
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
            url: '../php_functions/logbook_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.sensor_name);
                $("#description").val(response.description);
                $("#mdate").val(response.mdate);                 
                $("#mtime").val(response.mtime);
                $("#load").val(response.load);                
                $("#remark").val(response.remark);
            }
            
        });

    });
        
    
        function validateForm() {
        var errorFields = new Array();

        //var letters = /^[A-Z]+$/;  
        //var upperCase = new RegExp('[A-ZΑ-Ω0-9]');
        
        
        
                                                
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

        $("#set_time").click(function () {
        var dt = new Date();
        var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
        //alert(myVar);
        //if ($("#status11").text() == 'RS1') {
            
            $("#mtime").val(time);
        //}
    }
    );


});