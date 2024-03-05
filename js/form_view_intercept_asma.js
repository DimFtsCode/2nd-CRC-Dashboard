$(document).ready(function () {
    var i = 0;

    $(".cotype").css({"width": "10%"});
    $(".cotype").css({"font-weight": "bold"});
    $(".cotype").css({"font-size": "16px"});


   $(".int_id").click(function(){
    var  thisIntercept=$(this).text();
    var MyAsma = $("#my_asma").val();   

        //alert(thisIntercept); 
        var data = {
            thisIntercept : thisIntercept,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_intercept.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
              //alert(response.r1);  
            }
           
        });
    
      });
    
    
    $(".trnid").click(function(){
    var  thisTrain=$(this).text();
    //var row = $(this).parent().index();
    var MyAsma = $("#my_asma").val();   
            
      //  set global asma  
      var  thisAsma=$("#userAsma").val();
      
      var data1 = {
            thisAsma : thisAsma,
            myAsma : MyAsma
        };
                
            $.ajax({
            url: '../php_functions/global_asma.php',
            type: 'post',
            data: data1,
            dataType: 'JSON',
            success: function (response) {                           
            }           
        });
        
      //  set global training 
      //var thisTrain = $(".trnid").eq(row).text();
      //alert(thisTrain);                                                                                       
      var data2 = {
            thisTrain : thisTrain,
            myAsma : MyAsma
        };
                
            $.ajax({
            url: '../php_functions/global_training.php',
            type: 'post',
            data: data2,
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
        
        var $asma = $('#userAsma').val();

        var data = {
            myAsma: $asma
        };
        //alert($asma);    
        $.ajax({
            url: '../php_functions/personnel_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.city);
                //alert(response.branch);
                $("#Head_asma").text(response.asma); 
                $("#Head_rank").text(response.rank);
                $("#Head_specialty").text(response.specialty);
                $("#Head_last_name").text(response.last_name);
                $("#Head_first_name").text(response.first_name);
            }

        });
    };







