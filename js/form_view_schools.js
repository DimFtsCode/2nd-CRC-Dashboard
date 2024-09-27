$(document).ready(function () {
    var i = 0;

    
$(".shid").click(function(){
    var  thisSchool=$(this).text();
    var MyAsma = $("#my_asma").val();   

//     alert(thisSchool);
//     alert(MyAsma);
     
        var data = {
            thisSchool : thisSchool,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_school.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                
            }
           
        });
    
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

    








