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
    var Liren2;
    
    $.ajax({
      url: "http://erpfinalproject.ddns.net:808/staff",
      type: "GET",
      dataType: "json",
      success: function(Liren){
      alert("success!!");
        var type = ["sid","staffId","username","phone","erContact","erPhone"];
        var type_name = ["員工編號","員工卡號","員工姓名","電話","緊急聯絡人","緊急連絡人電話","編輯"];
        var i=0;
          //alert(type.length);
          //alert((Object.keys(Liren[0]).length));
          var t = document.getElementById("table1");
          Liren2=Liren;
         // alert(Liren);
          //alert(testJSON);
          
          for(i=0; i<=Liren.length;i++){
          t.insertRow();
            for(var j=0;j<type_name.length;j++){//填入第一行的名稱加上畫出表格
            t.rows[i].insertCell(j);
            t.rows[0].cells[j].innerText = type_name[j];
            }
          }
          
          for(i=0; i<Liren.length;i++){//填入json所拿到的資料
              for(j=0;j<type.length;j++){
                t.rows[i+1].cells[j].innerText = Liren[i][type[j]];
              }
          }
          
          for(i=0; i<Liren.length;i++){
            var editbtn = document.createElement('BUTTON');
            editbtn.id = ('edit'+(i+1));
            var text = document.createTextNode(editbtn.id);
            editbtn.appendChild(text);
            var delbtn = document.createElement('BUTTON');
            delbtn.id = ('del'+(i+1));
            var text2 = document.createTextNode('del');
            delbtn.appendChild(text2);
            editbtn.onclick = (function(){
                var nowId = editbtn.id;
                return function(){
                    editfunc(nowId);
                    //document.getElementById("sid"+nowId).te
                }
            })()
            delbtn.onclick = (function(){
                var nowId2 = delbtn.id;
                return function(){
                    editfunc(nowId2);
                    //document.getElementById("sid"+nowId).te
                }
            })()  
            t.rows[i+1].cells[6].appendChild(editbtn);
            t.rows[i+1].cells[6].appendChild(delbtn);
          }
      },
        error:function(){
        alert("Error!");
        }
    });
    
    function editfunc(id){
        alert(id);
        var form = document.createElement('form');
        form.setAttribute('method',"post");
        form.setAttribute('action',"http://erpfinalproject.ddns.net:808/staff"+""+"sid");
        var input = document.createElement('input');
        input.setAttribute('type',"text");
        input.setAttribute('name',"staffId");
        form.appendChild(input);
        
        
    }
    
// });
//    var type = ["usname","value"];
</script>    
    </body>
</html>