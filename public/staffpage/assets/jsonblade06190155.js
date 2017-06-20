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
          $("#addpanel").empty();
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
            var delbtn = document.createElement('BUTTON');
            var text = document.createTextNode('edit');
            var text2 = document.createTextNode('del');
            editbtn.id = ("edit"+Liren[i]["sid"]);
            delbtn.id = ("del"+Liren[i]["sid"]);
            editbtn.appendChild(text);
            delbtn.appendChild(text2);
            editbtn.onclick = (function(){
                var nowId = editbtn.id;
                return function(){
                    editfunc(nowId);
                    
                    //彈窗程式碼開始
					$("#demo01").animatedModal();
					lnk = document.getElementById("demo01"); 
					lnk.click();
					//彈窗程式碼結束
                }
            })()
            delbtn.onclick = (function(){
                var nowId2 = delbtn.id;
                return console.log=(function(){
                delfunc(nowId2);
                    //document.getElementById("sid"+nowId).te
                })
            })()  
            t.rows[i+1].cells[6].appendChild(editbtn);
            t.rows[i+1].cells[6].appendChild(delbtn); 
          }
          
            //製作並放置add按鈕
            var addbtn = document.createElement('BUTTON');
            var addtext = document.createTextNode('add');
            var enter = document.createTextNode('\n');
            var addpanel = document.getElementById('addpanel');
            addbtn.id = "addnewstaff";
            addbtn.appendChild(addtext);
            addpanel.appendChild(addbtn);
            addbtn.onclick = function(){
				addfunc();
				$("#demo01").animatedModal();
					lnk = document.getElementById("demo01"); 
					lnk.click();
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
    
    function delfunc(btnid){
        var t = document.getElementById("table2");//同樣地,宣告表格Id讓我可以在這裡存取第二個表格
        var id = ((btnid.match(/\d+/g))-1);//因為type陣列跟按鍵id差1所以要減一
        var btnid = (id+1); //按鈕所代表的sid(純數字)
        data="你真的要刪除員工編號"+btnid+"嗎?";
        title="警告";
        $('body').append('<div id="dps" title="'+title+'" style="display:none;">'+data+'</div>');
        $(function() {
            $("#dps").dialog({
              height:250,
              modal: true,
              buttons: {
                '確定':function() {
                    $('#dps').remove();
                    $.ajax({
                    url:"http://erpfinalproject.ddns.net:808/staff/"+btnid,
                    type:"DELETE",
                    dataType:"json",
                    success:function(){
                    $("#submitbtn").empty();
                    $("#editpanel").empty();
                    $("#table2").empty();
                    alert("刪除成功");
                    getStaff(nowPage);
                    },
                    error:function(){alert("刪除失敗,請聯繫網站管理員");},
                    });
                },
                '取消':function() {
                $('#dps').remove();
                }
              }
             });
        });
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
        submitgo.onclick = function (){submitfunc(1)};
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
            t.rows[i+1].cells[0].innerText = editLiren[edittype[0]];
            t.rows[i+1].cells[0].id = ('edit'+edittype[0]);
              for(j=1;j<edittype.length;j++){
                var editnow = document.createElement('input');//給使用者編輯的文字輸入框
                editnow.setAttribute('type','text');
                editnow.setAttribute('name',edittype[j]);
                editnow.setAttribute('value',editLiren[edittype[j]]);
                editnow.setAttribute('limitlength',2);
                editnow.id = (edittype[j]);
                t.rows[i+1].cells[j].appendChild(editnow);
                t.rows[i+1].cells[j].id = ('edit'+edittype[j]);
              }
            editsubmit=document.getElementById("submitbtn");
            editsubmit.appendChild(submitgo);
          }
            },
            error:function(){
            }
        });
    }
    
    
    function addfunc(){
        $("#table2").empty();
        $("#submitbtn").empty();
        $("#editpanel").empty();
        var addtype =["staffId","rfid","username","phone","email","address","erContact","erPhone","baseSalary","extraSalary"];
        var addtype_name =["員工卡號","RFID","員工姓名","電話","電子郵件","地址","erContact","erPhone","基本薪資","額外薪資"];
        var t = document.getElementById("table2");
        for(i=0;i<4;i++){
        t.insertRow();
            for(j=0;j<(addtype_name.length)/2;j++){
                if(i==0){
                    t.rows[i].insertCell(j);
                    t.rows[i].cells[j].innerText = addtype_name[j];
                }
                else if(i==1){
                    t.rows[i].insertCell(j);
                    addinput = document.createElement('input');//給使用者編輯的文字輸入框
                    addinput.setAttribute('type','text');
                    addinput.setAttribute('limitlength',2);
                    addinput.setAttribute('name',addtype[j]);
                    //addinput.setAttribute('onfocus',addtype_name[j]); //??????????????????????????????????????????????????????正在研究中的功能                
                    addinput.id = (addtype[j]);
                    t.rows[i].cells[j].appendChild(addinput);
                }
                else if(i==2){
                    t.rows[i].insertCell(j);
                    t.rows[i].cells[j].innerText = addtype_name[j+5];
                }
                else if(i==3){
                    t.rows[i].insertCell(j);
                    addinput = document.createElement('input');//給使用者編輯的文字輸入框
                    addinput.setAttribute('type','text');
                    addinput.setAttribute('limitlength',2);
                    addinput.setAttribute('name',addtype[j+5]);
                    addinput.id = (addtype[j+5]);
                    t.rows[i].cells[j].appendChild(addinput);
                }
                t.rows[i].cells[j].id = ('add'+'_'+addtype[j+5]);
            }
        }
        submitgo = document.createElement('BUTTON');
        submitgo.appendChild(document.createTextNode('submit'));
        //*************************表格提交重點************************* 
        submitgo.onclick = function(){submitfunc(2)};
        //*************************表格提交重點************************* 
        addsubmit = document.getElementById("submitbtn");
        addsubmit.appendChild(submitgo);
    }
    
    function submitfunc(choose){
        if(choose==1){
            var edittype = ["username","phone","email","address","baseSalary","extraSalary"];//參考用
            var formData={
                "username": $('#username').val(),
                "phone": $('#phone').val(),
                "email": $('#email').val(),
                "address": $('#address').val(),
                "baseSalary": $('#baseSalary').val(),
                "extraSalary": $('#extraSalary').val(),
            };
            var sid=$('#editsid').text();

            $.ajax({
              url:"http://erpfinalproject.ddns.net:808/staff/"+sid+"",
              type:"PUT",
              data: formData,
              dataType: "json",
            success:function(data){
                $("#submitbtn").empty();
                $("#editpanel").empty();
                $("#table2").empty();
                alert('保存成功');
                getStaff(nowPage);
            },
            error:function(){alert("error");},
            });
        }
        else if(choose==2){
             var addtype =["staffId","rfid","username","phone","email","address","erContact","erPhone","baseSalary","extraSalary"];//參考用
             var formData={
                "staffId":$('#staffId').val(),
                "rfid":$('#rfid').val(),
                "username":$('#username').val(),
                "phone":$('#phone').val(),
                "email":$('#email').val(),
                "address":$('#address').val(),
                "erContact":$('#erContact').val(),
                "erPhone":$('#erPhone').val(),
                "baseSalary":$('#baseSalary').val(),
                "extraSalary":$('#extraSalary').val(),
            };
            var sid=$('#sid1').text(); if($('#username').val().length<=0||$('#phone').val().length<=0||$('#email').val().length<=0){   
                alert("您有必填資料未填寫完整!!");
                return;}
            else{}
            $.ajax({
              url:"http://erpfinalproject.ddns.net:808/staff",
              type:"POST",
              data: formData,
              dataType:"json",
            success:function(data){
                $("#submitbtn").empty();
                $("#editpanel").empty();
                $("#table2").empty();
                alert("保存成功!!");
                getStaff(nowPage);
            },
            error:function(){alert("error");},
            });
        }
        
    }