<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<div id="salarySite"></div>
	<div id="salaryEditSite"></div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			getSalary();
		});

		function getSalary(){
			$.ajax({
				url: "http://erpfinalproject.ddns.net:808/salary",
				type: "GET",
				//data: pageData,
				dataType: "json",

				success:function(jsonData){
					$("#salarySite").empty();
					$("#salaryEditSite").empty();
					var $table = $(document.createElement('table'));
					$table.attr('id', 'salaryTable');
					$table.attr('border', '2px');
					$table.appendTo($("#salarySite"));

					var tableField ="<tr>";
					tableField +="<td>薪資時間</td>";
					tableField +="<td>員工編號</td>";
					tableField +="<td>員工卡號</td>";
					tableField +="<td>員工姓名</td>";
					tableField +="<td>出勤時數</td>";
					tableField +="<td>系統計薪</td>";
					tableField +="<td>人工調整</td>";
					tableField +="<td>總計薪</td>";
					tableField +="<td>備註</td>";
					tableField +="<td>系統計薪例外情況</td>";
					tableField +="<td>操作</td>";
					tableField +="</tr>";

					$(tableField).appendTo($table);

					//取得資料
					var dataCount=0;
					data=jsonData['result'];
					for(var i in data){
						dataCount++;
						var staffId = data[i]['sid'];
						var tablestr = "<tr>";
						tablestr += "<td>"+data[i]['salarytime']+"</td>";
						tablestr += "<td>"+data[i]['sid']+"</td>";
						tablestr += "<td>"+data[i]['staffId']+"</td>";
						tablestr += "<td>"+data[i]['username']+"</td>";
						tablestr += "<td>"+data[i]['allworktime']+"</td>";
						tablestr += "<td>"+data[i]['salary']+"</td>";
						tablestr += "<td>"+data[i]['extra']+"</td>";
						tablestr += "<td>"+data[i]['allsalary']+"</td>";
						tablestr += "<td>"+data[i]['remark']+"</td>";
						tablestr += "<td>"+data[i]['exception']+"</td>";
						tablestr += "<td id=edit"+data[i]['sid']+"></td";
						tablestr += "</tr>";
						
						$(tablestr).appendTo($table);

						//製作詳細紀錄按鈕
						$infoButton = $(document.createElement('button'));
						$infoButton.click( (function(){
							var id = staffId;
							return function(){ editSalary(id)};
						})() );
						$infoButton.text("edit"+staffId);
						$infoButton.appendTo("#edit"+staffId+"");
					}
					/*
					if(dataCount<10){
						for(var j=dataCount; j<10; j++){
							var tablestr = "<tr>";
							tablestr += "<td>&nbsp;</td>";
							tablestr += "<td>&nbsp;</td>";
							tablestr += "<td>&nbsp;</td>";
							tablestr += "<td>&nbsp;</td>";
							tablestr += "<td>&nbsp;</td>";
							tablestr += "<td>&nbsp;</td>";
							tablestr += "<td>&nbsp;</td>";
							tablestr += "</tr>";

							$(tablestr).appendTo($table);
						}
					}
					*/

					//確認頁數
					var salaryPage=1;
					salaryPage=Math.round(jsonData['count']/10);

					//製作頁數
					/*
					for(var i=1; i<=recordPage; i++){
						if(i==page){
							var pagestr='<a>'+i+'</a>'+"&nbsp;";
						}else{
							var pagestr='<a href="javascript:void(0)" style="text-decoration:none;" onclick="getRecord('+i+')">'+i+'</a>';
						}
						$(pagestr).appendTo($("#recordSite"));
						$("#recordSite").append("&nbsp;");
						//$("#recordSite").innerHTML += "&amp;nbsp;";
						//$("tt").appendTo($("#recordSite"));
					}
					*/

				


				},

				error: function(){
					alert("error");
				}
			});
		}


		function editSalary(id){

			$.ajax({
				url: "http://erpfinalproject.ddns.net:808/salary/"+id+"/edit",
				type: "GET",
				//data: pageData,
				dataType: "json",

				success:function(jsonData){
					$("#salaryEditSite").empty();
					var pstr = "<p>欲更改之員工編號為: "+id+"";
					$(pstr).appendTo($("#salaryEditSite"));

					var $table = $(document.createElement('table'));
					$table.attr('id', 'salaryEditTable');
					$table.attr('border', '2px');
					$table.appendTo($("#salaryEditSite"));

					var tableField ="<tr>";
					tableField +="<td>薪資時間</td>";
					tableField +="<td>員工編號</td>";
					tableField +="<td>員工卡號</td>";
					tableField +="<td>員工姓名</td>";
					tableField +="<td>系統計薪</td>";
					tableField +="<td>人工調整</td>";
					tableField +="<td>備註</td>";
					tableField +="<td>系統計薪例外情況</td>";
					tablestr += "</tr>";
					$(tableField).appendTo($table);

					var tablestr ="<tr>";
					tablestr += "<td>"+jsonData['salarytime']+"</td>";
					tablestr += "<td>"+id+"</td>";
					tablestr += "<td>"+jsonData['staffId']+"</td>";
					tablestr += "<td>"+jsonData['username']+"</td>";
					tablestr += "<td>"+jsonData['salary']+"</td>";
					tablestr += '<td> <input type="text" name="extra" value="'+jsonData['extra']+'"/></td>';
					tablestr += '<td> <input type="text" name="extra" value="'+jsonData['remark']+'"/></td>';
					tablestr += '<td> <input type="text" name="extra" value="'+jsonData['exception']+'"/></td>';
					tablestr += "</tr>";
					$(tablestr).appendTo($table);

					var $saveButton = $(document.createElement('button'));
					$saveButton.click( (function(){
							return function(){ saveSalary(id)};
						})() );
					$saveButton.text("save"+id);
					$saveButton.appendTo($("#salaryEditSite"));

				},
				error: function(){
					alert("editSalary error");
				}
			});
		}
	</script>
</body>
</html>