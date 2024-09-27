$(document).ready(function () {
    var i = 0;

    $(".sname").css({"width": "10%"});
    $(".sname").css({"font-weight": "bold"});
    $(".sname").css({"font-size": "16px"});

    $(".fname").css({"width": "10%"});
    $(".fname").css({"font-weight": "bold"});
    $(".fname").css({"font-size": "16px"});

    
$(".asma").click(function(){
    var  thisAsma=$(this).text();
    var MyAsma = $("#my_asma").val();   

//     alert(thisSchool);
//     alert(MyAsma);
     
        var data = {
            thisAsma : thisAsma,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_asma.php',
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

    
window.onload = function () {
         //document.getElementById("asma").setAttribute("readonly", true);
        
        var $school = $('#mySchool').val();

        var data = {
            mySchool: $school
        };
        //alert($asma);    
        $.ajax({
            url: '../php_functions/school_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.city);
                //alert(response.branch);
                $("#Head_shid").text(response.shid);
                $("#Head_type").text(response.shtype);
                $("#Head_name").text(response.shname);              
                $("#Head_location").text(response.location);
                $("#Head_description").text(response.description);             
            }

        });
    };








