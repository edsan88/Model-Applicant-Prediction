$(function(){
	$('#LoginWin').jqxWindow({
		width:'420px',
		height:'430px',
		showCloseButton:false,
		isModal:true,
		modalOpacity:1,
		autoOpen:false,
		resizable:false,
		draggable:false,
		initContent:function(){
			var title = "Fill-in required fields";
			var content = "<table style='width:100%;'>";
			content += "<tr>";
			content += "<td style='width:50%;'> ID #</td>";
			content += "<td><input id=IDNumber></td>";
			content += "</tr>";
			content += "<tr>";
			content += "<td style='width:50%;'>Age</td>";
			content += "<td><div id=AgeID></div></td>";
			content += "</tr>";
			content += "<tr>";
			content += "<td>Sex</td>";
			content += "<td><div id=SexID></div></td>";
			content += "</tr>";
			content += "<tr>";
			content += "<td>Religion</td>";
			content += "<td><div id=ReligionID></div></td>";
			content += "</tr>";
			content += "<tr>";
			content += "<td>Marital Status</td>";
			content += "<td><div id=MaritalStatusID></div></td>";
			content += "</tr>";
			content += "<tr>";
			content += "<td>Educational Attainment</td>";
			content += "<td><div id=EducLevelID></div></td>";
			content += "</tr>";
			content += "<tr>";
			content += "<td>Region</td>";
			content += "<td><div id=RegionID></div></td>";
			content += "</tr>";
			content += "<tr>";
			content += "<td>Province</td>";
			content += "<td><div id=ProvinceID></div></td>";
			content += "</tr>";
			content += "<tr>";
			content += "<td>City</td>";
			content += "<td><div id=CityID></div></td>";
			content += "</tr>";
			content += "<tr>";
			content += "<td>Brgy</td>";
			content += "<td><div id=BrgyID></div></td>";
			content += "</tr>";
			content += "<tr>";
			content += "<td></td>";
			content += "<td><button id='LoginWinSubmit' style='margin:5px;'>Proceed Survey</button></td>";
			content += "</tr>";
			content += "</table>";
			$('#LoginWin').jqxWindow('setTitle',title);
			$('#LoginWin').jqxWindow('setContent',content);
			$('#IDNumber').jqxInput({width:'100%'});
			$('#AgeID').jqxDropDownList({ 
				displayMember: "age",
				valueMember: "id",
				height: '25px',
				width:'100%',
			}).on('open',function(){
				var source =
				{
					datatype: "json",
					datafields: [
						{ name: 'id' },
						{ name: 'age' }
					],
					id: '',
					url: 'source/retention/load_age_list.php'
				};
				var Adapter = new $.jqx.dataAdapter(source);
				$(this).jqxDropDownList({ source: Adapter});
			});
			$('#SexID').jqxDropDownList({ 
				displayMember: "sex",
				valueMember: "id",
				height: '25px',
				width:'100%',
			}).on('open',function(){
				var source =
				{
					datatype: "json",
					datafields: [
						{ name: 'id' },
						{ name: 'sex' }
					],
					id: '',
					url: 'source/retention/load_sex_list.php'
				};
				var Adapter = new $.jqx.dataAdapter(source);
				$(this).jqxDropDownList({ source: Adapter});
			});
			$('#ReligionID').jqxDropDownList({ 
				displayMember: "religion",
				valueMember: "id",
				height: '25px',
				width:'100%',
			}).on('open',function(){
				var source =
				{
					datatype: "json",
					datafields: [
						{ name: 'id' },
						{ name: 'religion' }
					],
					id: '',
					url: 'source/retention/load_religion_list.php'
				};
				var Adapter = new $.jqx.dataAdapter(source);
				$(this).jqxDropDownList({ source: Adapter});
			});
			$('#MaritalStatusID').jqxDropDownList({ 
				displayMember: "marital_status",
				valueMember: "id",
				height: '25px',
				width:'100%',
			}).on('open',function(){
				var source =
				{
					datatype: "json",
					datafields: [
						{ name: 'id' },
						{ name: 'marital_status' }
					],
					id: '',
					url: 'source/retention/load_marital_status_list.php'
				};
				var Adapter = new $.jqx.dataAdapter(source);
				$(this).jqxDropDownList({ source: Adapter});
			});
			$('#EducLevelID').jqxDropDownList({ 
				displayMember: "educ_level",
				valueMember: "id",
				height: '25px',
				width:'100%',
			}).on('open',function(){
				var source =
				{
					datatype: "json",
					datafields: [
						{ name: 'id' },
						{ name: 'educ_level' }
					],
					id: '',
					url: 'source/retention/load_educ_level_list.php'
				};
				var Adapter = new $.jqx.dataAdapter(source);
				$(this).jqxDropDownList({ source: Adapter});
			});
			$('#RegionID').jqxDropDownList({ 
				displayMember: "region",
				valueMember: "id",
				height: '25px',
				width:'100%',
			}).on('open',function(){
				var source =
				{
					datatype: "json",
					datafields: [
						{ name: 'id' },
						{ name: 'region' }
					],
					id: '',
					url: 'source/retention/load_region_level_list.php'
				};
				var Adapter = new $.jqx.dataAdapter(source);
				$(this).jqxDropDownList({ source: Adapter});
			});
			$('#ProvinceID').jqxDropDownList({ 
				displayMember: "province",
				valueMember: "id",
				height: '25px',
				width:'100%',
			}).on('open',function(){
				var source =
				{
					datatype: "json",
					datafields: [
						{ name: 'id' },
						{ name: 'province' }
					],
					id: '',
					url: 'source/retention/load_province_level_list.php?id='+$('#RegionID').val()
				};
				var Adapter = new $.jqx.dataAdapter(source);
				$(this).jqxDropDownList({ source: Adapter});
			});
			$('#CityID').jqxDropDownList({ 
				displayMember: "city",
				valueMember: "id",
				height: '25px',
				width:'100%',
			}).on('open',function(){
				var source =
				{
					datatype: "json",
					datafields: [
						{ name: 'id' },
						{ name: 'city' }
					],
					id: '',
					url: 'source/retention/load_city_level_list.php?id='+$('#ProvinceID').val()
				};
				var Adapter = new $.jqx.dataAdapter(source);
				$(this).jqxDropDownList({ source: Adapter});
			});
			$('#BrgyID').jqxDropDownList({ 
				displayMember: "brgy",
				valueMember: "id",
				height: '25px',
				width:'100%',
			}).on('open',function(){
				var source =
				{
					datatype: "json",
					datafields: [
						{ name: 'id' },
						{ name: 'brgy' }
					],
					id: '',
					url: 'source/retention/load_brgy_level_list.php?id='+$('#CityID').val()
				};
				var Adapter = new $.jqx.dataAdapter(source);
				$(this).jqxDropDownList({ source: Adapter});
			});
			//$('#LoginPassword').jqxPasswordInput({ width:'190px',height:'25px'});

			$('#LoginWinSubmit').jqxButton({theme:'base'}).on('click',function(){
				$.ajax({
					url:'source/login/login.php',
					data:{
						id:$('#IDNumber').val(),
						age:$('#AgeID').val(),
						sex:$('#SexID').val(),
						religion:$('#ReligionID').val(),
						marital_status:$('#MaritalStatusID').val(),
						educ_level:$('#EducLevelID').val(),
						region:$('#RegionID').val(),
						province:$('#ProvinceID').val(),
						city:$('#CityID').val(),
						brgy:$('#BrgyID').val()
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
							$.session.set("age",obj[0].age);
							$.session.set("sex",obj[0].sex);
							$.session.set("religion",obj[0].religion);
							$.session.set("marital_status",obj[0].marital_status);
							$.session.set("educ_level",obj[0].educ_level);
							$.session.set("region",obj[0].region);
							$.session.set("province",obj[0].province);
							$.session.set("city",obj[0].city);
							$.session.set("brgy",obj[0].brgy);
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
	$("#MainNavBar").jqxNavigationBar({ 
		width:'100%', 
		height:'100%' 
	}).css({'border':'0px'});
	$('#MainSplitter').jqxSplitter({
		width:'100%',
		height:'100%',
		panels:[
			{size:'350px'},
			{}
		],
		orientation:'vertical',
		resizable:false,
		showSplitBar: false
	}).css({'border':'0px'});
	$('#ContentMainSplitter').jqxSplitter({
		width:'100%',
		height:'100%',
		panels:[
			{size:'70%'},
			{size:'30%'}
		],
		orientation:'horizontal',
		resizable:false,
		showSplitBar: false
	}).css({'border':'0px'});
	//
	var source = {
		datatype:'json',
		datafields:[
			{name:'id'},
			{name:'questionnaire'},
			{name:'info'}
		],
		id:'',
		url:'source/retention/load_questionnaire.php'
	};
	var Adapter = new $.jqx.dataAdapter(source);
	$('#RetentionExamGrid').jqxGrid({
		width:'100%',
		height:'100%',
		source:Adapter,
		filterable:true,
		showfilterrow:true,
		showtoolbar:true,
		columnsresize: true,
		rendertoolbar:function(toolbar){
			var html = "<table>";
			html += "<tr>";
			html += "<td><button id=ProdeedBtn style='margin:5px;'>Proceed</button></td>";
			html += "</tr>";
			html += "</table>";
			var container = $("<div></div>");
			container.append(html);
			toolbar.append(container);
			$('#ProdeedBtn').jqxButton({theme:'base'}).on('click',function(){
				var d = $('#RetentionExamGrid').jqxGrid('getrowdata',$('#RetentionExamGrid').jqxGrid('getselectedrowindex'));
				$.ajax({
					url:'source/retention/load_survey_questions.php',
					data:{
						test_id:d.id
					},
					type:'POST',
					success:function(e){
						$('#MainContentDiv').html(e);
					},
					complete:function(){
						
					}
				});
			});
		},
		showstatusbar:true,
		statusbarheight:300,
		renderstatusbar:function(statusbar){
			var html = "<table style='width:100%'>";
			html += "<tr>";
			html += "<td><b>Please Read:</b></td>";
			html += "</tr>";
			html += "<tr>";
			html += "<td><div id='side_note'></div></td>";
			html += "</tr>";
			html += "</table>";
			var container = $("<div style='margin:10px;'></div>");
			container.append(html);
			statusbar.append(container);
		},
		columns:[
			{text:'ID',dataField:'id',hidden:true},
			{text:'Questionnaire Available',dataField:'questionnaire'},
			{text:'Info',dataField:'info',hidden:true}
		]
	}).on('rowclick',function(e){
		var d = $(this).jqxGrid('getrowdata',e.args.rowindex);
		$('#side_note').html(d.info);
	}).css({'border':'0px'});
});

