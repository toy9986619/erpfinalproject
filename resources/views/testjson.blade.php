<html>
<head>
     <!--20170512 07:00-->
</head>

    <table border="1px" id="table1"></table>

    <button id="button" disabled>test</button>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>  
    //$("button#button").click(function() {
    $.ajax({
      url: "http://erpfinalproject.ddns.net:808/staff",
      type: "GET",
      dataType: "json",
      success: function(Liren){
      alert("success!!");
        var type = ["sid","staffId","username","phone","erContact","erPhone"];
        var type_name = ["員工編號","員工卡號","員工姓名","電話","緊急聯絡人","緊急連絡人電話"];
        var i=0;
        alert(type.length);
          //alert((Object.keys(Liren[0]).length));
          var t = document.getElementById("table1");
          
          for(i=0; i<=Liren.length;i++){
          t.insertRow();
            for(var j=0;j<type.length;j++){
            t.rows[i].insertCell(j);
            t.rows[i].cells[j].innerText = type_name[j];
            }
          }
          for(i=0; i<=Liren.length;i++){
              for(var k=0;k<type.length;k++){
                t.rows[i+1].cells[k].innerText = Liren[i][type[k]];
              }
          }
          
          
      },
        error:function(){
        alert("Error!");
        }
    });
// });
   
   

    
    
/*    
{"sid":1,"staffId":"5469","username":"Christophe","phone":"","erContact":"","erPhone":""}
*/



    
//    var type = ["usname","value"];
 




</script>    




    </html>