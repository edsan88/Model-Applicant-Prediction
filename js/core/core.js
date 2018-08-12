$(function(){
			$('#MainContainer').fadeIn(5000);
			$('#MainTab').jqxTabs({
				width:'100%',
				height:'100%'
			}).css({'border':'0px'});
			var sourceDimensionList =
			{
				datatype: "json",
				datafields: [
					{ name: 'id' },
					{ name: 'dimension' },
					{ name: 'desc' }
				],
				id: '',
				url: 'source/retention/load_dimension_list.php'
			};
			var DimensionListAdapter = new $.jqx.dataAdapter(sourceDimensionList);
			$('#MainGridDimension').jqxGrid({
				width:'100%',
				height:'100%',
				source:DimensionListAdapter,
				filterable:true,
				showfilterrow:true,
				showtoolbar:true,
				columnsresize: true,
				rendertoolbar:function(toolbar){
					var html = "<table>";
					html += "<tr>";
					html += "<td><button id=RefreshMainGridDimensionBtn style='margin:5px;'>Refresh</button></td>";
					html += "<td><button id=MainGridDimensionBtn style='margin:5px;'>Add Dimension Type</button></td>";
					html += "<td><button id=DeleteMainGridDimensionBtn style='margin:5px;'>Delete Type</button></td>";
					html += "</tr>";
					html += "</table>";
					html += "<div id=MainGridDimensionWin><div></div><div></div></div>";
					//var html = "<button id=MainGridDimensionBtn style='margin:5px;'>Add Dimension Type</button>";
					//html += "<div id=MainGridDimensionWin><div></div><div></div></div>";
					var container = $("<div></div>");
					container.append(html);
					toolbar.append(container);
					$('#RefreshMainGridDimensionBtn').jqxButton().on('click',function(){
						var source =
						{
							datatype: "json",
							datafields: [
								{ name: 'id' },
								{ name: 'dimension' },
								{ name: 'desc' }
							],
							id: '',
							url: 'source/retention/load_dimension_list.php'
						};
						var Adapter = new $.jqx.dataAdapter(source);
						$('#MainGridDimension').jqxGrid({ source: Adapter});
					});
					$('#MainGridDimensionBtn').jqxButton().on('click',function(){
						$('#MainGridDimensionWin').jqxWindow('open');
					});
					$('#DeleteMainGridDimensionBtn').jqxButton().on('click',function(){
						var d = $('#MainGridDimension').jqxGrid('getrowdata',$('#MainGridDimension').jqxGrid('getselectedrowindex'));
						$.ajax({
							url:'source/retention/delete_dimension.php',
							type:'POST',
							data:{
								id:d.id
							},
							success:function(){
								var source =
								{
									datatype: "json",
									datafields: [
										{ name: 'id' },
										{ name: 'dimension' },
										{ name: 'desc' }
									],
									id: '',
									url: 'source/retention/load_dimension_list.php'
								};
								var Adapter = new $.jqx.dataAdapter(source);
								$('#MainGridDimension').jqxGrid({ source: Adapter});
							},
							complete:function(){
								
							}
						});
					});
					$('#MainGridDimensionWin').jqxWindow({
						width:'500px',
						height:'200px',
						autoOpen:false,
						isModal:true,
						resizable:false,
						modalOpacity:0.7,
						initContent:function(){
							var title = "Add New Dimension";
							var content = "<table style='width:100%;'>";
							content += "<tr>";
								content += "<td>Dimension</td>";
								content += "<td><input id=MainGridDimensionInp></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td VALIGN='top' ALIGN='top'>Description</td>";
								content += "<td><textarea id=MainGridDimensionDescInp rows=7 cols=40></textarea></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td></td>";
								content += "<td><button id=SubmitMainGridDimensionBtn>Submit</button></td>";
							content += "</tr>";
							content += "</table>";
							$('#MainGridDimensionWin').jqxWindow('setTitle',title);
							$('#MainGridDimensionWin').jqxWindow('setContent',content);	
							$('#MainGridDimensionInp').jqxInput();
							$('#SubmitMainGridDimensionBtn').jqxButton().on('click',function(){
								$.ajax({
									url:'source/retention/add_dimension.php',
									type:'POST',
									data:{
										dimension:$('#MainGridDimensionInp').val(),
										desc:$('#MainGridDimensionDescInp').val()
									},
									success:function(){
										$('#MainGridDimensionWin').jqxWindow('close');
										$('#MainGridDimensionInp').val('');
										$('#MainGridDimensionDescInp').val('');
										var source =
										{
											datatype: "json",
											datafields: [
												{ name: 'id' },
												{ name: 'dimension' },
												{ name: 'desc' }
											],
											id: '',
											url: 'source/retention/load_dimension_list.php'
										};
										var Adapter = new $.jqx.dataAdapter(source);
										$('#MainGridDimension').jqxGrid({ source: Adapter});
									},
									complete:function(){
										
									}
								});
							});
						}
					});
				},
				showstatusbar:true,
				renderstatusbar:function(statusbar){
					
				},
				columns:[
					{text:'ID',dataField:'id',hidden:true},
					{text:'Dimension',dataField:'dimension',pinned:true,width:'200px'},
					{text:'Description',dataField:'desc'}
				]
			}).css({'border':'0px'});
			$('#MainGridQuestions').jqxGrid({
				width:'100%',
				height:'100%',
				filterable:true,
				showfilterrow:true,
				showtoolbar:true,
				columnsresize: true,
				rendertoolbar:function(toolbar){
					var container = $("<div></div>");
					var html = "<table>";
					html += "<tr>";
						html += "<td><button id=RefreshMainGridQuestionsBtn style='margin:5px;'>Refresh</button></td>";
						html += "<td><button id=AddMainGridQuestionsBtn style='margin:5px;'>Add Question</button></td>";
					html += "</tr>";
					html += "</table>";
					html += "<div id=MainGridQuestionsWin><div></div><div></div></div>";
					container.append(html);
					toolbar.append(container);
					$('#RefreshMainGridQuestionsBtn').jqxButton().on('click',function(){
						var source =
						{
							datatype: "json",
							datafields: [
								{ name: 'id' },
								{ name: 'dimension' },
								{ name: 'question' }
							],
							id: '',
							url: 'source/retention/load_question_list.php'
						};
						var Adapter = new $.jqx.dataAdapter(source);
						$('#MainGridQuestions').jqxGrid({ source: Adapter});
					});
					$('#AddMainGridQuestionsBtn').jqxButton().on('click',function(){
						$('#MainGridQuestionsWin').jqxWindow('open');
					});
					$('#MainGridQuestionsWin').jqxWindow({
						width:'500px',
						height:'380px',
						autoOpen:false,
						isModal:true,
						resizable:false,
						modalOpacity:0.7,
						initContent:function(){
							var title = "Add New Question";
							var content = "<table>";
							content += "<tr>";
								content += "<td>Dimension</td>";
								content += "<td><div id=FilterMainGridQuestionsDimension></div></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Question</td>";
								content += "<td><textarea id=MainGridQuestionsQuestionsInp rows=7 cols=40></textarea></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Key words (new word followed by comma)</td>";
								content += "<td><textarea id=MainGridKeywordsQuestionsInp rows=7 cols=40></textarea></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Ideal Response</td>";
								content += "<td><div id=MainGridIdealResponseQuestionsInp></div></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td></td>";
								content += "<td><button id=SubmitMainGridQuestionsWinBtn>Submit</button></td>";
							content += "</tr>";
							content += "</table>";
							$('#MainGridQuestionsWin').jqxWindow('setTitle',title);
							$('#MainGridQuestionsWin').jqxWindow('setContent',content);
							$('#FilterMainGridQuestionsDimension').jqxDropDownList({ 
								displayMember: "dimension",
								valueMember: "id",
								width:'150px',
							}).on('open',function(){
								var source =
								{
									datatype: "json",
									datafields: [
										{ name: 'id' },
										{ name: 'dimension' }
									],
									id: '',
									url: 'source/retention/load_dimension_list.php'
								};
								var Adapter = new $.jqx.dataAdapter(source);
								$(this).jqxDropDownList({ source: Adapter});
							});
							$('#MainGridIdealResponseQuestionsInp').jqxDropDownList({ 
								displayMember: "name",
								valueMember: "id",
								height: '25px',
								width:'100%',
							}).on('open',function(){
								var source =
								{
									datatype: "json",
									datafields: [
										{ name: 'id' },
										{ name: 'name' }
									],
									id: '',
									url: 'source/retention/ideal_response.php'
								};
								var Adapter = new $.jqx.dataAdapter(source);
								$(this).jqxDropDownList({ source: Adapter});
							});
							$('#SubmitMainGridQuestionsWinBtn').jqxButton().on('click',function(){
								$.ajax({
									url:'source/retention/add_question.php',
									type:'POST',
									data:{
										dimension_id:$('#FilterMainGridQuestionsDimension').val(),
										question:$('#MainGridQuestionsQuestionsInp').val(),
										keywords:$('#MainGridKeywordsQuestionsInp').val(),
										ideal_response:$('#MainGridIdealResponseQuestionsInp').val()
									},
									success:function(){
										$('#MainGridQuestionsQuestionsInp').val("");
										$('#MainGridQuestionsWin').jqxWindow('close');
										var source =
										{
											datatype: "json",
											datafields: [
												{ name: 'id' },
												{ name: 'dimension' },
												{ name: 'question' }
											],
											id: '',
											url: 'source/retention/load_question_list.php'
										};
										var Adapter = new $.jqx.dataAdapter(source);
										$('#MainGridQuestions').jqxGrid({ source: Adapter});
									},
									complete:function(){
										
									}
								});
							});
						}
					});
				},
				showstatusbar:true,
				renderstatusbar:function(statusbar){
					
				},
				columns:[
					{text:'ID',dataField:'id',hidden:true},
					{text:'Dimension',dataField:'dimension'},
					{text:'Question',dataField:'question'}
				]
			}).css({'border':'0px'});
			// $('#MainGridSplitter').jqxSplitter({
				// width:'100%',
				// height:'100%',
				// panels:[{size:'20%'},{size:'80%'}],
				// orientation:'vertical'
			// });
			// $('#MainGridUserResponseUser').jqxGrid({
				// width:'100%',
				// height:'100%',
				// filterable:true,
				// showfilterrow:true,
				// showtoolbar:true,
				// columnsresize: true,
				// rendertoolbar:function(toolbar){
					// var html = "<table>";
					// html += "<tr>";
						// html += "<td><button id=RefreshUserResponseListBtn style='margin:5px;'>Refresh</td>";
					// html += "</tr>";
					// html += "</table>";
					// var container = $("<div></div>");
					// container.append(html);
					// toolbar.append(container);
					// $('#RefreshUserResponseListBtn').jqxButton().on('click',function(){
						// var source =
						// {
							// datatype: "json",
							// datafields: [
								// { name: 'id' },
								// { name: 'user_id' }
							// ],
							// id: '',
							// url: 'source/retention/load_user_list.php'
						// };
						// var Adapter = new $.jqx.dataAdapter(source);
						// $('#MainGridUserResponseUser').jqxGrid({ source: Adapter});
					// });
				// },
				// columns:[
					// {text:'ID',dataField:'id',hidden:true},
					// {text:'User ID',dataField:'user_id'}
				// ]
			// }).on('rowclick',function(e){
				// var d = $(this).jqxGrid('getrowdata',e.args.rowindex);
				// var source =
				// {
					// datatype: "json",
					// datafields: [
						// { name: 'id' },
						// { name: 'dimension' },
						// { name: 'question' },
						// { name: 'response' },
						// { name: 'rating' }
					// ],
					// id: '',
					// url: 'source/retention/load_user_response_by_user.php?user_id='+d.user_id
				// };
				// var Adapter = new $.jqx.dataAdapter(source);
				// $('#MainGridUserResponse').jqxGrid({ source: Adapter});
			// }).css({'border':'0px'});
			// $('#MainGridUserResponse').jqxGrid({
				// width:'100%',
				// height:'100%',
				// filterable:true,
				// showfilterrow:true,
				// showtoolbar:true,
				// columnsresize: true,
				// rendertoolbar:function(toolbar){
					// var html = "";
					// var container = $("<div></div>");
					// container.append(html);
					// toolbar.append(container);
					
				// },
				// columns:[
					// {text:'ID',dataField:'id',hidden:true},
					// {text:'Dimension',dataField:'dimension'},
					// {text:'Question',dataField:'question'},
					// {text:'Response',dataField:'response'},
					// {text:'Ratings',dataField:'rating'}
				// ]
			// }).css({'border':'0px'});
			$('#SetupTab').jqxTabs({width:'100%',height:'100%'}).css({'border':'0px'});
			$('#MainGridUserResponseByTemplate').jqxGrid({
				width:'100%',
				height:'100%',
				filterable:true,
				showfilterrow:true,
				showtoolbar:true,
				columnsresize: true,
				groupable:true,
				showgroupsheader:false,
				groupsexpandedbydefault:true,
				rendertoolbar:function(toolbar){
					var html = "";
					var container = $("<div style='margin:5px;'><b>Employee Response</b></div>");
					container.append(html);
					toolbar.append(container);
					
				},
				columns:[
					{text:'ID',dataField:'id',hidden:true},
					{text:'Dimension',dataField:'dimension',width:'250px'},
					{text:'Ratings',dataField:'rating',width:'150px'},
					{text:'Question',dataField:'question',width:'1500px'},
					{text:'Response',dataField:'response',width:'3000px'}
				],
				groups:['dimension']
			}).css({'border':'0px'});
			$('#AnalysisEmployeeApplicantTab').jqxTabs({
				width:'100%',
				height:'100%'
			}).css({'border':'0px'});
			$('#AnalysisTab').jqxTabs({
				width:'100%',
				height:'100%'
			}).css({'border':'0px'});
			$('#ConsolidateUserResponseSplitterMain').jqxSplitter({
				width:'100%',
				height:'100%',
				panels:[
					{size:'500px'},
					{size:''}
				]
			}).css({'border':'0px'});
			$('#ConsolidateUserResponseSplitterLeft').jqxSplitter({
				width:'100%',
				height:'100%',
				panels:[
					{size:'50%'},
					{size:'50%'}
				]
			}).css({'border':'0px'});
			$('#ConsolidateUserResponseSplitterRight').jqxSplitter({
				width:'100%',
				height:'100%',
				panels:[
					{size:'50%'},
					{size:'50%'}
				],
				orientation:'horizontal'
			}).css({'border':'0px'});
			$('#ConsolidateUserResponseSplitterRightDetails').jqxSplitter({
				width:'100%',
				height:'100%',
				panels:[
					{size:'250px'},
					{size:'50%'}
				]
			}).css({'border':'0px'});
			$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander({
				width:'100%',
				height:'100%',
				toggleMode: 'none'
			}).css({'border':'0px'});
			
			var sourceTemplate =
			{
				datatype: "json",
				datafields: [
					{ name: 'id' },
					{ name: 'template_description' },
					{ name: 'status'},
					{ name: 'date_start' },
					{ name: 'date_end' }
				],
				id: '',
				url: 'source/retention/load_consolidate_template.php'
			};
			var AdapterTemplate = new $.jqx.dataAdapter(sourceTemplate);
			$('#ConsolidateTemplateGrid').jqxGrid({
				width:'100%',
				height:'100%',
				source:AdapterTemplate,
				filterable:true,
				showfilterrow:true,
				showtoolbar:true,
				columnsresize: true,
				showtoolbar:true,
				rendertoolbar:function(toolbar){
					var html = "<button id=AddNewConsolidateTemplateBtn style='margin:5px;'>New</button>";
					html += "<button id=RefreshConsolidateTemplateBtn style='margin:5px;'>Refresh</button>";
					html += "<button id=RevertConsolidateTemplateBtn style='margin:5px;'>Revert</button>";
					html += "<div id=ConsolidateTemplateGridWin><div></div><div></div></div>";
					var container = $("<div></div>");
					container.append(html);
					toolbar.append(container);
					$('#AddNewConsolidateTemplateBtn').jqxButton().on('click',function(){
						$('#ConsolidateTemplateGridWin').jqxWindow('open');
					});
					$('#RefreshConsolidateTemplateBtn').jqxButton().on('click',function(){
						var source =
						{
							datatype: "json",
							datafields: [
								{ name: 'id' },
								{ name: 'template_description' },
								{ name: 'status'},
								{ name: 'date_start' },
								{ name: 'date_end' }
							],
							id: '',
							url: 'source/retention/load_consolidate_template.php'
						};
						var Adapter = new $.jqx.dataAdapter(source);
						$('#ConsolidateTemplateGrid').jqxGrid({ source: Adapter});
					});
					$('#RevertConsolidateTemplateBtn').jqxButton().on('click',function(){
						var d = $('#ConsolidateTemplateGrid').jqxGrid('getrowdata',$('#ConsolidateTemplateGrid').jqxGrid('getselectedrowindex'));
						$.ajax({
							url:'source/retention/revert_template.php',
							type:'POST',
							data:{
								id:d.id
							},
							beforeSend:function(){
								
							},
							success:function(){
								
							},
							complete:function(){
								var source =
								{
									datatype: "json",
									datafields: [
										{ name: 'id' },
										{ name: 'template_description' },
										{ name: 'status'},
										{ name: 'date_start' },
										{ name: 'date_end' }
									],
									id: '',
									url: 'source/retention/load_consolidate_template.php'
								};
								var Adapter = new $.jqx.dataAdapter(source);
								$('#ConsolidateTemplateGrid').jqxGrid({ source: Adapter});
							}
						});
						
					});
					$('#ConsolidateTemplateGridWin').jqxWindow({
						width:'500px',
						maxWidth:(($(window).innerWidth() * 100)/100),
						height:'90%',
						maxHeight:(($(window).innerHeight() * 100)/100),
						autoOpen:false,
						isModal:true,
						resizable:false,
						modalOpacity:0.7,
						initContent:function(){
							var title = "Add New Survey Template";
							$('#ConsolidateTemplateGridWin').jqxWindow('setTitle',title);
								var content = "<table style='width:94%;'>";
								content += "<tr>";
									content += "<td style='text-align:right;'>Survey Start Date</td>";
									content += "<td style='70%'><div id='TemplateStartDateInp'></div></td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td style='text-align:right;'>Survey Start Date</td>";
									content += "<td style='70%'><div id='TemplateEndDateInp'></div></td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td colspan=2; style='border-bottom:1px solid;'><img src='img/icon/component.png'> Template Description</td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td style='text-align:right;'>Name</td>";
									content += "<td style='70%'><input type='text' id='TemplateDescInp'></td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td colspan=2; style='border-bottom:1px solid;'><img src='img/icon/component.png'> Age</td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td style='text-align:right;'>Min</td>";
									content += "<td style='70%'><div id=AgeIDMin></div></td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td style='text-align:right;'>Max</td>";
									content += "<td><div id=AgeIDMax></div></td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td colspan=2;><br></td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td colspan=2; style='border-bottom:1px solid;'><img src='img/icon/component.png'> Sex</td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td></td>";
									content += "<td>";
										content += "<p><input class=SexAnalysisFilter type=checkbox value=1> Male </p> ";
										content += "<p><input class=SexAnalysisFilter type=checkbox value=2> Female</p>"; 
									content += "</td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td colspan=2;><br></td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td colspan=2; style='border-bottom:1px solid;'><img src='img/icon/component.png'> Religion</td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td></td>";
									content += "<td><div id=ReligionGridAnalysisFilter></div></td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td colspan=2;><br></td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td colspan=2; style='border-bottom:1px solid;'><img src='img/icon/component.png'> Marital Status</td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td></td>";
									content += "<td>";
										content += "<p><input class=MaritalAnalysisFilter type=checkbox value=1> Married</p>";
										content += "<p><input class=MaritalAnalysisFilter type=checkbox value=2> Single</p>"; 
										content += "<p><input class=MaritalAnalysisFilter type=checkbox value=3> Divorced</p>"; 
										content += "<p><input class=MaritalAnalysisFilter type=checkbox value=4> Widowed</p>"; 
									content += "</td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td colspan=2;><br></td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td colspan=2; style='border-bottom:1px solid;'><img src='img/icon/component.png'> Educational Attainment</td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td></td>";
									content += "<td><div id=EducAttainmentGridAnalysisFilter></div></td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td colspan=2;><br></td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td colspan=2; style='border-bottom:1px solid;'><img src='img/icon/component.png'> Region</td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td></td>";	
									content += "<td>";
										content += "<div id=RegionGridAnalysisFilter></div>";
										content += "<button id=BtnSelectAllRegionGridAnalysisFilter>Select All</button>";
										content += "<button id=BtnClearRegionGridAnalysisFilter>Clear</button>";
										content += "<button id=BtnLoadProvinceByRegionGridAnalysisFilter>Load Province</button>";
									content += "</td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td colspan=2;><br></td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td colspan=2; style='border-bottom:1px solid;'><img src='img/icon/component.png'> Province</td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td></td>";
									content += "<td>";
										content += "<div id=ProvinceGridAnalysisFilter></div>";
										content += "<button id=BtnSelectAllProvinceGridAnalysisFilter>Select All</button>";
										content += "<button id=BtnClearProvinceGridAnalysisFilter>Clear</button>";
										content += "<button id=BtnLoadCityByProvinceGridAnalysisFilter>Load City</button>";
									content += "</td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td colspan=2;><br></td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td colspan=2; style='border-bottom:1px solid;'><img src='img/icon/component.png'> City</td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td></td>";
									content += "<td>";
										content += "<div id=CityGridAnalysisFilter></div>";
										content += "<button id=BtnSelectAllCityGridAnalysisFilter>Select All</button>";
										content += "<button id=BtnClearCityGridAnalysisFilter>Clear</button>";
										content += "<button id=BtnLoadBrgyByCityGridAnalysisFilter>Load Brgy</button>";
									content += "</td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td colspan=2;><br></td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td colspan=2; style='border-bottom:1px solid;'><img src='img/icon/component.png'> Brgy</td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td></td>";
									content += "<td>";
										content += "<div id=BrgyGridAnalysisFilter></div>";
										content += "<button id=BtnSelectAllBrgyGridAnalysisFilter>Select All</button>";
										content += "<button id=BtnClearBrgyGridAnalysisFilter>Clear</button>";
									content += "</td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td colspan=2;><hr></td>";
								content += "</tr>";
								content += "<tr>";
									content += "<td colspan=2; style='text-align:right;'><button id=SubmitConsolidatedFilteredListBtn>Submit</button></td>";
								content += "</tr>";
							content += "</table>";
							$('#ConsolidateTemplateGridWin').jqxWindow('setContent',content);
							$('#TemplateStartDateInp').jqxDateTimeInput({ width: '100%',height:'20px',formatString:'yyyy-MM-dd'});
							$('#TemplateEndDateInp').jqxDateTimeInput({ width: '100%',height:'20px',formatString:'yyyy-MM-dd'});
							$('#TemplateDescInp').jqxInput({
								width:'100%',
								height:25
							});
							$('#AgeIDMin').jqxDropDownList({ 
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
							$('#AgeIDMax').jqxDropDownList({ 
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
							$('#ReligionGridAnalysisFilter').jqxGrid({
								width:'100%',
								height:'200px',
								filterable:true,
								showfilterrow:true,
								selectionmode:'checkbox',
								columns:[
									{text:'ID',dataField:'id'},
									{text:'Religion',dataField:'religion'}
								],
								showstatusbar:true,
								renderstatusbar:function(statusbar){
									var html = "<table>";
									html += "<tr>";
										html += "<td><button id=RefreshSelectionReligionFilterBtn>Refresh</button></td>";
										html += "<td><button id=ClearSelectionReligionFilterBtn>Clear</button></td>";
									html += "</tr>";
									html += "</table>";
									var container = $("<div></div>");
									container.append(html);
									statusbar.append(container);
									$('#RefreshSelectionReligionFilterBtn').jqxButton().on('click',function(){
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
										$('#ReligionGridAnalysisFilter').jqxGrid({ source: Adapter});
									});
									$('#ClearSelectionReligionFilterBtn').jqxButton().on('click',function(){
										$('#ReligionGridAnalysisFilter').jqxGrid('clearselection');
									});
								}
							});
							$('#EducAttainmentGridAnalysisFilter').jqxGrid({
								width:'100%',
								height:'200px',
								filterable:true,
								showfilterrow:true,
								selectionmode:'checkbox',
								columns:[
									{text:'ID',dataField:'id',hidden:true},
									{text:'Level',dataField:'educ_level'}
								],
								showstatusbar:true,
								renderstatusbar:function(statusbar){
									var html = "<table>";
									html += "<tr>";
										html += "<td><button id=RefreshSelectionEducAttainmentFilterBtn>Refresh</button></td>";
										html += "<td><button id=ClearSelectionEducAttainmentFilterBtn>Clear</button></td>";
									html += "</tr>";
									html += "</table>";
									var container = $("<div></div>");
									container.append(html);
									statusbar.append(container);
									$('#RefreshSelectionEducAttainmentFilterBtn').jqxButton().on('click',function(){
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
										$('#EducAttainmentGridAnalysisFilter').jqxGrid({ source: Adapter});
									});
									$('#ClearSelectionEducAttainmentFilterBtn').jqxButton().on('click',function(){
										$('#EducAttainmentGridAnalysisFilter').jqxGrid('clearselection');
									});
								}
							});
							
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
							$('#RegionGridAnalysisFilter').jqxListBox({ source: Adapter});
							$('#RegionGridAnalysisFilter').jqxListBox({ 
								checkboxes: true,
								displayMember: "region", 
								valueMember: "id" ,
								width:'100%', 
								height: 250 
							});
							$('#BtnSelectAllRegionGridAnalysisFilter').jqxButton().on('click',function(){
								$('#RegionGridAnalysisFilter').jqxListBox('checkAll');
							});
							$('#BtnClearRegionGridAnalysisFilter').jqxButton().on('click',function(){
								$('#RegionGridAnalysisFilter').jqxListBox('uncheckAll');
								$('#ProvinceGridAnalysisFilter').jqxListBox('clear');
							});
							$('#BtnLoadProvinceByRegionGridAnalysisFilter').jqxButton().on('click',function(){
								var checkedItems = $('#RegionGridAnalysisFilter').jqxListBox('getCheckedItems');
								//console.log(checkedItems[0].value);
								var filtervalue = new Array();
								for (var i = 0; i < checkedItems.length; i++) {
									filtervalue[i] = checkedItems[i].value;
								};
								var test = filtervalue.join(',');
								console.log(test);
								var source =
								{
									datatype: "json",
									datafields: [
										{ name: 'id' },
										{ name: 'province' }
									],
									id: '',
									url: 'source/retention/load_province_level_list.php?id='+test
								};
								var Adapter = new $.jqx.dataAdapter(source);
								$('#ProvinceGridAnalysisFilter').jqxListBox({ source: Adapter});
							});
							$('#ProvinceGridAnalysisFilter').jqxListBox({ 
								checkboxes: true,
								displayMember: "province", 
								valueMember: "id" ,
								width:'100%', 
								height: 250 
							});
							$('#BtnSelectAllProvinceGridAnalysisFilter').jqxButton().on('click',function(){
								$('#ProvinceGridAnalysisFilter').jqxListBox('checkAll');
							});
							$('#BtnClearProvinceGridAnalysisFilter').jqxButton().on('click',function(){
								$('#ProvinceGridAnalysisFilter').jqxListBox('uncheckAll');
								$('#CityGridAnalysisFilter').jqxListBox('clear');
							});
							$('#BtnLoadCityByProvinceGridAnalysisFilter').jqxButton().on('click',function(){
								var checkedItems = $('#ProvinceGridAnalysisFilter').jqxListBox('getCheckedItems');
								//console.log(checkedItems[0].value);
								var filtervalue = new Array();
								for (var i = 0; i < checkedItems.length; i++) {
									filtervalue[i] = checkedItems[i].value;
								};
								var test = filtervalue.join(',');
								console.log(test);
								var source =
								{
									datatype: "json",
									datafields: [
										{ name: 'id' },
										{ name: 'city' }
									],
									id: '',
									url: 'source/retention/load_city_level_list.php?id='+test
								};
								var Adapter = new $.jqx.dataAdapter(source);
								$('#CityGridAnalysisFilter').jqxListBox({ source: Adapter});
							});
							$('#CityGridAnalysisFilter').jqxListBox({ 
								checkboxes: true,
								displayMember: "city", 
								valueMember: "id" ,
								width:'100%', 
								height: 250 
							});
							$('#BtnSelectAllCityGridAnalysisFilter').jqxButton().on('click',function(){
								$('#CityGridAnalysisFilter').jqxListBox('checkAll');
							});
							$('#BtnClearCityGridAnalysisFilter').jqxButton().on('click',function(){
								$('#CityGridAnalysisFilter').jqxListBox('uncheckAll');
								$('#BrgyGridAnalysisFilter').jqxListBox('clear');
							});
							$('#BtnLoadBrgyByCityGridAnalysisFilter').jqxButton().on('click',function(){
								var checkedItems = $('#CityGridAnalysisFilter').jqxListBox('getCheckedItems');
								//console.log(checkedItems[0].value);
								var filtervalue = new Array();
								for (var i = 0; i < checkedItems.length; i++) {
									filtervalue[i] = checkedItems[i].value;
								};
								var test = filtervalue.join(',');
								console.log(test);
								var source =
								{
									datatype: "json",
									datafields: [
										{ name: 'id' },
										{ name: 'brgy' }
									],
									id: '',
									url: 'source/retention/load_brgy_level_list.php?id='+test
								};
								var Adapter = new $.jqx.dataAdapter(source);
								$('#BrgyGridAnalysisFilter').jqxListBox({ source: Adapter});
							});
							$('#BrgyGridAnalysisFilter').jqxListBox({ 
								checkboxes: true,
								displayMember: "brgy", 
								valueMember: "id" ,
								width:'100%', 
								height: 250 
							});
							$('#BtnSelectAllBrgyGridAnalysisFilter').jqxButton().on('click',function(){
								$('#BrgyGridAnalysisFilter').jqxListBox('checkAll');
							});
							$('#BtnClearBrgyGridAnalysisFilter').jqxButton().on('click',function(){
								$('#BrgyGridAnalysisFilter').jqxListBox('uncheckAll');
							});
							$('#SubmitConsolidatedFilteredListBtn').jqxButton().on('click',function(){
								//Sex Values
								var sex = $('input.SexAnalysisFilter:checked').map(function () {
										  return this.value;
										}).get();
								var sex_csv = sex.join(',');
								//Religion Values
								var religion = $('#ReligionGridAnalysisFilter').jqxGrid('selectedrowindexes');
								var tempreligion = new Array();
								for (var i = 0; i < religion.length; i++) {
									var currentId = $('#ReligionGridAnalysisFilter').jqxGrid('getrowdata', religion[i]);
									console.log(currentId);
									tempreligion[i] = currentId.id;
								};
								var religion_csv = tempreligion.join(',');
								//Marital Status Values
								var marital = $('input.MaritalAnalysisFilter:checked').map(function () {
										  return this.value;
										}).get();
								var marital_csv = marital.join(',');
								//Educ Level Status
								var educ_level = $('#EducAttainmentGridAnalysisFilter').jqxGrid('selectedrowindexes');
								var tempeduc_level = new Array();
								for (var i = 0; i < educ_level.length; i++) {
									var currentId = $('#EducAttainmentGridAnalysisFilter').jqxGrid('getrowdata', educ_level[i]);
									console.log(currentId);
									tempeduc_level[i] = currentId.id;
								};
								var educ_level_csv = tempeduc_level.join(',');
								//Region Values
								var RegioncheckedItems = $('#RegionGridAnalysisFilter').jqxListBox('getCheckedItems');
								var Regionfiltervalue = new Array();
								for (var i = 0; i < RegioncheckedItems.length; i++) {
									Regionfiltervalue[i] = RegioncheckedItems[i].value;
								};
								var Regiontest = Regionfiltervalue.join(',');
								//Province Values
								var ProvincecheckedItems = $('#ProvinceGridAnalysisFilter').jqxListBox('getCheckedItems');
								var Provincefiltervalue = new Array();
								for (var i = 0; i < ProvincecheckedItems.length; i++) {
									Provincefiltervalue[i] = ProvincecheckedItems[i].value;
								};
								var Provincetest = Provincefiltervalue.join(',');
								//City Values
								var CitycheckedItems = $('#CityGridAnalysisFilter').jqxListBox('getCheckedItems');
								var Cityfiltervalue = new Array();
								for (var i = 0; i < CitycheckedItems.length; i++) {
									Cityfiltervalue[i] = CitycheckedItems[i].value;
								};
								var Citytest = Cityfiltervalue.join(',');
								//Brgy Values
								var BrgycheckedItems = $('#BrgyGridAnalysisFilter').jqxListBox('getCheckedItems');
								var Brgyfiltervalue = new Array();
								for (var i = 0; i < BrgycheckedItems.length; i++) {
									Brgyfiltervalue[i] = BrgycheckedItems[i].value;
								};
								var Brgytest = Brgyfiltervalue.join(',');
								
								$.ajax({
									url:'source/retention/save_consolidation_template.php',
									type:'POST',
									data:{
										start:$('#TemplateStartDateInp').val(),
										end:$('#TemplateEndDateInp').val(),
										template_desc:$('#TemplateDescInp').val(),
										age:$('#AgeIDMin').val()+","+$('#AgeIDMax').val(),
										sex:sex_csv,
										religion:religion_csv,
										marital_status:marital_csv,
										educ_level:educ_level_csv,
										region:Regiontest,
										province:Provincetest,
										city:Citytest,
										brgy:Brgytest
									},
									success:function(){
										
									},
									complete:function(){
										$('#ConsolidateTemplateGridWin').jqxWindow('close');
										var source =
										{
											datatype: "json",
											datafields: [
												{ name: 'id' },
												{ name: 'template_description' },
												{ name: 'status'},
												{ name: 'date_start' },
												{ name: 'date_end' }
											],
											id: '',
											url: 'source/retention/load_consolidate_template.php'
										};
										var Adapter = new $.jqx.dataAdapter(source);
										$('#ConsolidateTemplateGrid').jqxGrid({ source: Adapter});
									},
									error:function(e){
										console.log(e);
									}
								});
							});
						}
					});
				},
				showstatusbar:true,
				statusbarheight:260,
				renderstatusbar:function(statusbar){
					var html = "<table style='width:100%;'>";
					html += "<tr>";
						html += "<td style='width:70px;'>Date Start</td>";
						html += "<td><input id=ConsolidateDateStart readonly=readonly; style='margin:5px;'></td>";
					html += "</tr>";
					html += "<tr>";
						html += "<td style='width:70px;'>Date End</td>";
						html += "<td ><input id=ConsolidateDateEnd readonly=readonly; style='margin:5px;'></td>";
					html += "</tr>";
					html += "<tr>";
						html += "<td colspan=2 style='border-bottom:1px solid #888888;'></td>";
					html += "</tr>";
					html += "<tr>";
						html += "<td colspan=2><p>Note:Surveys answered between start and end date will be selected for word frequency,survey ratings & perception analysis</p></td>";
						html += "<td></td>";
					html += "</tr>";
					html += "<tr>";
						html += "<td colspan=2 style='border-bottom:1px solid #888888;'></td>";
					html += "</tr>";
					html += "<tr>";
						html += "<td style='width:70px;'></td>";
						html += "<td ><button id=ProcessConsolidateTemplateBtn style='margin:5px;'>Consolidate Response</button></td>";
					html += "</tr>";
					html += "</table>";
					var container = $("<div style=margin:8px;></div>");
					container.append(html);
					statusbar.append(container);
					$('#ConsolidateDateStart').jqxInput({ width: '100%',height:'20px'});
					$('#ConsolidateDateEnd').jqxInput({ width: '100%',height:'20px'});
					$('#ProcessConsolidateTemplateBtn').jqxButton().on('click',function(){
						var d = $('#ConsolidateTemplateGrid').jqxGrid('getrowdata',$('#ConsolidateTemplateGrid').jqxGrid('getselectedrowindex'));
						$('#ProcessConsolidateTemplateBtn').jqxButton({disabled:true});
						$.ajax({
							url:'source/cronjob/consolidate_user_responses.php',
							type:'POST',
							data:{
								id:d.id,
								date_start:$('#ConsolidateDateStart').val(),
								date_end:$('#ConsolidateDateEnd').val()
							},
							beforeSend:function(){
								$('#ConsolidatedEmployeeResponsesGridNotice').html("<b><img src='img/progress_bar/bar-large-green.gif'> : Consolidating</b>");
							},
							success:function(){
								
							},
							complete:function(){
								$.ajax({
									url:'source/cronjob/phpinsight/examples/demo.php',
									type:'POST',
									data:{
										id:d.id
									},
									beforeSend:function(){
										$('#ConsolidatedEmployeeResponsesGridNotice').html("<b><img src='img/progress_bar/bar-large-green.gif'> : Calculating Sentiments</b>");
									},
									success:function(){
										
									},
									complete:function(){
										$.ajax({
											url:'source/cronjob/consolidate_ratings_overall_response.php',
											type:'POST',
											data:{
												id:d.id
											},
											beforeSend:function(){
												$('#ConsolidatedEmployeeResponsesGridNotice').html("<b><img src='img/progress_bar/bar-large-green.gif'> : Generating Ratings</b>");
											},
											success:function(){
												
											},
											complete:function(){
												$.ajax({
													url:'source/cronjob/Frequency-Analysis-master/Frequency-Analysis-master/frequency-analysis.php',
													type:'POST',
													data:{
														id:d.id
													},
													beforeSend:function(){
														$('#ConsolidatedEmployeeResponsesGridNotice').html("<b><img src='img/progress_bar/bar-large-green.gif'> : Generating Word Frequency</b>");
													},
													success:function(){
														
													},
													complete:function(){
														$.ajax({
															url:'source/cronjob/brill_tagger_lexicon/brill_pos_tagger.php',
															type:'POST',
															data:{
																id:d.id
															},
															beforeSend:function(){
																$('#ConsolidatedEmployeeResponsesGridNotice').html("<b><img src='img/progress_bar/bar-large-green.gif'> : Applying Part Of Speech Tags</b>");
															},
															success:function(){
																
															},
															complete:function(){
																$.ajax({
																	url:'source/cronjob/phpinsight/examples/update_word_frequency_list_sentiments.php',
																	type:'POST',
																	data:{
																		id:d.id
																	},
																	beforeSend:function(){
																		$('#ConsolidatedEmployeeResponsesGridNotice').html("<b><img src='img/progress_bar/bar-large-green.gif'> : Applying Sentiments</b>");
																	},
																	success:function(){
																		
																	},
																	complete:function(){
																		$.ajax({
																			url:'source/cronjob/generate_meaningful_phrase.php',
																			type:'POST',
																			data:{
																				id:d.id
																			},
																			beforeSend:function(){
																				$('#ConsolidatedEmployeeResponsesGridNotice').html("<b><img src='img/progress_bar/bar-large-green.gif'> : Generate Meaningful Phrase</b>");
																			},
																			success:function(){
																				
																			},
																			complete:function(){
																				$.ajax({
																					url:'source/cronjob/phpinsight/examples/update_extracted_words.php',
																					type:'POST',
																					data:{
																						id:d.id
																					},
																					beforeSend:function(){
																						$('#ConsolidatedEmployeeResponsesGridNotice').html("<b><img src='img/progress_bar/bar-large-green.gif'> : Applying Sentiments to Meaningful Phrase</b>");
																					},
																					success:function(){
																						
																					},
																					complete:function(){
																						var source =
																						{
																							datatype: "json",
																							datafields: [
																								{ name: 'id' },
																								{ name: 'template_description' },
																								{ name: 'status'},
																								{ name: 'date_start' },
																								{ name: 'date_end' }
																							],
																							id: '',
																							url: 'source/retention/load_consolidate_template.php'
																						};
																						var Adapter = new $.jqx.dataAdapter(source);
																						$('#ConsolidateTemplateGrid').jqxGrid({ source: Adapter});
																						$('#ProcessConsolidateTemplateBtn').jqxButton({disabled:false});
																						var sourceTemplateConsolidateResponseFetch =
																						{
																							datatype: "json",
																							datafields: [
																								{ name: 'id' },
																								{ name: 'dimension' },
																								{ name: 'question' },
																								{ name: 'response' }
																							],
																							id: '',
																							url: 'source/retention/load_user_overall_response.php?id='+d.id
																						};
																						var AdaptersourceTemplateConsolidateResponseFetchFetch = new $.jqx.dataAdapter(sourceTemplateConsolidateResponseFetch);
																						$('#ConsolidatedEmployeeResponsesGrid').jqxGrid({source:AdaptersourceTemplateConsolidateResponseFetchFetch,groups:['dimension']});
																						$('#ConsolidatedEmployeeResponsesGridNotice').html("");	
																					}
																				});	
																			}
																		});	
																	}
																});	
															}
														});
													}
												});
											}
										});
									}
								});
								
							}
						});
						
					});
				},
				columns:[
					{text:'ID',dataField:'id',hidden:true},
					{text:'Template',dataField:'template_description'},
					{text:'Status',dataField:'status',width:50}
				]
			}).on('rowclick',function(e){
				$('#ConsolidateUserResponseUserGetByTemplateGrid').jqxGrid('clear');
				$('#MainGridUserResponseByTemplate').jqxGrid('clear');
				var d = $(this).jqxGrid('getrowdata',e.args.rowindex);
				//$('#ConsolidateTemplateGridWin').jqxWindow('open');
				$('#ConsolidateDateStart').val(d.date_start);
				$('#ConsolidateDateEnd').val(d.date_end);
				$.ajax({
					url:'source/retention/get_template_age_details.php',
					type:'POST',
					data:{
						id:d.id
					},
					beforeSend:function(){
						$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
						$('#TemplateAgeView').css({'background-color':'#c2c2c2'});
					},
					success:function(e){
						$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
						$('#TemplateAgeView').html(e).css({'background-color':'#FFFFFF'});
					},
					complete:function(){
						$.ajax({
							url:'source/retention/get_template_sex_details.php',
							type:'POST',
							data:{
								id:d.id
							},
							beforeSend:function(){
								$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
								$('#TemplateSexView').css({'background-color':'#c2c2c2'});
							},
							success:function(e){
								$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
								$('#TemplateSexView').html(e).css({'background-color':'#FFFFFF'});
							},
							complete:function(){
								$.ajax({
									url:'source/retention/get_template_religion_details.php',
									type:'POST',
									data:{
										id:d.id
									},
									beforeSend:function(){
										$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
										$('#TemplateReligionView').css({'background-color':'#c2c2c2'});
									},
									success:function(e){
										$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
										$('#TemplateReligionView').html(e).css({'background-color':'#FFFFFF'});
									},
									complete:function(){
										$.ajax({
											url:'source/retention/get_template_marital_status_details.php',
											type:'POST',
											data:{
												id:d.id
											},
											beforeSend:function(){
												$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
												$('#TemplateMaritalStatusView').css({'background-color':'#c2c2c2'});
											},
											success:function(e){
												$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
												$('#TemplateMaritalStatusView').html(e).css({'background-color':'#FFFFFF'});
											},
											complete:function(){
												$.ajax({
													url:'source/retention/get_template_educ_attainment_details.php',
													type:'POST',
													data:{
														id:d.id
													},
													beforeSend:function(){
														$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
														$('#TemplateEducAttainmentView').css({'background-color':'#c2c2c2'});
													},
													success:function(e){
														$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
														$('#TemplateEducAttainmentView').html(e).css({'background-color':'#FFFFFF'});
													},
													complete:function(){
														$.ajax({
															url:'source/retention/get_template_region_details.php',
															type:'POST',
															data:{
																id:d.id
															},
															beforeSend:function(){
																$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
																$('#TemplateRegionView').css({'background-color':'#c2c2c2'});
															},
															success:function(e){
																$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
																$('#TemplateRegionView').html(e).css({'background-color':'#FFFFFF'});
															},
															complete:function(){
																$.ajax({
																	url:'source/retention/get_template_province_details.php',
																	type:'POST',
																	data:{
																		id:d.id
																	},
																	beforeSend:function(){
																		$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
																		$('#TemplateProvinceView').css({'background-color':'#c2c2c2'});
																	},
																	success:function(e){
																		$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
																		$('#TemplateProvinceView').html(e).css({'background-color':'#FFFFFF'});
																	},
																	complete:function(){
																		$.ajax({
																			url:'source/retention/get_template_city_details.php',
																			type:'POST',
																			data:{
																				id:d.id
																			},
																			beforeSend:function(){
																				$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
																				$('#TemplateCityView').css({'background-color':'#c2c2c2'});
																			},
																			success:function(e){
																				$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
																				$('#TemplateCityView').html(e).css({'background-color':'#FFFFFF'});
																			},
																			complete:function(){
																				$.ajax({
																					url:'source/retention/get_template_brgy_details.php',
																					type:'POST',
																					data:{
																						id:d.id
																					},
																					beforeSend:function(){
																						$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
																						$('#TemplateBrgyView').css({'background-color':'#c2c2c2'});
																					},
																					success:function(e){
																						$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
																						$('#TemplateBrgyView').html(e).css({'background-color':'#FFFFFF'});
																					},
																					complete:function(){
																						var sourceTemplateUserFetch =
																						{
																							datatype: "json",
																							datafields: [
																								{ name: 'id' },
																								{ name: 'user_id' }
																							],
																							id: '',
																							url: 'source/retention/get_template_user_fetch.php?id='+d.id+'&start='+d.date_start+'&end='+d.date_end
																						};
																						var AdapterTemplateUserFetch = new $.jqx.dataAdapter(sourceTemplateUserFetch);
																						$('#ConsolidateUserResponseUserGetByTemplateGrid').jqxGrid({source:AdapterTemplateUserFetch});
																						
																						var sourceTemplateConsolidateResponseFetch =
																						{
																							datatype: "json",
																							datafields: [
																								{ name: 'id' },
																								{ name: 'dimension' },
																								{ name: 'question' },
																								{ name: 'response' }
																							],
																							id: '',
																							url: 'source/retention/load_user_overall_response.php?id='+d.id
																						};
																						var AdaptersourceTemplateConsolidateResponseFetchFetch = new $.jqx.dataAdapter(sourceTemplateConsolidateResponseFetch);
																						$('#ConsolidatedEmployeeResponsesGrid').jqxGrid({source:AdaptersourceTemplateConsolidateResponseFetchFetch,groups:['dimension']});
																					}
																				});
																			}
																		});
																	}
																});
															}
														});
													}
												});
											}
										});
									}
								});
							}
						});
					}
				});
				
			}).css({'border':'0px'});
			$('#ConsolidateUserResponseUserGetByTemplateGrid').jqxGrid({
				width:'100%',
				height:'100%',
				filterable:true,
				showfilterrow:true,
				showtoolbar:true,
				columnsresize: true,
				showtoolbar:true,
				pageable:true,
				pagermode:'simple',
				rendertoolbar:function(toolbar){
					var container = $("<div style='margin:5px;'><b>Profile Filtered by Template</b></div>");
					toolbar.append(container);
				},
				columns:[
					{text:'ID',dataField:'id',hidden:true},
					{text:'Employee ID',dataField:'user_id'}
				]
			}).on('rowclick',function(e){
				var d = $(this).jqxGrid('getrowdata',e.args.rowindex);
				var source =
				{
					datatype: "json",
					datafields: [
						{ name: 'id' },
						{ name: 'dimension' },
						{ name: 'question' },
						{ name: 'response' },
						{ name: 'rating' }
					],
					id: '',
					url: 'source/retention/load_user_response_by_user.php?user_id='+d.user_id
				};
				var Adapter = new $.jqx.dataAdapter(source);
				$('#MainGridUserResponseByTemplate').jqxGrid({ source: Adapter,groups:['dimension']});
			}).css({'border':'0px'});
			$('#ConsolidatedEmployeeResponsesGrid').jqxGrid({
				width:'100%',
				height:'100%',
				filterable:true,
				showfilterrow:true,
				showtoolbar:true,
				columnsresize: true,
				showtoolbar:true,
				groupable:true,
				showgroupsheader:false,
				groupsexpandedbydefault:true,
				rendertoolbar:function(toolbar){
					var container = $("<div style='margin:5px;'><table><tr><td><b>Consolidated Response</b></td><td><div id=ConsolidatedEmployeeResponsesGridNotice></div></td></tr></table></div>");
					toolbar.append(container);
				},
				columns:[
					{text:'ID',dataField:'id',hidden:true},
					{text:'Dimension',dataField:'dimension',width:'250px',pinned:true},
					{text:'Question',dataField:'question',width:'1000px'},
					{text:'Response',dataField:'response',width:'3000px'}
				],
				groups:['dimension']
			}).css({'border':'0px'});
			//Word Frequency
			$('#WordFreqPerceptionSplitter').jqxSplitter({
				width:'100%',
				height:'100%',
				panels:[
					{size:'250px'},
					{}
				]
			}).css({'border':'0px'});
			$('#WordFreqPerceptionSplitterLeft').jqxSplitter({
				width:'100%',
				height:'100%',
				panels:[
					{size:'30%'},
					{size:'70%'}
				],
				orientation:'horizontal'
			}).css({'border':'0px'});
			$('#WordFreqPerceptionTemplateGrid').jqxGrid({
				width:'100%',
				height:'100%',
				source:AdapterTemplate,
				filterable:true,
				showfilterrow:true,
				showtoolbar:true,
				columnsresize: true,
				showtoolbar:true,
				rendertoolbar:function(toolbar){
					
					var html = "<button id=RefreshWordFreqPerceptionTemplateBtn style='margin:5px;'>Refresh</button>";
					var container = $("<div></div>");
					container.append(html);
					toolbar.append(container);

					$('#RefreshWordFreqPerceptionTemplateBtn').jqxButton().on('click',function(){
						var source =
						{
							datatype: "json",
							datafields: [
								{ name: 'id' },
								{ name: 'template_description' },
								{ name: 'status'},
								{ name: 'date_start' },
								{ name: 'date_end' }
							],
							id: '',
							url: 'source/retention/load_consolidate_template.php'
						};
						var Adapter = new $.jqx.dataAdapter(source);
						$('#WordFreqPerceptionTemplateGrid').jqxGrid({ source: Adapter});
					});
					
					
				},
				columns:[
					{text:'ID',dataField:'id',hidden:true},
					{text:'Template',dataField:'template_description'},
					{text:'Status',dataField:'status',width:50}
				]
			}).on('rowclick',function(e){
				//$('#ConsolidateUserResponseUserGetByTemplateGrid').jqxGrid('clear');
				//$('#MainGridUserResponseByTemplate').jqxGrid('clear');
				var d = $(this).jqxGrid('getrowdata',e.args.rowindex);
				//$('#ConsolidateTemplateGridWin').jqxWindow('open');
				$.ajax({
					url:'source/retention/get_template_age_details.php',
					type:'POST',
					data:{
						id:d.id
					},
					beforeSend:function(){
						//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
						$('#WordFreqPerceptionTemplateAgeView').css({'background-color':'#c2c2c2'});
					},
					success:function(e){
						//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
						$('#WordFreqPerceptionTemplateAgeView').html(e).css({'background-color':'#FFFFFF'});
					},
					complete:function(){
						$.ajax({
							url:'source/retention/get_template_sex_details.php',
							type:'POST',
							data:{
								id:d.id
							},
							beforeSend:function(){
								//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
								$('#WordFreqPerceptionTemplateSexView').css({'background-color':'#c2c2c2'});
							},
							success:function(e){
								//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
								$('#WordFreqPerceptionTemplateSexView').html(e).css({'background-color':'#FFFFFF'});
							},
							complete:function(){
								$.ajax({
									url:'source/retention/get_template_religion_details.php',
									type:'POST',
									data:{
										id:d.id
									},
									beforeSend:function(){
										//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
										$('#WordFreqPerceptionTemplateReligionView').css({'background-color':'#c2c2c2'});
									},
									success:function(e){
										//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
										$('#WordFreqPerceptionTemplateReligionView').html(e).css({'background-color':'#FFFFFF'});
									},
									complete:function(){
										$.ajax({
											url:'source/retention/get_template_marital_status_details.php',
											type:'POST',
											data:{
												id:d.id
											},
											beforeSend:function(){
												//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
												$('#WordFreqPerceptionTemplateMaritalStatusView').css({'background-color':'#c2c2c2'});
											},
											success:function(e){
												//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
												$('#WordFreqPerceptionTemplateMaritalStatusView').html(e).css({'background-color':'#FFFFFF'});
											},
											complete:function(){
												$.ajax({
													url:'source/retention/get_template_educ_attainment_details.php',
													type:'POST',
													data:{
														id:d.id
													},
													beforeSend:function(){
														//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
														$('#WordFreqPerceptionTemplateEducAttainmentView').css({'background-color':'#c2c2c2'});
													},
													success:function(e){
														//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
														$('#WordFreqPerceptionTemplateEducAttainmentView').html(e).css({'background-color':'#FFFFFF'});
													},
													complete:function(){
														$.ajax({
															url:'source/retention/get_template_region_details.php',
															type:'POST',
															data:{
																id:d.id
															},
															beforeSend:function(){
																//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
																$('#WordFreqPerceptionTemplateRegionView').css({'background-color':'#c2c2c2'});
															},
															success:function(e){
																//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
																$('#WordFreqPerceptionTemplateRegionView').html(e).css({'background-color':'#FFFFFF'});
															},
															complete:function(){
																$.ajax({
																	url:'source/retention/get_template_province_details.php',
																	type:'POST',
																	data:{
																		id:d.id
																	},
																	beforeSend:function(){
																		//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
																		$('#WordFreqPerceptionTemplateProvinceView').css({'background-color':'#c2c2c2'});
																	},
																	success:function(e){
																		//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
																		$('#WordFreqPerceptionTemplateProvinceView').html(e).css({'background-color':'#FFFFFF'});
																	},
																	complete:function(){
																		$.ajax({
																			url:'source/retention/get_template_city_details.php',
																			type:'POST',
																			data:{
																				id:d.id
																			},
																			beforeSend:function(){
																				//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
																				$('#WordFreqPerceptionTemplateCityView').css({'background-color':'#c2c2c2'});
																			},
																			success:function(e){
																				//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
																				$('#WordFreqPerceptionTemplateCityView').html(e).css({'background-color':'#FFFFFF'});
																			},
																			complete:function(){
																				$.ajax({
																					url:'source/retention/get_template_brgy_details.php',
																					type:'POST',
																					data:{
																						id:d.id
																					},
																					beforeSend:function(){
																						//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
																						$('#WordFreqPerceptionTemplateBrgyView').css({'background-color':'#c2c2c2'});
																					},
																					success:function(e){
																						//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
																						$('#WordFreqPerceptionTemplateBrgyView').html(e).css({'background-color':'#FFFFFF'});
																					},
																					complete:function(){
																						

																						var sourceTemplateConsolidateResponseFetch =
																						{
																							datatype: "json",
																							datafields: [
																								{ name: 'id' },
																								{ name: 'dimension' },
																								{ name: 'question' },
																								{ name: 'response' }
																							],
																							id: '',
																							url: 'source/retention/load_user_overall_response.php?id='+d.id
																						};
																						var AdaptersourceTemplateConsolidateResponseFetchFetch = new $.jqx.dataAdapter(sourceTemplateConsolidateResponseFetch);
																						$('#WordFreqConsolidatedEmployeeResponsesGrid').jqxGrid({source:AdaptersourceTemplateConsolidateResponseFetchFetch,groups:['dimension']});
																						
																					}
																				});
																			}
																		});
																	}
																});
															}
														});
													}
												});
											}
										});
									}
								});
							}
						});
					}
				});
				
			}).css({'border':'0px'});
			$('#WordFreqPerceptionSplitterRight').jqxSplitter({
				width:'100%',
				height:'100%',
				panels:[
					{size:'50%'},
					{size:'50%'}
				],
				orientation:'horizontal'
			}).css({'border':'0px'});
			// $('#WordFreqPerceptionSplitterRightBtm').jqxSplitter({
				// width:'100%',
				// height:'100%',
				// panels:[
					// {size:'50%'},
					// {size:'50%'}
				// ],
				// orientation:'vertical'
			// }).css({'border':'0px'});
			$('#WordFreqConsolidatedEmployeeResponsesGrid').jqxGrid({
				width:'100%',
				height:'100%',
				filterable:true,
				showfilterrow:true,
				showtoolbar:true,
				columnsresize: true,
				showtoolbar:true,
				groupable:true,
				showgroupsheader:false,
				groupsexpandedbydefault:true,
				rendertoolbar:function(toolbar){
					var container = $("<div style='margin:5px;'><b>Consolidated Response</b></div>");
					toolbar.append(container);
				},
				columns:[
					{text:'ID',dataField:'id',hidden:true},
					{text:'Dimension',dataField:'dimension',width:'250px',pinned:true},
					{text:'Question',dataField:'question',width:'1000px'},
					{text:'Response',dataField:'response',width:'3000px'}
				],
				groups:['dimension']
			}).on('rowclick',function(e){
				var d = $(this).jqxGrid('getrowdata',e.args.rowindex);
				$('#WOrdFreqWordListGrid').jqxGrid('clear');
				var sourceA =
				{
					datatype: "json",
					datafields: [
						{ name: 'id' },
						{ name: 'num_words' },
						{ name: 'rank' },
						{ name: 'words' },
						{ name: 'frequency' },
						{ name: 'pos_tag' },
						{ name: 'status' }
					],
					id: '',
					url: 'source/retention/load_frequency_word_list_by_dimension.php?id='+d.id
				};
				var AdapterA = new $.jqx.dataAdapter(sourceA);
				$('#WOrdFreqWordListGrid').jqxGrid({ source: AdapterA,groups:['num_words']});
				
				//$('#WOrdFreqMeaningfulPhraseGrid').jqxGrid('clear');
				// var sourceB =
				// {
					// datatype: "json",
					// datafields: [
						// { name: 'id' },
						// { name: 'phrase' },
						// { name: 'phrase_rank' },
						// { name: 'positive' },
						// { name: 'neutral' },
						// { name: 'negative' },
						// { name: 'sentiment_likelihood'}
					// ],
					// id: '',
					// url: 'source/retention/load_meaningful_phrase.php?id='+d.id
				// };
				// var AdapterB = new $.jqx.dataAdapter(sourceB);
				// $('#WOrdFreqMeaningfulPhraseGrid').jqxGrid({ source: AdapterB});
			}).css({'border':'0px'});
			$('#WOrdFreqWordListGrid').jqxGrid({
				width:'100%',
				height:'100%',
				filterable:true,
				showfilterrow:true,
				columnsresize: true,
				showtoolbar:true,
				groupable:true,
				showgroupsheader:false,
				groupsexpandedbydefault:false,
				columns:[
					{text:'ID',dataField:'id',hidden:true},
					{text:'# of Words',dataField:'num_words',width:'60px',hidden:true},
					{text:'Rank',dataField:'rank',width:'70px',pinned:true},
					{text:'Status',dataField:'status',width:'100px'},
					{text:'Words',dataField:'words',width:'300px'},
					{text:'Frequency',dataField:'frequency'}
					//{text:'Part of Speech Tag',dataField:'pos_tag',width:'300px'}
				],
				groups:['num_words']
			}).css({'border':'0px'});
			// $('#WOrdFreqMeaningfulPhraseGrid').jqxGrid({
				// width:'100%',
				// height:'100%',
				// filterable:true,
				// showfilterrow:true,
				// columnsresize: true,
				// columns:[
					// {text:'ID',dataField:'id',hidden:true},
					// {text:'Phrase Generated',dataField:'phrase'},
					// {text:'Phrase Rank',dataField:'phrase_rank',width:'100px'}
					// {text:'Positive %',dataField:'positive',width:'100px'},
					// {text:'Neutral %',dataField:'neutral',width:'100px'},
					// {text:'Negative %',dataField:'negative',width:'100px'},
					// {text:'Sentiment Likelihood',dataField:'sentiment_likelihood',width:'100px'}
				// ]
			// }).css({'border':'0px'});
			//Sentiment
			// var sourceSenti =
			// {
				// datatype: "json",
				// datafields: [
					// { name: 'id' },
					// { name: 'dimension' },
					// { name: 'question' },
					// { name: 'response' },
					// { name: 'positive' },
					// { name: 'neutral'},
					// { name: 'negative' },
					// { name: 'strongly_disagree_rating',type:'float' },
					// { name: 'neutral_rating',type:'float' },
					// { name: 'somewhat_agree_rating',type:'float' },
					// { name: 'strongly_agree_rating',type:'float' },
					// { name: 'na_rating',type:'float' },
					// { name: 'question' },
					// { name: 'template'}
				// ],
				// id: '',
				// url: 'source/retention/load_all_user_overall_response.php'
			// };
			// var AdapterSenti = new $.jqx.dataAdapter(sourceSenti);
			// $('#SentimentRatingsEmployeeResponsesGrid').jqxGrid({
				// width:'100%',
				// height:'100%',
				// source:sourceSenti,
				// filterable:true,
				// showfilterrow:true,
				// showtoolbar:true,
				// columnsresize: true,
				// showtoolbar:true,
				// groupable:true,
				// groupsexpandedbydefault: true,
				// showgroupsheader:false,
				// rendertoolbar:function(toolbar){
					// var html = "<button id=RefreshSentimentRatingsEmployeeResponsesBtn style='margin:5px;'>Refresh</button>";
					// var container = $("<div></div>");
					// container.append(html);
					// toolbar.append(container);
					// $('#RefreshSentimentRatingsEmployeeResponsesBtn').jqxButton().on('click',function(){
						// var source =
						// {
							// datatype: "json",
							// datafields: [
								// { name: 'id' },
								// { name: 'dimension' },
								// { name: 'question' },
								// { name: 'response' },
								// { name: 'positive' },
								// { name: 'neutral'},
								// { name: 'negative' },
								// { name: 'strongly_disagree_rating',type:'float' },
								// { name: 'neutral_rating',type:'float' },
								// { name: 'somewhat_agree_rating',type:'float' },
								// { name: 'strongly_agree_rating',type:'float' },
								// { name: 'na_rating',type:'float' },
								// { name: 'question' },
								// { name: 'template'}
							// ],
							// id: '',
							// url: 'source/retention/load_all_user_overall_response.php'
						// };
						// var Adapter = new $.jqx.dataAdapter(source);
						// $('#SentimentRatingsEmployeeResponsesGrid').jqxGrid({source:Adapter,groups: ['template','dimension']});
					// });
				// },
				// columns:[
					// {text:'ID',dataField:'id',hidden:true},
					// {text:'Template',dataField:'template',hidden:true},
					// {text:'Dimension',dataField:'dimension',width:'250px',pinned:true},
					// {text:'Strongly Disagree',dataField:'strongly_disagree_rating',columngroup: 'ratings',width:'140px',cellsalign: 'right',cellclassname: function (row, column, value, data) { if (value < '25.00' && value > '0') { return "perception1"; }else if(value > '25.00' && value < '50.00'){ return "perception2"; }else if(value > '50.00' && value < '75.00'){ return "perception3"; }else if(value > '75.00' && value <= '100.00'){ return "perception4"; }}},
					// {text:'Neutral',dataField:'neutral_rating',columngroup: 'ratings',width:'80px',cellsalign: 'right',cellclassname: function (row, column, value, data) { if (value < '25.00' && value > '0') { return "perception1"; }else if(value > '25.00' && value < '50.00'){ return "perception2"; }else if(value > '50.00' && value < '75.00'){ return "perception3"; }else if(value > '75.00' && value <= '100.00'){ return "perception4"; }}},
					// {text:'Somewhat Agree',dataField:'somewhat_agree_rating',columngroup: 'ratings',width:'130px',cellsalign: 'right',cellclassname: function (row, column, value, data) { if (value < '25.00' && value > '0') { return "perception1"; }else if(value > '25.00' && value < '50.00'){ return "perception2"; }else if(value > '50.00' && value < '75.00'){ return "perception3"; }else if(value > '75.00' && value <= '100.00'){ return "perception4"; }}},
					// {text:'Strongly Agree',dataField:'strongly_agree_rating',columngroup: 'ratings',width:'130px',cellsalign: 'right',cellclassname: function (row, column, value, data) { if (value < '25.00' && value > '0') { return "perception1"; }else if(value > '25.00' && value < '50.00'){ return "perception2"; }else if(value > '50.00' && value < '75.00'){ return "perception3"; }else if(value > '75.00' && value <= '100.00'){ return "perception4"; }}},
					// {text:'N/A',dataField:'na_rating',columngroup: 'ratings',width:'60px',cellsalign: 'right',cellsalign: 'right',cellclassname: function (row, column, value, data) { if (value < '25.00' && value > '0') { return "perception1"; }else if(value > '25.00' && value < '50.00'){ return "perception2"; }else if(value > '50.00' && value < '75.00'){ return "perception3"; }else if(value > '75.00' && value <= '100.00'){ return "perception4"; }}},
					// {text:'Question',dataField:'question'}
				// ],
				// columngroups: [
					// { text: 'Ratings', align: 'center', name: 'ratings',pinned:true }
				// ],
				// groups: ['template','dimension']
			// }).css({'border':'0px'});
			
			$('#PerceptionSplitter').jqxSplitter({
				width:'100%',
				height:'100%',
				panels:[
					{size:'250px'},
					{}
				]
			}).css({'border':'0px'});
			$('#PerceptionSplitterLeft').jqxSplitter({
				width:'100%',
				height:'100%',
				panels:[
					{size:'30%'},
					{size:'70%'}
				],
				orientation:'horizontal'
			}).css({'border':'0px'});
			$('#PerceptionTemplateGrid').jqxGrid({
				width:'100%',
				height:'100%',
				source:AdapterTemplate,
				filterable:true,
				showfilterrow:true,
				showtoolbar:true,
				columnsresize: true,
				showtoolbar:true,
				rendertoolbar:function(toolbar){
					
					var html = "<button id=RefreshPerceptionTemplateBtn style='margin:5px;'>Refresh</button>";
					var container = $("<div></div>");
					container.append(html);
					toolbar.append(container);

					$('#RefreshPerceptionTemplateBtn').jqxButton().on('click',function(){
						var source =
						{
							datatype: "json",
							datafields: [
								{ name: 'id' },
								{ name: 'template_description' },
								{ name: 'status'},
								{ name: 'date_start' },
								{ name: 'date_end' }
							],
							id: '',
							url: 'source/retention/load_consolidate_template.php'
						};
						var Adapter = new $.jqx.dataAdapter(source);
						$('#PerceptionTemplateGrid').jqxGrid({ source: Adapter});
					});
					
					
				},
				columns:[
					{text:'ID',dataField:'id',hidden:true},
					{text:'Template',dataField:'template_description'},
					{text:'Status',dataField:'status',width:50}
				]
			}).on('rowclick',function(e){
				//$('#ConsolidateUserResponseUserGetByTemplateGrid').jqxGrid('clear');
				//$('#MainGridUserResponseByTemplate').jqxGrid('clear');
				var d = $(this).jqxGrid('getrowdata',e.args.rowindex);
				//$('#ConsolidateTemplateGridWin').jqxWindow('open');
				$.ajax({
					url:'source/retention/get_template_age_details.php',
					type:'POST',
					data:{
						id:d.id
					},
					beforeSend:function(){
						//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
						$('#PerceptionTemplateAgeView').css({'background-color':'#c2c2c2'});
					},
					success:function(e){
						//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
						$('#PerceptionTemplateAgeView').html(e).css({'background-color':'#FFFFFF'});
					},
					complete:function(){
						$.ajax({
							url:'source/retention/get_template_sex_details.php',
							type:'POST',
							data:{
								id:d.id
							},
							beforeSend:function(){
								//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
								$('#PerceptionTemplateSexView').css({'background-color':'#c2c2c2'});
							},
							success:function(e){
								//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
								$('#PerceptionTemplateSexView').html(e).css({'background-color':'#FFFFFF'});
							},
							complete:function(){
								$.ajax({
									url:'source/retention/get_template_religion_details.php',
									type:'POST',
									data:{
										id:d.id
									},
									beforeSend:function(){
										//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
										$('#PerceptionTemplateReligionView').css({'background-color':'#c2c2c2'});
									},
									success:function(e){
										//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
										$('#PerceptionTemplateReligionView').html(e).css({'background-color':'#FFFFFF'});
									},
									complete:function(){
										$.ajax({
											url:'source/retention/get_template_marital_status_details.php',
											type:'POST',
											data:{
												id:d.id
											},
											beforeSend:function(){
												//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
												$('#PerceptionTemplateMaritalStatusView').css({'background-color':'#c2c2c2'});
											},
											success:function(e){
												//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
												$('#PerceptionTemplateMaritalStatusView').html(e).css({'background-color':'#FFFFFF'});
											},
											complete:function(){
												$.ajax({
													url:'source/retention/get_template_educ_attainment_details.php',
													type:'POST',
													data:{
														id:d.id
													},
													beforeSend:function(){
														//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
														$('#PerceptionTemplateEducAttainmentView').css({'background-color':'#c2c2c2'});
													},
													success:function(e){
														//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
														$('#PerceptionTemplateEducAttainmentView').html(e).css({'background-color':'#FFFFFF'});
													},
													complete:function(){
														$.ajax({
															url:'source/retention/get_template_region_details.php',
															type:'POST',
															data:{
																id:d.id
															},
															beforeSend:function(){
																//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
																$('#PerceptionTemplateRegionView').css({'background-color':'#c2c2c2'});
															},
															success:function(e){
																//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
																$('#PerceptionTemplateRegionView').html(e).css({'background-color':'#FFFFFF'});
															},
															complete:function(){
																$.ajax({
																	url:'source/retention/get_template_province_details.php',
																	type:'POST',
																	data:{
																		id:d.id
																	},
																	beforeSend:function(){
																		//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
																		$('#PerceptionTemplateProvinceView').css({'background-color':'#c2c2c2'});
																	},
																	success:function(e){
																		//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
																		$('#PerceptionTemplateProvinceView').html(e).css({'background-color':'#FFFFFF'});
																	},
																	complete:function(){
																		$.ajax({
																			url:'source/retention/get_template_city_details.php',
																			type:'POST',
																			data:{
																				id:d.id
																			},
																			beforeSend:function(){
																				//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
																				$('#PerceptionTemplateCityView').css({'background-color':'#c2c2c2'});
																			},
																			success:function(e){
																				//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
																				$('#PerceptionTemplateCityView').html(e).css({'background-color':'#FFFFFF'});
																			},
																			complete:function(){
																				$.ajax({
																					url:'source/retention/get_template_brgy_details.php',
																					type:'POST',
																					data:{
																						id:d.id
																					},
																					beforeSend:function(){
																						//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','<img src=img/progress_bar/loading.gif style=width:60%;>');
																						$('#PerceptionTemplateBrgyView').css({'background-color':'#c2c2c2'});
																					},
																					success:function(e){
																						//$('#ConsolidateUserResponseSplitterLeftExpander').jqxExpander('setHeaderContent','Details');
																						$('#PerceptionTemplateBrgyView').html(e).css({'background-color':'#FFFFFF'});
																					},
																					complete:function(){
																						var template = $('#PerceptionTemplateGrid').jqxGrid('getrowdata',$('#PerceptionTemplateGrid').jqxGrid('getselectedrowindex'));
																						//var dimension = $(this).jqxGrid('getrowdata',e.args.rowindex);

																						var source =
																						{
																							datatype: "json",
																							datafields: [
																								{ name: 'id' },
																								{ name: 'dimension' },
																								{ name: 'question' },
																								{ name: 'response' },
																								{ name: 'positive' },
																								{ name: 'neutral'},
																								{ name: 'negative' },
																								{ name: 'percent_per_rating' },
																								{ name: 'strongly_disagree_rating' },
																								{ name: 'neutral_rating' },
																								{ name: 'somewhat_agree_rating' },
																								{ name: 'strongly_agree_rating' },
																								{ name: 'na_rating' },
																								{ name: 'question' },
																								{ name: 'template'},
																								{ name: 'ideal_status' },
																								{ name: 'ideal_response' }
																							],
																							id: '',
																							url: 'source/retention/load_filter_per_dimension_user_overall_response.php?template='+template.id
																						};
																						var Adapter = new $.jqx.dataAdapter(source);
																						$('#PerceptionAnalysis').jqxGrid({source:Adapter,groups: ['template','dimension']});
																						
																						
																					}
																				});
																			}
																		});
																	}
																});
															}
														});
													}
												});
											}
										});
									}
								});
							}
						});
					}
				});
				
			}).css({'border':'0px'});
			
			$('#PerceptionAnalysis').jqxGrid({
				width:'100%',
				height:'100%',
				filterable:true,
				showfilterrow:true,
				columnsresize: true,
				groupable:true,
				groupsexpandedbydefault: true,
				showgroupsheader:false,
				showtoolbar:true,
				rendertoolbar:function(toolbar){
					var html = "<table>";
					html += "<tr>";
					html += "<td style='padding-right:15px;'>";
					html += "<button id=ViewDimensionResultBtn><b>Dimension Result</b></button>";
					html += "<div id=PerceptionAnalysisDimensionWin><div></div><div></div></div>";
					html += "</td>";
					html += "<td>";
					html += "<b> Legend: </b>";
					html += "</td>";
					html += "<td style='width:30px;background-color:#990000;color:#FFFFFF;padding-left:5px;padding-right:5px;'></td>";
					html += "<td style='width:10px;padding-left:10px;padding-right:10px;'> Highest Descriptive Equivalent</td>";
					html += "<td style='width:30px;background-color:#0000FF;color:#FFFFFF;padding-left:5px;padding-right:5px;'></td>";
					html += "<td style='width:10px;padding-left:10px;padding-right:10px;'> Highest Rating %</td>";
					html += "</tr>";
					html += "</table>";
					var container = $("<div style='margin:5px;'></div>");
					container.append(html);
					toolbar.append(container);
					$('#ViewDimensionResultBtn').jqxButton().on('click',function(){
						$('#PerceptionAnalysisDimensionWin').jqxWindow('open');
					});
					$('#PerceptionAnalysisDimensionWin').jqxWindow({
						width:'90%',
						maxWidth:(($(window).innerWidth() * 100)/100),
						height:'90%',
						maxHeight:(($(window).innerHeight() * 100)/100),
						autoOpen:false,
						modalOpacity:0.7,
						isModal:true,
						resizable:false,
						initContent:function(){
							var title = 'Dimension Result';
							var content = "<div id=DimesionResultGrid></div>";
							$('#PerceptionAnalysisDimensionWin').jqxWindow('setTitle',title);
							$('#PerceptionAnalysisDimensionWin').jqxWindow('setContent',content);
							$('#DimesionResultGrid').jqxGrid({
								width:'100%',
								height:'100%',
								filterable:true,
								showstatusbar:true,
								statusbarheight:200,
								renderstatusbar:function(statusbar){
									var html = "<fieldset style='width:100%;height:100%;'>";
									html += "<legend>Legend</legend>";
										html += "<table style='width:100%;background-color:#c2c2c2;'>";
											html += "<tr>";
												html += "<td colspan=2><b>DETAIL</b></td>";
												html += "<td><b>DESCRIPTION</b></td>";
											html += "</tr>";
											html += "<tr>";
												html += "<td><img src='img/icon/enabled.gif'></td>";
												html += "<td> : </td>";
												html += "<td><i>Dimension used for support reference</i></td>";
											html += "</tr>";
											// html += "<tr>";
												// html += "<td><img src='img/icon/disabled.gif'></td>";
												// html += "<td> : </td>";
												// html += "<td><i>Dimension excluded for support reference</i></td>";
											// html += "</tr>";
											html += "<tr>";
												html += "<td><b>[ + ]Response %</b></td>";
												html += "<td> : </td>";
												html += "<td><i>Percentage of Positive Response (e.g 3 out of 7 questions per dimension )</i></td>";
											html += "</tr>";
											// html += "<tr>";
												// html += "<td><b>Support % </b></td>";
												// html += "<td> : </td>";
												// html += "<td><i>Percentage as reference in selecting support value for <br>finding interesting employee profile</i></td>";
											// html += "</tr>";
											html += "<tr>";
												html += "<td><b>Dimension %</b></td>";
												html += "<td> : </td>";
												html += "<td><i>Percentage ratio in 12 dimensions </i></td>";
											html += "</tr>";
											html += "<tr>";
												html += "<td><b>Response % Per Dimension</b></td>";
												html += "<td> : </td>";
												html += "<td><i>Percentage of Dimension by Positive Response</i></td>";
											html += "</tr>";
											
										html += "</table>";
									html += "</fieldset>";
									var container = $("<div style='padding:10px;'></div>");
									container.append(html);
									statusbar.append(container);
								},
								columns:[
									{text:'ID',dataField:'id',hidden:true},
									{text:'Dimensions',dataField:'dimension',width:'200px'},
									{text:'[ + ]Response %',cellsalign:'right',dataField:'response_percentage',width:'150px',cellclassname: function (row, column, value, data) { if (value < 50) { return "negative1"; }else{ return "positive1"; }}},
									//{text:'Support %',cellsalign:'right',dataField:'support_response_percentage',width:'150px',cellclassname: function (row, column, value, data) { if (value < 50) { return "negative1"; }else{ return "positive1"; }}},
									{text:'Dimension %',cellsalign:'right', dataField:'percentage',width:'150px'},
									{text:'Response % Per Dimension',cellsalign:'right',dataField:'total'}
								]
							}).css({'border':'0px'});
						}
					}).on('open',function(){
						var template = $('#PerceptionTemplateGrid').jqxGrid('getrowdata',$('#PerceptionTemplateGrid').jqxGrid('getselectedrowindex'));
						var source =
						{
							datatype: "json",
							datafields: [
								{ name: 'id' },
								{ name: 'dimension' },
								{ name: 'percentage' },
								{ name: 'response_percentage' },
								{ name: 'support_response_percentage' },
								{ name: 'total' }
							],
							id: '',
							url: 'source/retention/load_dimension_result.php?template='+template.id
						};
						var Adapter = new $.jqx.dataAdapter(source);
						$('#DimesionResultGrid').jqxGrid({source:Adapter});
					});
				},
				columns:[
					{text:'ID',dataField:'id',hidden:true},
					{text:'Template',dataField:'template',hidden:true},
					{text:'Dimensions',dataField:'dimension',width:'230px',pinned:true},
					//{text:'Ideal Response',dataField:'ideal_response',width:'150px',cellclassname: function (row, column, value, data) { if (value != '') { return "ideal_response"; }else{ return "ideal_response"; }}},
					//{text:'% Per Rating',dataField:'percent_per_rating',width:'150px',cellclassname: function (row, column, value, data) { if (value != '') { return "ideal_response"; }else{ return "ideal_response"; }}},
					{text:'Strongly Disagree %',dataField:'strongly_disagree_rating',columngroup: 'ratings',width:'180px',cellsalign: 'right',cellclassname: function (row, column, value, data) { if (value) { return "perception2"; }}},
					{text:'Neutral %',dataField:'neutral_rating',columngroup: 'ratings',width:'180px',cellsalign: 'right',cellclassname: function (row, column, value, data) { if (value) { return "perception2"; }}},
					{text:'Somewhat Agree %',dataField:'somewhat_agree_rating',columngroup: 'ratings',width:'180px',cellsalign: 'right',cellclassname: function (row, column, value, data) { if (value) { return "perception2"; }}},
					{text:'Strongly Agree %',dataField:'strongly_agree_rating',columngroup: 'ratings',width:'180px',cellsalign: 'right',cellclassname: function (row, column, value, data) { if (value) { return "perception2"; }}},
					{text:'Question',dataField:'question',width:'800px'},
					{text:'Status',dataField:'ideal_status',width:'80px',pinned:true,cellclassname: function (row, column, value, data) { if (value == 'Positive') { return "positive"; }else{ return "negative"; }}}
				],
				columngroups: [
					{ text: 'Ratings', align: 'center', name: 'ratings',pinned:true }
				],
				groups: ['template','dimension']
			}).css({'border':'0px'});
			$('#ApplicantMainTab').jqxTabs({
				width:'100%',
				height:'100%'
			}).css({'border':'0px'});
			$('#ApplicantSplitterMain').jqxSplitter({
				width:'100%',
				height:'100%',
				panels:[
					{size:'250px'},{}
				],
				orientation:'vertical'
			}).css({'border':'0px'});
			$('#ApplicantSplitterMainL').jqxSplitter({
				width:'100%',
				height:'100%',
				panels:[
					{size:'30%'},{size:'70%'}
				],
				orientation:'horizontal'
			}).css({'border':'0px'});
			var sourceSupCon =
			{
				datatype: "json",
				datafields: [
					{ name: 'id' },
					{ name: 'support' },
					{ name: 'confidence' },
					{ name: 'status' },
					{ name: 'sex_allowed' },
					{ name: 'civilstatus_allowed' },
					{ name: 'city_allowed' },
					{ name: 'province_allowed' },
					{ name: 'citizenship_allowed' },
					{ name: 'total_work_years_allowed' },
					{ name: 'position_allowed' },
					{ name: 'department_allowed' },
					{ name: 'work_history_allowed' },
					{ name: 'degree_allowed' },
					{ name: 'age_allowed' },
					{ name: 'd1'},
					{ name: 'd2'},
					{ name: 'd3'},
					{ name: 'd4'},
					{ name: 'd5'},
					{ name: 'd6'},
					{ name: 'd7'},
					{ name: 'd8'},
					{ name: 'd9'},
					{ name: 'd10'},
					{ name: 'd11'},
					{ name: 'd12'},
					{ name: 'discretize'}
				],
				id: '',
				url: 'source/applicant/load_assoc_support_confidence.php'
			};
			var AdapterSupCon = new $.jqx.dataAdapter(sourceSupCon);
			$('#ApplicantSupportConfidenceGrid').jqxGrid({
				width:'100%',
				height:'100%',
				source:AdapterSupCon,
				filterable:true,
				showfilterrow:true,
				showtoolbar:true,
				showstatusbar:true,
				renderstatusbar:function(statusbar){
					var html = "<div id=AssocStatusBar style='margin:5px;'></div>";
					var container = $("<div></div>");
					container.append(html);
					statusbar.append(container);
				},
				toolbarheight:80,
				rendertoolbar:function(toolbar){
					var html = "<table style=width:100%;table-layout:fixed;>";
					html += "<tr>";
					html += "<td><button id=SetSuppCOnCustomRulesBtn style='margin:5px;'>Custom Rules</button></td>";
					html += "</tr>";
					html += "<tr>";
					html += "<td><button id=SetSuppCOnBtn style='margin:5px;'>Set</button>";
					html += "<button id=EditSuppCOnBtn style='margin:5px;'>Active</button>";
					html += "<button id=RefreshSuppCOnBtn>Refresh</button>";
					html += "<button id=ApplicantSupportConfidenceBtn style='margin:5px;'>Generate</button></td>";
					html += "</tr>";
					html += "<tr>";
					html += "<td>";
					html += "<div id=SetSuppCOnCustomRulesWin><div></div><div></div></div>";
					html += "<div id=SetSuppCOnWin><div></div><div></div></div>";
					html += "<div id=EditSuppCOnWin><div></div><div></div></div>";
					html += "</td>";
					html += "</tr>";
					html += "</table>";
					
					var container = $("<div></div>");
					container.append(html);
					toolbar.append(container);
					$('#SetSuppCOnCustomRulesBtn').jqxButton({width:'100%'}).on('click',function(){
						//$('#ApplicantSupportConfidenceGrid').jqxGrid({source:AdapterSupCon});
						$('#SetSuppCOnCustomRulesWin').jqxWindow('open');
					});
					$('#RefreshSuppCOnBtn').jqxButton().on('click',function(){
						$('#ApplicantSupportConfidenceGrid').jqxGrid({source:AdapterSupCon});
					});
					$('#SetSuppCOnBtn').jqxButton().on('click',function(){
						$('#SetSuppCOnWin').jqxWindow('open');
					});
					$('#EditSuppCOnBtn').jqxButton().on('click',function(){
						var d = $('#ApplicantSupportConfidenceGrid').jqxGrid('getrowdata',$('#ApplicantSupportConfidenceGrid').jqxGrid('getselectedrowindex'));
						$.ajax({
							url:'source/applicant/set_assoc_conf_active.php',
							data:{
								id:d.id
							},
							type:'POST',
							success:function(){
								
							},
							complete:function(){
								$('#ApplicantSupportConfidenceGrid').jqxGrid({source:AdapterSupCon});
							}
						});
					});
					
					$('#ApplicantSupportConfidenceBtn').jqxButton().on('click',function(){
						var d = $('#ApplicantSupportConfidenceGrid').jqxGrid('getrowdata',$('#ApplicantSupportConfidenceGrid').jqxGrid('getselectedrowindex'));
						$.ajax({
							//url:'source/cronjob/apriori/example.php',
							url:'source/php_ml/src/Association/test.php',
							data:{
								support:d.support,
								confidence:d.confidence,
								sex_allowed:d.sex_allowed,
								civilstatus_allowed:d.civilstatus_allowed,
								city_allowed:d.city_allowed,
								province_allowed:d.province_allowed,
								citizenship_allowed:d.citizenship_allowed,
								total_work_years_allowed:d.total_work_years_allowed,
								position_allowed:d.position_allowed,
								department_allowed:d.department_allowed,
								work_history_allowed:d.work_history_allowed,
								degree_allowed:d.degree_allowed,
								sex:d.age_allowed,
								d1:d.d1,
								d2:d.d2,
								d3:d.d3,
								d4:d.d4,
								d5:d.d5,
								d6:d.d6,
								d7:d.d7,
								d8:d.d8,
								d9:d.d9,
								d10:d.d10,
								d11:d.d11,
								d12:d.d12
							},
							type:'GET',
							beforeSend:function(){
								$('#ApplicantSupportConfidenceBtn').jqxButton({disabled:true});
								$('#AssocStatusBar').html("Generating Rules");
							},
							success:function(){
								
							},
							complete:function(){
								var source =
								{
									datatype: "json",
									datafields: [
										{ name: 'id' },
										{ name: 'position' },
										{ name: 'support' },
										{ name: 'confidence' },
										{ name: 'assoc_rules' },
										{ name: 'percentage' },
										{ name: 'status' }
									],
									id: '',
									url: 'source/applicant/load_employee_association_rules.php?support='+d.support+"&confidence="+d.confidence
								};
								var Adapter = new $.jqx.dataAdapter(source);
								$('#ApplicantSupportConfidenceEmpAssocRules').jqxGrid({source:Adapter});
								
								$.ajax({
									url:'source/cronjob/tag_employee_profile_with_rules.php',
									data:{
										support:d.support,
										confidence:d.confidence
									},
									type:'POST',
									beforeSend:function(){
										$('#ApplicantSupportConfidenceBtn').jqxButton({disabled:true});
										$('#AssocStatusBar').html("Applying Rules");
									},
									success:function(){
										
									},
									complete:function(){
										var sourceA =
										{
											datatype: "json",
											datafields: [
												{ name: 'id' },
												{ name: 'sex' },
												{ name: 'civilstatus' },
												{ name: 'religion' },
												{ name: 'city' },
												{ name: 'province' },
												{ name: 'citizenship' },
												{ name: 'bloodtype' },
												{ name: 'position' },
												{ name: 'dept' },
												{ name: 'work_years_current' },
												{ name: 'work_years_previous' },
												{ name: 'degree' },
												{ name: 'age'},
												{ name: 'd1' },
												{ name: 'd2' },
												{ name: 'd3' },
												{ name: 'd4' },
												{ name: 'd5' },
												{ name: 'd6' },
												{ name: 'd7' },
												{ name: 'd8' },
												{ name: 'd9' },
												{ name: 'd10' },
												{ name: 'd11' },
												{ name: 'd12' }
											],
											id: '',
											url: 'source/applicant/load_desirable_employees.php?dval=0&support='+d.support+"&confidence="+d.confidence+"&discretize="+d.discretize+"&dimensions="+d.d1+","+d.d2+","+d.d3+","+d.d4+","+d.d5+","+d.d6+","+d.d7+","+d.d8+","+d.d9+","+d.d10+","+d.d11+","+d.d12
										};
										var AdapterA = new $.jqx.dataAdapter(sourceA);
										$('#ApplicantAssocDesirableEmp').jqxGrid({source:AdapterA,groups:['position']});
										$('#ApplicantSupportConfidenceBtn').jqxButton({disabled:false});
										$('#AssocStatusBar').html("");
										
									}
								});
							}
						});
					});
					$('#SetSuppCOnWin').jqxWindow({
						width:'300px',
						height:'600px',
						autoOpen:false,
						modalOpacity:0.7,
						isModal:true,
						resizable:false,
						initContent:function(){
							var title = "Set Support & Confidence";
							var content = "<table>";
							content += "<tr>";
								content += "<td>Support</td>";
								content += "<td><input id=AssocRuleSupportInp></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Confidence</td>";
								content += "<td><input id=AssocRuleConfidenceInp></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Status</td>";
								content += "<td><select id=AssocRuleConfidenceStatus><option value=0>Inactive</option><option value=1>Active</option></select></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Sex</td>";
								content += "<td><input type='radio' id='AssocRuleSexAllow' name=SetSex value='1'> Yes <input type='radio' name=SetSex id='AssocRuleSexAllow' value='0'> No</td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Civil Status</td>";
								content += "<td><input type='radio' id='AssocRuleCivilStatusAllow' name=SetCivilStatus value='1'> Yes <input type='radio' name=SetCivilStatus id='AssocRuleCivilStatusAllow' value='0'> No</td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>City</td>";
								content += "<td><input type='radio' id='AssocRuleCityAllow' name=SetCity value='1'> Yes <input type='radio' name=SetCity id='AssocRuleCityAllow' value='0'> No</td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Province</td>";
								content += "<td><input type='radio' id='AssocRuleProvinceAllow' name=SetProvince value='1'> Yes <input type='radio' name=SetProvince id='AssocRuleProvinceAllow' value='0'> No</td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Citizenship</td>";
								content += "<td><input type='radio' id='AssocRuleCitizenshipAllow' name=SetCitizenship value='1'> Yes <input type='radio' name=SetCitizenship id='AssocRuleCitizenshipAllow' value='0'> No</td>";
							content += "</tr>";
							// content += "<tr>";
								// content += "<td>Position</td>";
								// content += "<td><input type='radio' id='AssocRulePositionAllow' name=SetPosition value='1'> Yes <input type='radio' name=SetPosition id='AssocRulePositionAllow' value='0'> No</td>";
							// content += "</tr>";
							content += "<tr>";
								content += "<td>Department</td>";
								content += "<td><input type='radio' id='AssocRuleDepartmentAllow' name=SetDepartment value='1'> Yes <input type='radio' name=SetDepartment id='AssocRuleDepartmentAllow' value='0'> No</td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Work History</td>";
								content += "<td><input type='radio' id='AssocRuleWorkHistoryAllow' name=SetWorkHistory value='1'> Yes <input type='radio' name=SetWorkHistory id='AssocRuleWorkHistoryAllow' value='0'> No</td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Educational Attainment</td>";
								content += "<td><input type='radio' id='AssocRuleDegreeAllow' name=SetDegree value='1'> Yes <input type='radio' name=SetDegree id='AssocRuleDegreeAllow' value='0'> No</td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Age</td>";
								content += "<td><input type='radio' id='AssocRuleAgeAllow' name=SetAge value='1'> Yes <input type='radio' name=SetAge id='AssocRuleAgeAllow' value='0'> No</td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>D1</td>";
								content += "<td><input type='radio' id='AssocRuleD1Allow' name=SetD1 value='1'> Yes <input type='radio' name=SetD1 id='AssocRuleD1Allow' value='0'> No</td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>D2</td>";
								content += "<td><input type='radio' id='AssocRuleD2Allow' name=SetD2 value='1'> Yes <input type='radio' name=SetD2 id='AssocRuleD2Allow' value='0'> No</td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>D3</td>";
								content += "<td><input type='radio' id='AssocRuleD3Allow' name=SetD3 value='1'> Yes <input type='radio' name=SetD3 id='AssocRuleD3Allow' value='0'> No</td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>D4</td>";
								content += "<td><input type='radio' id='AssocRuleD4Allow' name=SetD4 value='1'> Yes <input type='radio' name=SetD4 id='AssocRuleD4Allow' value='0'> No</td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>D5</td>";
								content += "<td><input type='radio' id='AssocRuleD5Allow' name=SetD5 value='1'> Yes <input type='radio' name=SetD5 id='AssocRuleD5Allow' value='0'> No</td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>D6</td>";
								content += "<td><input type='radio' id='AssocRuleD6Allow' name=SetD6 value='1'> Yes <input type='radio' name=SetD6 id='AssocRuleD6Allow' value='0'> No</td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>D7</td>";
								content += "<td><input type='radio' id='AssocRuleD7Allow' name=SetD7 value='1'> Yes <input type='radio' name=SetD7 id='AssocRuleD7Allow' value='0'> No</td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>D8</td>";
								content += "<td><input type='radio' id='AssocRuleD8Allow' name=SetD8 value='1'> Yes <input type='radio' name=SetD8 id='AssocRuleD8Allow' value='0'> No</td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>D9</td>";
								content += "<td><input type='radio' id='AssocRuleD9Allow' name=SetD9 value='1'> Yes <input type='radio' name=SetD9 id='AssocRuleD9Allow' value='0'> No</td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>D10</td>";
								content += "<td><input type='radio' id='AssocRuleD10Allow' name=SetD10 value='1'> Yes <input type='radio' name=SetD10 id='AssocRuleD10Allow' value='0'> No</td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>D11</td>";
								content += "<td><input type='radio' id='AssocRuleD11Allow' name=SetD11 value='1'> Yes <input type='radio' name=SetD11 id='AssocRuleD11Allow' value='0'> No</td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>D12</td>";
								content += "<td><input type='radio' id='AssocRuleD12Allow' name=SetD12 value='1'> Yes <input type='radio' name=SetD12 id='AssocRuleD12Allow' value='0'> No</td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Discretize Value</td>";
								content += "<td><input type=text id=AssocRuleDiscreetizationAllow></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td></td>";
								content += "<td><button id=SetSupConfidenceBtn>Submit</button></td>";
							content += "</tr>";
							content += "</table>";
							$('#SetSuppCOnWin').jqxWindow('setTitle',title);
							$('#SetSuppCOnWin').jqxWindow('setContent',content);
							$('#SetSupConfidenceBtn').jqxButton().on('click',function(){
								$.ajax({
									url:'source/applicant/set_sup_conf.php',
									data:{
										sup:$('#AssocRuleSupportInp').val(),
										conf:$('#AssocRuleConfidenceInp').val(),
										status:$('#AssocRuleConfidenceStatus').val(),
										sex:$('input[id=AssocRuleSexAllow]:checked').val(),
										civilstatus:$('input[id=AssocRuleCivilStatusAllow]:checked').val(),
										city:$('input[id=AssocRuleCityAllow]:checked').val(),
										province:$('input[id=AssocRuleProvinceAllow]:checked').val(),
										citizenship:$('input[id=AssocRuleCitizenshipAllow]:checked').val(),
										position:$('input[id=AssocRulePositionAllow]:checked').val(),
										department:$('input[id=AssocRuleDepartmentAllow]:checked').val(),
										work_history:$('input[id=AssocRuleWorkHistoryAllow]:checked').val(),
										degree:$('input[id=AssocRuleDegreeAllow]:checked').val(),
										age:$('input[id=AssocRuleAgeAllow]:checked').val(),
										d1:$('input[id=AssocRuleD1Allow]:checked').val(),
										d2:$('input[id=AssocRuleD2Allow]:checked').val(),
										d3:$('input[id=AssocRuleD3Allow]:checked').val(),
										d4:$('input[id=AssocRuleD4Allow]:checked').val(),
										d5:$('input[id=AssocRuleD5Allow]:checked').val(),
										d6:$('input[id=AssocRuleD6Allow]:checked').val(),
										d7:$('input[id=AssocRuleD7Allow]:checked').val(),
										d8:$('input[id=AssocRuleD8Allow]:checked').val(),
										d9:$('input[id=AssocRuleD9Allow]:checked').val(),
										d10:$('input[id=AssocRuleD10Allow]:checked').val(),
										d11:$('input[id=AssocRuleD11Allow]:checked').val(),
										d12:$('input[id=AssocRuleD12Allow]:checked').val(),
										discreet:$('#AssocRuleDiscreetizationAllow').val()
									},
									type:'POST',
									success:function(){
										var source =
										{
											datatype: "json",
											datafields: [
												{ name: 'id' },
												{ name: 'support' },
												{ name: 'confidence' },
												{ name: 'status' }
											],
											id: '',
											url: 'source/applicant/load_assoc_support_confidence.php'
										};
										var Adapter = new $.jqx.dataAdapter(source);
										$('#ApplicantSupportConfidenceGrid').jqxGrid({source:Adapter});
									},
									complete:function(){
										$('#SetSuppCOnWin').jqxWindow('close');
										$('#AssocRuleSupportInp').val('');
										$('#AssocRuleConfidenceInp').val('');
									}
								});
							});
						}
					});
					$('#SetSuppCOnCustomRulesWin').jqxWindow({
						width:'95%',
						maxWidth:(($(window).innerWidth() * 100)/100),
						height:'95%',
						maxHeight:(($(window).innerHeight() * 100)/100),
						autoOpen:false,
						modalOpacity:0.7,
						isModal:true,
						resizable:false,
						initContent:function(){
							var title = "<b>Custom Rules</b>";
							var content = "<div id=SetSuppCOnCustomRulesGrid></div>";
							
							$('#SetSuppCOnCustomRulesWin').jqxWindow('setTitle',title);
							$('#SetSuppCOnCustomRulesWin').jqxWindow('setContent',content);
							$('#SetSuppCOnCustomRulesGrid').jqxGrid({
								width:'100%',
								height:'100%',
								pageable:true,
								showstatusbar:true,
								renderstatusbar:function(statusbar){
									var container = $("<div style='margin:5px;'></div>");
									var content = "<button id=RefreshSetSuppConCustomRulesBtn>Refresh List</button>";
									container.append(content);
									statusbar.append(container);
									$('#RefreshSetSuppConCustomRulesBtn').jqxButton().on('click',function(){
										var source =
										{
											datatype: "json",
											datafields: [
												{name:'id'},
												{name:'profile_selected'},
												{name:'option'},
												{name:'support'},
												{name:'confidence'},
												{name:'sex'},
												{name:'civilstatus'},
												{name:'city'},
												{name:'province'},
												{name:'citizenship'},
												{name:'total_work'},
												{name:'position'},
												{name:'department'},
												{name:'work_history',width:'120px'},
												{name:'degree',width:'180px'},
												{name:'age'},
												{name:'d1'},
												{name:'d2'},
												{name:'d3'},
												{name:'d4'},
												{name:'d5'},
												{name:'d6'},
												{name:'d7'},
												{name:'d8'},
												{name:'d9'},
												{name:'d10'},
												{name:'d11'},
												{name:'d12'},
												{name:'status'},
												{name:'date'}
											],
											id: '',
											url: 'source/applicant/load_custom_ruleset.php'
										};
										var Adapter = new $.jqx.dataAdapter(source);
										$('#SetSuppCOnCustomRulesGrid').jqxGrid({source:Adapter}).on('bindingcomplete',function(){
											
										});
									});
								},
								showtoolbar:true,
								toolbarheight:70,
								rendertoolbar:function(toolbar){
									var container = $("<div style='margin:5px;'></div>");
									var contentx = "<table style='width:100%;table-layout:fixed;'>";
									contentx += "<tr>";
									contentx += "<td style='text-align:right;'><b>Select : </b></td>";
									contentx += "<td colspan=2><div id=SelectEmployeeMainProfileList></div></td>";
									contentx += "<td rowspan=2><button id=SubmitOptionSelectEmployeeMainProfileBtn style='margin-left:5px;'><b>Submit</b></button></td>";
									contentx += "</tr>";
									contentx += "<tr>";
									contentx += "<td style='text-align:right;'><b>Options : </b></td>";
									contentx += "<td><input id=OptionSelectEmployeeMainProfileInp></td><td><div id=OptionSelectEmployeeMainProfileList></div></td>";
									contentx += "</tr>";
									// contentx += "<tr>";
									// contentx += "<td></td>";
									// contentx += "<td></td><td style='text-align:right;'></td>";
									// contentx += "</tr>";
									contentx += "</table>";
									contentx += "<div id=CustomAssocResultWin>";
										contentx += "<div>";
										contentx += "</div>";
										contentx += "<div>";
										contentx += "</div>";
									contentx += "</div>";
									container.append(contentx);
									toolbar.append(container);
									$('#SelectEmployeeMainProfileList').jqxDropDownList({ 
										displayMember: "name",
										valueMember: "id",
										height: '25px',
										width:'100%',
									}).on('open',function(){
										var source =
										{
											datatype: "json",
											datafields: [
												{ name: 'id' },
												{ name: 'name' }
											],
											id: '',
											url: 'source/applicant/load_employee_profile_listing.php'
										};
										var Adapter = new $.jqx.dataAdapter(source);
										$(this).jqxDropDownList({ source: Adapter});
									});
									$('#OptionSelectEmployeeMainProfileInp').jqxInput({placeHolder: " If Age is selected,enter range here: e.g. 20-35",width:'100%',height:'25px'});
									$('#OptionSelectEmployeeMainProfileList').jqxDropDownList({ 
										displayMember: "name",
										valueMember: "id",
										height: '25px',
										width:'100%',
									}).on('open',function(){
										var source =
										{
											datatype: "json",
											datafields: [
												{ name: 'id' },
												{ name: 'name' }
											],
											id: '',
											url: 'source/applicant/load_employee_profile_listing_by_id.php?id='+$('#SelectEmployeeMainProfileList').val()
										};
										var Adapter = new $.jqx.dataAdapter(source);
										$(this).jqxDropDownList({ source: Adapter});
									});
									$('#SubmitOptionSelectEmployeeMainProfileBtn').jqxButton({width:'100%',height:'55px'}).on('click',function(){
										var d = $('#ApplicantSupportConfidenceGrid').jqxGrid('getrowdata',$('#ApplicantSupportConfidenceGrid').jqxGrid('getselectedrowindex'));
										if($('#SelectEmployeeMainProfileList').val() == 10){ 
											$.ajax({
												url:'source/applicant/add_custom_ruleset.php',
												type:'POST',
												data:{
													profile_selected:$('#SelectEmployeeMainProfileList').val(),
													option:$('#OptionSelectEmployeeMainProfileInp').val(),
													support:d.support,
													confidence:d.confidence,
													sex_allowed:d.sex_allowed,
													civilstatus_allowed:d.civilstatus_allowed,
													city_allowed:d.city_allowed,
													province_allowed:d.province_allowed,
													citizenship_allowed:d.citizenship_allowed,
													total_work_years_allowed:d.total_work_years_allowed,
													position_allowed:d.position_allowed,
													department_allowed:d.department_allowed,
													work_history_allowed:d.work_history_allowed,
													degree_allowed:d.degree_allowed,
													age:d.age_allowed,
													d1:d.d1,
													d2:d.d2,
													d3:d.d3,
													d4:d.d4,
													d5:d.d5,
													d6:d.d6,
													d7:d.d7,
													d8:d.d8,
													d9:d.d9,
													d10:d.d10,
													d11:d.d11,
													d12:d.d12
												},
												success:function(){
													
												},
												complete:function(){
													var source =
													{
														datatype: "json",
														datafields: [
															{name:'id'},
															{name:'profile_selected'},
															{name:'option'},
															{name:'support'},
															{name:'confidence'},
															{name:'sex'},
															{name:'civilstatus'},
															{name:'city'},
															{name:'province'},
															{name:'citizenship'},
															{name:'total_work'},
															{name:'position'},
															{name:'department'},
															{name:'work_history',width:'120px'},
															{name:'degree',width:'180px'},
															{name:'age'},
															{name:'d1'},
															{name:'d2'},
															{name:'d3'},
															{name:'d4'},
															{name:'d5'},
															{name:'d6'},
															{name:'d7'},
															{name:'d8'},
															{name:'d9'},
															{name:'d10'},
															{name:'d11'},
															{name:'d12'},
															{name:'status'},
															{name:'date'}
														],
														id: '',
														url: 'source/applicant/load_custom_ruleset.php'
													};
													var Adapter = new $.jqx.dataAdapter(source);
													$('#SetSuppCOnCustomRulesGrid').jqxGrid({source:Adapter});
												}
											});
										}else{
											$.ajax({
												url:'source/applicant/add_custom_ruleset.php',
												type:'POST',
												data:{
													profile_selected:$('#SelectEmployeeMainProfileList').val(),
													option:$('#OptionSelectEmployeeMainProfileList').val(),
													support:d.support,
													confidence:d.confidence,
													sex_allowed:d.sex_allowed,
													civilstatus_allowed:d.civilstatus_allowed,
													city_allowed:d.city_allowed,
													province_allowed:d.province_allowed,
													citizenship_allowed:d.citizenship_allowed,
													total_work_years_allowed:d.total_work_years_allowed,
													position_allowed:d.position_allowed,
													department_allowed:d.department_allowed,
													work_history_allowed:d.work_history_allowed,
													degree_allowed:d.degree_allowed,
													age:d.age_allowed,
													d1:d.d1,
													d2:d.d2,
													d3:d.d3,
													d4:d.d4,
													d5:d.d5,
													d6:d.d6,
													d7:d.d7,
													d8:d.d8,
													d9:d.d9,
													d10:d.d10,
													d11:d.d11,
													d12:d.d12
												},
												success:function(){
													
												},
												complete:function(){
													var source =
													{
														datatype: "json",
														datafields: [
															{name:'id'},
															{name:'profile_selected'},
															{name:'option'},
															{name:'support'},
															{name:'confidence'},
															{name:'sex'},
															{name:'civilstatus'},
															{name:'city'},
															{name:'province'},
															{name:'citizenship'},
															{name:'total_work'},
															{name:'position'},
															{name:'department'},
															{name:'work_history',width:'120px'},
															{name:'degree',width:'180px'},
															{name:'age'},
															{name:'d1'},
															{name:'d2'},
															{name:'d3'},
															{name:'d4'},
															{name:'d5'},
															{name:'d6'},
															{name:'d7'},
															{name:'d8'},
															{name:'d9'},
															{name:'d10'},
															{name:'d11'},
															{name:'d12'},
															{name:'status'},
															{name:'date'}
														],
														id: '',
														url: 'source/applicant/load_custom_ruleset.php'
													};
													var Adapter = new $.jqx.dataAdapter(source);
													$('#SetSuppCOnCustomRulesGrid').jqxGrid({source:Adapter});
												}
											});
										}
										
									});
									$('#CustomAssocResultWin').jqxWindow({
										width:'90%',
										maxWidth:(($(window).innerWidth() * 100)/100),
										height:'90%',
										maxHeight:(($(window).innerHeight() * 100)/100),
										autoOpen:false,
										modalOpacity:0.7,
										isModal:true,
										resizable:false,
										initContent:function(){
											var title = "<b>Custom Association Rules Result</b>";
											var content = "<div id=CustomAssocResultSplitterMain>";
												content += "<div>";
													content += "<div id=CustomApplicantSupportConfidenceEmpAssocRules></div>";	
												content += "</div>";
												content += "<div>";
													content += "<div id=CustomApplicantFrequentItemSet></div>";
												content += "</div>";
											content += "</div>";
											$('#CustomAssocResultWin').jqxWindow('setTitle',title);
											$('#CustomAssocResultWin').jqxWindow('setContent',content);
											$('#CustomAssocResultSplitterMain').jqxSplitter({
												width:'100%',
												height:'100%',
												panels:[
													{size:'50%'},{size:'50%'}
												],
											}).css({'border':'0px'});

											$('#CustomApplicantSupportConfidenceEmpAssocRules').jqxGrid({
												width:'100%',
												height:'100%',
												filterable:true,
												showfilterrow:true,
												showtoolbar:true,
												groupable:true,
												showgroupsheader:false,
												groupsexpandedbydefault:false,
												rendertoolbar:function(toolbar){
													var container = $('<div style=margin:5px;></div>');
													container.append("Association Rules of Employee");
													toolbar.append(container);
												},
												columns:[
													{text:'ID',dataField:'id',hidden:true},
													{text:'',dataField:'position',width:'130px',pinned:true},
													{text:'Rule Selection',dataField:'status',width:'120px'},
													{text:'%',dataField:'percentage',width:'100px'},
													{text:'Association Rules',dataField:'assoc_rules',width:'800px'}
												],
												groups:['position']
											}).css({'border':'0px'});
											$('#CustomApplicantFrequentItemSet').jqxGrid({
												width:'100%',
												height:'100%',
												filterable:true,
												showfilterrow:true,
												showtoolbar:true,
												groupable:true,
												showgroupsheader:false,
												groupsexpandedbydefault:false,
												rendertoolbar:function(toolbar){
													var container = $('<div style=margin:5px;></div>');
													container.append("Frequent Itemsets");
													toolbar.append(container);
												},
												columns:[
													{text:'ID',dataField:'id',hidden:true},
													{text:'',dataField:'position',width:'130px',pinned:true},
													{text:'Item Set',dataField:'itemset',width:'200px'},
													{text:'Count',dataField:'count',width:'200px'}
												],
												groups:['position']
											}).css({'border':'0px'});
											
										}
									}).on('open',function(){
										var custom_ruleset = $('#SetSuppCOnCustomRulesGrid').jqxGrid('getrowdata',$('#SetSuppCOnCustomRulesGrid').jqxGrid('getSelectedrowindex'));
										var source =
										{
											datatype: "json",
											datafields: [
												{ name: 'id' },
												{ name: 'position' },
												{ name: 'support' },
												{ name: 'confidence' },
												{ name: 'assoc_rules' },
												{ name: 'percentage' },
												{ name: 'status' }
											],
											id: '',
											url: 'source/applicant/custom_load_employee_association_rules.php?id='+custom_ruleset.id
										};
										var Adapter = new $.jqx.dataAdapter(source);
										//$('#CustomApplicantSupportConfidenceEmpAssocRules').jqxGrid({source:Adapter,groups:['position']});
										$('#CustomApplicantSupportConfidenceEmpAssocRules').jqxGrid({source:Adapter});
										var sourceB =
										{
											datatype: "json",
											datafields: [
												{ name: 'id' },
												{ name: 'itemset' },
												{ name: 'count' },
												{ name: 'position'}
											],
											id: '',
											url: 'source/applicant/custom_load_itemsets.php?id='+custom_ruleset.id
										};
										var AdapterB = new $.jqx.dataAdapter(sourceB);
										//$('#CustomApplicantFrequentItemSet').jqxGrid({source:AdapterB,groups:['position']});
										$('#CustomApplicantFrequentItemSet').jqxGrid({source:AdapterB});
									});
								},
								columns:[
									{text:'ID',dataField:'id',hidden:true},
									{text:'Filtered Profile',dataField:'profile_selected',width:'120px'},
									{text:'Option',dataField:'option',width:'80px'},
									{text:'Support',dataField:'support',width:'80px'},
									{text:'Confidence',dataField:'confidence',width:'100px'},
									{text:'Sex',dataField:'sex',width:'90px'},
									{text:'Civil Status',dataField:'civilstatus',width:'90px'},
									{text:'City',dataField:'city',width:'90px'},
									{text:'Province',dataField:'province',width:'90px'},
									{text:'Citizenship',dataField:'citizenship',width:'90px'},
									{text:'Total Work',dataField:'total_work',width:'90px'},
									{text:'Position',dataField:'position',width:'90px'},
									{text:'Department',dataField:'department',width:'90px'},
									{text:'Work History',dataField:'work_history',width:'120px'},
									{text:'Educational Attainment',dataField:'degree',width:'180px'},
									{text:'Age',dataField:'age',width:'90px'},
									{text:'Dimension 1',dataField:'d1',width:'90px'},
									{text:'Dimension 2',dataField:'d2',width:'90px'},
									{text:'Dimension 3',dataField:'d3',width:'90px'},
									{text:'Dimension 4',dataField:'d4',width:'90px'},
									{text:'Dimension 5',dataField:'d5',width:'90px'},
									{text:'Dimension 6',dataField:'d6',width:'90px'},
									{text:'Dimension 7',dataField:'d7',width:'90px'},
									{text:'Dimension 8',dataField:'d8',width:'90px'},
									{text:'Dimension 9',dataField:'d9',width:'90px'},
									{text:'Dimension 10',dataField:'d10',width:'100px'},
									{text:'Dimension 11',dataField:'d11',width:'100px'},
									{text:'Dimension 12',dataField:'d12',width:'100px'},
									{text:'Status',dataField:'status',width:'100px',pinned:true},
									{text:'Date Created',dataField:'date',width:'180px'}
									
								]
							}).on('rowdoubleclick',function(){
								$('#CustomAssocResultWin').jqxWindow('open');
							}).css({'border':'0px'});
							
						}
					}).on('open',function(){
						var source =
						{
							datatype: "json",
							datafields: [
								{name:'id'},
								{name:'profile_selected'},
								{name:'option'},
								{name:'support'},
								{name:'confidence'},
								{name:'sex'},
								{name:'civilstatus'},
								{name:'city'},
								{name:'province'},
								{name:'citizenship'},
								{name:'total_work'},
								{name:'position'},
								{name:'department'},
								{name:'work_history',width:'120px'},
								{name:'degree',width:'180px'},
								{name:'age'},
								{name:'d1'},
								{name:'d2'},
								{name:'d3'},
								{name:'d4'},
								{name:'d5'},
								{name:'d6'},
								{name:'d7'},
								{name:'d8'},
								{name:'d9'},
								{name:'d10'},
								{name:'d11'},
								{name:'d12'},
								{name:'status'},
								{name:'date'}
							],
							id: '',
							url: 'source/applicant/load_custom_ruleset.php'
						};
						var Adapter = new $.jqx.dataAdapter(source);
						$('#SetSuppCOnCustomRulesGrid').jqxGrid({source:Adapter});
					});
				},	
				columns:[
					{text:'ID',dataField:'id',hidden:true},
					{text:'Support',dataField:'support',width:'80px'},
					{text:'Confidence',dataField:'confidence',width:'100px'},
					{text:'Status',dataField:'status'}
				]
			}).on('rowclick',function(e){
				var d = $(this).jqxGrid('getrowdata',e.args.rowindex);
				if(d.sex_allowed == 1){
					$('#SexAllowed').html('<b style=background-color:#00FF00;padding:2px;>Yes</b>');
				}else if(d.sex_allowed == 0){
					$('#SexAllowed').html('<b style=background-color:#FF0000;color:#FFFFFF;padding:2px;>No</b>');
				}
				if(d.civilstatus_allowed == 1){
					$('#CivilStatusAllowed').html('<b style=background-color:#00FF00;padding:2px;>Yes</b>');
				}else if(d.civilstatus_allowed == 0){
					$('#CivilStatusAllowed').html('<b style=background-color:#FF0000;color:#FFFFFF;padding:2px;>No</b>');
				}
				if(d.city_allowed == 1){
					$('#CityAllowed').html('<b style=background-color:#00FF00;padding:2px;>Yes</b>');
				}else if(d.city_allowed == 0){
					$('#CityAllowed').html('<b style=background-color:#FF0000;color:#FFFFFF;padding:2px;>No</b>');
				}
				if(d.province_allowed == 1){
					$('#ProvinceAllowed').html('<b style=background-color:#00FF00;padding:2px;>Yes</b>');
				}else if(d.province_allowed == 0){
					$('#ProvinceAllowed').html('<b style=background-color:#FF0000;color:#FFFFFF;padding:2px;>No</b>');
				}
				if(d.citizenship_allowed == 1){
					$('#CitizenshipAllowed').html('<b style=background-color:#00FF00;padding:2px;>Yes</b>');
				}else if(d.citizenship_allowed == 0){
					$('#CitizenshipAllowed').html('<b style=background-color:#FF0000;color:#FFFFFF;padding:2px;>No</b>');
				}
				if(d.position_allowed == 1){
					$('#PositionAllowed').html('<b style=background-color:#00FF00;padding:2px;>Yes</b>');
				}else if(d.position_allowed == 0){
					$('#PositionAllowed').html('<b style=background-color:#FF0000;color:#FFFFFF;padding:2px;>No</b>');
				}
				if(d.department_allowed == 1){
					$('#DepartmentAllowed').html('<b style=background-color:#00FF00;padding:2px;>Yes</b>');
				}else if(d.department_allowed == 0){
					$('#DepartmentAllowed').html('<b style=background-color:#FF0000;color:#FFFFFF;padding:2px;>No</b>');
				}
				if(d.work_history_allowed == 1){
					$('#WorkHistoryAllowed').html('<b style=background-color:#00FF00;padding:2px;>Yes</b>');
				}else if(d.work_history_allowed == 0){
					$('#WorkHistoryAllowed').html('<b style=background-color:#FF0000;color:#FFFFFF;padding:2px;>No</b>');
				}
				if(d.degree_allowed == 1){
					$('#DegreeAllowed').html('<b style=background-color:#00FF00;padding:2px;>Yes</b>');
				}else if(d.degree_allowed == 0){
					$('#DegreeAllowed').html('<b style=background-color:#FF0000;color:#FFFFFF;padding:2px;>No</b>');
				}
				if(d.age_allowed == 1){
					$('#AgeAllowed').html('<b style=background-color:#00FF00;padding:2px;>Yes</b>');
				}else if(d.age_allowed == 0){
					$('#AgeAllowed').html('<b style=background-color:#FF0000;color:#FFFFFF;padding:2px;>No</b>');
				}
				if(d.d1 == 1){
					$('#Dimension1Allowed').html('<b style=background-color:#00FF00;padding:2px;>Yes</b>');
				}else if(d.d1 == 0){
					$('#Dimension1Allowed').html('<b style=background-color:#FF0000;color:#FFFFFF;padding:2px;>No</b>');
				}
				if(d.d2 == 1){
					$('#Dimension2Allowed').html('<b style=background-color:#00FF00;padding:2px;>Yes</b>');
				}else if(d.d2 == 0){
					$('#Dimension2Allowed').html('<b style=background-color:#FF0000;color:#FFFFFF;padding:2px;>No</b>');
				}
				if(d.d3 == 1){
					$('#Dimension3Allowed').html('<b style=background-color:#00FF00;padding:2px;>Yes</b>');
				}else if(d.d3 == 0){
					$('#Dimension3Allowed').html('<b style=background-color:#FF0000;color:#FFFFFF;padding:2px;>No</b>');
				}
				if(d.d4 == 1){
					$('#Dimension4Allowed').html('<b style=background-color:#00FF00;padding:2px;>Yes</b>');
				}else if(d.d4 == 0){
					$('#Dimension4Allowed').html('<b style=background-color:#FF0000;color:#FFFFFF;padding:2px;>No</b>');
				}
				if(d.d5 == 1){
					$('#Dimension5Allowed').html('<b style=background-color:#00FF00;padding:2px;>Yes</b>');
				}else if(d.d5 == 0){
					$('#Dimension5Allowed').html('<b style=background-color:#FF0000;color:#FFFFFF;padding:2px;>No</b>');
				}
				if(d.d6 == 1){
					$('#Dimension6Allowed').html('<b style=background-color:#00FF00;padding:2px;>Yes</b>');
				}else if(d.d6 == 0){
					$('#Dimension6Allowed').html('<b style=background-color:#FF0000;color:#FFFFFF;padding:2px;>No</b>');
				}
				if(d.d7 == 1){
					$('#Dimension7Allowed').html('<b style=background-color:#00FF00;padding:2px;>Yes</b>');
				}else if(d.d7 == 0){
					$('#Dimension7Allowed').html('<b style=background-color:#FF0000;color:#FFFFFF;padding:2px;>No</b>');
				}
				if(d.d8 == 1){
					$('#Dimension8Allowed').html('<b style=background-color:#00FF00;padding:2px;>Yes</b>');
				}else if(d.d8 == 0){
					$('#Dimension8Allowed').html('<b style=background-color:#FF0000;color:#FFFFFF;padding:2px;>No</b>');
				}
				if(d.d9 == 1){
					$('#Dimension9Allowed').html('<b style=background-color:#00FF00;padding:2px;>Yes</b>');
				}else if(d.d9 == 0){
					$('#Dimension9Allowed').html('<b style=background-color:#FF0000;color:#FFFFFF;padding:2px;>No</b>');
				}
				if(d.d10 == 1){
					$('#Dimension10Allowed').html('<b style=background-color:#00FF00;padding:2px;>Yes</b>');
				}else if(d.d10 == 0){
					$('#Dimension10Allowed').html('<b style=background-color:#FF0000;color:#FFFFFF;padding:2px;>No</b>');
				}
				if(d.d11 == 1){
					$('#Dimension11Allowed').html('<b style=background-color:#00FF00;padding:2px;>Yes</b>');
				}else if(d.d11 == 0){
					$('#Dimension11Allowed').html('<b style=background-color:#FF0000;color:#FFFFFF;padding:2px;>No</b>');
				}
				if(d.d12 == 1){
					$('#Dimension12Allowed').html('<b style=background-color:#00FF00;padding:2px;>Yes</b>');
				}else if(d.d12 == 0){
					$('#Dimension12Allowed').html('<b style=background-color:#FF0000;color:#FFFFFF;padding:2px;>No</b>');
				}
				$('#DiscretizeAllowed').html('<b style=background-color:#000000;color:#FFFFFF;padding:2px;>'+d.discretize+'</b>');
				var source =
				{
					datatype: "json",
					datafields: [
						{ name: 'id' },
						{ name: 'position' },
						{ name: 'support' },
						{ name: 'confidence' },
						{ name: 'assoc_rules' },
						{ name: 'percentage' },
						{ name: 'status' }
					],
					id: '',
					url: 'source/applicant/load_employee_association_rules.php?support='+d.support+"&confidence="+d.confidence
				};
				var Adapter = new $.jqx.dataAdapter(source);
				$('#ApplicantSupportConfidenceEmpAssocRules').jqxGrid({source:Adapter,groups:['position']});
				var sourceA =
				{
					datatype: "json",
					datafields: [
						{ name: 'id' },
						{ name: 'sex' },
						{ name: 'civilstatus' },
						{ name: 'religion' },
						{ name: 'city' },
						{ name: 'province' },
						{ name: 'citizenship' },
						{ name: 'bloodtype' },
						{ name: 'position' },
						{ name: 'dept' },
						{ name: 'work_years_current' },
						{ name: 'work_years_previous' },
						{ name: 'degree' },
						{ name: 'age'},
						{ name: 'd1' },
						{ name: 'd2' },
						{ name: 'd3' },
						{ name: 'd4' },
						{ name: 'd5' },
						{ name: 'd6' },
						{ name: 'd7' },
						{ name: 'd8' },
						{ name: 'd9' },
						{ name: 'd10' },
						{ name: 'd11' },
						{ name: 'd12' }
					],
					id: '',
					url: 'source/applicant/load_desirable_employees.php?dval=0&support='+d.support+"&confidence="+d.confidence+"&discretize="+d.discretize+"&dimensions="+d.d1+","+d.d2+","+d.d3+","+d.d4+","+d.d5+","+d.d6+","+d.d7+","+d.d8+","+d.d9+","+d.d10+","+d.d11+","+d.d12
				};
				var AdapterA = new $.jqx.dataAdapter(sourceA);
				$('#ApplicantAssocDesirableEmp').jqxGrid({source:AdapterA,groups:['position']});
				var sourceB =
				{
					datatype: "json",
					datafields: [
						{ name: 'id' },
						{ name: 'itemset' },
						{ name: 'count' },
						{ name: 'position'}
					],
					id: '',
					url: 'source/applicant/load_itemsets.php?support='+d.support+"&confidence="+d.confidence
				};
				var AdapterB = new $.jqx.dataAdapter(sourceB);
				$('#ApplicantFrequentItemSet').jqxGrid({source:AdapterB,groups:['position']});
			}).css({'border':'0px'});
			$('#ApplicantAssocSplitter').jqxSplitter({
				width:'100%',
				height:'100%',
				panels:[
					{size:'50%'},
					{size:'50%'}
				],
				orientation:'horizontal'
			}).css({'border':'0px'});
			$('#ApplicantAssocSplitterRightTop').jqxSplitter({
				width:'100%',
				height:'100%',
				panels:[
					{size:'60%'},
					{size:'40%'}
				],
				orientation:'vertical'
			}).css({'border':'0px'});
			$('#ApplicantSupportConfidenceEmpAssocRules').jqxGrid({
				width:'100%',
				height:'100%',
				filterable:true,
				showfilterrow:true,
				showtoolbar:true,
				groupable:true,
				showgroupsheader:false,
				groupsexpandedbydefault:false,
				rendertoolbar:function(toolbar){
					var container = $('<div style=margin:5px;></div>');
					container.append("Association Rules of Employee per position");
					toolbar.append(container);
				},
				columns:[
					{text:'ID',dataField:'id',hidden:true},
					{text:'',dataField:'position',width:'300px',pinned:true},
					{text:'Rule Selection',dataField:'status',width:'150px',pinned:true},
					{text:'%',dataField:'percentage',width:'100px',pinned:true},
					{text:'Association Rules',dataField:'assoc_rules',width:'800px'}
				],
				groups:['position']
			}).css({'border':'0px'});
			$('#ApplicantFrequentItemSet').jqxGrid({
				width:'100%',
				height:'100%',
				filterable:true,
				showfilterrow:true,
				showtoolbar:true,
				groupable:true,
				showgroupsheader:false,
				groupsexpandedbydefault:false,
				rendertoolbar:function(toolbar){
					var container = $('<div style=margin:5px;></div>');
					container.append("Frequent Itemsets");
					toolbar.append(container);
				},
				columns:[
					{text:'ID',dataField:'id',hidden:true},
					{text:'',dataField:'position',width:'250px',pinned:true},
					{text:'Item Set',dataField:'itemset',width:'350px'},
					{text:'Count',dataField:'count',width:'200px'}
				],
				groups:['position']
			}).css({'border':'0px'});
			$('#ApplicantAssocDesirableEmp').jqxGrid({
				width:'100%',
				height:'100%',
				filterable:true,
				showfilterrow:true,
				showtoolbar:true,
				groupable:true,
				showgroupsheader:false,
				groupsexpandedbydefault:false,
				toolbarheight:60,
				rendertoolbar:function(toolbar){
					var html = "<table style='width:400px;'>";
					html += "<tr>";
					html += "<td colspan=3>Frequent Employee Profile by Rules</td>";
					html += "</tr>";
					html += "<tr>";
					html += "<td style='width:150px;'>Select Discretize Value</td><td><div id=D1FilterDiscrete></div></td>";
					html += "<td style='width:80px'><button id=UseEmployeeDataForNaiveBtn>Use Employee Data</button></td>";
					html += "<td><div id=UseEmployeeDataForNaiveWin><div>Tagging Employee Data</div><div><table style='width:100%;table-layout:fixed;'><tr><td id=TotalTagEmpBar>Tagging:</td></tr><tr><td><div id=UseEmployeeDataForNaiveProgressBar></div></td></tr></table></div></div></td>";
					// html += "<td>D4<div id=D4FilterDiscrete></div></td>";
					// html += "<td>D5<div id=D5FilterDiscrete></div></td>";
					// html += "<td>D6<div id=D6FilterDiscrete></div></td>";
					// html += "<td>D7<div id=D7FilterDiscrete></div></td>";
					// html += "<td>D8<div id=D8FilterDiscrete></div></td>";
					// html += "<td>D9<div id=D9FilterDiscrete></div></td>";
					// html += "<td>D10<div id=D10FilterDiscrete></div></td>";
					// html += "<td>D11<div id=D11FilterDiscrete></div></td>";
					// html += "<td>D12<div id=D12FilterDiscrete></div></td>";
					
					html += "</tr>";
					html += "</table>";
					var container = $('<div style=margin:5px;></div>');
					container.append(html);
					toolbar.append(container);
					
					$('#D1FilterDiscrete').jqxDropDownList({ 
						displayMember: "val",
						valueMember: "id",
						width:'150px',
					}).on('open',function(){
						var d = $('#ApplicantSupportConfidenceGrid').jqxGrid('getrowdata',$('#ApplicantSupportConfidenceGrid').jqxGrid('getselectedrowindex'));
						var source =
						{
							datatype: "json",
							datafields: [
								{ name: 'id' },
								{ name: 'val' }
							],
							id: '',
							url: 'source/applicant/load_discreetize_list.php?val='+d.discretize
						};
						var Adapter = new $.jqx.dataAdapter(source);
						$(this).jqxDropDownList({ source: Adapter});
					}).on('close',function(){
						var d = $('#ApplicantSupportConfidenceGrid').jqxGrid('getrowdata',$('#ApplicantSupportConfidenceGrid').jqxGrid('getselectedrowindex'));
						var sourceA =
						{
							datatype: "json",
							datafields: [
								{ name: 'id' },
								{ name: 'sex' },
								{ name: 'civilstatus' },
								{ name: 'religion' },
								{ name: 'city' },
								{ name: 'province' },
								{ name: 'citizenship' },
								{ name: 'bloodtype' },
								{ name: 'position' },
								{ name: 'dept' },
								{ name: 'work_years_current' },
								{ name: 'work_years_previous' },
								{ name: 'degree' },
								{ name: 'age'},
								{ name: 'd1' },
								{ name: 'd2' },
								{ name: 'd3' },
								{ name: 'd4' },
								{ name: 'd5' },
								{ name: 'd6' },
								{ name: 'd7' },
								{ name: 'd8' },
								{ name: 'd9' },
								{ name: 'd10' },
								{ name: 'd11' },
								{ name: 'd12' }
							],
							id: '',
							url: 'source/applicant/load_desirable_employees.php?dval='+$('#D1FilterDiscrete').val()+'&support='+d.support+"&confidence="+d.confidence+"&discretize="+d.discretize+"&dimensions="+d.d1+","+d.d2+","+d.d3+","+d.d4+","+d.d5+","+d.d6+","+d.d7+","+d.d8+","+d.d9+","+d.d10+","+d.d11+","+d.d12
						};
						var AdapterA = new $.jqx.dataAdapter(sourceA);
						$('#ApplicantAssocDesirableEmp').jqxGrid({source:AdapterA,groups:['position']});
					});
					$('#UseEmployeeDataForNaiveBtn').jqxButton().on('click',function(){
						$('#UseEmployeeDataForNaiveWin').jqxWindow('open');	
						var promises = [];
						var rows = $('#ApplicantAssocDesirableEmp').jqxGrid('getrows');
						var d = $('#ApplicantSupportConfidenceGrid').jqxGrid('getrowdata',$('#ApplicantSupportConfidenceGrid').jqxGrid('getselectedrowindex'));
						$('#TotalTagEmpBar').html("<b>Acquiring list of employees</b>");
						$.ajax({
							url:'source/applicant/clear_employee_associated_status.php',
							type:'POST',
							data:{
								id:d.id
							},
							beforeSend:function(){
								//$('#TotalTagEmpBar').html("<b>Saving list of employees</b>");
							},
							success:function(){
								
							},
							complete:function(){
								var tempo = new Array();
								for (var i = 0; i < rows.length; i++){ 
									tempo[i] = rows[i].id 
								}
								var lists = tempo.join(',');
								var request =  $.ajax({
												url:'source/applicant/update_employee_associated_status.php',
												type:'POST',
												data:{
													id:lists,
													support:d.support,
													confidence:d.confidence
												},
												beforeSend:function(){
													//$('#TotalTagEmpBar').html("<b>Saving list of employees</b>");
												},
												success:function(){
													
												},
												complete:function(){
													$('#ApplicantSupportConfidenceGrid').jqxGrid({source:AdapterSupCon});
												}
											});
											
								   promises.push( request);
							}
						});
						

						$.when.apply(null, promises).done(function(){
						   var rows = $('#ApplicantAssocDesirableEmp').jqxGrid('getrows');
							$('#TotalTagEmpBar').html("<b>Tagging:"+rows.length+" employees</b>");
						   $('#UseEmployeeDataForNaiveProgressBar').jqxProgressBar({ animationDuration:3000,value:100}).on('complete',function(){
								setTimeout(function(){
									$('#UseEmployeeDataForNaiveWin').jqxWindow('close');
								},4000);
								
						   });
						});
						// setTimeout(function(){
							// var rows = $('#ApplicantAssocDesirableEmp').jqxGrid('getrows');
							// $('#TotalTagEmpBar').html("Tagging:"+rows.length+" employees");
							// for (var i = 0; i < rows.length; i++) {

								
								// $.ajax({
									// url:'source/applicant/update_employee_associated_status.php',
									// type:'POST',
									// data:{
										// id:id
									// },
									// beforeSend:function(){
										// $('#UseEmployeeDataForNaiveProgressBar').jqxProgressBar({ value: i+1});
										//$('#TagEmpBar').html(i);
									// },
									// success:function(){
										
									// },
									// complete:function(){
										
									// }
								// });

								// if((i+1) == rows.length){
									// $('#UseEmployeeDataForNaiveWin').jqxWindow('close');
								// }else{
									
								// }
							// }
						// },3000);
					});
					$('#UseEmployeeDataForNaiveWin').jqxWindow({
						width:'350px',
						height:'90px',
						autoOpen:false,
						modalOpacity:0.7,
						isModal:true,
						resizable:false,
						showCloseButton:false
					}).on('open',function(){
							
					}).on('close',function(){
						$('#UseEmployeeDataForNaiveProgressBar').jqxProgressBar({ value:0});
					});
					$('#UseEmployeeDataForNaiveProgressBar').jqxProgressBar({ width:'100%', height: 20, value: 0});
					// $('#D2FilterDiscrete').jqxDropDownList({ 
						// displayMember: "val",
						// valueMember: "id",
						// width:'50px',
					// }).on('open',function(){
						// var d = $('#ApplicantSupportConfidenceGrid').jqxGrid('getrowdata',$('#ApplicantSupportConfidenceGrid').jqxGrid('getselectedrowindex'));
						// var source =
						// {
							// datatype: "json",
							// datafields: [
								// { name: 'id' },
								// { name: 'val' }
							// ],
							// id: '',
							// url: 'source/applicant/load_discreetize_list.php?val='+d.discreetize
						// };
						// var Adapter = new $.jqx.dataAdapter(source);
						// $(this).jqxDropDownList({ source: Adapter});
					// });
					// $('#D3FilterDiscrete').jqxDropDownList({ 
						// displayMember: "val",
						// valueMember: "id",
						// width:'50px',
					// }).on('open',function(){
						// var d = $('#ApplicantSupportConfidenceGrid').jqxGrid('getrowdata',$('#ApplicantSupportConfidenceGrid').jqxGrid('getselectedrowindex'));
						// var source =
						// {
							// datatype: "json",
							// datafields: [
								// { name: 'id' },
								// { name: 'val' }
							// ],
							// id: '',
							// url: 'source/applicant/load_discreetize_list.php?val='+d.discreetize
						// };
						// var Adapter = new $.jqx.dataAdapter(source);
						// $(this).jqxDropDownList({ source: Adapter});
					// });
					// $('#D4FilterDiscrete').jqxDropDownList({ 
						// displayMember: "val",
						// valueMember: "id",
						// width:'50px',
					// }).on('open',function(){
						// var d = $('#ApplicantSupportConfidenceGrid').jqxGrid('getrowdata',$('#ApplicantSupportConfidenceGrid').jqxGrid('getselectedrowindex'));
						// var source =
						// {
							// datatype: "json",
							// datafields: [
								// { name: 'id' },
								// { name: 'val' }
							// ],
							// id: '',
							// url: 'source/applicant/load_discreetize_list.php?val='+d.discreetize
						// };
						// var Adapter = new $.jqx.dataAdapter(source);
						// $(this).jqxDropDownList({ source: Adapter});
					// });
					// $('#D5FilterDiscrete').jqxDropDownList({ 
						// displayMember: "val",
						// valueMember: "id",
						// width:'50px',
					// }).on('open',function(){
						// var d = $('#ApplicantSupportConfidenceGrid').jqxGrid('getrowdata',$('#ApplicantSupportConfidenceGrid').jqxGrid('getselectedrowindex'));
						// var source =
						// {
							// datatype: "json",
							// datafields: [
								// { name: 'id' },
								// { name: 'val' }
							// ],
							// id: '',
							// url: 'source/applicant/load_discreetize_list.php?val='+d.discreetize
						// };
						// var Adapter = new $.jqx.dataAdapter(source);
						// $(this).jqxDropDownList({ source: Adapter});
					// });
					// $('#D6FilterDiscrete').jqxDropDownList({ 
						// displayMember: "val",
						// valueMember: "id",
						// width:'50px',
					// }).on('open',function(){
						// var d = $('#ApplicantSupportConfidenceGrid').jqxGrid('getrowdata',$('#ApplicantSupportConfidenceGrid').jqxGrid('getselectedrowindex'));
						// var source =
						// {
							// datatype: "json",
							// datafields: [
								// { name: 'id' },
								// { name: 'val' }
							// ],
							// id: '',
							// url: 'source/applicant/load_discreetize_list.php?val='+d.discreetize
						// };
						// var Adapter = new $.jqx.dataAdapter(source);
						// $(this).jqxDropDownList({ source: Adapter});
					// });
					// $('#D7FilterDiscrete').jqxDropDownList({ 
						// displayMember: "val",
						// valueMember: "id",
						// width:'50px',
					// }).on('open',function(){
						// var d = $('#ApplicantSupportConfidenceGrid').jqxGrid('getrowdata',$('#ApplicantSupportConfidenceGrid').jqxGrid('getselectedrowindex'));
						// var source =
						// {
							// datatype: "json",
							// datafields: [
								// { name: 'id' },
								// { name: 'val' }
							// ],
							// id: '',
							// url: 'source/applicant/load_discreetize_list.php?val='+d.discreetize
						// };
						// var Adapter = new $.jqx.dataAdapter(source);
						// $(this).jqxDropDownList({ source: Adapter});
					// });
					// $('#D8FilterDiscrete').jqxDropDownList({ 
						// displayMember: "val",
						// valueMember: "id",
						// width:'50px',
					// }).on('open',function(){
						// var d = $('#ApplicantSupportConfidenceGrid').jqxGrid('getrowdata',$('#ApplicantSupportConfidenceGrid').jqxGrid('getselectedrowindex'));
						// var source =
						// {
							// datatype: "json",
							// datafields: [
								// { name: 'id' },
								// { name: 'val' }
							// ],
							// id: '',
							// url: 'source/applicant/load_discreetize_list.php?val='+d.discreetize
						// };
						// var Adapter = new $.jqx.dataAdapter(source);
						// $(this).jqxDropDownList({ source: Adapter});
					// });
					// $('#D9FilterDiscrete').jqxDropDownList({ 
						// displayMember: "val",
						// valueMember: "id",
						// width:'50px',
					// }).on('open',function(){
						// var d = $('#ApplicantSupportConfidenceGrid').jqxGrid('getrowdata',$('#ApplicantSupportConfidenceGrid').jqxGrid('getselectedrowindex'));
						// var source =
						// {
							// datatype: "json",
							// datafields: [
								// { name: 'id' },
								// { name: 'val' }
							// ],
							// id: '',
							// url: 'source/applicant/load_discreetize_list.php?val='+d.discreetize
						// };
						// var Adapter = new $.jqx.dataAdapter(source);
						// $(this).jqxDropDownList({ source: Adapter});
					// });
					// $('#D10FilterDiscrete').jqxDropDownList({ 
						// displayMember: "val",
						// valueMember: "id",
						// width:'50px',
					// }).on('open',function(){
						// var d = $('#ApplicantSupportConfidenceGrid').jqxGrid('getrowdata',$('#ApplicantSupportConfidenceGrid').jqxGrid('getselectedrowindex'));
						// var source =
						// {
							// datatype: "json",
							// datafields: [
								// { name: 'id' },
								// { name: 'val' }
							// ],
							// id: '',
							// url: 'source/applicant/load_discreetize_list.php?val='+d.discreetize
						// };
						// var Adapter = new $.jqx.dataAdapter(source);
						// $(this).jqxDropDownList({ source: Adapter});
					// });
					// $('#D11FilterDiscrete').jqxDropDownList({ 
						// displayMember: "val",
						// valueMember: "id",
						// width:'50px',
					// }).on('open',function(){
						// var d = $('#ApplicantSupportConfidenceGrid').jqxGrid('getrowdata',$('#ApplicantSupportConfidenceGrid').jqxGrid('getselectedrowindex'));
						// var source =
						// {
							// datatype: "json",
							// datafields: [
								// { name: 'id' },
								// { name: 'val' }
							// ],
							// id: '',
							// url: 'source/applicant/load_discreetize_list.php?val='+d.discreetize
						// };
						// var Adapter = new $.jqx.dataAdapter(source);
						// $(this).jqxDropDownList({ source: Adapter});
					// });
					// $('#D12FilterDiscrete').jqxDropDownList({ 
						// displayMember: "val",
						// valueMember: "id",
						// width:'50px',
					// }).on('open',function(){
						// var d = $('#ApplicantSupportConfidenceGrid').jqxGrid('getrowdata',$('#ApplicantSupportConfidenceGrid').jqxGrid('getselectedrowindex'));
						// var source =
						// {
							// datatype: "json",
							// datafields: [
								// { name: 'id' },
								// { name: 'val' }
							// ],
							// id: '',
							// url: 'source/applicant/load_discreetize_list.php?val='+d.discreetize
						// };
						// var Adapter = new $.jqx.dataAdapter(source);
						// $(this).jqxDropDownList({ source: Adapter});
					// });
				},
				columns:[
					{text:'ID',dataField:'id',hidden:true},
					{text:'Sex',dataField:'sex',width:'80px'},
					{text:'Civil Status',dataField:'civilstatus',width:'100px'},
					{text:'Religion',dataField:'religion',width:'100px'},
					{text:'City',dataField:'city',width:'150px'},
					{text:'Province',dataField:'province',width:'300px'},
					{text:'Citizenship',dataField:'citizenship',width:'100px'},
					{text:'Blood Type',dataField:'bloodtype',width:'80px'},
					{text:'',dataField:'position',width:'300px',pinned:true},
					{text:'Dept',dataField:'dept',width:'300px'},
					{text:'#of Work Years(current)',dataField:'work_years_current',width:'250px'},
					{text:'#of Work Years(previous)',dataField:'work_years_previous',width:'250px'},
					{text:'Educational Attainment',dataField:'degree',width:'150px'},
				],
				groups:['position']
			}).css({'border':'0px'});
			$('#ApplicantDesirabilitySplitter').jqxSplitter({
				width:'100%',
				height:'100%',
				panels:[
					{size:'250px'},
					{size:''}
				],
				orientation:'vertical'
			}).css({'border':'0px'});
			$('#ApplicantDesirabilitySplitterRight').jqxSplitter({
				width:'100%',
				height:'100%',
				panels:[
					{size:'60%'},
					{size:'40%'}
				],
				orientation:'horizontal'
			}).css({'border':'0px'});
			
			
			var sourceApplicantList =
			{
				datatype: "json",
				datafields: [
					{ name: 'id' },
					{ name: 'position' ,type:'string'}
				],
				id: '',
				url: 'source/applicant/load_applicant_profile.php?type=0'
			};
			var AdapterApplicantList = new $.jqx.dataAdapter(sourceApplicantList);
			$('#ApplicantDesirabilityPosition').jqxGrid({
				width:'100%',
				height:'100%',
				source:AdapterApplicantList,
				filterable:true,
				showfilterrow:true,
				showtoolbar:true,
				groupable:true,
				showgroupsheader:false,
				groupsexpandedbydefault:false,
				rendertoolbar:function(toolbar){
					var html = "<table style='width:100%;'>";
					html += "<tr>";
					html += "<td><button id=AddNewApplicantBtn>Add</button><div id=AddNewApplicantWin><div></div><div></div></div></td>";
					html += "<td><button id=RefreshNewApplicantBtn>Reload</button></td>";
					html += "<td><button id=ViewApplicantExamResultBtn>Records</button><div id=ViewApplicantExamResultWin><div></div><div></div></div></td>";
					html += "</tr>";
					html += "</table>";
					var container = $('<div style=margin:5px;></div>');
					container.append(html);
					toolbar.append(container);
					$('#AddNewApplicantBtn').jqxButton().on('click',function(){
						$('#AddNewApplicantWin').jqxWindow('open');
					});
					$('#RefreshNewApplicantBtn').jqxButton().on('click',function(){
						var sourceApplicantList =
						{
							datatype: "json",
							datafields: [
								{ name: 'id' },
								{ name: 'position' ,type:'string'}
							],
							id: '',
							url: 'source/applicant/load_applicant_profile.php?type=0'
						};
						var AdapterApplicantList = new $.jqx.dataAdapter(sourceApplicantList);
						$('#ApplicantDesirabilityPosition').jqxGrid({source:AdapterApplicantList});
					});
					$('#AddNewApplicantWin').jqxWindow({
						width:'400px',
						height:'475px',
						isModal:true,
						autoOpen:false,
						modalOpacity:0.7,
						initContent:function(){
							var title = "New Applicant Profile";
							var content = "<table style='width:100%'>";
							content += "<tr>";
								content += "<td style='width:120px;'>Application Date</td>";
								content += "<td><div id=AppDate></div></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td style='width:120px;'>First Name</td>";
								content += "<td><input id=AppFname></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Middle Name</td>";
								content += "<td><input id=AppMname></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Last Name</td>";
								content += "<td><input id=AppLname></td>";
							content += "</tr>";
							content += "<tr>";
							content += "<tr>";
								content += "<td>Sex</td>";
								content += "<td><div id=AppSex></div></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Civil Status</td>";
								content += "<td><div id=AppCivilstatus></div></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Religion</td>";
								content += "<td><div id=AppReligion></div></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>City</td>";
								content += "<td><div id=AppCity></div></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Province</td>";
								content += "<td><div id=AppProvince></div></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Citizenship</td>";
								content += "<td><div id=AppCitizenship></div></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Blood Type</td>";
								content += "<td><div id=AppBloodtype></div></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Position</td>";
								content += "<td><div id=AppPosition></div></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Department</td>";
								content += "<td><div id=AppDepartment></div></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Work History</td>";
								content += "<td><div id=AppWorkhistory></div></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Educational Attainment</td>";
								content += "<td><div id=AppDegree></div></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td>Age</td>";
								content += "<td><input id=AppAge></div></td>";
							content += "</tr>";
							content += "<tr>";
								content += "<td></td>";
								content += "<td><button id=SubmitNewApplicantBtn>Submit</button></td>";
							content += "</tr>";
							content += "</table>";
							$('#AddNewApplicantWin').jqxWindow('setTitle',title);
							$('#AddNewApplicantWin').jqxWindow('setContent',content);
							$('#AppDate').jqxDateTimeInput({ width: '100%',height:'20px',formatString:'yyyy-MM-dd'});
							$('#AppFname').jqxInput({width:'100%',height:25});
							$('#AppMname').jqxInput({width:'100%',height:25});
							$('#AppLname').jqxInput({width:'100%',height:25});
							$('#AppAge').jqxInput({width:'100%',height:25});
							$('#AppSex').jqxDropDownList({ 
								displayMember: "val",
								valueMember: "id",
								width:'100%',
							}).on('open',function(){
								var source =
								{
									datatype: "json",
									datafields: [
										{ name: 'id' },
										{ name: 'val' }
									],
									id: '',
									url: 'source/applicant/load_sex_list.php'
								};
								var Adapter = new $.jqx.dataAdapter(source);
								$(this).jqxDropDownList({ source: Adapter});
							});
							$('#AppCivilstatus').jqxDropDownList({ 
								displayMember: "val",
								valueMember: "id",
								width:'100%',
							}).on('open',function(){
								var source =
								{
									datatype: "json",
									datafields: [
										{ name: 'id' },
										{ name: 'val' }
									],
									id: '',
									url: 'source/applicant/load_civilstatus_list.php'
								};
								var Adapter = new $.jqx.dataAdapter(source);
								$(this).jqxDropDownList({ source: Adapter});
							});
							$('#AppReligion').jqxDropDownList({ 
								displayMember: "val",
								valueMember: "id",
								width:'100%',
							}).on('open',function(){
								var source =
								{
									datatype: "json",
									datafields: [
										{ name: 'id' },
										{ name: 'val' }
									],
									id: '',
									url: 'source/applicant/load_religion_list.php'
								};
								var Adapter = new $.jqx.dataAdapter(source);
								$(this).jqxDropDownList({ source: Adapter});
							});
							$('#AppCity').jqxDropDownList({ 
								displayMember: "val",
								valueMember: "id",
								width:'100%',
							}).on('open',function(){
								var source =
								{
									datatype: "json",
									datafields: [
										{ name: 'id' },
										{ name: 'val' }
									],
									id: '',
									url: 'source/applicant/load_city_list.php'
								};
								var Adapter = new $.jqx.dataAdapter(source);
								$(this).jqxDropDownList({ source: Adapter});
							});
							$('#AppProvince').jqxDropDownList({ 
								displayMember: "val",
								valueMember: "id",
								width:'100%',
							}).on('open',function(){
								var source =
								{
									datatype: "json",
									datafields: [
										{ name: 'id' },
										{ name: 'val' }
									],
									id: '',
									url: 'source/applicant/load_province_list.php'
								};
								var Adapter = new $.jqx.dataAdapter(source);
								$(this).jqxDropDownList({ source: Adapter});
							});
							$('#AppCitizenship').jqxDropDownList({ 
								displayMember: "val",
								valueMember: "id",
								width:'100%',
							}).on('open',function(){
								var source =
								{
									datatype: "json",
									datafields: [
										{ name: 'id' },
										{ name: 'val' }
									],
									id: '',
									url: 'source/applicant/load_citizenship_list.php'
								};
								var Adapter = new $.jqx.dataAdapter(source);
								$(this).jqxDropDownList({ source: Adapter});
							});
							$('#AppBloodtype').jqxDropDownList({ 
								displayMember: "val",
								valueMember: "id",
								width:'100%',
							}).on('open',function(){
								var source =
								{
									datatype: "json",
									datafields: [
										{ name: 'id' },
										{ name: 'val' }
									],
									id: '',
									url: 'source/applicant/load_bloodtype_list.php'
								};
								var Adapter = new $.jqx.dataAdapter(source);
								$(this).jqxDropDownList({ source: Adapter});
							});
							$('#AppPosition').jqxDropDownList({ 
								displayMember: "val",
								valueMember: "id",
								width:'100%',
							}).on('open',function(){
								var source =
								{
									datatype: "json",
									datafields: [
										{ name: 'id' },
										{ name: 'val' }
									],
									id: '',
									url: 'source/applicant/load_position_list.php'
								};
								var Adapter = new $.jqx.dataAdapter(source);
								$(this).jqxDropDownList({ source: Adapter});
							});
							$('#AppDepartment').jqxDropDownList({ 
								displayMember: "val",
								valueMember: "id",
								width:'100%',
							}).on('open',function(){
								var source =
								{
									datatype: "json",
									datafields: [
										{ name: 'id' },
										{ name: 'val' }
									],
									id: '',
									url: 'source/applicant/load_department_list.php'
								};
								var Adapter = new $.jqx.dataAdapter(source);
								$(this).jqxDropDownList({ source: Adapter});
							});
							$('#AppWorkhistory').jqxDropDownList({ 
								displayMember: "val",
								valueMember: "id",
								width:'100%',
							}).on('open',function(){
								var source =
								{
									datatype: "json",
									datafields: [
										{ name: 'id' },
										{ name: 'val' }
									],
									id: '',
									url: 'source/applicant/load_workhistory_list.php'
								};
								var Adapter = new $.jqx.dataAdapter(source);
								$(this).jqxDropDownList({ source: Adapter});
							});
							$('#AppDegree').jqxDropDownList({ 
								displayMember: "val",
								valueMember: "id",
								width:'100%',
							}).on('open',function(){
								var source =
								{
									datatype: "json",
									datafields: [
										{ name: 'id' },
										{ name: 'val' }
									],
									id: '',
									url: 'source/applicant/load_degree_list.php'
								};
								var Adapter = new $.jqx.dataAdapter(source);
								$(this).jqxDropDownList({ source: Adapter});
							});
							$('#SubmitNewApplicantBtn').jqxButton().on('click',function(){
								$.ajax({
									url:'source/applicant/add_applicant_profile.php',
									type:'POST',
									data:{
										date:$('#AppDate').val(),
										fname:$('#AppFname').val(),
										mname:$('#AppMname').val(),
										lname:$('#AppLname').val(),
										sex:$('#AppSex').val(),
										civilstatus:$('#AppCivilstatus').val(),
										religion:$('#AppReligion').val(),
										city:$('#AppCity').val(),
										province:$('#AppProvince').val(),
										citizenship:$('#AppCitizenship').val(),
										bloodtype:$('#AppBloodtype').val(),
										position:$('#AppPosition').val(),
										department:$('#AppDepartment').val(),
										workhistory:$('#AppWorkhistory').val(),
										degree:$('#AppDegree').val(),
										age:$('#AppAge').val()
									},
									success:function(edata){
										// var result = edata.split(',');

										// console.log(result);
										// $.ajax({
											// url:'http://localhost:8080/',
											// data:{
												// support:result[2],
												// confidence:result[3],
												// position:"'"+result[1]+"'",
												// applicant:result[0]
											// },
											// type:'GET',
											// success:function(){
												
											// },
											// complete:function(){
												
											// }
										// });
										$.ajax({
											url:'source/php_ml/src/Classification/test.php',
											data:{
												
											},
											type:'GET',
											success:function(){
												
											},
											complete:function(){
												
											}
										});
										
									},
									complete:function(){
										$('#AddNewApplicantWin').jqxWindow('close');
										var sourceApplicantList =
										{
											datatype: "json",
											datafields: [
												{ name: 'id' },
												{ name: 'position' ,type:'string'}
											],
											id: '',
											url: 'source/applicant/load_applicant_profile.php?type=0'
										};
										var AdapterApplicantList = new $.jqx.dataAdapter(sourceApplicantList);
										$('#ApplicantDesirabilityPosition').jqxGrid({source:AdapterApplicantList});
									}
								});
							});
						}
					});
					$('#ViewApplicantExamResultBtn').jqxButton().on('click',function(){
						var rowIndexes = $('#ApplicantDesirabilityPosition').jqxGrid('selectedrowindexes');
						var temp = new Array();
						for (var i = 0; i < rowIndexes.length; i++) {
							var currentId =$('#ApplicantDesirabilityPosition').jqxGrid('getrowdata', rowIndexes[i]);
							temp[i] = currentId.id;
						};
						var test = temp.join(',');
						//alert(test);
						$('#ViewApplicantExamResultWin').jqxWindow('open');
					});
					$('#ViewApplicantExamResultWin').jqxWindow({
						width:'90%',
						maxWidth:(($(window).innerWidth() * 100)/100),
						height:'90%',
						maxHeight:(($(window).innerHeight() * 100)/100),
						isModal:true,
						autoOpen:false,
						modalOpacity:0.7,
						initContent:function(){
							var title = "Records";
							var content = "<div id=ViewApplicantExamResultSplitter>";
								content += "<div>";
									content += "<div id=ViewApplicantExamResultGrid></div>";
								content += "</div>";
								content += "<div id=textpdf style='height:100%;'></div>";
							content += "</div>";
							$('#ViewApplicantExamResultWin').jqxWindow('setTitle',title);
							$('#ViewApplicantExamResultWin').jqxWindow('setContent',content);
							$('#ViewApplicantExamResultSplitter').jqxSplitter({
								width:'100%',
								height:'100%',
								panels:[
									{size:'20%'},
									{size:'80%'}
								],
								orientation:'vertical'
							}).css({'border':'0px'});
							$('#ViewApplicantExamResultGrid').jqxGrid({
								width:'100%',
								height:'100%',
								filterable:true,
								showfilterrow:true,
								showtoolbar:true,
								rendertoolbar:function(toolbar){
									var html = "<table style='width:100%;'>";
									html += "<tr>";
									html += "<td><button id=AddApplicantAttachmentBtn style='margin:5px;'>Add Attachment</button></td>";
									html += "<td><button id=RemoveApplicantAttachmentBtn style='margin:5px;'>Remove</button></td>";
									html += "</tr>";
									html += "</table>";
									html += "<div id=AddApplicantAttachmentWin><div></div><div></div></div>";
									html += "<div id=ViewAddApplicantAttachmentUploadWin><div></div><div></div></div>";
									html += "<div id=RemoveApplicantAttachmentWin><div></div><div></div></div>";
									var container = $("<div></div>");
									container.append(html);
									toolbar.append(container);
									$('#AddApplicantAttachmentBtn').jqxButton().on('click',function(){
										$('#AddApplicantAttachmentWin').jqxWindow('open');
									});
									$('#AddApplicantAttachmentWin').jqxWindow({
										width:'50%',
										maxWidth:(($(window).innerWidth() * 100)/100),
										height:'50%',
										maxHeight:(($(window).innerHeight() * 100)/100),
										autoOpen:false,
										isModal:true,
										modalOpacity:0.7,
										draggable: false,
										showCloseButton:true,
										resizable:false,
										initContent:function(){
											var title = 'Add Applicant Attachment';
											var html = "<table style='width:100%;'>";
											html += "<tr>";
											html += "<td>Attachment Type</td><td><div id=AddApplicantAttachmentType></div></td>";
											html += "</tr>";
											html += "<tr>";
											html += "<td>Upload File</td><td><div id=AddApplicantAttachmentUpload></div></td>";
											html += "</tr>";
											
											html += "</table>";
											$('#AddApplicantAttachmentWin').jqxWindow('setTitle',title);
											$('#AddApplicantAttachmentWin').jqxWindow('setContent',html);
											$('#AddApplicantAttachmentType').jqxDropDownList({ 
												displayMember: "attachment_type",
												valueMember: "id",
												height: '25px',
											}).on('open',function(){
												var source =
												{
													datatype: "json",
													datafields: [
														{ name: 'id' },
														{ name: 'attachment_type' }
													],
													id: '',
													url: 'source/applicant/load_attachment_type.php'
												};
												var Adapter = new $.jqx.dataAdapter(source);
												$(this).jqxDropDownList({ source: Adapter});
											});
											$('#AddApplicantAttachmentUpload').jqxFileUpload({
												uploadUrl: 'source/applicant/upload_applicant_attachment.php',
												fileInputName: 'fileToUpload'
											}).on('uploadStart',function(e){
												var args = e.args;
												var fileName = args.file;
												//console.log(e,args);
												//$('#ApplicantUploadAttachmentStatus').html("Uploading:"+fileName);
											}).on('uploadEnd',function(e){
												var args = e.args;
												var fileName = args.file;
												var serverResponse = args.response;
												// Your code here.
												//console.log(args+" > "+fileName+" > "+serverResponse);
												//$('#UploadApplicantIDReference').val();
												if(serverResponse == 1){
													var attachment_type = $('#AddApplicantAttachmentType').jqxDropDownList('getSelectedItem');
													var id = $('#ApplicantDesirabilityPosition').jqxGrid('getrowdata',$('#ApplicantDesirabilityPosition').jqxGrid('getselectedrowindex'));
													$.ajax({
														url:'source/applicant/add_applicant_attachment.php',
														type:'POST',
														data:{
															applicant_id:id.id,
															attachment_type_id:attachment_type.value,
															filename:fileName
														},
														beforeSend:function(){
															
														},
														success:function(){
															$('#AddApplicantAttachmentWin').jqxWindow('close');
															var id = $('#ApplicantDesirabilityPosition').jqxGrid('getrowdata',$('#ApplicantDesirabilityPosition').jqxGrid('getselectedrowindex'));
															// var HRApplicantAttachmentsource =
															// {
																// datatype: "json",
																// datafields: [
																	// { name: 'id' },
																	// { name:	'attachment_type'},
																	// { name: 'directory' },
																	// { name: 'filename' }
																// ],
																// id: '',
																// url: 'source/hr/tab1/database/applicant_attachment/load_applicant_attachment.php?id='+id.id
															// };
															// var HRApplicantAttachmentAdapter = new $.jqx.dataAdapter(HRApplicantAttachmentsource);
															// $('#ApplicantAttachmentGrid').jqxGrid({source:HRApplicantAttachmentAdapter});
														},
														complete:function(){
															
														}
													});
													//$('#ApplicantUploadAttachmentStatus').html('');
												}else{
													alert(serverResponse);
												}
												
											});
											
										}
									});
									$('#RemoveApplicantAttachmentBtn').jqxButton().on('click',function(){
										$('#RemoveApplicantAttachmentWin').jqxWindow('open');
									});
									$('#RemoveApplicantAttachmentWin').jqxWindow({
										width:'300px',
										maxWidth:(($(window).innerWidth() * 100)/100),
										height:'80px',
										maxHeight:(($(window).innerHeight() * 100)/100),
										autoOpen:false,
										isModal:true,
										modalOpacity:0.7,
										draggable: false,
										showCloseButton:true,
										resizable:false,
										initContent:function(){
											var title = 'Remove Applicant Attachment';
											var html = "<button id=ConfirmRemoveApplicantAttachmentBtn>Remove Attachment</button>";
											$('#RemoveApplicantAttachmentWin').jqxWindow('setTitle',title);
											$('#RemoveApplicantAttachmentWin').jqxWindow('setContent',html);
											$('#ConfirmRemoveApplicantAttachmentBtn').jqxButton({width:'100%'}).on('click',function(){
												var id = $('#ApplicantDesirabilityPosition').jqxGrid('getrowdata',$('#ApplicantDesirabilityPosition').jqxGrid('getselectedrowindex'));
												var attach = $('#ViewApplicantExamResultGrid').jqxGrid('getrowdata',$('#ViewApplicantExamResultGrid').jqxGrid('getSelectedrowindex'));
												$.ajax({
													url:'source/applicant/delete_applicant_attachment.php',
													data:{
														id:attach.id
													},
													type:'POST',
													success:function(){
														
													},
													complete:function(){
														
														var source =
														{
															datatype: "json",
															datafields: [
																{ name: 'id' },
																{ name: 'attachment_type' ,type:'string'},
																{ name: 'directory' ,type:'string'},
																{ name: 'filename' ,type:'string'}
															],
															id: '',
															url: 'source/applicant/load_applicant_attachment_type.php?applicant_profile_id='+id.id
														};
														var Adapter = new $.jqx.dataAdapter(source);
														$('#ViewApplicantExamResultGrid').jqxGrid({source:Adapter}).on('bindingcomplete',function(){
															$('#ViewApplicantExamResultGrid').jqxGrid('clearselection');
															$('#RemoveApplicantAttachmentWin').jqxWindow('close');
														});
													}
												});
											});
										}
									});
								},
								columns:[
									{text:'ID',datafield:'id',hidden:true},
									{text:'Attachment Type',datafield:'attachment_type',width:'100%'},
								]
							}).on('rowdoubleclick',function(e){
								//$('#ViewAddApplicantAttachmentUploadWin').jqxWindow('open');	
								var id = $('#ViewApplicantExamResultGrid').jqxGrid('getrowdata',$('#ViewApplicantExamResultGrid').jqxGrid('getselectedrowindex'));
								console.log('source/applicant/'+id.directory+""+id.filename);
								PDFObject.embed('source/applicant/'+id.directory+""+id.filename, "#textpdf",{pdfOpenParams: { page: 1 }});
							}).css({'border':'0px'});
						}
					}).on('open',function(){
						$(this).jqxWindow({
							width:'90%',
							maxWidth:(($(window).innerWidth() * 100)/100),
							height:'90%',
							maxHeight:(($(window).innerHeight() * 100)/100)
						});
						PDFObject.embed("", "#textpdf",{pdfOpenParams: { page: 1 }});
						var id = $('#ApplicantDesirabilityPosition').jqxGrid('getrowdata',$('#ApplicantDesirabilityPosition').jqxGrid('getselectedrowindex'));
						var source =
						{
							datatype: "json",
							datafields: [
								{ name: 'id' },
								{ name: 'attachment_type' ,type:'string'},
								{ name: 'directory' ,type:'string'},
								{ name: 'filename' ,type:'string'}
							],
							id: '',
							url: 'source/applicant/load_applicant_attachment_type.php?applicant_profile_id='+id.id
						};
						var Adapter = new $.jqx.dataAdapter(source);
						$('#ViewApplicantExamResultGrid').jqxGrid({source:Adapter}).on('bindingcomplete',function(){
							$('#ViewApplicantExamResultGrid').jqxGrid('clearselection');
						});
					}).on('close',function(){
						PDFObject.embed("", "#textpdf",{pdfOpenParams: { page: 1 }});
					});
				},
				columns:[
					{text:'ID',dataField:'id',width:'50px'},
					{text:'Position Applying',dataField:'position',width:'200px'}
				]
			}).on('rowclick',function(e){
				var d = $(this).jqxGrid('getrowdata',e.args.rowindex);
				var source =
				{
					datatype: "json",
					datafields: [
						{ name: 'id' },
						{ name: 'profile' },
						{ name: 'details'}
					],
					id: '',
					url: 'source/applicant/load_applicant_details.php?id='+d.id
				};
				var Adapter = new $.jqx.dataAdapter(source);
				$('#ApplicantDetailsGrid').jqxGrid({source:Adapter});
				$.ajax({
					url:'source/applicant/get_active_supp_confi.php',
					data:{},
					type:'POST',
					success:function(ev){
						var res = ev.split(',');
						//var d = $(this).jqxGrid('getrowdata',e.args.rowindex);
						var e = $('#ApplicantDesirabilityPosition').jqxGrid('getrowdata',$('#ApplicantDesirabilityPosition').jqxGrid('getselectedrowindex'));
						var app  = $('#ApplicantDesirabilityPosition').jqxGrid('getrowdata',$('#ApplicantDesirabilityPosition').jqxGrid('getselectedrowindex'));
						var sourceA =
						{
							datatype: "json",
							datafields: [
								{ name: 'id' },
								{ name: 'sex' },
								{ name: 'civilstatus' },
								{ name: 'religion' },
								{ name: 'city' },
								{ name: 'province' },
								{ name: 'citizenship' },
								{ name: 'bloodtype' },
								{ name: 'position' },
								{ name: 'dept' },
								{ name: 'work_years_current' },
								{ name: 'work_years_previous' },
								{ name: 'degree' }
							],
							id: '',
							url: 'source/applicant/load_desirable_employees_reference.php?support='+res[0]+"&confidence="+res[1]+"&position="+e.position
						};
						var AdapterA = new $.jqx.dataAdapter(sourceA);
						$('#ApplicantAssocDesirableEmpReference').jqxGrid({source:AdapterA});	
						
						
						var source =
						{
							datatype: "json",
							datafields: [
								{ name: '# of Years' },
								{ name: '% Value' }
							],
							url: 'source/applicant/get_per_applicant_chart_model.php?support='+res[0]+'&confidence='+res[1]+'&applicant='+app.id
						};

						var dataAdapter = new $.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error);} });

						// prepare jqxChart settings
						var settings = {
							title: "Probability if Applicant will Stay based on Desirable Employees",
							description: "{# of years}",
							showLegend: true,
							enableAnimations: true,
							padding: { left: 5, top: 5, right: 5, bottom: 5 },
							titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
							source: dataAdapter,
							xAxis:
								{
									dataField: '# of Years',
									showGridLines: true,
									showTickMarks:true,
									tickMarksInterval: 1,
									tickMarksColor: '#888888',
									unitInterval: 1,
									showGridLines: true,
									gridLinesInterval: 1,
									textRotationAngle:55

								},
							colorScheme: 'scheme01',
							seriesGroups:
								[
									{
										type: 'area',
										columnsGapPercent: 0,
										showLabels: true,
										valueAxis:
										{
											minValue:0,
											maxValue:1,
											unitInterval: 0.1,
											displayValueAxis: true,
											description: 'Probability',
											symbolType: 'square',
											toolTipFormatSettings: {
												decimalPlaces: 6
											}
										},
										series: [
												{ dataField: '% Value', displayText: 'Value',symbolType: 'square'}
											]
									}

								]
						};

						// setup the chart
						$('#chartContainer').jqxChart(settings);
						$.ajax({
							url:'source/applicant/get_result.php',
							data:{
								support:res[0],
								confidence:res[1],
								applicant:app.id
							},
							type:"GET",
							success:function(e){
								// var obj = JSON.parse(e);
								// console.log(obj);
								// $('#AnswerYrs').html("<p><h3>Answer:</h3></p><hr><p><h3>"+obj.val+"</h3></p>");
								$('#AnswerYrs').html(e);
							},
							complete:function(){
								
							}
						});
					},
					complete:function(){
						
					}
				});
				
			}).css({'border':'0px'});
			
			
			$('#ApplicantAssocDesirableEmpReference').jqxGrid({
				width:'100%',
				height:'100%',
				filterable:true,
				showfilterrow:true,
				showtoolbar:true,
				rendertoolbar:function(toolbar){
					var container = $('<div style=margin:5px;></div>');
					container.append("Frequent Employee Profile by Rules");
					toolbar.append(container);
				},
				columns:[
					{text:'ID',dataField:'id',hidden:true},
					{text:'Position',dataField:'position',width:'300px'},
					{text:'Sex',dataField:'sex',width:'80px'},
					{text:'Civil Status',dataField:'civilstatus',width:'100px'},
					{text:'Religion',dataField:'religion',width:'100px'},
					{text:'City',dataField:'city',width:'150px'},
					{text:'Province',dataField:'province',width:'300px'},
					{text:'Citizenship',dataField:'citizenship',width:'100px'},
					{text:'Blood Type',dataField:'bloodtype',width:'80px'},
					{text:'Dept',dataField:'dept',width:'300px'},
					{text:'#of Work Years(current)',dataField:'work_years_current',width:'250px'},
					{text:'#of Work Years(previous)',dataField:'work_years_previous',width:'250px'},
					{text:'Educational Attainment',dataField:'degree',width:'150px'},
				]
			}).css({'border':'0px'});
			$('#ApplicantDesirabilitySplitterBottom').jqxSplitter({
				width:'100%',
				height:'100%',
				panels:[
					{size:'50%'},
					{size:'50%'}
				]
			}).css({'bprder':'0px'});
			$('#ApplicantDetailsGrid').jqxGrid({
				width:'100%',
				height:'100%',
				filterable:true,
				showfilterrow:true,
				showtoolbar:true,
				rendertoolbar:function(toolbar){
					var container = $('<div style=margin:5px;></div>');
					container.append("<b>Applicant Details</b>");
					toolbar.append(container);
				},
				columns:[
					{text:'ID',dataField:'id',hidden:true},
					{text:'Profile',dataField:'profile',width:'300px',pinned:true},
					{text:'Details',dataField:'details',width:'700px'},
				]
			}).css({'border':'0px'});
			
			// var source =
            // {
                // datatype: "json",
                // datafields: [
                    // { name: '# of Years' },
                    // { name: 'GDP' },
                    // { name: 'DebtPercent' },
                    // { name: 'Debt' }
                // ],
                // url: '../sampledata/gdp_dept_2010.txt'
            // };

            // var dataAdapter = new $.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error);} });

            // prepare jqxChart settings
            var settings = {
                title: "Probability if Applicant will Stay based on Desirable Employees",
                description: "{# of years}",
                showLegend: true,
                enableAnimations: true,
                padding: { left: 5, top: 5, right: 5, bottom: 5 },
                titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                //source: dataAdapter,
                xAxis:
                    {
                        dataField: '# of Years',
                        showGridLines: true,
						showTickMarks:true,
						tickMarksInterval: 1,
						tickMarksColor: '#888888',
						unitInterval: 1,
						showGridLines: true,
						gridLinesInterval: 1,
						textRotationAngle:55
                    },
                colorScheme: 'scheme01',
                seriesGroups:
                    [
                        {
                            type: 'area',
                            columnsGapPercent: 0,
							showLabels: true,
                            valueAxis:
                            {
                                minValue:0,
								maxValue:1,
								unitInterval: 0.1,
                                displayValueAxis: true,
                                description: 'Probability',
								symbolType: 'square',
								toolTipFormatSettings: {
									decimalPlaces: 6
								}
                            },
                            series: [
                                    { dataField: '% Value', displayText: 'Value',symbolType: 'square'}
                                ]
                        }

                    ]
            };

            // setup the chart
            $('#chartContainer').jqxChart(settings);
			$('#ApplicantDesirabilitySplitterBottomSplit').jqxSplitter({
				width:'100%',
				height:'100%',
				panels:[
					{size:'80%'},
						{size:'20%'}
				],
				orientation:'vertical'
			}).css({'border':'0px'});
			$('#ComparativeSplitter').jqxSplitter({
				width:'100%',
				height:'100%',
				panels:[
				{size:'40%'},{size:'60%'}
				],
				orientation:'horizontal'
			}).css({'border':'0px'});
			var sourceApplicantList =
			{
				datatype: "json",
				datafields: [
					{ name: 'id' },
					{ name: 'position',type:'string'},
					{ name: 'fname' ,type:'string'},
					{name:'mname',type:'string'},
					{name:'lname',type:'string'},
					{name:'app_date',type:'date'}
				],
				id: '',
				url: 'source/applicant/load_applicant_profile.php?type=0'
			};
			var AdapterApplicantList = new $.jqx.dataAdapter(sourceApplicantList);
			$('#ComparativeApplicantDesirabilityPosition').jqxGrid({
				width:'100%',
				height:'100%',
				source:AdapterApplicantList,
				filterable:true,
				showfilterrow:true,
				showtoolbar:true,
				groupable:true,
				showgroupsheader:false,
				pageable:true,
				pagesize:50,
				pagesizeoptions: ['50', '100', '150'],
				groupsexpandedbydefault:false,
				selectionmode:'checkbox',
				rendertoolbar:function(toolbar){
					var html = "<table>";
						html += "<tr>";
							html += "<td><button id=RefreshComparativeNewApplicantBtn>Load All Applicant</button></td>";
						html += "</tr>";
					html += "</table>";
					var container = $('<div style=margin:5px;></div>');
					container.append(html);
					toolbar.append(container);
					$('#RefreshComparativeNewApplicantBtn').jqxButton().on('click',function(){
						var sourceApplicantList =
						{
							datatype: "json",
							datafields: [
								{ name: 'id' },
								{ name: 'position' ,type:'string'},
								{ name: 'fname' ,type:'string'},
								{name:'mname',type:'string'},
								{name:'lname',type:'string'},
								{name:'app_date',type:'date'}
							],
							id: '',
							url: 'source/applicant/load_applicant_profile.php?type=0'
						};
						var AdapterApplicantList = new $.jqx.dataAdapter(sourceApplicantList);
						$('#ComparativeApplicantDesirabilityPosition').jqxGrid({source:AdapterApplicantList});
					});
					
				},
				showstatusbar:true,
				renderstatusbar:function(statusbar){
					var html = "<table>";
					html += "<tr>";
						html += "<td><button id=CompareResultBtn>Compare Result</button></td>";
					html += "</tr>";
					html += "</table>";
					//var html = "";
					var container = $("<div style='margin:5px;'></div>");
					container.append(html);
					statusbar.append(container);
					$('#CompareResultBtn').jqxButton().on('click',function(){
						var rowIndexes = $('#ComparativeApplicantDesirabilityPosition').jqxGrid('selectedrowindexes');
						var temp = new Array();
						for (var i = 0; i < rowIndexes.length; i++) {
							var currentId = $('#ComparativeApplicantDesirabilityPosition').jqxGrid('getrowdata', rowIndexes[i]);
							temp[i] = currentId.id;
						};
						var test = temp.join(',');
						//alert(test);
						$.ajax({
							url:'source/applicant/get_assoc_support_active_status.php',
							data:{},
							type:'POST',
							success:function(e){
								var obj = $.parseJSON(e);
								var source =
								{
									datatype: "json",
									datafields: [
										{ name: 'Applicant'},
										{ name: '# of Years' },
										{ name: '% Value' }
									],
									url: 'source/applicant/get_per_applicant_chart_model_comparison.php?id='+test+'&support='+obj[0].support+'&confidence='+obj[0].confidence
								};

								var dataAdapter = new $.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error);} });

								// prepare jqxChart settings
								var settings = {
									title: "Applicant Comparison",
									description: "Probability and # of years applicant will stay",
									showLegend: true,
									enableAnimations: true,
									padding: { left: 5, top: 5, right: 5, bottom: 5 },
									titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
									source: dataAdapter,
									xAxis:
										{
											dataField: 'Applicant',
											showGridLines: true,
											showTickMarks: true,
											tickMarksInterval: 0,
											tickMarksColor: '#888888',
											unitInterval: 1,
											minValue:0,
											gridLinesInterval: 1,
											textRotationAngle:90
										},
									colorScheme: 'scheme01',
									seriesGroups:
										[
											{
												type: 'column',
												orientation:'horizontal',
												columnsGapPercent: 10,
												valueAxis:
												{
													flip:true,
													minValue:0,
													unitInterval: 1,
													displayValueAxis: true,
													description: '# Of Years',
													symbolType:'diamond',
													toolTipFormatSettings: {
														decimalPlaces: 1
													}
												},
												series: [
														{ dataField: '# of Years', displayText: '#Years', symbolType:'diamond'}
													]
											},
											{
												type: 'line',
												orientation:'horizontal',
												valueAxis:
												{	
													flip:true,
													minValue:0,
													maxValue:100,
													unitInterval:10,
													displayValueAxis: true,
													description: 'Probability %',
													symbolType: 'square',
													toolTipFormatSettings: {
														decimalPlaces: 8
													}
												},
												series: [
														{ dataField: '% Value', displayText: 'Probability %' ,symbolType: 'square'}
													]
											}

										]
								};
								 $('#chartCompareContainer').jqxChart(settings);
							},
							complete:function(){
								
							}
						});
						
					});
					
				},
				columns:[
					{text:'ID',dataField:'id',width:'50px',hidden:true},
					{text:'Position Applying',dataField:'position',width:'200px',filtertype:'textbox',pinned:true},
					{text:'Date Applied',dataField:'app_date',width:'120px',filtertype:'date'},
					{text:'First Name',dataField:'fname',width:'200px',filtertype:'textbox'},
					{text:'Middle Name',dataField:'mname',width:'200px',filtertype:'textbox'},
					{text:'Last Name',dataField:'lname'}
				]
			}).css({'border':'0px'});
			// prepare jqxChart settings
			var settings = {
				title: "Applicant Comparison",
				description: "Probability and # of years applicant will stay",
				showLegend: true,
				enableAnimations: true,
				padding: { left: 5, top: 5, right: 5, bottom: 5 },
				titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
				xAxis:
					{
						dataField: 'Applicant',
						showGridLines: true,
						showTickMarks: true,
						tickMarksInterval: 0,
						tickMarksColor: '#888888',
						unitInterval: 1,
						minValue:0,
						gridLinesInterval: 1,
						textRotationAngle:90
					},
				colorScheme: 'scheme01',
				seriesGroups:
					[
						{
							type: 'column',
							orientation:'horizontal',
							columnsGapPercent: 10,
							valueAxis:
							{
								flip:true,
								minValue:0,
								unitInterval: 1,
								displayValueAxis: true,
								description: '# Of Years',
								symbolType:'diamond',
								toolTipFormatSettings: {
									decimalPlaces: 1
								}
							},
							series: [
									{ dataField: '# of Years', displayText: '#Years',symbolType:'diamond'}
								]
						},
						{
							type: 'line',
							orientation:'horizontal',
							valueAxis:
							{	
								flip:true,
								minValue:0,
								maxValue:100,
								unitInterval:10,
								displayValueAxis: true,
								description: 'Probability %',
								symbolType: 'square',
								toolTipFormatSettings: {
									decimalPlaces: 8
								}
							},
							series: [
									{ dataField: '% Value', displayText: 'Probability %' ,symbolType: 'square'}
								]
						}

					]
			};
			$('#chartCompareContainer').jqxChart(settings);
		});