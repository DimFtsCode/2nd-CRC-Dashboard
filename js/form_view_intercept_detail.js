$(document).ready(function () {
    
   // $("#division_info").css({backgroundColor: 'yellow'});
    //$("#branch_info").css({backgroundColor: 'green'});
    
    $("#form_view_intercept_detail").submit(function (e) {
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
    
    
    $('#preset').change(function () {        

        //Use $option (with the "$") to see that the variable is a jQuery object
        var $option = $(this).find('option:selected');
      
        var value1 = $option.val();//to get content of "value" attrib
        //
        //alert(value1);
        //alert(MyAsma);        
        
         $("#reason").val(value1);        
        
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
      var $asma = $('#userAsma').val();
      
      //var $asma = $('#userAsma').val();
        var $myIntercept = $('#myIntercept').val();

        var data = {
            myAsma: $asma
        };
        
        var data1 = {
            myIntercept: $myIntercept
        };
        //alert($asma);    
        //alert($myIntercept);
        $.ajax({
            url: '../php_functions/personnel_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.city);
                //alert(response.branch);
                $("#asma").val(response.asma);
                $("#rank").val(response.rank);
                $("#specialty").val(response.specialty);
                $("#last_name").val(response.last_name);
                $("#first_name").val(response.first_name);
            }

        });
        
         $.ajax({
            url: '../php_functions/intercept_select.php',
            type: 'post',
            data: data1,
            dataType: 'JSON',
            success: function (response) {
                $("#int_id").val(response.int_id);
                $("#cotype").val(response.cotype);
                $("#mdate").val(response.mdate);
                $("#stime").val(response.stime);
                $("#ltime").val(response.ltime);
                $("#fcs1").val(response.fcs1);
                $("#numf1").val(response.numf1);
                $("#typef1").val(response.typef1);
                $("#sq1").val(response.sq1);
                $("#fcs2").val(response.fcs2);
                $("#numf2").val(response.numf2);
                $("#typef2").val(response.typef2);
                $("#sq2").val(response.sq2);
                $("#fcs3").val(response.fcs3);
                $("#numf3").val(response.numf3);
                $("#typef3").val(response.typef3);
                $("#sq3").val(response.sq3);
                $("#fcs4").val(response.fcs4);
                $("#numf4").val(response.numf4);
                $("#typef4").val(response.typef4);
                $("#sq4").val(response.sq4);
                $("#extcard").val(response.extcard);
                $("#area").val(response.area);
                $("#alt").val(response.alt);
                $("#numint").val(response.numint);
                $("#intype").val(response.intype);
                $("#numint2").val(response.numint2);
                $("#intype2").val(response.intype2);
                $("#freq").val(response.freq);
                $("#radio").val(response.radio);
                $("#post").val(response.post);
                $("#aj").val(response.aj);
                $("#ajnet").val(response.ajnet);
                $("#crypto").val(response.crypto);
                $("#mids").val(response.mids);
                $("#comq").val(response.comq);
                $("#eng").val(response.eng);
                $("#iff").val(response.iff);
                $("#reason").val(response.reason);
                $("#reason2").val(response.reason2);
                $("#remark").val(response.remark);
            }
        });
        
        
        
        
    };

