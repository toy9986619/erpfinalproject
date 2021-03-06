<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div id="recordSite"></div>
	<div id="recordInfoSite"></div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('recordpage/assets/css/jquery.datepick.css') }}"> 
	<script type="text/javascript" src="{{ URL::asset('recordpage/assets/js/jquery.plugin.js') }}"></script> 
	<script type="text/javascript" src="{{ URL::asset('recordpage/assets/js/jquery.datepick.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('recordpage/assets/js/jquery.datepick-zh-TW.js') }}"></script>
	<script type="text/javascript">
		

		$(document).ready(function(){
			getRecord(1);
		});

		function getRecord(page){
			var pageData={
				"page":page,
			};

			$.ajax({
				url: "http://erpfinalproject.ddns.net:808/record",
				type: "GET",
				data: pageData,
				dataType: "json",

				success:function(jsonData){
					$("#recordSite").empty();
					$("#recordInfoSite").empty();
					var $table = $(document.createElement('table'));
					$table.attr('id', 'recordTable');
					$table.attr('border', '2px');
					$table.appendTo($("#recordSite"));

					var tableField ="<tr>";
					tableField +="<td>員工編號</td>";
					tableField +="<td>員工卡號</td>";
					tableField +="<td>員工姓名</td>";
					tableField +="<td>最後打卡日期</td>";
					tableField +="<td>該天上班紀錄</td>";
					tableField +="<td>該天下班紀錄</td>";
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
						tablestr += "<td>"+data[i]['sid']+"</td>";
						tablestr += "<td>"+data[i]['staffId']+"</td>";
						tablestr += "<td>"+data[i]['username']+"</td>";
						tablestr += "<td>"+data[i]['date']+"</td>";
						tablestr += "<td>"+data[i]['first']+"</td>";
						tablestr += "<td>"+data[i]['last']+"</td>";
						tablestr += "<td id=info"+data[i]['sid']+"></td";
						tablestr += "</tr>";
						
						$(tablestr).appendTo($table);

						//製作詳細紀錄按鈕
						$infoButton = $(document.createElement('button'));
						$infoButton.click( (function(){
							var id = staffId;
							return function(){ getInfo(id)};
						})() );
						$infoButton.text("info"+staffId);
						$infoButton.appendTo("#info"+staffId+"");
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
							tablestr += "</tr>";

							$(tablestr).appendTo($table);
						}
					}

					//確認頁數
					var recordPage=1;
					recordPage=Math.ceil(jsonData['count']/10);

					//製作頁數
					for(var i=1; i<=recordPage; i++){
						if(i==page){
							var pagestr='<a>'+i+'</a>'+"&nbsp;";
						}else{
							var pagestr='<a href="javascript:void(0)" style="text-decoration:none;" onclick="getRecord('+i+')">'+i+'</a>';
						}
						$(pagestr).appendTo($("#recordSite"));
						$("#recordSite").append("&nbsp;");
						
					}




				},

				error: function(){
					alert("error");
				}
			});
		}


		
		function getInfo(id, searchDate){
			var dateData;
			if(typeof(searchDate) != "undefined"){
				//alert(searchDate);
				dateData={
					"date": searchDate,
				};
			}

			$.ajax({
				url: "http://erpfinalproject.ddns.net:808/record/"+id+"",
				type: "GET",
				data: dateData,
				dataType: "json",

				success: function(jsonData){
					$("#recordInfoSite").empty();
					var $table = $(document.createElement('table'));
					$table.attr('id', 'recordInfoTable');
					$table.attr('border', '2px');
					$table.appendTo($("#recordInfoSite"))

					var time = jsonData['time'];
					var tableField ="<tr>";
					tableField +='<td colspan="6" align="center" valign="center">詳細紀錄時間：'+time+"</td>";
					tableField +="</tr><tr>";
					tableField +="<td>員工編號</td>";
					tableField +="<td>員工卡號</td>";
					tableField +="<td>員工姓名</td>";
					tableField +="<td>打卡日期</td>";
					tableField +="<td>該天上班紀錄</td>";
					tableField +="<td>該天下班紀錄</td>";
					tableField +="</tr>";

					$(tableField).appendTo($table);

					//取得資料
					data=jsonData['result'];
					for(var i in data){
						var tablestr = "<tr>";
						tablestr += "<td>"+data[i]['sid']+"</td>";
						tablestr += "<td>"+data[i]['staffId']+"</td>";
						tablestr += "<td>"+data[i]['username']+"</td>";
						tablestr += "<td>"+data[i]['date']+"</td>";
						tablestr += "<td>"+data[i]['first']+"</td>";
						tablestr += "<td>"+data[i]['last']+"</td>";
						tablestr += "</tr>";
					
						$(tablestr).appendTo($table);

					}

					$('#recordInfoSite').append("<br>");
					var searchHTML='<p id="searchP"> 查詢指定年月時間: <input id="datePicker" /> </p>';
					$('#recordInfoSite').append(searchHTML);
					if(typeof(searchDate) != "undefined"){
						$("#datePicker").val(searchDate);
					}
					$("#datePicker").datepick({dateFormat: 'yyyy-mm'}, $.datepick.regionalOptions['zh-TW']);
					
					$searchButton = $(document.createElement('button'));
					$searchButton.text("查詢");
					$searchButton.click( function(){
						var searchDate = $("#datePicker").val();
						//alert(id+" "+searchDate);
						getInfo(id, searchDate);
					} );
					$('#searchP').append($searchButton);

				},

				error: function(){
					alert("getInfo error");
				}
			});
		}
		
		
		
			
	
		
	</script>
</body>
</html>