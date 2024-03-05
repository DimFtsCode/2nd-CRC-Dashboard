$(document).ready(function () {
    var i = 0;

    
$(".asma").click(function(){
    var  thisAsma=$(this).text();
    var MyAsma = $("#my_asma").val();   

        var data = {
            thisAsma : thisAsma,
            myAsma : MyAsma
        };
           $.ajax({
            //url: '../php_functions/global_variables.php',
            url: '../php_functions/global_asma.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                
            }
           
        });
    
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
    
    
      $(".date_end").each(function () {
        var today = new Date();
        var myDate = new Date($(this).text());
        var row = $(this).parent().index();
        var type = $(".exam_type").eq(row).text();
        //var test = 0;
        var diffDays = parseInt((today - myDate) / (1000 * 60 *60 *24), 10 );
        if (diffDays > 365 && type =="ΕΤΗΣΙΑ") {             
            $(this).css({"background-color": "red"});
        } else if (diffDays > 330 && type =="ΕΤΗΣΙΑ") {             
            $(this).css({"background-color": "orange"});
        } else if (diffDays > 730 && type =="ΔΙΕΤΗΣΙΑ") {             
            $(this).css({"background-color": "red"});
        } else if (diffDays > 700 && type =="ΔΙΕΤΗΣΙΑ") {             
            $(this).css({"background-color": "orange"});
        } else if (diffDays > 1825 && type =="ΠΕΡΙΟΔΙΚΗ ΕΞΕΤΑΣΗ") {             
            $(this).css({"background-color": "red"});
        } else if (diffDays > 1790 && type =="ΠΕΡΙΟΔΙΚΗ ΕΞΕΤΑΣΗ") {             
            $(this).css({"background-color": "orange"});
        } else if (diffDays > 1825 && type =="ΑΡΧΙΚΗ ΕΝΤΑΞΗ") {             
            $(this).css({"background-color": "red"});
        }              
        //alert(diffDays);
       
    }
    );
 
});

    








