$(document).ready(function () {
var helpChat= function () {
     //    var states = {"mailBox" , "LiveChat"};
         var currentState ="";
            
    
        var mailBox=function(){
            alert($('input[name=staff]:checked').val());    
            $('#submit').click(function(){
              //  alert("");
                $.post("updateHelpChat.php",function(data){
                alert(data);    
                $('.chatarea').text(data);
            });
                });
            };
        mailBox();
        };
    
        setInterval(function() {
      // Do something every 5 seconds
          //      alert("");
                var name=$.trim($('#name').val());
                var staff_id=$('input[name=staff]:checked').val();
               // var query= $('#query').val();
                if(name!="")
                $.post("updateHelpChat.php",{name:name,staff_id:staff_id},function(data){
                      $('.chatarea').html(data);
                    })
        }, 5000);

            $('#submitQ').click(function(){
           //    alert("");
              //  helpChat(); 
                var name=$('#name').val();
                var staff_id=$('input[name=staff]:checked').val();
                var query= $('#query').val();
                if(name!=="" || staff!=="" || query!==""){
                     $.post("mailBox.php",{name:name,staff_id:staff_id,query:query},function(data){
                //         alert(data);
                     });

                }
                
            });   
   
});