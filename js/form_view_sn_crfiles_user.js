$(document).ready(function () {
    
 var tokens = null;
    
$(".description").css({"width": "25%"});
$(".description").css({"font-weight": "bold"});
    
    
    $(".sign_id").click(function () {        

        var col = $(this).index();
        var row = $(this).parent().index();


       // var thisSign = $(this).text();
        var thisID = $(".fid").eq(row).text();
        var MyAsma = $("#my_asma").val();

        var data = {
            myID: thisID,
            myAsma: MyAsma
        };
        //alert(MyAsma);  
        alert("You are going to UnSIGN CRF File with ID : " + thisID);  
        $.ajax({
            url: '../php_functions/edit2_crf_asma.php',
            type: 'post',
            data: data,
            async: false,
            global: false,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.sign);               
                tokens = JSON.parse(response.sign);
            }

        });
        
         if (tokens == 1) {
            //window.location = "success_op.php";     
            window.location = "form_view_us_crfiles_user.php";
        } else {
            window.location = "form_view_sn_crfiles_user.php";
        }
        
    });
    

    
});            


