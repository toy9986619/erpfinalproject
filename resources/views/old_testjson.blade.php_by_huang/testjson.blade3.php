<html>
<head>
     <!--20170512 07:00-->
</head>
<body>
    <table border="1px" id="table1"></table>

    <button id="button" onclick="myfunction()">test</button>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>  
    //$("button#button").click(function() {
    function myfunction(){
        var z=0;
         var addbtn = document.createElement('BUTTON');
            var text = document.createTextNode('add'+(z+1));
            addbtn.appendChild(text);
            document.body.appendChild(addbtn);
    }
    
    $.ajax({
      url: "http://erpfinalproject.ddns.net:808/staff",
      type: "GET",
      dataType: "json",
      success: function(Liren){
      alert("success!!");
        var type = ["sid","staffId","username","phone","erContact","erPhone"];
        var type_name = ["員工編號","員工卡號","員工姓名","電話","緊急聯絡人","緊急連絡人電話"];
        var i=0;
          //alert(type.length);
          //alert((Object.keys(Liren[0]).length));
          var t = document.getElementById("table1");
          
          for(i=0; i<=Liren.length;i++){
          t.insertRow();
            for(var j=0;j<type.length;j++){//填入第一行的名稱加上畫出表格
            t.rows[i].insertCell(j);
            t.rows[i].cells[j].innerText = type_name[j];
            }
          }
          for(i=0; i<=Liren.length;i++){//填入json所拿到的資料
              for(j=0;j<type.length;j++){
                t.rows[i+1].cells[j].innerText = Liren[i][type[j]];
              }
          }
          for(i=0; i<=Liren.length;i++){
            var addbtn = document.createElement('BUTTON');
            var text = document.createTextNode('add'+(i+1));
            addbtn.appendChild(text);
            t.rows[i+1].cells[1].appendChild(addbtn);
          }
      },
        error:function(){
        alert("Error!");
        }
    });
// });
//    var type = ["usname","value"];
</script>    
    </body>
</html>