<html>
<head>
     <!--20170512 07:00-->
</head>
<body>
    <div id="tablearea" class="tablearea">
    <table border="1px" id="table1"></table>
    <p id="pagepanel"></p>
        <div id="staffEdit">
            <p id="editpanel"></p>		
            <table border="1px" id="table2"></table>
            <p id="submitbtn"></p>
        </div>
    </div>
    <button id="button" onclick="myfunction()">test</button>
    
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        getStaff(1);
    });
    function myfunction(){
        var z=0;
         var addbtn = document.createElement('BUTTON');
            var text = document.createTextNode('add'+(z+1));
            addbtn.appendChild(text);
            document.body.appendChild(addbtn);
    }
    var editLiren;
    
    var nowPage=1;
    
    function getStaff(page, callback){
    var pageData={
            "page":page,
    };
    nowPage=page;    
        
    $.ajax({
      url: "http://erpfinalproject.ddns.net:808/staff",
      type: "GET",
      data: pageData,
      dataType: "json",
      success: function(jsonData){
          var dataCount=0;
          Liren = jsonData['result'];
          
       // alert("第一個json");
          $("#table1").empty();
          $("#pagepanel").empty();
        var type = ["sid","staffId","username","phone","erContact","erPhone"];
        var type_name = ["員工編號","員工卡號","員工姓名","電話","緊急聯絡人","緊急連絡人電話","編輯"];
        var i=0;
          //alert((Object.keys(Liren[0]).length));
          var t = document.getElementById("table1");
          for(i=0; i<=10;i++){//畫出表格
          t.insertRow();
            for(var j=0;j<type_name.length;j++){//填入第一行的名稱
            t.rows[i].insertCell(j);
            t.rows[0].cells[j].innerText = type_name[j];
            t.rows[0].cells[j].id = ('type_name'+(j+1));//將type_name的每一行賦予值
            }
          } 
          for(i=0; i<Liren.length;i++){//填入json所拿到的資料
              dataCount++;
              for(j=0;j<type.length;j++){
                t.rows[i+1].cells[j].innerText = Liren[i][type[j]];
                t.rows[i+1].cells[j].id = (type[j]+(i+1));
              }
          }
          if(i<10){
            for(i=dataCount;i<10;i++){
              for(j=0;j<type.length;j++){
                t.rows[i+1].cells[j].innerText ='\u00a0';
              }
            }
           }
          
          for(i=0; i<Liren.length;i++){
            var editbtn = document.createElement('BUTTON');
            editbtn.id = ("edit"+Liren[i]["sid"]);
            var text = document.createTextNode(editbtn.id);
            editbtn.appendChild(text);
            var delbtn = document.createElement('BUTTON');
            delbtn.id = ("del"+Liren[i]["sid"]);
            var text2 = document.createTextNode('del');
            delbtn.appendChild(text2);
            editbtn.onclick = (function(){
                var nowId = editbtn.id;
                return function(){
                    editfunc(nowId);
                }
            })()
            delbtn.onclick = (function(){
                var nowId2 = delbtn.id;
                return console.log(function(){
                    editfunc(nowId2);
                    //document.getElementById("sid"+nowId).te
                })
            })()  
            t.rows[i+1].cells[6].appendChild(editbtn);
            t.rows[i+1].cells[6].appendChild(delbtn);
          //alert(dataCount);
              /**
              if(dataCount<10){//計算如果資料有缺少就把她補滿
                for(var j=dataCount+1; j<10; j++){
                    t.insertRow(j);
                    for(var i=0;i<type.length;i++){
                        t.rows[j].insertCell(i);
                        t.rows[j].cells[i].innerText="&nbsp;";
                        alert(i);
                    }
                }
              }
              */
              
          }
          
          
            //確認頁數
            var salaryPage=1;
            salaryPage=Math.ceil(jsonData['count']/10);

            //製作頁數
            for(var i=1; i<=salaryPage; i++){
                if(i==page){
                    var pagestr='<a>'+i+'</a>'+"&nbsp;";
                }else{
                    var pagestr='<a href="javascript:void(0)" style="text-decoration:none;" onclick="getStaff('+i+')">'+i+'</a>';
                }
                $(pagestr).appendTo($("#pagepanel"));
                $("#pagepanel").append("&nbsp;");
                //$("#recordSite").innerHTML += "&amp;nbsp;";
                //$("tt").appendTo($("#recordSite"));
            }
          
          
      },
        error:function(){
        alert("Error!");
        }
    });
       /* .done(function(){
            if (callback && typeof(callback) === "function") {
                callback();
            }
    });*/
        
    }
    
    function editfunc(btnid){//傳入按鈕的名稱
        var t = document.getElementById("table2");//同樣地,宣告表格Id讓我可以在這裡存取第二個表格
        var id = ((btnid.match(/\d+/g))-1);//因為type陣列跟按鍵id差1所以要減一
        var btnid = (id+1); //按鈕所代表的sid(純數字)
        $("#table2").empty();
        $("#submitbtn").empty();
        $("#editpanel").empty();
        //alert(btnid);
        //alert(id);
        //alert(btnid_int);
        $.ajax({
            url: "http://erpfinalproject.ddns.net:808/staff/"+(id+1)+"/edit",
            type: "GET",
            dataType: "json",
            success: function(editLiren_ajax){
                editLiren = editLiren_ajax;
        var form = document.getElementById('form1');
        //form.setAttribute('method',"PUT");
        //form.setAttribute('action',"http://erpfinalproject.ddns.net:808/staff/"+id);  
        var edittype_name = ["員工編號","員工姓名","電話","電子郵件","地址","基本薪資","額外加給"];
        var edittype = ["sid","username","phone","email","address","baseSalary","extraSalary"];
        var editpanel = document.getElementById('editpanel');
        var submitgo = document.createElement('button');    //submit按鈕建立
        submitgo.appendChild(document.createTextNode('submit')); //submit按鈕建立
        //*************************表格提交重點************************* 
        submitgo.onclick = function (){submitfunc()};
        //*************************表格提交重點*************************        
        sidtext = document.createTextNode("您要更改的員工編號為"+btnid+"號"); //新增sid文字
        editpanel.appendChild(sidtext);
        for(var i=0; i<2;i++){//畫出表格
          t.insertRow();
            for(var j=0;j<edittype_name.length;j++){//填入第一行的名稱
            t.rows[i].insertCell(j);
            t.rows[0].cells[j].innerText = edittype_name[j];
            t.rows[0].cells[j].id = ('edittype_name'+(j+1));//將edittype_name的每一行賦予值
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
                t.rows[i+1].cells[j].appendChild(editnow);
                t.rows[i+1].cells[j].id = (edittype[j]+'G'+(i+1));
              }
            submit1=document.getElementById("submitbtn");
            submit1.appendChild(submitgo);
          }
            },
            error:function(){
            }
        });
    }
    function submitfunc(){
        var datatype = ["username","phone","email","address","baseSalary","extraSalary"];
        var formData={
            "username": $('#username').val(),
            "phone": $('#phone').val(),
            "email": $('#email').val(),
            "address": $('#address').val(),
            "baseSalary": $('#baseSalary').val(),
            "extraSalary": $('#extraSalary').val(),
        };
        var sid=$('#sid').val();
        alert(sid);
        
        $.ajax({
          url:"http://erpfinalproject.ddns.net:808/staff/"+sid+"",
          type:"PUT",
          data: formData,
          dataType: "json",
        success:function(data){
            $("#table2").empty();
            getStaff();
        },
        error:function(){alert("error");},
        });
        
    }
    </script>   
    
    </body>
</html>