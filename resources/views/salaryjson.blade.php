<html>
<head>
</head>

<body>
    <table border="1px" id="table1"></table>
    <p id="editpanel"></p>
    <table border="1px" id="table2"></table>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>  
    
    var LirenG;
    var typeG;
    var type_nameG;

    
    $.ajax({
      url: "http://erpfinalproject.ddns.net:808/salary",
      type: "GET",
      dataType: "json",
      success: function(Liren){
      //alert("success!!");
        var type = ["id","salarytime","sid","staffId","username","allworktime","salary","extra","allsalary","exception","remark"];
        var type_name = ["薪水條目","薪資月份","員工編號","員工卡號","員工姓名","總工時","薪資","額外給薪","總薪資","例外情況","註記","編輯"];
        var i=0;
          //alert(type.length);
          //alert((Object.keys(Liren[0]).length));
          var t = document.getElementById("table1");
          LirenG = Liren;
          typeG = type;
          type_nameG = type_name;
          for(i=0; i<=Liren.length;i++){//畫出表格
          t.insertRow();
            for(var j=0;j<type_name.length;j++){//填入第一行的名稱
            t.rows[i].insertCell(j);
            t.rows[0].cells[j].innerText = type_name[j];
            t.rows[0].cells[j].id = ('type_name'+(j+1));//將type_name的每一行賦予值
            }
          }
          
          for(i=0; i<Liren.length;i++){//填入json所拿到的資料
              for(j=0;j<type.length;j++){
                t.rows[i+1].cells[j].innerText = Liren[i][type[j]];
                t.rows[i+1].cells[j].id = (type[j]+(i+1));
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
                var bye = i+1;
                return function(){
                    remove_data(bye);
                    //document.getElementById("sid"+nowId).te
                }
            })()  
            t.rows[i+1].cells[11].appendChild(editbtn);
            t.rows[i+1].cells[11].appendChild(delbtn);
          }
      },
        error:function(){
        alert("Error!");
        }
    });
 
    function remove_data(bye) {
 var num = document.getElementById("table2").rows.length;
 
  document.getElementById("table1").deleteRow(bye);
}

    function editfunc(buttonid){
        alert(buttonid);
        var t = document.getElementById("table2");//同樣地,宣告表格Id讓我可以在這裡存取第二個表格
        var id = ((buttonid.match(/\d+/g))-1);//因為type陣列跟按鍵id差1所以要減一
        alert(type_nameG.length);
        
        
        var editpanel = document.getElementById('editpanel');
        var submit = document.createElement('button');
        submit.appendChild(document.createTextNode('submit'));
        var form = document.createElement('form');
        form.setAttribute('method',"post");
        form.setAttribute('action',"http://erpfinalproject.ddns.net:808/staff/"+id+"/edit");
        

        var sidtext = document.createTextNode("您要更改的員工編號為"+LirenG[id][typeG[0]]); //新增sid文字
       
        /*
        var staffId = document.createElement('input');//staffId的輸入框
        staffId.setAttribute('type',"text");
        staffId.setAttribute('name',"staffId");
        staffId.setAttribute('value',LirenG[id][typeG[1]]);
        */
        
        for(var i=0; i<2;i++){//畫出表格
          t.insertRow();
            for(var j=0;j<type_nameG.length;j++){//填入第一行的名稱
            t.rows[i].insertCell(j);
            t.rows[0].cells[j].innerText = type_nameG[j];
            t.rows[0].cells[j].id = ('type_nameG'+(j+1));//將type_nameG的每一行賦予值
            }
          }
        for(i=0; i<1;i++){//填入json所拿到的資料
              for(j=0;j<typeG.length;j++){
                var editnow = document.createElement('input');//給使用者編輯的文字輸入框
                editnow.setAttribute('type','text');
                editnow.setAttribute('name',typeG[j]);
                editnow.setAttribute('value',LirenG[id][typeG[j]]);
                
                form.appendChild(editnow);
                t.rows[i+1].cells[j].appendChild(editnow);
                t.rows[i+1].cells[j].id = (typeG[j]+'G'+(i+1));
              }
                submit.id = ('submit');
                form.appendChild(submit);
                t.rows[i+1].cells[j].appendChild(submit);//最後一個按鈕
          }
        
        
        /*
        form.appendChild(sidtext);
        form.appendChild(document.createElement("br"));
        form.appendChild(staffId);
        editpanel.appendChild(form);
       */
    
        
    }
</script>
</body>
</html>