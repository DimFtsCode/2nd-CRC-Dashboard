$(document).ready(function () {
    var i = 0;

$('#directorate').change(function () {        
        
        
        var MyAsma = $("#my_asma").val();       
        //$("#my_asma").css({backgroundColor: 'yellow'});
        //Use $option (with the "$") to see that the variable is a jQuery object
        var $option = $(this).find('option:selected');
        //Added with the EDIT
        var value1 = $option.val();//to get content of "value" attrib
        //
        //alert(value1);
        //alert(MyAsma);        
        
        var data = {
            myDivID: value1,
            myAsma : MyAsma
        };
        
            $.ajax({
            url: '../php_functions/global_division.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
            //  alert(response.r1);

            }
           
        });
        //window.location.reload();
        //setTimeout(function(){location.reload()}, 3000);
        
        setTimeout(function () {     location.reload(true); }, 500);
        
 });
                    
$(".asma").click(function(){
    var  thisAsma=$(this).text();
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
    
$("#btn_calc").click(function () {
   var i = 0;
   $(".leave1").each(function () {
       
        var myDays = $(this).text();
        //var myDays = parseint($(this).text());
        var row = $(this).parent().index();
        var CheckDays = $("#numofdays").val();
        //var CheckDays = parseint($("#numofdays").val());
                
        //numofdays
        if (myDays < CheckDays) {             
            $(this).css({"background-color": "red"});
            $(".sname").eq(i).css({"background-color": "red"});
        } else if (myDays < 10) {             
            $(this).css({"background-color": "red"});
            $(".sname").eq(i).css({"background-color": "red"});
        } else if (myDays > 30) {             
            $(this).css({"background-color": "cyan"});
            $(".sname").eq(i).css({"background-color": "cyan"});
        } 
        //alert(myDays);
        //alert(CheckDays);
       i = i + 1;
    }
    ); 
                
});   
    
    
    
$(".tpid").click(function(){
    var  thisTpye=$(this).text();
    var row = $(this).parent().index();  
    var MyAsma = $("#my_asma").val();   

        var data = {
            thisTpye : thisTpye,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_tpye.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                
            }
           
        });
        
        
      //  set global asma  
      var thisAsma = $(".asma").eq(row).text();
      
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
                        
    });
 
});



