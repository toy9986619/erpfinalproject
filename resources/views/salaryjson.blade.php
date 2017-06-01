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
    var dbefore=0;
    var temp;
    var k;
    var oh = [2];

    
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
          for(i=0; i<Liren.length;i++) oh[i]=1;
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
 var num = document.getElementById("table1").rows.length;
        var g=0;
        oh[bye]=0;
        for(var i=0; i<bye ; i++){
            g=g+oh[i];
        }
        temp=bye-g;
        bye=bye-temp;
        console.log(bye);
  document.getElementById("table1").deleteRow(bye);
        
        
}

    function editfunc(btnid){//傳入按鈕的名稱
        var t = document.getElementById("table2");//同樣地,宣告表格Id讓我可以在這裡存取第二個表格
        var id = ((btnid.match(/\d+/g))-1);//因為type陣列跟按鍵id差1所以要減一
        var btnid_int = (id+1); //按鈕所代表的sid(純數字)
        //alert(btnid);
        //alert(id);
        //alert(btnid_int);
        $.ajax({
            url: "http://erpfinalproject.ddns.net:808/salary/"+(id+1)+"/edit",
            type: "GET",
            dataType: "json",
            success: function(editLiren_ajax){
                editLiren = editLiren_ajax;
                
        var form = document.createElement('form');
        //form.setAttribute('method',"PUT");
        //form.setAttribute('action',"http://erpfinalproject.ddns.net:808/staff/"+id);  
        form.id = ('form_id');
        var edittype_name = ["員工卡號","員工姓名","薪資","額外給薪","總薪資","送出"];
        var edittype = ["staffId","username","salary","extra","allsalary"];
        var editpanel = document.getElementById('editpanel');
        var submitgo = document.createElement('button');    //submit按鈕建立
        submitgo.appendChild(document.createTextNode('submit')); //submit按鈕建立
        submitgo.id = ('submitbtn');
        submitgo.setAttribute('type','submit');
        form.appendChild(submitgo);
        //submitgo.onclick = function(){};
        //*************************表格提交重點************************* 
        submitgo.onclick = function (){submitfunc()};
        document.body.appendChild(form);
        //*************************表格提交重點*************************        
        
        sidtext = document.createTextNode("您要更改的員工編號為"+LirenG[id][typeG[0]]); //新增sid文字
        editpanel.appendChild(sidtext);
        /*
        var staffId = document.createElement('input');//staffId的輸入框
        staffId.setAttribute('type',"text");
        staffId.setAttribute('name',"staffId");
        staffId.setAttribute('value',LirenG[id][typeG[1]]);
        */
        for(var i=0; i<2;i++){//畫出表格
          t.insertRow();
            for(var j=0;j<edittype_name.length;j++){//填入第一行的名稱
            t.rows[i].insertCell(j);
            t.rows[0].cells[j].innerText = edittype_name[j];
            t.rows[0].cells[j].id = ('edittype_name'+(j+1));//將type_nameG的每一行賦予值
            }
          }
        for(i=0; i<1;i++){//填入json所拿到的資料
              for(j=0;j<edittype.length;j++){
                var editnow = document.createElement('input');//給使用者編輯的文字輸入框
                editnow.setAttribute('type','text');
                editnow.setAttribute('name',edittype[j]);
                editnow.setAttribute('value',editLiren[edittype[j]]);
                editnow.setAttribute('limitlength',2);
                editnow.id = (edittype[j]);
                form.appendChild(editnow);
                t.rows[i+1].cells[j].appendChild(editnow);
                t.rows[i+1].cells[j].id = (edittype[j]+'G'+(i+1));
              }
                //document.body.appendChild(form);
                t.rows[i+1].cells[j].appendChild(submitgo);//最後一個按鈕
          }
            },
            error:function(){
            }
        });
    }
    
    function submitfunc(){
        var data = ["id","salarytime","sid","staffId","username","allworktime","salary","extra","allsalary","exception","remark"];
        for(var i = 0;i<data.length;i++){
            data[i] = $('#'+data[i]).val();   
            alert(data[i]);
        }
    }''

// });
//    var type = ["usname","value"];
 
</script>
</body>
</html>