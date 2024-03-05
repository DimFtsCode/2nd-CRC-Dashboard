$(document).ready(function () {
    
    //$("#password").css({backgroundColor: 'blue'});
    
    $("#form_add_supply").submit(function (e) {
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
    
     $('#presetCode').change(function () {        

        //Use $option (with the "$") to see that the variable is a jQuery object
        var $option = $(this).find('option:selected');
      
        var value1 = $option.val();//to get content of "value" attrib
        //
        //alert(value1);
        //alert(MyAsma);        
        
         $("#bcode").val(value1);        
        
    });
    
     $('#presetBudget').change(function () {        

        //Use $option (with the "$") to see that the variable is a jQuery object
        var $option = $(this).find('option:selected');
      
        var value1 = $option.val();//to get content of "value" attrib
        //
        //alert(value1);
        //alert(MyAsma);        
        
         $("#budget").val(value1);        
        
    });
        
    function validateForm() {
        var errorFields = new Array();
        
        //Check Serial to be only numbers                
        var MySerial = $('#serial').val();
        if (!($.isNumeric(MySerial))) {
            errorFields.push("serial");
        }

        //var letters = /^[A-Z]+$/;  
        var upperCase = new RegExp('[A-ZΑ-Ω]');
        
        if (!($('#poc').val().match(upperCase))) {
            //if (Mylast_name.length < 6){
            errorFields.push("poc");
        } 
        
        //Check cost to be only numbers                
        var MyCost = $('#cost').val();
        if (!($.isNumeric(MyCost))) {
            errorFields.push("cost");
        }
        
        //Check final cost to be only numbers                
        var MyFCost = $('#fcost').val();        
        if (MyFCost.length > 1) {                    
        if (!($.isNumeric(MyFCost))) {
            errorFields.push("fcost");
        }
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