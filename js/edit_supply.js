$(document).ready(function () {
    
    $("#division_info").css({backgroundColor: 'yellow'});
    $("#branch_info").css({backgroundColor: 'green'});
    $("#branch_info2").css({backgroundColor: 'yellow'});
    
    
    
    $("#form_edit_supply").submit(function (e) {
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
        
        var $mySupply = $('#mySupply').val();
        var $myAsma = $('#userAsma').val();
        var $check = 1;

        var data = {
            mySupply: $mySupply,
            myAsma : $myAsma
        };
        //alert($myAsma);  
        
        
        $.ajax({
            url: '../php_functions/supply_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                $("#supid").val(response.supid);
                $("#serial").val(response.serial);
                $("#sdate").val(response.sdate);
                $("#year").val(response.year);
                $("#description").val(response.description);
                $("#directorate").val(response.directorate);
                $("#branch").val(response.branch);
                $("#poc").val(response.poc);
                $("#cost").val(response.cost);
                $("#budget").val(response.budget);
                $("#bcode").val(response.bcode);
                $("#type_order").val(response.type_order);
                $("#order").val(response.order);
                $("#link").val(response.link);
                $("#funded").val(response.funded);
                $("#own_budget").val(response.own_budget);
                $("#rdate").val(response.rdate);
                $("#ordate").val(response.ordate);
                $("#orplace").val(response.orplace);
                $("#invoice").val(response.invoice);
                $("#fcost").val(response.fcost);
                $("#status").val(response.status);
                $("#remark").val(response.remark);
                //$("#complete").val(response.complete);
                $("#branch_info2").text(response.branch);
                //alert(response.own_budget);
            }
            
        });
       //alert(response.branch);
       
       if ($check == 1) {
            //setTimeout(function () { location.reload(true); }, 500);
            $check = 0;
       }
      
    };

