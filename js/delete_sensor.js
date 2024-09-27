$(document).ready(function () {
    var rec_to_delete = 0;
    
    $("#btn_delete").attr("disabled", true);
    
    $("#form_delete_sensor").submit(function (e) {
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

    $('#sensor_id').change(function () { 
        //Use $option (with the "$") to see that the variable is a jQuery object
        var $option = $(this).find('option:selected');
        //Added with the EDIT
        var value1 = $option.val();//to get content of "value" attrib
        rec_to_delete = value1;
        $("#btn_delete").removeAttr("disabled");
        $("#btn_delete").css({backgroundColor: 'red'});
        //
        var data = {
            myID: value1
        };
        //alert(value1);
        $.ajax({
            url: '../php_functions/sensor_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.sensor_name);
                $("#sensor_name").val(response.sensor_name);
                //$("#sensor_type").val(response.sensor_type);

            }

        });

    });

    $("#btn_delete").click(function () {
        var txt;
        var SID;
        var r = confirm(" Are you sure ?? DELETE the RECORD ??");
        if (r == true) {
            //txt = "You pressed OK!";
            //txt = rec_to_delete;
            SID = rec_to_delete;

            var data = {
                myID: SID
            };
            //alert(value1);
            $.ajax({              
                url: '../php_functions/sensor_delete.php',
                type: 'post',
                data: data,
                dataType: 'JSON',
                success: function (response) {
                    alert(response);                    
                    //$("#delete_btn").innerHTML = response;
                                      
                    //$("#sensor_name").val(response.sensor_name);
                    //$("#sensor_type").val(response.sensor_type);
                    //$("#delete_btn").text(response);
                    //$(location).attr('herf', 'http://1akesbadmin/pages/success_op.php');
                    //window.location.replace("http://1akesbadmin/pages/success_op.php");
                    //window.location.replace("http://1akesbadmin/pages/admin_dashboard.php");
                }
                
            });
            //document.getElementById("delete_btn").innerHTML = txt;
            //window.location.herf = "../pages/success_op.php";
            window.location.replace("http://1akesbadmin/pages/success_op.php");        
        } else {
            txt = "You  Canceled Deletion !!";
            
            document.getElementById("delete_btn").innerHTML = txt;
            //location.reload();
            //setTimeout(location.reload(), 5000);
            //$(location).attr("herf", "http://1akesbadmin/pages/success_op.php");
            window.location.replace("http://1akesbadmin/pages/success_op.php");
            
        }
        //document.getElementById("delete_btn").innerHTML = txt;
        //$("#button2").innerHTML = txt;
    });

    function validateForm() {
        var errorFields = new Array();

        //var letters = /^[A-Z]+$/;  
        var upperCase = new RegExp('[A-ZΑ-Ω]');
        //var Mylast_name = $('#last_name').val();
        if (!($('#sensor_name').val().match(upperCase))) {
            //if (Mylast_name.length < 6){
            errorFields.push("sensor_name");
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