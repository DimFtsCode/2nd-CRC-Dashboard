

$(document).ready(function () {
    
    //$("#location").css({backgroundColor: 'blue'});
    //$("#asma").val(12345);
    //$("#location").val( $_SESSION['MyID'][0] );
    //$("#location").val($myError);
    
    $("#form_edit_pgr_leave").submit(function (e) {
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
    
    $('#pl_id').change(function () {
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
            url: '../php_functions/pgr_leave_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.sensor_name);
                $("#startdate").val(response.startdate);
                $("#numofdays").val(response.numofdays);                 
                $("#leave_type").val(response.leave_type);
                $("#location").val(response.location);                              
            }
            
        });

    });
            
    
     $("#btn_getdata").click(function () {
         var xid = $('#xid').val();
         
         var data = {
            myID: xid
        };
        
            $.ajax({
            url: '../php_functions/pgr_leave_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.sensor_name);
                $("#startdate").val(response.startdate);
                $("#numofdays").val(response.numofdays);                 
                $("#leave_type").val(response.leave_type);
                $("#location").val(response.location);                              
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
        
        var MyLocation= $('#location').val();
         if (MyLocation.length < 4) {
         //if (!($.isNumeric(MyPassword))) {    
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


//window.onload = function () {
//         var xid = $('#xid').val();
//         
//         var data = {
//            myID: xid
//        };
//        
//            $.ajax({
//            url: '../php_functions/pgr_leave_select.php',
//            type: 'post',
//            data: data,
//            dataType: 'JSON',
//            success: function (response) {
//                //alert(response.sensor_name);
//                $("#startdate").val(response.startdate);
//                $("#numofdays").val(response.numofdays);                 
//                $("#leave_type").val(response.leave_type);
//                $("#location").val(response.location);                              
//            }
//            
//        });  
//    };