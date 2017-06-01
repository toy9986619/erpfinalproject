<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div id="recordSite"></div>
	<div id="recordInfoSite"></div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			getRecord();
		});

		function getRecord(){
			$.ajax({
				url: "http://erpfinalproject.ddns.net:808/record",
				type: "GET",
				dataType: "json",

				success:function(data){
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
					tableField +="<td>編輯</td>";
					tableField +="</tr>";

					$(tableField).appendTo($table);

					for(var i in data){
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

						$infoButton = $(document.createElement('button'));
						$infoButton.click( (function(){
							var id = staffId;
							return function(){ getInfo(id)};
						})() );
						$infoButton.text("info"+staffId);
						$infoButton.appendTo("#info"+staffId+"");
					}



				},

				error: function(){
					alert("error");
				}
			});
		}


		
		function getInfo(id){
			$.ajax({
				url: "http://erpfinalproject.ddns.net:808/record/"+id+"",
				type: "GET",
				dataType: "json",

				success: function(data){
					$("#recordInfoSite").empty();
					var $table = $(document.createElement('table'));
					$table.attr('id', 'recordTable');
					$table.attr('border', '2px');
					$table.appendTo($("#recordInfoSite"))

					var tableField ="<tr>";
					tableField +="<td>員工編號</td>";
					tableField +="<td>員工卡號</td>";
					tableField +="<td>員工姓名</td>";
					tableField +="<td>打卡日期</td>";
					tableField +="<td>該天上班紀錄</td>";
					tableField +="<td>該天下班紀錄</td>";
					tableField +="</tr>";

					$(tableField).appendTo($table);

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
				},

				error: function(){
					alert("getInfo error");
				}
			});
		}
		
		
			
	
		
	</script>
</body>
</html>