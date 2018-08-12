<!DOCTYPE html >
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>A MODEL BASED PREDICTION OF DESIRABLE APPLICANTS THROUGH EMPLOYEE’S PERCEPTION OF RETENTION AND PERFORMANCE</title>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">
	<style>
		#MainContainer {display: none;}
	</style>
	<script type='text/javascript' src='js/jquery/jquery-2.2.4.min.js'></script>
	<script type='text/javascript' src='js/plugins/pace.js'></script>
	<script type='text/javascript' src='js/plugins/bootstrap.min.js'></script>
	<link rel="stylesheet" href="css/pace/dark_blue.css" type="text/css" />
	<link rel="stylesheet" href="css/bootstrap-3.3.6/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="js/jqwidgets/styles/jqx.base.css" type="text/css" />
</head>
<body style="position:fixed;height:100%;width:100%;margin:0px;">
	<div id=container>
		<div id=MainContainer style="position:fixed;height:100%;width:100%;margin:0px;">
			<div id=LoginWin>
				<div></div>
				<div></div>
			</div>
			<div id=MainSplitter>
				<div>
					<div id=ContentMainSplitter>
						<div>
							<div id=RetentionExamGrid></div>
						</div>
						<div>
							<div id=MainNavBar>
								<div>How to Participate</div>
								<div>Click to highlight `Employee Perception Towards Organizaton` under Questionnaire Available table and press `Proceed Button`</div>
								<div>About System</div>
								<div>The system is intended for research purpose only to better understand and analyze data in the pursuit of new knowledge and application applying machine learning.</div>
							</div>
						</div>
					</div>

				</div>
				<div>
					<div id='MainContentDiv' style='overflow-y:scroll; overflow-x:none;height:100%;'></div>
				</div>
			</div>

		</div>
	</div>
</body>
	<script type='text/javascript' src='js/plugins/jquery.session.js'></script>
	<script type='text/javascript' src='js/plugins/jquery.idle.min.js'></script>
	<script type='text/javascript' src='js/jqwidgets/jqxcore.js'></script>
	<script type='text/javascript' src='js/jqwidgets/jqx-all.js'></script>
	<script type='text/javascript' src='js/core/system-main.js'></script>
	<script type='text/javascript'>
		$(function(){
			$('#MainContainer').fadeIn(5000);
			
		});
		function SubmitSurvey(){
			$.ajax({
				url:'source/retention/save_user_details.php',
				data:{
					user_id:$.session.get('user_id'),
					age:$.session.get('age'),
					brgy:$.session.get('brgy'),
					city:$.session.get('city'),
					educ_level:$.session.get('educ_level'),
					marital_status:$.session.get('marital_status'),
					province:$.session.get('province'),
					region:$.session.get('region'),
					sex:$.session.get('sex'),
					religion:$.session.get('religion')
				},
				type:'POST',
				success:function(){
					$("select").each(function(){
						// Add $(this).val() to your list
						console.log($(this).val() + "--" + this.id + '--' + this.name + '---' + $('#comment'+this.id+'-'+this.name).val());
						$.ajax({
							url:'source/retention/save_user_response.php',
							data:{
								user_id:$.session.get('user_id'),
								ratings:$(this).val(),
								dimensions_id:this.id,
								questionnaire_id:this.name,
								response:$('#comment'+this.id+'-'+this.name).val()
							},
							type:'POST',
							success:function(){
								$.session.remove('user_id');
								$('#MainContentDiv').html('');
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
								open = undefined;
							},
							complete:function(){
								
							}
						});
					});
				},
				complete:function(){
					
				}
			});
		}
	</script>
</html>
