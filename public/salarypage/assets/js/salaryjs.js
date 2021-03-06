
		$(document).ready(function(){
			getSalary(1);

			$countButton = $(document.createElement('button'));
			$countButton.click( function(){
				countSalary();
			} );
			$countButton.text("計算薪水");
			$countButton.appendTo("#salaryActionSite");
		});

		var nowPage=1;

		function getSalary(page, callback){
			var pageData={
				"page":page,
			};
			nowPage=page;

			$.ajax({
				url: "http://erpfinalproject.ddns.net:808/salary",
				type: "GET",
				data: pageData,
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
						var salaryId = data[i]['id'];
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
						tablestr += "<td id=salaryEdit"+data[i]['sid']+"></td";
						tablestr += "</tr>";
						
						$(tablestr).appendTo($table);

						//製作編輯按鈕
						$infoButton = $(document.createElement('button'));
						$infoButton.click( (function(){
							var id = salaryId;
							return function(){ 
								editSalary(id)
								//彈窗開始
								$("#demo03").animatedModal({
									modalTarget:'animatedModal3'
								});
	                    		lnk = document.getElementById("demo03");
 	                    		lnk.click();
 	                    		//彈窗結束
							};
						})() );
						$infoButton.text("edit");
						$infoButton.appendTo("#salaryEdit"+salaryId+"");
					}
					
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
							tablestr += "<td>&nbsp;</td>";
							tablestr += "<td>&nbsp;</td>";
							tablestr += "<td>&nbsp;</td>";
							tablestr += "<td>&nbsp;</td>";
							tablestr += "</tr>";

							$(tablestr).appendTo($table);
						}
					}
					

					//確認頁數
					var salaryPage=1;
					salaryPage=Math.ceil(jsonData['count']/10);

					//製作頁數
					for(var i=1; i<=salaryPage; i++){
						if(i==page){
							var pagestr='<a>'+i+'</a>'+"&nbsp;";
						}else{
							var pagestr='<a href="javascript:void(0)" style="text-decoration:none;" onclick="getSalary('+i+')">'+i+'</a>';
						}
						$(pagestr).appendTo($("#salarySite"));
						$("#salarySite").append("&nbsp;");
						//$("#recordSite").innerHTML += "&amp;nbsp;";
						//$("tt").appendTo($("#recordSite"));
					}
					

				


				},

				error: function(){
					alert("error");
				}
			}).done(function(){
				if (callback && typeof(callback) === "function") {
        			callback();
    			}
			});

			
		}


		function editSalary(id){
			
			$.ajax({
				url: "http://erpfinalproject.ddns.net:808/salary/"+id+"/edit",
				type: "GET",
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
					tablestr += '<td> <input type="text" name="remark" value="'+jsonData['remark']+'"/></td>';
					tablestr += '<td> <input type="text" name="exception" value="'+jsonData['exception']+'"/></td>';
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

		function saveSalary(id){
			var formData ={
				'extra':$('input[name="extra"]').val(),
				'remark':$('input[name="remark"]').val(),
				'exception':$('input[name="exception"]').val(),
			};

			$.ajax({
				url: "http://erpfinalproject.ddns.net:808/salary/"+id+"",
				type: "PUT",
				data: formData,
				dataType: "json",
				success: function(jsonData){
					if(jsonData['status']==1){
						getSalary(nowPage, function(){
							$("#salaryEditSite").append("<p> 成功保存 </p>");}
						);
					}
				},
				error: function(){
					alert("saveSalary error");
				}
			});

		}

		function countSalary(){
		$("#salaryMsgSite").empty();

			$.ajax({
				url: "http://erpfinalproject.ddns.net:808/countSalary",
				type: "get",
				dataType: "json",
				success: function(jsonData){
					if(jsonData['status']==1){
						getSalary(1, function(){
							$("#salaryMsgSite").append("<p> 成功計薪 </p>");}
						);
					}else{
						$("#salaryMsgSite").append("<p> 失敗，已有薪水資料 </p>");
					}
				},
				error: function(){
					alert("saveSalary error");
				}
			});

		}
