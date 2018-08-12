$(function(){
	$('#LoginWin').jqxWindow({
		width:'300px',
		height:'160px',
		showCloseButton:false,
		isModal:true,
		modalOpacity:1,
		autoOpen:false,
		resizable:false,
		draggable:false,
		initContent:function(){
			var title = "<div style='width:76px;height:20px;background-image:url(img/system_logo/core_system_login.png);background-size:100% 100%;background-repeat:no-repeat;'></div>";
			var content = "<table style='width:100%;'>";
			content += "<tr>";
			content += "<td>User ID</td>";
			content += "<td><input id=LoginID></td>";
			content += "</tr>";
			content += "<tr>";
			content += "<td>Password</td>";
			content += "<td><input type='password' id=LoginPassword></td>";
			content += "</tr>";
			content += "<tr>";
			content += "<td></td>";
			content += "<td><button id='LoginWinSubmit'>Login</button></td>";
			content += "</tr>";
			content += "</table>";
			$('#LoginWin').jqxWindow('setTitle',title);
			$('#LoginWin').jqxWindow('setContent',content);
			$('#LoginID').jqxInput({ width:'195px',height:'25px'});
			$('#LoginPassword').jqxPasswordInput({ width:'190px',height:'25px'});

			$('#LoginWinSubmit').jqxButton().on('click',function(){
				$.ajax({
					url:'source/retention/login.php',
					data:{
						id:$('#LoginID').val(),
						pass:$('#LoginPassword').val()
					},
					type:'POST',
					beforeSend:function(){

					},
					success:function(data){
						//console.log(data.length);
						if(data.length == 16){
							//console.log('X');
						}else if(data.length == 17){
							var obj = $.parseJSON(data);
							$.session.set("user_id",obj[0].user_id);
							$("#LoginWin").jqxWindow('close');
							//console.log(data.length);
						}
					},
					complete:function(){
						
					}
				});
			});
		}
	}).on('close',function(){
		if($.session.get('user_id')){

		}else{
			$(this).jqxWindow('open');
		}
	}).on('open',function(){
		if($.session.get('user_id')){
			$(this).jqxWindow('close');
		}else{

		}
	});
	
	var open = $("#LoginWin").jqxWindow('isOpen');
	if(open){
		if($.session.get('user_id')){
			$("#LoginWin").jqxWindow('close');
		}else{

		}
	}else{
		if($.session.get('user_id')){

		}else{
			$("#LoginWin").jqxWindow('open');
		}
	}
	$('#LogOutBtn').jqxButton().on('click',function(){
		$.session.remove('user_id');
		$('#LoginWin').jqxWindow('open');
		console.log('xxx');
	});
});