$(document).ready(function () {
    var i = 0;
    var j = 0;
    
    $(".description").css({"width": "15%"});
    $(".division").css({"font-size": "12px"});
    $(".branch").css({"font-size": "12px"});
    $(".description").css({"font-weight": "bold"});
    $(".status").css({"font-size": "10px"});
    $(".poc").css({"font-size": "12px"});
    $(".type_order").css({"font-size": "12px"});
    $(".order").css({"font-size": "12px"});
    $(".link").css({"font-size": "12px"});
    $(".remark").css({"font-size": "12px"});
    
    $(".sum1").css({"font-weight": "bold"});
    $(".sum1").css({"background-color": "yellow"});
    $(".sum2").css({"font-weight": "bold"});
    $(".sum2").css({"background-color": "cyan"});
    
   
    $(".funded").each(function () {
        //var existingText = $(this).text();
        //$(this).css({"background-color" : "red"});
        if ($(this).text() == "Yes") {
            $(this).css({"background-color": "yellow"});
           // $(this).next().css({"background-color": "red"});
            $(".budget").eq(i).css({"background-color": "yellow"});
            $(".bcode").eq(i).css({"background-color": "yellow"});
        } else if ($(this).text() == "No") {
            $(this).css({"background-color": "red"});

        } 
        
        i = i + 1;
    }
    );
    
    
    $(".status").each(function () {
        //var existingText = $(this).text();        
        if ($(this).text() == "ΟΛΟΚΛΗΡΩΜΕΝΗ") {
            $(this).css({"background-color": "green"});
           // $(this).next().css({"background-color": "red"});
            $(".snumber").eq(j).css({"background-color": "green"});
            $(".sdate").eq(j).css({"background-color": "green"});
            $(".description").eq(j).css({"background-color": "green"});
            $(".division").eq(j).css({"background-color": "green"});
            $(".branch").eq(j).css({"background-color": "green"});
            $(".budget").eq(j).css({"background-color": "green"});
            $(".bcode").eq(j).css({"background-color": "green"});
            $(".funded").eq(j).css({"background-color": "green"});
        } else if ($(this).text() == "ΣΕ ΕΞΕΛΙΞΗ") {
            $(this).css({"background-color": "orange"});

        } else if ($(this).text() == "ΑΚΥΡΩΘΗΚΕ") {
            $(this).css({"background-color": "red"});

        } 
        
        j = j + 1;
    }
    );

    $('#kae').change(function () {        
                
        var MyAsma = $("#my_asma").val();               
        var $option = $(this).find('option:selected');       
        var value1 = $option.val();//to get content of "value" attrib
        //
        //alert(value1);          
        
        var data = {
            myKAE: value1,
            myAsma : MyAsma
        };
        
            $.ajax({
            url: '../php_functions/global_kae.php',
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
    
    
    $(".supid").click(function(){
    var  thisSupply=$(this).text();
    var row = $(this).parent().index();
    var MyAsma = $("#my_asma").val();   

        //alert(thisSecData); 
        //alert(MyAsma); 
        var data = {
            thisSupply : thisSupply,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_supply.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
              //alert(response.r1);  
            }
           
        });        
               
  
      });
      
      
    $(".delid").click(function(){
    var  thisSupply=$(this).text();
    var row = $(this).parent().index();
    var MyAsma = $("#my_asma").val();   

        //alert(thisSecData); 
        //alert(MyAsma); 
        var data = {
            thisSupply : thisSupply,
            myAsma : MyAsma
        };
           $.ajax({
            url: '../php_functions/global_supply.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
              //alert(response.r1);  
            }
           
        });          
               
  
      });  
 
});

    






