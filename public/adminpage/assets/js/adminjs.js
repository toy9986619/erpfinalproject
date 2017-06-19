$(document).ready(function(){
			getAdmin();

			$addButton = $(document.createElement('button'));
			$addButton.attr('id', "createAdminButton");
			$addButton.click( function(){
				getCreateAdmin();
				
				$("#demo04").animatedModal({
									modalTarget:'animatedModal4'
								});
	                    		lnk = document.getElementById("demo04");
 	                    		lnk.click();
			} );
			$addButton.text("新增管理員");
			$addButton.appendTo("#adminActionSite");
		});

		function getAdmin(callback){
			//$("#createAdminButton").show();

			$.ajax({
				url: "http://erpfinalproject.ddns.net:808/admin",
				type: "GET",
				dataType: "json",

				success:function(jsonData){
					$("#adminSite").empty();
					$("#adminEditSite").empty();
					$("#adminMsgSite").empty();
			
					var $table = $(document.createElement('table'));
					$table.attr('id', 'adminTable');
					$table.attr('border', '2px');
					$table.appendTo($("#adminSite"));

					var tableField ="<tr>";
					tableField +="<td>管理員編號</td>";
					tableField +="<td>管理員姓名</td>";
					tableField +="<td>聯絡信箱</td>";
					tableField +="<td>操作</td>";
					tableField +="</tr>";

					$(tableField).appendTo($table);

					//取得資料
					data=jsonData['result'];
					for(var i in data){
						var tablestr = "<tr>";
						tablestr += "<td>"+data[i]['id']+"</td>";
						tablestr += "<td>"+data[i]['username']+"</td>";
						tablestr += "<td>"+data[i]['email']+"</td>";
						tablestr += "<td id=delete"+data[i]['id']+"></td";
						tablestr += "</tr>";
						
						$(tablestr).appendTo($table);
						var id = data[i]['id'];
						//製作刪除按鈕
						$deleteButton = $(document.createElement('button'));
						$deleteButton.click( (function(){
							var id = data[i]['id'];
							return function(){ deleteAdmin(id)};
						})() );
						$deleteButton.text("delete"+id);
						$deleteButton.appendTo("#delete"+id+"");
					}
					


				},

				error: function(){
					alert("getAdmin error");
				}
			}).done(function(){
				if (callback && typeof(callback) === "function") {
        			callback();
    			}
			});
		}


		function deleteAdmin(id){
			$("#adminMsgSite").empty();

			var deleteHTML="<p> 確定刪除編號"+id+"號之管理員? <p>";
			$(deleteHTML).appendTo("#adminMsgSite");

			$yesButton = $(document.createElement('button'));
			$yesButton.click( function(){
				$.ajax({
				url: "http://erpfinalproject.ddns.net:808/admin/"+id+"",
				type: "delete",
				dataType: "json",
				success: function(jsonData){
					if(jsonData['status']==1){
						getAdmin( function(){
							$("#adminMsgSite").append("<p> 成功刪除 </p>"); }
						);
					}
				},
				error: function(){
					alert("deleteAdmin error");
				}
				});
			} );
			$yesButton.text("確定");
			$yesButton.appendTo("#adminMsgSite");

			var fixstr = "&nbsp;&nbsp;";
			$("#adminMsgSite").append(fixstr);

			$noButton = $(document.createElement('button'));
			$noButton.click( function(){
				getAdmin();
			} );
			$noButton.text("取消");
			$noButton.appendTo("#adminMsgSite");

		}

		function getCreateAdmin(){
			$("#adminEditSite").empty();
			//$("#createAdminButton").hide();

			var pstr = "<p>欲新增之管理員資料: ";
			$(pstr).appendTo($("#adminEditSite"));

			var $table = $(document.createElement('table'));
			$table.attr('id', 'adminEditTable');
			$table.attr('border', '2px');
			$table.appendTo($("#adminEditSite"));

			var tableField ="<tr>";
			tableField +="<td>管理員姓名</td>";
			tableField +="<td>管理員信箱</td>";
			tableField +="<td>管理員密碼</td>";
			tablestr += "</tr>";
			$(tableField).appendTo($table);

			var tablestr ="<tr>";
			tablestr += '<td> <input type="text" name="username" value=""/></td>';
			tablestr += '<td> <input type="email" name="email" value=""/></td>';
			tablestr += '<td> <input type="password" name="password" value=""/></td>';
			tablestr += "</tr>";
			$(tablestr).appendTo($table);

			var $saveButton = $(document.createElement('button'));
			$saveButton.click( (function(){
				return function(){ saveAdmin()};
			})() );
			$saveButton.text("儲存");
			$saveButton.appendTo($("#adminEditSite"));
		}

		function saveAdmin(){
			var formData={
				'username': $('input[name="username"]').val(),
				'email': $('input[name="email"]').val(),
				'password': $('input[name="password"]').val(),
			}

			$.ajax({
				url: "http://erpfinalproject.ddns.net:808/admin",
				type: "POST",
				data: formData,
				dataType: "json",
				success: function(jsonData){
					if(jsonData['status']==1){
						getAdmin( function(){
							$("#adminEditSite").append("<p> 成功保存 </p>"); }
						);
						$("#createAdminButton").show();
					}
				},
				error: function(){
					alert("saveAdmin error");
				}
			});
		}