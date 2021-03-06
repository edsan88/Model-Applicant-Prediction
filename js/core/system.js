$(function(){
	$('#LoginWin').jqxWindow({
		width:'300px',
		height:'160px',
		showCloseButton:false,
		isModal:true,
		modalOpacity:0,
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

			$('#LoginWinSubmit').jqxButton({theme:'base'}).on('click',function(){
				$.ajax({
					url:'source/login/login.php',
					data:{
						id:$('#LoginID').val(),
						pass:$('#LoginPassword').val()
					},
					type:'POST',
					beforeSend:function(){

					},
					success:function(data){
						if(data.length == 16){
							$('#NotifyMessage').html("<center>Username/ Password Incorrect</center>");
						}else if(data.length > 17){
							var obj = $.parseJSON(data);
							$.session.set("user_id",obj[0].user_id);
							$("#LoginWin").jqxWindow('close');
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
	$('#MainSplitter').jqxSplitter({
		width:'100%',
		height:'100%',
		panels:[
			{size:'30px'},
			{}
		],
		orientation:'horizontal',
		resizable:false,
		showSplitBar: false
	}).css({'border':'0px'});
	$("#MainMenu").jqxMenu({ 
		width: '100%',
		height: '100%', 
		mode: 'horizontal',
		showTopLevelArrows: true
	}).on('itemclick', function (event){
		console.log($(event.target).text()+"----"+event.args.id);
		if($(event.target).text()){
			$('#CoreWin').jqxWindow('setTitle','<b>'+$(event.target).text()+'</b>');
			$('#CoreContentWin').empty().load('source/'+event.args.id+'/main.php');
			$('#CoreWin').jqxWindow('open');
		}
		
		
	});
	$('#CoreWin').jqxWindow({
		width:'100%',
		maxWidth:(($(window).innerWidth() * 100)/100),
		height:((($(window).innerHeight() * 100)/100) - 35),
		maxHeight:(($(window).innerHeight() * 100)/100),
		showCloseButton:true,
		isModal:true,
		modalOpacity:0,
		autoOpen:false,
		resizable:false,
		draggable:false,
		position:'bottom'
	});
	$('#system_logo').css({
		'position':'absolute',
		'width':'186px',
		'height':'49px',
		'bottom':((($(window).innerHeight() * 50)/100) - 25),
		'left':((($(window).innerWidth() * 50)/100) - 93),
		'z-index':10,
		'background-image':'url(img/system_logo/core_system.png)',
		'background-size': '100% 100%',
		'background-repeat':'no-repeat'
	});
	$('#system_version').css({
		'position':'absolute',
		'width':'100px',
		'height':'20px',
		'bottom':((($(window).innerHeight() * 50)/100) - 45),
		'left':((($(window).innerWidth() * 50)/100) - 50),
		'z-index':10,
		'background-repeat':'no-repeat',
		'color':'#c2c2c2',
		'text-align':'center'
	}).html('version 1.0.0');
});