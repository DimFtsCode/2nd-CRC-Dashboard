$(document).ready(function () {
    
    //$("#password").css({backgroundColor: 'blue'});
    
    $("#form_add_personnel").submit(function (e) {
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
    
    $('#directorate').change(function () {        
        
        $('#branch')
                .empty()
                .append('<option selected="disabled" value="">branch</option>')
                ;
        
        //Use $option (with the "$") to see that the variable is a jQuery object
        var $option = $(this).find('option:selected');
        //Added with the EDIT
        var value1 = $option.val();//to get content of "value" attrib
        //
        var data = {
            myBranch: value1
        };
        //alert(value1);    
        $.ajax({
            url: '../php_functions/branch_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response);
                var mystr = response[0].toString();
                
                var res = mystr.substring(0, 3);                                
               
                for (var i = 0; i < response.length; i++) {
                    var mykey = response[i].toString();
                    mykey = mykey.substring(0, 3);
                    var myvalue = response[i];

                    $('#branch').append($("<option/>", {
                        value: mykey,
                        text: myvalue
                    }));
                     $('#branch').css('color', 'red'); 
                    
                }
               
            }

        });

    });
    
    $("#btn_passwd").click(function () {
         $("#password").val("123456"); 
    });
    
    
    function validateForm() {
        var errorFields = new Array();

        //Check asma to be only numbers                
        var MyAsma = $('#asma').val();
        if (!($.isNumeric(MyAsma))) {
            errorFields.push("asma");
        }
        
        //Check idnumber to be only numbers                
        var MyIDnum = $('#idnumber').val();
        if (!($.isNumeric(MyIDnum))) {
            errorFields.push("idnumber");
        }

         if (('#password').length < 5) {
            errorFields.push("password");
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
               
        if (('#office').length > 0 && $('#office').val() !== "") {
            if (!($('#office').val().match(upperCase))) {
                //if (Mylast_name.length < 6){
                errorFields.push("office");
            }
        }
               
        if (!($('#specialty').val().match(upperCase))) {
            //if (Mylast_name.length < 6){
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