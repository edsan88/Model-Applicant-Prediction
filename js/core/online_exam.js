$(function(){
	$('#OnlineExamGrid').jqxGrid({
		width:'100%',
		pagesize: 50,
		height:'100%',
		pageable:true,
		pagesizeoptions: ['50', '75', '100'],
		filterable:true,
		showfilterrow:true,
		showtoolbar:true,
		toolbarHeight:'40px',
		rendertoolbar:function(toolbar){
				var html = "<table>";
				html += "<tr>";
				html += "<td>ID</td><td><input type=text id=OnlineExamInp></td><td><button id=OnlineExamSubmitBtn style='margin:5px;'>Load Examination</button></td>";
				html += "<tr>";
				html += "</table>";
				var container = $('<div></div>');
				container.append(html);
				toolbar.append(container);
				$('#OnlineExamInp').jqxInput({height:'25px'});
				$('#OnlineExamSubmitBtn').jqxButton().on('click',function(){
					var ApplicantExamsource =
					{
						datatype: "json",
						datafields: [
							{ name: 'id' },
							{ name: 'examination_id' },
							{ name: 'examination_type' },
							{ name: 'examination_name' },
							{ name: 'total_points' },
							{ name: 'total_items' },
							{ name: 'passing_score' }
						],
						id: '',
						url: 'source/hr/tab1/database/exam_result/get_applicant_exam_test.php?id='+$('#OnlineExamInp').val()
					};
					var ApplicantExamAdapter = new $.jqx.dataAdapter(ApplicantExamsource);
					$('#OnlineExamGrid').jqxGrid({source:ApplicantExamAdapter});
				});
		},
		columns:[
			{text:'ID',dataField:'id',hidden:true},
			{text:'Type',dataField:'examination_type',width:'250px',pinned:true},
			{text:'Name',dataField:'examination_name',width:'250px',pinned:true},
			{text:'Total Points',dataField:'total_points'},
			{text:'Total Items',dataField:'total_items'},
			{text:'Passing Score',dataField:'passing_score'}
		]
	}).on('rowdoubleclick',function(e){
		var details = $(this).jqxGrid('getrowdata',e.args.rowindex);
		$('#OnlineExamWin').jqxWindow('setTitle','Examination Details: '+ details.examination_type +' : '+details.examination_name);
		$('#OnlineExamWin').jqxWindow('setContent','');
		$.ajax({
			url:'source/hr/tab14/database/question_bank/get_question_bank.php',
			type:'GET',
			data:{
				id:details.examination_id
			},
			success:function(e){
				var obj = $.parseJSON(e);
				var html = "<div class='row'>";
				html += "<div class='col-sm-12'>";
				for(var x=0;x<obj.length;x++){
						html += "<div class='panel panel-default'>";
						html += "<div class='panel-heading'>";
						html += "Question # "+Number(x + 1)+": "+obj[x].question;	
						html += "</div>";
						html += "<div class='panel-body'>";
						var choices = obj[x].choices;
						var choice_list = choices.split("||");
						for(var y=0;y<choice_list.length;y++){
							html += "<div class='row'>"
								html += "<div class='col-sm-1' style='text-align:right;'>["+Number(y + 1)+"]</div>";
								html += "<div class='col-sm-11'>";
								html += choice_list[y];
								html += "</div>";
							html += "</div>";
							// html += "<tr>";
							// html += "<td></td><td>[ "+Number(y + 1)+" ] "+choice_list[y]+"</td>";
							// html += "</tr>";
						}
						html += "</div>";
						html += "<div class='panel-footer'>Answer: <input type=text class=OnlineExamAnswerInp></div>";
						html += "</div>";
				}
				html += "<div class='col-sm-1'><button id=SubmitOnlineExaminationAnswerBtn class='btn btn-primary' onClick=SaveAnswer();>Submit Examination</button></div>";
				html += "</div>";
				html += "</div>";
				// var html = "<table style='width:100%;'>";
				// for(var x=0;x<obj.length;x++){
					// html += "<tr>";
					// html += "<td style='width:150px;'>Question # "+Number(x + 1)+":  </td><td>"+obj[x].question+"</td>";
					// html += "</tr>";
					// var choices = obj[x].choices;
					// var choice_list = choices.split("||");
					// for(var y=0;y<choice_list.length;y++){
						// html += "<tr>";
						// html += "<td></td><td>[ "+Number(y + 1)+" ] "+choice_list[y]+"</td>";
						// html += "</tr>";
					// }
					// html += "<tr>";
					// html += "<td style='text-align:right;'>Answer:</td><td><input type=text class=OnlineExamAnswerInp></td>";
					// html += "</tr>";
					// html += "<tr>";
					// html += "<td colspan=2><hr></td>";
					// html += "</tr>";
				// }
				// html += "<tr>";
				// html += "<td><button></button></td>";
				// html += "</tr>";
				// html += "</table>";
				$('#OnlineExamWin').jqxWindow('setContent',html);
			},
			complete:function(){
				
			}
		});
		$('#OnlineExamWin').jqxWindow('open');
	});
	$('#OnlineExamWin').jqxWindow({
		width:'100%',
		maxWidth:(($(window).innerWidth() * 100)/100),
		//maxWidth:'800px',
		height:'100%',
		maxHeight:(($(window).innerHeight() * 100)/100),
		showCloseButton:true,
		isModal:true,
		modalOpacity:0,
		autoOpen:false,
		resizable:false
	});
});
function SaveAnswer(){
	var temp = new Array();
	var x = 0;
	$(".OnlineExamAnswerInp").each(function() {
    //alert($(this).val());
		temp[x] = $(this).val();
		x++;
	});
	//alert(temp);
	var app_exam = $('#OnlineExamGrid').jqxGrid('getrowdata',$('#OnlineExamGrid').jqxGrid('getselectedrowindex'));
	$.ajax({
		url:'source/online_examination/submit_applicant_answer.php',
		type:'POST',
		data:{
			app_exam_id:app_exam.id,
			exam_id:app_exam.examination_id,
			answer:temp
		},
		success:function(){
			$('#OnlineExamWin').jqxWindow('close');
			var ApplicantExamsource =
			{
				datatype: "json",
				datafields: [
					{ name: 'id' },
					{ name: 'examination_id' },
					{ name: 'examination_type' },
					{ name: 'examination_name' },
					{ name: 'total_points' },
					{ name: 'total_items' },
					{ name: 'passing_score' }
				],
				id: '',
				url: 'source/hr/tab1/database/exam_result/get_applicant_exam_test.php?id='+$('#OnlineExamInp').val()
			};
			var ApplicantExamAdapter = new $.jqx.dataAdapter(ApplicantExamsource);
			$('#OnlineExamGrid').jqxGrid({source:ApplicantExamAdapter});
		},
		complete:function(){
			
		}
	});
	
}