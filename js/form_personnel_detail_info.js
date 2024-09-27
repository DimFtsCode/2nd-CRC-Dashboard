

$(document).ready(function () {
    
    //$("#location").css({backgroundColor: 'blue'});
    //$("#asma").val(12345);
   
    
    $("#add_prsdata").click(function(){
    var  thisAsma=$("#userAsma").val();
    var MyAsma = $("#my_asma").val();  
    
    //alert(MyAsma);
    //alert(thisAsma);//check the id if you are getting current id or not

        var data = {
            thisAsma : thisAsma,
            myAsma : MyAsma
            
        };
           $.ajax({
            url: '../php_functions/global_variables.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
            }
           
        });
    
    });   
    
     $("#add_duty").click(function(){
    var  thisAsma=$("#userAsma").val();
    var MyAsma = $("#my_asma").val();  
    
    //alert(MyAsma);
    //alert(thisAsma);//check the id if you are getting current id or not

        var data = {
            thisAsma : thisAsma,
            myAsma : MyAsma
            
        };
           $.ajax({
            url: '../php_functions/global_variables.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
            }
           
        });
    
    });   
    
    
  $("#edit_prsdata").click(function(){
    var  thisAsma=$("#userAsma").val();
    var MyAsma = $("#my_asma").val();   
    //var MyAsma = $("#pl_asma").text();
    //alert(thisAsma);//check the id if you are getting current id or not
    //alert(MyAsma);
    //alert("test");
    //var value1 = id;
    // var value1 = "check";
    //alert(value1);  
        //
        var data = {
            thisAsma : thisAsma,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_variables.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
            //setTimeout(function () {     location.reload(true); }, 5000);
            //alert(response.r3);
            //setTimeout(function () {     location.reload(true); }, 5000);            
                
            }
           
        });
    
    });
    
    
   $("#edit_personnel").click(function(){
    var  thisAsma=$("#userAsma").val();
    var MyAsma = $("#my_asma").val();   
        //alert(MyAsma);
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
    
    
    $("#edit_duty").click(function(){
    var  thisAsma=$("#userAsma").val();
    var MyAsma = $("#my_asma").val();   

        var data = {
            thisAsma : thisAsma,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_variables.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {           
                                   
            }
           
        });
    
    });
    
    
    
    $("#view_leave").click(function(){
    var  thisAsma=$("#userAsma").val();
    var MyAsma = $("#my_asma").val();   
        //
        var data = {
            thisAsma : thisAsma,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_variables.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                
            }
           
        });
    
    });
    
    $("#view_pgrleave").click(function(){
    var  thisAsma=$("#userAsma").val();
    var MyAsma = $("#my_asma").val();   
        //
        var data = {
            thisAsma : thisAsma,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_variables.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                
            }
           
        });
    
    });
    
    
    
    $("#view_school").click(function(){
    var  thisAsma=$("#userAsma").val();
    var MyAsma = $("#my_asma").val();   
        //alert(thisAsma);  
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
    
    
    $("#add_medata").click(function(){
    var  thisAsma=$("#userAsma").val();
    var MyAsma = $("#my_asma").val();       
    //alert(thisAsma);
    
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
    
    $("#edit_medata").click(function(){
    var  thisAsma=$("#userAsma").val();
    var MyAsma = $("#my_asma").val();       
    //alert(thisAsma);
    
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
    
    
    $("#add_tpye").click(function(){
    var  thisAsma=$("#userAsma").val();
    var MyAsma = $("#my_asma").val();       
    //alert(thisAsma);
    
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
    
    $("#edit_tpye").click(function(){
    var  thisAsma=$("#userAsma").val();
    var MyAsma = $("#my_asma").val();       
    //alert(thisAsma);
    
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
    
    $("#intercept").click(function(){
    var  thisAsma=$("#userAsma").val();
    var MyAsma = $("#my_asma").val();       
    //alert(thisAsma);
    
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
    
    $("#view_event").click(function(){
    var  thisAsma=$("#userAsma").val();
    var MyAsma = $("#my_asma").val();       
    //alert(thisAsma);
    
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

});       


window.onload = function () {
        //setTimeout(function () {     location.reload(true); }, 500);
        
       var $asma = $('#userAsma').val();

        var data = {
            myAsma: $asma
        };
        
            $.ajax({
            url: '../php_functions/personnel_select3.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                //alert(response.rank);
                $("#asma").val(response.asma);
                $("#rank").val(response.rank);
                $("#specialty").val(response.specialty);
                $("#last_name").val(response.last_name);
                $("#first_name").val(response.first_name);
                $("#directorate").val(response.directorate);
                $("#branch").val(response.branch);
                $("#office").val(response.office);
                $("#dateofbirth").val(response.dateofbirth);
                $("#dateofassign").val(response.dateofassign);
                $("#dateofrelease").val(response.dateofrelease);
                $("#idnumber").val(response.idnumber);
                                                 
                $("#city").val(response.city);
                $("#address").val(response.address);
                $("#pscode").val(response.pscode);
                $("#mphone").val(response.mphone);
                $("#phone1").val(response.phone1);
                $("#phone2").val(response.phone2);
                $("#iphone").val(response.iphone);
                $("#duty1").val(response.duty1);
                $("#date1").val(response.date1);
                $("#duty2").val(response.duty2);
                $("#date2").val(response.date2);
                $("#duty3").val(response.duty3);
                $("#date3").val(response.date3);
                
                $("#medfolder_yn").val(response.medfolder_yn);
                $("#medfolder_loc").val(response.medfolder_loc);
                $("#trfolder_yn").val(response.trfolder_yn);
                $("#trfolder_loc").val(response.trfolder_loc);
                $("#abm_yn").val(response.abm_yn);
                $("#abm_loc").val(response.abm_loc);
                
                $("#tpye_last").val(response.date_start);
                $("#tpye").val(response.tpye);
            }
            
        });
    };


