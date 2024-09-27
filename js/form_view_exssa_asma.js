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







