$(function(){
	$('#EmployeeAttendanceGrid').jqxGrid({
		width:'100%',
		height:'100%',
		filterable:true,
		showfilterrow:true,
		showtoolbar:true,
		toolbarheight:'535px',
		columnsresize: true,
		rendertoolbar:function(toolbar){
			var container = $('<div></div>');
			html = "<div id='EmployeeAttendanceExpander'>";
				html +="<div>Employee Attendance</div>";
				html +="<div>";
					html += "<table style='width:100%;'>";
					html += "<tr>";
					html += "<td ></td>";
					html += "<td style='width:295px;'><input type='text' id='EmployeeIDInp'></td><td style='width:295px;'><div id='clock' style='color:#c2c2c2;font-size:2em;width:100%;text-align:right;'></div></td>";
					html += "<td ></td>";
					html += "<td rowspan=2 style='border-left:1px solid #000000;'>";
						html += "<div id=EmployeeLatestAttendanceGrid></div>";
					html += "</td>";
					html += "</tr>";
					html += "<tr>";
					html += "<td style='width:110px;'>";
						html += "<button id=TimeInEmployeeAttendanceBtn style='margin:5px;display:block;'><h3>1</h3></button>";
						html += "<button id=LunchOutEmployeeAttendanceBtn style='margin:5px;display:block;'><h3>2</h3></button>";
						html += "<button id=LunchInEmployeeAttendanceBtn style='margin:5px;display:block;'><h3>3</h3></button>";
						html += "<button id=TimeOutEmployeeAttendanceBtn style='margin:5px;display:block;'><h3>4</h3></button>";
						html += "<button id=BreakOutEmployeeAttendanceBtn style='margin:5px;display:block;'><h3>5</h3></button>";
						html += "<button id=BreakInEmployeeAttendanceBtn style='margin:5px;display:block;'><h3>6</h3></button>";
					html += "</td>";
					html += "<td colspan=2 style='width:590px;'><div id='my_camera' style='margin:5px;width: 580;height: 460;'></div></td>";
					html += "<td style='width:110px;'>";
						html += "<button id=BusinessOutEmployeeAttendanceBtn style='margin:5px;display:block;'><h3>7</h3></button>";
						html += "<button id=BusinessInEmployeeAttendanceBtn style='margin:5px;display:block;'><h3>8</h3></button>";
						html += "<button id=PersonalOutEmployeeAttendanceBtn style='margin:5px;display:block;'><h3>9</h3></button>";
						html += "<button id=PersonalInEmployeeAttendanceBtn style='margin:5px;display:block;'><h3>10</h3></button>";
						html += "<button id=OvertimeInEmployeeAttendanceBtn style='margin:5px;display:block;'><h3>11</h3></button>";
						html += "<button id=OvertimeOutEmployeeAttendanceBtn style='margin:5px;display:block;'><h3>12</h3></button>";
					html += "</td>";
					//html += "<td>e</td>";
					html += "</tr>";
					html += "</table>";
				html +="</div>";
			html +="</div>";
			container.append(html);
			toolbar.append(container);
			$('#EmployeeAttendanceExpander').jqxExpander({
				width:'100%',
				height:'535px',
				toggleMode: "none",
				showArrow: false 
			});
			$('#EmployeeIDInp').jqxInput({width:'100%',height:'25px'});
			//Set Cam ----------
			Webcam.set({
				width: 580,height: 460,image_format: 'jpeg',jpeg_quality: 50
			});
			Webcam.attach( '#my_camera' );
			$('#TimeInEmployeeAttendanceBtn').jqxButton({width:'100'}).on('click',function(){
				var rString = randomString(15, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
				Webcam.snap( function(data_uri) {
					$.ajax({
						url:'source/employee_attendance/save_time_log_image_directory.php',
						type:'POST',
						data:{
							base64:data_uri,
							barcode_id:$('#EmployeeIDInp').val(),
							random:rString
						},
						success:function(){
							
							
						},
						complete:function(){
							
						}
					});
				});
				$.ajax({
					url:'source/employee_attendance/add_time_logs.php',
					type:'POST',
					data:{
						barcode_id:$('#EmployeeIDInp').val(),
						type:1,
						random:rString
					},
					success:function(){
						var source = {
								datatype:'json',
								datafields:[
									{name:'id'},
									{name:'image'},
									{name:'employee_code'},
									{name:'type'},
									{name:'time_log'},
									{name:'date'}
								],
								id:'',
								url:'source/employee_attendance/get_time_logs.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var Adapter = new $.jqx.dataAdapter(source);
							$('#EmployeeLatestAttendanceGrid').jqxGrid({source:Adapter});
							var DTRSummaryEmployeesource =
							{
								datatype: "json",
								datafields: [
									{ name: 'id' },
									{ name: 'employee_id' },
									{ name: 'employee_name' },
									{ name: 'employee_code' },
									{ name: 'employee_time_shift_id' },
									{ name: 'date' },
									{ name: 'time_in' },
									{ name: 'lunch_out' },
									{ name: 'lunch_in'},
									{ name: 'time_out' },
									{ name: 'business_out' },
									{ name: 'business_in' },
									{ name: 'personal_out' },
									{ name: 'personal_in' },
									{ name: 'overtime_in' },
									{ name: 'overtime_out' },
									{ name: 'work_minutes' },
									{ name: 'late_minutes' },
									{ name: 'overtime_minutes' },
									{ name: 'business_minutes' },
									{ name: 'personal_minutes' },
									{ name: 'status' }
								],
								id: '',
								url: 'source/employee_attendance/get_employee_dtr_by_code.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var DTRSummaryEmployeeAdapter = new $.jqx.dataAdapter(DTRSummaryEmployeesource);
							$('#EmployeeAttendanceGrid').jqxGrid({source:DTRSummaryEmployeeAdapter });
							$('#EmployeeIDInp').val('');
					},
					complete:function(){
						
					}
				});
			});
			$('#LunchOutEmployeeAttendanceBtn').jqxButton({width:'100'}).on('click',function(){
				var rString = randomString(15, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
				Webcam.snap( function(data_uri) {
					$.ajax({
						url:'source/employee_attendance/save_time_log_image_directory.php',
						type:'POST',
						data:{
							base64:data_uri,
							barcode_id:$('#EmployeeIDInp').val(),
							random:rString
						},
						success:function(){
							
							
						},
						complete:function(){
							
						}
					});
				});
				$.ajax({
					url:'source/employee_attendance/add_time_logs.php',
					type:'POST',
					data:{
						barcode_id:$('#EmployeeIDInp').val(),
						type:2,
						random:rString
					},
					success:function(){
						var source = {
								datatype:'json',
								datafields:[
									{name:'id'},
									{name:'image'},
									{name:'employee_code'},
									{name:'type'},
									{name:'time_log'},
									{name:'date'}
								],
								id:'',
								url:'source/employee_attendance/get_time_logs.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var Adapter = new $.jqx.dataAdapter(source);
							$('#EmployeeLatestAttendanceGrid').jqxGrid({source:Adapter});
							var DTRSummaryEmployeesource =
							{
								datatype: "json",
								datafields: [
									{ name: 'id' },
									{ name: 'employee_id' },
									{ name: 'employee_name' },
									{ name: 'employee_code' },
									{ name: 'employee_time_shift_id' },
									{ name: 'date' },
									{ name: 'time_in' },
									{ name: 'lunch_out' },
									{ name: 'lunch_in'},
									{ name: 'time_out' },
									{ name: 'business_out' },
									{ name: 'business_in' },
									{ name: 'personal_out' },
									{ name: 'personal_in' },
									{ name: 'overtime_in' },
									{ name: 'overtime_out' },
									{ name: 'work_minutes' },
									{ name: 'late_minutes' },
									{ name: 'overtime_minutes' },
									{ name: 'business_minutes' },
									{ name: 'personal_minutes' },
									{ name: 'status' }
								],
								id: '',
								url: 'source/employee_attendance/get_employee_dtr_by_code.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var DTRSummaryEmployeeAdapter = new $.jqx.dataAdapter(DTRSummaryEmployeesource);
							$('#EmployeeAttendanceGrid').jqxGrid({source:DTRSummaryEmployeeAdapter });
							$('#EmployeeIDInp').val('');
					},
					complete:function(){
						
						
					}
				});
			});
			$('#LunchInEmployeeAttendanceBtn').jqxButton({width:'100'}).on('click',function(){
				var rString = randomString(15, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
				Webcam.snap( function(data_uri) {
					$.ajax({
						url:'source/employee_attendance/save_time_log_image_directory.php',
						type:'POST',
						data:{
							base64:data_uri,
							barcode_id:$('#EmployeeIDInp').val(),
							random:rString
						},
						success:function(){
							
							
						},
						complete:function(){
							
						}
					});
				});
				$.ajax({
					url:'source/employee_attendance/add_time_logs.php',
					type:'POST',
					data:{
						barcode_id:$('#EmployeeIDInp').val(),
						type:3,
						random:rString
					},
					success:function(){
						var source = {
								datatype:'json',
								datafields:[
									{name:'id'},
									{name:'image'},
									{name:'employee_code'},
									{name:'type'},
									{name:'time_log'},
									{name:'date'}
								],
								id:'',
								url:'source/employee_attendance/get_time_logs.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var Adapter = new $.jqx.dataAdapter(source);
							$('#EmployeeLatestAttendanceGrid').jqxGrid({source:Adapter});
							var DTRSummaryEmployeesource =
							{
								datatype: "json",
								datafields: [
									{ name: 'id' },
									{ name: 'employee_id' },
									{ name: 'employee_name' },
									{ name: 'employee_code' },
									{ name: 'employee_time_shift_id' },
									{ name: 'date' },
									{ name: 'time_in' },
									{ name: 'lunch_out' },
									{ name: 'lunch_in'},
									{ name: 'time_out' },
									{ name: 'business_out' },
									{ name: 'business_in' },
									{ name: 'personal_out' },
									{ name: 'personal_in' },
									{ name: 'overtime_in' },
									{ name: 'overtime_out' },
									{ name: 'work_minutes' },
									{ name: 'late_minutes' },
									{ name: 'overtime_minutes' },
									{ name: 'business_minutes' },
									{ name: 'personal_minutes' },
									{ name: 'status' }
								],
								id: '',
								url: 'source/employee_attendance/get_employee_dtr_by_code.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var DTRSummaryEmployeeAdapter = new $.jqx.dataAdapter(DTRSummaryEmployeesource);
							$('#EmployeeAttendanceGrid').jqxGrid({source:DTRSummaryEmployeeAdapter });
							$('#EmployeeIDInp').val('');
					},
					complete:function(){
						
						
					}
				});
			});
			$('#TimeOutEmployeeAttendanceBtn').jqxButton({width:'100'}).on('click',function(){
				var rString = randomString(15, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
				Webcam.snap( function(data_uri) {
					$.ajax({
						url:'source/employee_attendance/save_time_log_image_directory.php',
						type:'POST',
						data:{
							base64:data_uri,
							barcode_id:$('#EmployeeIDInp').val(),
							random:rString
						},
						success:function(){
							
							
						},
						complete:function(){
							
						}
					});
				});
				$.ajax({
					url:'source/employee_attendance/add_time_logs.php',
					type:'POST',
					data:{
						barcode_id:$('#EmployeeIDInp').val(),
						type:4,
						random:rString
					},
					success:function(){
						var source = {
								datatype:'json',
								datafields:[
									{name:'id'},
									{name:'image'},
									{name:'employee_code'},
									{name:'type'},
									{name:'time_log'},
									{name:'date'}
								],
								id:'',
								url:'source/employee_attendance/get_time_logs.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var Adapter = new $.jqx.dataAdapter(source);
							$('#EmployeeLatestAttendanceGrid').jqxGrid({source:Adapter});
							var DTRSummaryEmployeesource =
							{
								datatype: "json",
								datafields: [
									{ name: 'id' },
									{ name: 'employee_id' },
									{ name: 'employee_name' },
									{ name: 'employee_code' },
									{ name: 'employee_time_shift_id' },
									{ name: 'date' },
									{ name: 'time_in' },
									{ name: 'lunch_out' },
									{ name: 'lunch_in'},
									{ name: 'time_out' },
									{ name: 'business_out' },
									{ name: 'business_in' },
									{ name: 'personal_out' },
									{ name: 'personal_in' },
									{ name: 'overtime_in' },
									{ name: 'overtime_out' },
									{ name: 'work_minutes' },
									{ name: 'late_minutes' },
									{ name: 'overtime_minutes' },
									{ name: 'business_minutes' },
									{ name: 'personal_minutes' },
									{ name: 'status' }
								],
								id: '',
								url: 'source/employee_attendance/get_employee_dtr_by_code.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var DTRSummaryEmployeeAdapter = new $.jqx.dataAdapter(DTRSummaryEmployeesource);
							$('#EmployeeAttendanceGrid').jqxGrid({source:DTRSummaryEmployeeAdapter });	
							$('#EmployeeIDInp').val('');
					},
					complete:function(){
						
					
					}
				});
			});
			$('#BreakOutEmployeeAttendanceBtn').jqxButton({width:'100'}).on('click',function(){
				var rString = randomString(15, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
				Webcam.snap( function(data_uri) {
					$.ajax({
						url:'source/employee_attendance/save_time_log_image_directory.php',
						type:'POST',
						data:{
							base64:data_uri,
							barcode_id:$('#EmployeeIDInp').val(),
							random:rString
						},
						success:function(){
							
							
						},
						complete:function(){
							
						}
					});
				});
				$.ajax({
					url:'source/employee_attendance/add_time_logs.php',
					type:'POST',
					data:{
						barcode_id:$('#EmployeeIDInp').val(),
						type:5,
						random:rString
					},
					success:function(){
						var source = {
								datatype:'json',
								datafields:[
									{name:'id'},
									{name:'image'},
									{name:'employee_code'},
									{name:'type'},
									{name:'time_log'},
									{name:'date'}
								],
								id:'',
								url:'source/employee_attendance/get_time_logs.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var Adapter = new $.jqx.dataAdapter(source);
							$('#EmployeeLatestAttendanceGrid').jqxGrid({source:Adapter});
							var DTRSummaryEmployeesource =
							{
								datatype: "json",
								datafields: [
									{ name: 'id' },
									{ name: 'employee_id' },
									{ name: 'employee_name' },
									{ name: 'employee_code' },
									{ name: 'employee_time_shift_id' },
									{ name: 'date' },
									{ name: 'time_in' },
									{ name: 'lunch_out' },
									{ name: 'lunch_in'},
									{ name: 'time_out' },
									{ name: 'business_out' },
									{ name: 'business_in' },
									{ name: 'personal_out' },
									{ name: 'personal_in' },
									{ name: 'overtime_in' },
									{ name: 'overtime_out' },
									{ name: 'work_minutes' },
									{ name: 'late_minutes' },
									{ name: 'overtime_minutes' },
									{ name: 'business_minutes' },
									{ name: 'personal_minutes' },
									{ name: 'status' }
								],
								id: '',
								url: 'source/employee_attendance/get_employee_dtr_by_code.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var DTRSummaryEmployeeAdapter = new $.jqx.dataAdapter(DTRSummaryEmployeesource);
							$('#EmployeeAttendanceGrid').jqxGrid({source:DTRSummaryEmployeeAdapter });
							$('#EmployeeIDInp').val('');
					},
					complete:function(){
						
						
					}
				});
			});
			$('#BreakInEmployeeAttendanceBtn').jqxButton({width:'100'}).on('click',function(){
				var rString = randomString(15, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
				Webcam.snap( function(data_uri) {
					$.ajax({
						url:'source/employee_attendance/save_time_log_image_directory.php',
						type:'POST',
						data:{
							base64:data_uri,
							barcode_id:$('#EmployeeIDInp').val(),
							random:rString
						},
						success:function(){
							
							
						},
						complete:function(){
							
						}
					});
				});
				$.ajax({
					url:'source/employee_attendance/add_time_logs.php',
					type:'POST',
					data:{
						barcode_id:$('#EmployeeIDInp').val(),
						type:6,
						random:rString
					},
					success:function(){
						var source = {
								datatype:'json',
								datafields:[
									{name:'id'},
									{name:'image'},
									{name:'employee_code'},
									{name:'type'},
									{name:'time_log'},
									{name:'date'}
								],
								id:'',
								url:'source/employee_attendance/get_time_logs.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var Adapter = new $.jqx.dataAdapter(source);
							$('#EmployeeLatestAttendanceGrid').jqxGrid({source:Adapter});
							var DTRSummaryEmployeesource =
							{
								datatype: "json",
								datafields: [
									{ name: 'id' },
									{ name: 'employee_id' },
									{ name: 'employee_name' },
									{ name: 'employee_code' },
									{ name: 'employee_time_shift_id' },
									{ name: 'date' },
									{ name: 'time_in' },
									{ name: 'lunch_out' },
									{ name: 'lunch_in'},
									{ name: 'time_out' },
									{ name: 'business_out' },
									{ name: 'business_in' },
									{ name: 'personal_out' },
									{ name: 'personal_in' },
									{ name: 'overtime_in' },
									{ name: 'overtime_out' },
									{ name: 'work_minutes' },
									{ name: 'late_minutes' },
									{ name: 'overtime_minutes' },
									{ name: 'business_minutes' },
									{ name: 'personal_minutes' },
									{ name: 'status' }
								],
								id: '',
								url: 'source/employee_attendance/get_employee_dtr_by_code.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var DTRSummaryEmployeeAdapter = new $.jqx.dataAdapter(DTRSummaryEmployeesource);
							$('#EmployeeAttendanceGrid').jqxGrid({source:DTRSummaryEmployeeAdapter });
							$('#EmployeeIDInp').val('');
					},
					complete:function(){
						
						
					}
				});
			});
			$('#BusinessOutEmployeeAttendanceBtn').jqxButton({width:'100'}).on('click',function(){
				var rString = randomString(15, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
				Webcam.snap( function(data_uri) {
					$.ajax({
						url:'source/employee_attendance/save_time_log_image_directory.php',
						type:'POST',
						data:{
							base64:data_uri,
							barcode_id:$('#EmployeeIDInp').val(),
							random:rString
						},
						success:function(){
							
							
						},
						complete:function(){
							
						}
					});
				});
				$.ajax({
					url:'source/employee_attendance/add_time_logs.php',
					type:'POST',
					data:{
						barcode_id:$('#EmployeeIDInp').val(),
						type:7,
						random:rString
					},
					success:function(){
						var source = {
								datatype:'json',
								datafields:[
									{name:'id'},
									{name:'image'},
									{name:'employee_code'},
									{name:'type'},
									{name:'time_log'},
									{name:'date'}
								],
								id:'',
								url:'source/employee_attendance/get_time_logs.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var Adapter = new $.jqx.dataAdapter(source);
							$('#EmployeeLatestAttendanceGrid').jqxGrid({source:Adapter});
							var DTRSummaryEmployeesource =
							{
								datatype: "json",
								datafields: [
									{ name: 'id' },
									{ name: 'employee_id' },
									{ name: 'employee_name' },
									{ name: 'employee_code' },
									{ name: 'employee_time_shift_id' },
									{ name: 'date' },
									{ name: 'time_in' },
									{ name: 'lunch_out' },
									{ name: 'lunch_in'},
									{ name: 'time_out' },
									{ name: 'business_out' },
									{ name: 'business_in' },
									{ name: 'personal_out' },
									{ name: 'personal_in' },
									{ name: 'overtime_in' },
									{ name: 'overtime_out' },
									{ name: 'work_minutes' },
									{ name: 'late_minutes' },
									{ name: 'overtime_minutes' },
									{ name: 'business_minutes' },
									{ name: 'personal_minutes' },
									{ name: 'status' }
								],
								id: '',
								url: 'source/employee_attendance/get_employee_dtr_by_code.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var DTRSummaryEmployeeAdapter = new $.jqx.dataAdapter(DTRSummaryEmployeesource);
							$('#EmployeeAttendanceGrid').jqxGrid({source:DTRSummaryEmployeeAdapter });
							$('#EmployeeIDInp').val('');
					},
					complete:function(){
						
						
					}
				});
			});
			$('#BusinessInEmployeeAttendanceBtn').jqxButton({width:'100'}).on('click',function(){
				var rString = randomString(15, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
				Webcam.snap( function(data_uri) {
					$.ajax({
						url:'source/employee_attendance/save_time_log_image_directory.php',
						type:'POST',
						data:{
							base64:data_uri,
							barcode_id:$('#EmployeeIDInp').val(),
							random:rString
						},
						success:function(){
							
							
						},
						complete:function(){
							
						}
					});
				});
				$.ajax({
					url:'source/employee_attendance/add_time_logs.php',
					type:'POST',
					data:{
						barcode_id:$('#EmployeeIDInp').val(),
						type:8,
						random:rString
					},
					success:function(){
						var source = {
								datatype:'json',
								datafields:[
									{name:'id'},
									{name:'image'},
									{name:'employee_code'},
									{name:'type'},
									{name:'time_log'},
									{name:'date'}
								],
								id:'',
								url:'source/employee_attendance/get_time_logs.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var Adapter = new $.jqx.dataAdapter(source);
							$('#EmployeeLatestAttendanceGrid').jqxGrid({source:Adapter});
							var DTRSummaryEmployeesource =
							{
								datatype: "json",
								datafields: [
									{ name: 'id' },
									{ name: 'employee_id' },
									{ name: 'employee_name' },
									{ name: 'employee_code' },
									{ name: 'employee_time_shift_id' },
									{ name: 'date' },
									{ name: 'time_in' },
									{ name: 'lunch_out' },
									{ name: 'lunch_in'},
									{ name: 'time_out' },
									{ name: 'business_out' },
									{ name: 'business_in' },
									{ name: 'personal_out' },
									{ name: 'personal_in' },
									{ name: 'overtime_in' },
									{ name: 'overtime_out' },
									{ name: 'work_minutes' },
									{ name: 'late_minutes' },
									{ name: 'overtime_minutes' },
									{ name: 'business_minutes' },
									{ name: 'personal_minutes' },
									{ name: 'status' }
								],
								id: '',
								url: 'source/employee_attendance/get_employee_dtr_by_code.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var DTRSummaryEmployeeAdapter = new $.jqx.dataAdapter(DTRSummaryEmployeesource);
							$('#EmployeeAttendanceGrid').jqxGrid({source:DTRSummaryEmployeeAdapter });
							$('#EmployeeIDInp').val('');
					},
					complete:function(){
						
						
					}
				});
			});
			$('#PersonalOutEmployeeAttendanceBtn').jqxButton({width:'100'}).on('click',function(){
				var rString = randomString(15, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
				Webcam.snap( function(data_uri) {
					$.ajax({
						url:'source/employee_attendance/save_time_log_image_directory.php',
						type:'POST',
						data:{
							base64:data_uri,
							barcode_id:$('#EmployeeIDInp').val(),
							random:rString
						},
						success:function(){
							
							
						},
						complete:function(){
							
						}
					});
				});
				$.ajax({
					url:'source/employee_attendance/add_time_logs.php',
					type:'POST',
					data:{
						barcode_id:$('#EmployeeIDInp').val(),
						type:9,
						random:rString
					},
					success:function(){
						var source = {
								datatype:'json',
								datafields:[
									{name:'id'},
									{name:'image'},
									{name:'employee_code'},
									{name:'type'},
									{name:'time_log'},
									{name:'date'}
								],
								id:'',
								url:'source/employee_attendance/get_time_logs.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var Adapter = new $.jqx.dataAdapter(source);
							$('#EmployeeLatestAttendanceGrid').jqxGrid({source:Adapter});
							var DTRSummaryEmployeesource =
							{
								datatype: "json",
								datafields: [
									{ name: 'id' },
									{ name: 'employee_id' },
									{ name: 'employee_name' },
									{ name: 'employee_code' },
									{ name: 'employee_time_shift_id' },
									{ name: 'date' },
									{ name: 'time_in' },
									{ name: 'lunch_out' },
									{ name: 'lunch_in'},
									{ name: 'time_out' },
									{ name: 'business_out' },
									{ name: 'business_in' },
									{ name: 'personal_out' },
									{ name: 'personal_in' },
									{ name: 'overtime_in' },
									{ name: 'overtime_out' },
									{ name: 'work_minutes' },
									{ name: 'late_minutes' },
									{ name: 'overtime_minutes' },
									{ name: 'business_minutes' },
									{ name: 'personal_minutes' },
									{ name: 'status' }
								],
								id: '',
								url: 'source/employee_attendance/get_employee_dtr_by_code.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var DTRSummaryEmployeeAdapter = new $.jqx.dataAdapter(DTRSummaryEmployeesource);
							$('#EmployeeAttendanceGrid').jqxGrid({source:DTRSummaryEmployeeAdapter });
							$('#EmployeeIDInp').val('');
					},
					complete:function(){
						
						
					}
				});
			});
			$('#PersonalInEmployeeAttendanceBtn').jqxButton({width:'100'}).on('click',function(){
				var rString = randomString(15, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
				Webcam.snap( function(data_uri) {
					$.ajax({
						url:'source/employee_attendance/save_time_log_image_directory.php',
						type:'POST',
						data:{
							base64:data_uri,
							barcode_id:$('#EmployeeIDInp').val(),
							random:rString
						},
						success:function(){
							
							
						},
						complete:function(){
							
						}
					});
				});
				$.ajax({
					url:'source/employee_attendance/add_time_logs.php',
					type:'POST',
					data:{
						barcode_id:$('#EmployeeIDInp').val(),
						type:10,
						random:rString
					},
					success:function(){
						var source = {
								datatype:'json',
								datafields:[
									{name:'id'},
									{name:'image'},
									{name:'employee_code'},
									{name:'type'},
									{name:'time_log'},
									{name:'date'}
								],
								id:'',
								url:'source/employee_attendance/get_time_logs.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var Adapter = new $.jqx.dataAdapter(source);
							$('#EmployeeLatestAttendanceGrid').jqxGrid({source:Adapter});
							var DTRSummaryEmployeesource =
							{
								datatype: "json",
								datafields: [
									{ name: 'id' },
									{ name: 'employee_id' },
									{ name: 'employee_name' },
									{ name: 'employee_code' },
									{ name: 'employee_time_shift_id' },
									{ name: 'date' },
									{ name: 'time_in' },
									{ name: 'lunch_out' },
									{ name: 'lunch_in'},
									{ name: 'time_out' },
									{ name: 'business_out' },
									{ name: 'business_in' },
									{ name: 'personal_out' },
									{ name: 'personal_in' },
									{ name: 'overtime_in' },
									{ name: 'overtime_out' },
									{ name: 'work_minutes' },
									{ name: 'late_minutes' },
									{ name: 'overtime_minutes' },
									{ name: 'business_minutes' },
									{ name: 'personal_minutes' },
									{ name: 'status' }
								],
								id: '',
								url: 'source/employee_attendance/get_employee_dtr_by_code.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var DTRSummaryEmployeeAdapter = new $.jqx.dataAdapter(DTRSummaryEmployeesource);
							$('#EmployeeAttendanceGrid').jqxGrid({source:DTRSummaryEmployeeAdapter });
							$('#EmployeeIDInp').val('');
					},
					complete:function(){
						
						
					}
				});
			});
			$('#OvertimeInEmployeeAttendanceBtn').jqxButton({width:'100'}).on('click',function(){
				var rString = randomString(15, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
				Webcam.snap( function(data_uri) {
					$.ajax({
						url:'source/employee_attendance/save_time_log_image_directory.php',
						type:'POST',
						data:{
							base64:data_uri,
							barcode_id:$('#EmployeeIDInp').val(),
							random:rString
						},
						success:function(){
							
							
						},
						complete:function(){
							
						}
					});
				});
				$.ajax({
					url:'source/employee_attendance/add_time_logs.php',
					type:'POST',
					data:{
						barcode_id:$('#EmployeeIDInp').val(),
						type:11,
						random:rString
					},
					success:function(){
						var source = {
								datatype:'json',
								datafields:[
									{name:'id'},
									{name:'image'},
									{name:'employee_code'},
									{name:'type'},
									{name:'time_log'},
									{name:'date'}
								],
								id:'',
								url:'source/employee_attendance/get_time_logs.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var Adapter = new $.jqx.dataAdapter(source);
							$('#EmployeeLatestAttendanceGrid').jqxGrid({source:Adapter});
							var DTRSummaryEmployeesource =
							{
								datatype: "json",
								datafields: [
									{ name: 'id' },
									{ name: 'employee_id' },
									{ name: 'employee_name' },
									{ name: 'employee_code' },
									{ name: 'employee_time_shift_id' },
									{ name: 'date' },
									{ name: 'time_in' },
									{ name: 'lunch_out' },
									{ name: 'lunch_in'},
									{ name: 'time_out' },
									{ name: 'business_out' },
									{ name: 'business_in' },
									{ name: 'personal_out' },
									{ name: 'personal_in' },
									{ name: 'overtime_in' },
									{ name: 'overtime_out' },
									{ name: 'work_minutes' },
									{ name: 'late_minutes' },
									{ name: 'overtime_minutes' },
									{ name: 'business_minutes' },
									{ name: 'personal_minutes' },
									{ name: 'status' }
								],
								id: '',
								url: 'source/employee_attendance/get_employee_dtr_by_code.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var DTRSummaryEmployeeAdapter = new $.jqx.dataAdapter(DTRSummaryEmployeesource);
							$('#EmployeeAttendanceGrid').jqxGrid({source:DTRSummaryEmployeeAdapter });
							$('#EmployeeIDInp').val('');
					},
					complete:function(){
						
						
					}
				});
			});
			$('#OvertimeOutEmployeeAttendanceBtn').jqxButton({width:'100'}).on('click',function(){
				var rString = randomString(15, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
				Webcam.snap( function(data_uri) {
					$.ajax({
						url:'source/employee_attendance/save_time_log_image_directory.php',
						type:'POST',
						data:{
							base64:data_uri,
							barcode_id:$('#EmployeeIDInp').val(),
							random:rString
						},
						success:function(){
							
							
						},
						complete:function(){
							
						}
					});
				});
				$.ajax({
					url:'source/employee_attendance/add_time_logs.php',
					type:'POST',
					data:{
						barcode_id:$('#EmployeeIDInp').val(),
						type:12,
						random:rString
					},
					success:function(){
						var source = {
								datatype:'json',
								datafields:[
									{name:'id'},
									{name:'image'},
									{name:'employee_code'},
									{name:'type'},
									{name:'time_log'},
									{name:'date'}
								],
								id:'',
								url:'source/employee_attendance/get_time_logs.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var Adapter = new $.jqx.dataAdapter(source);
							$('#EmployeeLatestAttendanceGrid').jqxGrid({source:Adapter});
							var DTRSummaryEmployeesource =
							{
								datatype: "json",
								datafields: [
									{ name: 'id' },
									{ name: 'employee_id' },
									{ name: 'employee_name' },
									{ name: 'employee_code' },
									{ name: 'employee_time_shift_id' },
									{ name: 'date' },
									{ name: 'time_in' },
									{ name: 'lunch_out' },
									{ name: 'lunch_in'},
									{ name: 'time_out' },
									{ name: 'business_out' },
									{ name: 'business_in' },
									{ name: 'personal_out' },
									{ name: 'personal_in' },
									{ name: 'overtime_in' },
									{ name: 'overtime_out' },
									{ name: 'work_minutes' },
									{ name: 'late_minutes' },
									{ name: 'overtime_minutes' },
									{ name: 'business_minutes' },
									{ name: 'personal_minutes' },
									{ name: 'status' }
								],
								id: '',
								url: 'source/employee_attendance/get_employee_dtr_by_code.php?employee_code='+$('#EmployeeIDInp').val()
							};
							var DTRSummaryEmployeeAdapter = new $.jqx.dataAdapter(DTRSummaryEmployeesource);
							$('#EmployeeAttendanceGrid').jqxGrid({source:DTRSummaryEmployeeAdapter });
							$('#EmployeeIDInp').val('');
					},
					complete:function(){
						
						
					}
				});
			});
			$('#EmployeeLatestAttendanceGrid').jqxGrid({
				width:'100%',
				height:'505px',
				rowsheight: 45,
				columns:[
					{text:'ID',dataField:'id',hidden:true},
					{text:'Image',dataField:'image',width:'55px'},
					{text:'Code',dataField:'employee_code'},
					{text:'Type',dataField:'type'},
					{text:'Time Log',dataField:'time_log'},
					{text:'Date',dataField:'date'}
				]
			}).css({'border':'0px'});
			$('#EmployeeLatestAttendanceGrid').jqxGrid('render');
		},
		columns:[
			{text:'ID',dataField:'id',hidden:true},
			{text:'Employee ID',dataField:'employee_id',hidden:true},
			{text:'Name',dataField:'employee_name',width:'300px',hidden:true},
			{text:'Code',dataField:'employee_code',width:'100px'},
			{text:'Employee Time Shift ID',dataField:'employee_time_shift_id',hidden:true},
			{text:'Date',dataField:'date',width:'170px'},
			{text:'Time In',dataField:'time_in',width:'100px'},
			{text:'Lunch Out',dataField:'lunch_out',width:'100px'},
			{text:'Lunch In',dataField:'lunch_in',width:'100px'},
			{text:'Break Out',dataField:'break_out',width:'100px'},
			{text:'Break In',dataField:'break_in',width:'100px'},
			{text:'Time Out',dataField:'time_out',width:'100px'},
			{text:'Business Out',dataField:'business_out',width:'100px'},
			{text:'Business In',dataField:'business_in',width:'100px'},
			{text:'Personal Out',dataField:'personal_out',width:'100px'},
			{text:'Personal In',dataField:'personal_in',width:'100px'},
			{text:'Overtime In',dataField:'overtime_in',width:'100px'},
			{text:'Overtime Out',dataField:'overtime_out'},
			{text:'Work (min)',dataField:'work_minutes',width:'130px',hidden:true},
			{text:'Late (min)',dataField:'late_minutes',width:'130px',hidden:true},
			{text:'Overtime (min)',dataField:'overtime_minutes',width:'130px',hidden:true},
			{text:'Business (min)',dataField:'business_minutes',width:'130px',hidden:true},
			{text:'Personal (min)',dataField:'personal_minutes',width:'130px',hidden:true},
			{text:'Status',dataField:'status',width:'100px',hidden:true}
		]
	}).css({'border':'0px'});
	$('#EmployeeAttendanceGrid').jqxGrid('render');
	
	setInterval(function(){
		updateClock();
		$('#EmployeeIDInp').jqxInput('focus');
		if($('#EmployeeIDInp').val() == ''){
			$('button').attr({disabled:true});
		}else{
			$('button').attr({disabled:false});
		}
	}, 1000);
});

function updateClock(){
	var currentTime = new Date ( );
	var currentHours = currentTime.getHours ( );
	var currentMinutes = currentTime.getMinutes ( );
	var currentSeconds = currentTime.getSeconds ( );
	currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
	currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
	var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";
	currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
	currentHours = ( currentHours == 0 ) ? 12 : currentHours;
	var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
	$("#clock").html(currentTimeString);
						
 }
function randomString(length, chars) {
	var result = '';
	for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
	return result;
}