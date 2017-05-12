<html>
<head>
</head>

    <table border="1px" id="table1"></table>

    <button id="button">test</button>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>  
    $("button#button").click(function() {
    $.ajax({
	url: "http://erpfinalproject.ddns.net:808/staff",
      type: "GET",
      dataType: "json",
      success: function(Liren){
      alert("success!!");
        var type = ["sid","staffId","username","phone","erContact","erPhone"]; 
        var i=0;
        alert(type.length);

          //alert((Object.keys(Liren[0]).length));

          var t = document.getElementById("table1");
          for(i=0; i<Liren.length;i++){
            t.insertRow();

            for(var j=0;j<type.length;j++){
            t.rows[i].insertCell(j);
            t.rows[i].cells[j].innerText = Liren[i][type[j]];
            }
          }  
          
      },
        error:function(){
        alert("Error!");
        }
    });
 });
   
   

    
    
/*    
{"sid":1,"staffId":"5469","username":"Christophe","phone":"","erContact":"","erPhone":""}
*/



    
//    var type = ["usname","value"];
 




</script>    




    </html>
