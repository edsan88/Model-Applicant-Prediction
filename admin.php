<!DOCTYPE html >
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ADMIN PAGE: A MODEL BASED PREDICTION OF DESIRABLE APPLICANTS THROUGH EMPLOYEE’S PERCEPTION OF RETENTION AND PERFORMANCE</title>
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
	<style>
	.perception1{
		background-color:#EAFAF1;
		font-weight:bold;
	}
	.perception2{
		<!--background-color:#D5F5E3;-->
		background-color:#FFFFFF;
		font-weight:bold;
	}
	.perception3{
		background-color:#ABEBC6;
		font-weight:bold;
	}
	.perception4{
		background-color:#82E0AA;
		font-weight:bold;
	}
	.positive{
		background-color:#ABEBC6;
		font-weight:bold;
	}
	.negative{
		background-color:#EAFAF1;
		font-weight:normal;
	}
	.positive1{
		font-weight:bold;
	}
	.negative1{
		font-weight:normal;
	}
	.warning{
		background-color:#FADBD8;
		font-weight:normal;
	}
	.ideal_response{
		background-color:#F9E79F;
		font-weight:bold;
	}
	.holiday_icon{
		background-image: url("img/icons/holiday.png");
		background-repeat:no-repeat;
		background-position:center bottom;
	}
	.ot_icon{
		background-image: url("img/icons/clock_ot.png");
		background-repeat:no-repeat;
		background-position:center bottom;
	}
	.ndiff_icon{
		background-image: url("img/icons/night_diff_clock.png");
		background-repeat:no-repeat;
		background-position:center bottom;
	}
	.money_icon{
		background-image: url("img/icons/info_red.png");
		background-repeat:no-repeat;
		background-position:center bottom;
	}
</style>
</head>
<body style="position:fixed;height:100%;width:100%;margin:0px;">
	<div id=container>
		<div id=MainContainer style="position:fixed;height:100%;width:100%;margin:0px;">
			<div style='position:absolute;top:0px;right:0px;z-index:999999;'><button id=LogOutBtn style='margin:5px;'>Log Out</button></div>
			<div id=LoginWin>
				<div></div>
				<div></div>
			</div>
			<div id=MainTab>
				<ul>
					<li><b>Analysis</b></li>
					<li><b>Setup</b></li>
				</ul>
				<div>
					<div id=AnalysisEmployeeApplicantTab>
						<ul>
							<li><b>Employee</b></li>
							<li><b>Applicant</b></li>
						</ul>
						<div>
							<div id=AnalysisTab>
								<ul>
									<li><b>Response</b></li>
									<li><b>Word Frequency</b></li>
									<!--<li><b>Survey Ratings</b></li>-->
									<li><b>Perception</b></li>
								</ul>
								<div>
									<div id=ConsolidateUserResponseSplitterMain>
										<div>
											<div id=ConsolidateUserResponseSplitterLeft>
												<div>
													<div id=ConsolidateTemplateGrid></div>
												</div>
												<div>
													<div id=ConsolidateUserResponseSplitterLeftExpander>
														<div>Details</div>
														<div>
															<table style='width:96%;margin:2%;'>
																<tr>
																	<td>Age</td>
																</tr>
																<tr>
																	<td><div id=TemplateAgeView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
																</tr>
																<tr>
																	<td>Sex</td>
																</tr>
																<tr>
																	<td><div id=TemplateSexView style='width:100%;height:60px;overflow-y:scroll;border:1px solid;'></div></td>
																</tr>
																<tr>
																	<td>Religion</td>
																</tr>
																<tr>
																	<td><div id=TemplateReligionView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
																</tr>
																<tr>
																	<td>Marital Status</td>
																</tr>
																<tr>
																	<td><div id=TemplateMaritalStatusView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
																</tr>
																<tr>
																	<td>Educational Attainment</td>
																</tr>
																<tr>
																	<td><div id=TemplateEducAttainmentView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
																</tr>
																<tr>
																	<td>Region</td>
																</tr>
																<tr>
																	<td><div id=TemplateRegionView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
																</tr>
																<tr>
																	<td>Province</td>
																</tr>
																<tr>
																	<td><div id=TemplateProvinceView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
																</tr>
																<tr>
																	<td>City</td>
																</tr>
																<tr>
																	<td><div id=TemplateCityView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
																</tr>
																<tr>
																	<td>Brgy</td>
																</tr>
																<tr>
																	<td><div id=TemplateBrgyView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
																</tr>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div>
											<div id=ConsolidateUserResponseSplitterRight>
												<div>
													<div id=ConsolidateUserResponseSplitterRightDetails>
														<div>
															<div id=ConsolidateUserResponseUserGetByTemplateGrid></div>
														</div>
														<div>
															<div id=MainGridUserResponseByTemplate></div>
														</div>
													</div>
												</div>
												<div>
													<div id=ConsolidatedEmployeeResponsesGrid></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div>
									<div id=WordFreqPerceptionSplitter>
										<div>
											<div id=WordFreqPerceptionSplitterLeft>
												<div>
													<div id=WordFreqPerceptionTemplateGrid></div>
												</div>
												<div style='overflow-y:scroll;'>
													<table style='width:96%;margin:2%;'>
														<tr>
															<td>Age</td>
														</tr>
														<tr>
															<td><div id=WordFreqPerceptionTemplateAgeView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
														</tr>
														<tr>
															<td>Sex</td>
														</tr>
														<tr>
															<td><div id=WordFreqPerceptionTemplateSexView style='width:100%;height:60px;overflow-y:scroll;border:1px solid;'></div></td>
														</tr>
														<tr>
															<td>Religion</td>
														</tr>
														<tr>
															<td><div id=WordFreqPerceptionTemplateReligionView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
														</tr>
														<tr>
															<td>Marital Status</td>
														</tr>
														<tr>
															<td><div id=WordFreqPerceptionTemplateMaritalStatusView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
														</tr>
														<tr>
															<td>Educational Attainment</td>
														</tr>
														<tr>
															<td><div id=WordFreqPerceptionTemplateEducAttainmentView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
														</tr>
														<tr>
															<td>Region</td>
														</tr>
														<tr>
															<td><div id=WordFreqPerceptionTemplateRegionView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
														</tr>
														<tr>
															<td>Province</td>
														</tr>
														<tr>
															<td><div id=WordFreqPerceptionTemplateProvinceView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
														</tr>
														<tr>
															<td>City</td>
														</tr>
														<tr>
															<td><div id=WordFreqPerceptionTemplateCityView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
														</tr>
														<tr>
															<td>Brgy</td>
														</tr>
														<tr>
															<td><div id=WordFreqPerceptionTemplateBrgyView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
														</tr>
													</table>
												</div>
											</div>
										</div>
										<div>
											<div id=WordFreqPerceptionSplitterRight>
												<div>
													<div id=WordFreqConsolidatedEmployeeResponsesGrid></div>
												</div>
												<div>
													<div id=WOrdFreqWordListGrid></div>
													<!--
													<div id=WordFreqPerceptionSplitterRightBtm>
														<div>
															
														</div>
														<div>
															<div id=WOrdFreqMeaningfulPhraseGrid></div>
														</div>
													</div>
													
													-->
												</div>
											</div>
										</div>
									</div>
								</div>
								<!--
								<div>
									<div id=SentimentRatingsEmployeeResponsesGrid></div>
								</div>
								-->
								<div>
									<div id=PerceptionSplitter>
										<div>
											<div id=PerceptionSplitterLeft>
												<div>
													<div id=PerceptionTemplateGrid></div>
												</div>
												<div style='overflow-y:scroll;'>
													<table style='width:96%;margin:2%;'>
														<tr>
															<td>Age</td>
														</tr>
														<tr>
															<td><div id=PerceptionTemplateAgeView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
														</tr>
														<tr>
															<td>Sex</td>
														</tr>
														<tr>
															<td><div id=PerceptionTemplateSexView style='width:100%;height:60px;overflow-y:scroll;border:1px solid;'></div></td>
														</tr>
														<tr>
															<td>Religion</td>
														</tr>
														<tr>
															<td><div id=PerceptionTemplateReligionView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
														</tr>
														<tr>
															<td>Marital Status</td>
														</tr>
														<tr>
															<td><div id=PerceptionTemplateMaritalStatusView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
														</tr>
														<tr>
															<td>Educational Attainment</td>
														</tr>
														<tr>
															<td><div id=PerceptionTemplateEducAttainmentView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
														</tr>
														<tr>
															<td>Region</td>
														</tr>
														<tr>
															<td><div id=PerceptionTemplateRegionView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
														</tr>
														<tr>
															<td>Province</td>
														</tr>
														<tr>
															<td><div id=PerceptionTemplateProvinceView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
														</tr>
														<tr>
															<td>City</td>
														</tr>
														<tr>
															<td><div id=PerceptionTemplateCityView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
														</tr>
														<tr>
															<td>Brgy</td>
														</tr>
														<tr>
															<td><div id=PerceptionTemplateBrgyView style='width:100%;height:150px;overflow-y:scroll;border:1px solid;'></div></td>
														</tr>
													</table>
												</div>
											</div>
										</div>
										<div>
											<div id=PerceptionAnalysis></div>
										<!--
											<div id=PerceptionDetailsNavBar>
												<div>Overall Perception</div>
													<div>
														<div id=PerceptionAnalysis></div>
													</div>
												<div>Positive Dimensions</div>
													<div>
														<div id=PerceptionDetailsPositiveGrid></div>
													</div>
												<div>Negative Dimensions</div>
													<div>
														<div id=PerceptionDetailsNegativeGrid></div>
													</div>
											</div>
										-->
										</div>
									</div>
								</div>
								
							</div>
						</div>
						<div>
							<div id=ApplicantMainTab>
								<ul>
									<li><b>Association Rules</b></li>
									<li><b>Desirability</b></li>
									<li><b>Comparative Result</b></li>
								</ul>
								<div>
									<div id=ApplicantSplitterMain>
										<div>
											<div id=ApplicantSplitterMainL>
												<div>
													<div id=ApplicantSupportConfidenceGrid></div>
												</div>
												<div style='overflow-y:scroll;overflow-x:none;'>
													<table style='width:100%'>
														<tr>
															<td style='padding:5px;'><b>Sex</b></td>
															<td><div id=SexAllowed></div></td>
														</tr>
														<tr>
															<td style='padding:5px;'><b>Civil Status</b></td>
															<td><div id=CivilStatusAllowed></div></td>
														</tr>
														<tr>
															<td style='padding:5px;'><b>City</b></td>
															<td><div id=CityAllowed></div></td>
														</tr>
														<tr>
															<td style='padding:5px;'><b>Province</b></td>
															<td><div id=ProvinceAllowed></div></td>
														</tr>
														<tr>
															<td style='padding:5px;'><b>Citizenship</b></td>
															<td><div id=CitizenshipAllowed></div></td>
														</tr>
														<tr>
															<td style='padding:5px;'><b>Position</b></td>
															<td><div id=PositionAllowed></div></td>
														</tr>
														<tr>
															<td style='padding:5px;'><b>Department</b></td>
															<td><div id=DepartmentAllowed></div></td>
														</tr>
														<tr>
															<td style='padding:5px;'><b>Work History</b></td>
															<td><div id=WorkHistoryAllowed></div></td>
														</tr>
														<tr>
															<td style='padding:5px;'><b>Educational Attainment</b></td>
															<td><div id=DegreeAllowed></div></td>
														</tr>
														<tr>
															<td style='padding:5px;'><b>Age</b></td>
															<td><div id=AgeAllowed></div></td>
														</tr>
														<tr>
															<td style='padding:5px;'><b>Dimension 1</b></td>
															<td><div id=Dimension1Allowed></div></td>
														</tr>
														<tr>
															<td style='padding:5px;'><b>Dimension 2</b></td>
															<td><div id=Dimension2Allowed></div></td>
														</tr>
														<tr>
															<td style='padding:5px;'><b>Dimension 3</b></td>
															<td><div id=Dimension3Allowed></div></td>
														</tr>
														<tr>
															<td style='padding:5px;'><b>Dimension 4</b></td>
															<td><div id=Dimension4Allowed></div></td>
														</tr>
														<tr>
															<td style='padding:5px;'><b>Dimension 5</b></td>
															<td><div id=Dimension5Allowed></div></td>
														</tr>
														<tr>
															<td style='padding:5px;'><b>Dimension 6</b></td>
															<td><div id=Dimension6Allowed></div></td>
														</tr>
														<tr>
															<td style='padding:5px;'><b>Dimension 7</b></td>
															<td><div id=Dimension7Allowed></div></td>
														</tr>
														<tr>
															<td style='padding:5px;'><b>Dimension 8</b></td>
															<td><div id=Dimension8Allowed></div></td>
														</tr>
														<tr>
															<td style='padding:5px;'><b>Dimension 10</b></td>
															<td><div id=Dimension10Allowed></div></td>
														</tr>
														<tr>
															<td style='padding:5px;'><b>Dimension 11</b></td>
															<td><div id=Dimension11Allowed></div></td>
														</tr>
														<tr>
															<td style='padding:5px;'><b>Dimension 12</b></td>
															<td><div id=Dimension12Allowed></div></td>
														</tr>
														<tr>
															<td style='padding:5px;'><b>Discretize</b></td>
															<td><div id=DiscretizeAllowed></div></td>
														</tr>
													</table>
												</div>
											</div>
											
										</div>
										<div>
											<div id=ApplicantAssocSplitter>
												<div>
													<div id=ApplicantAssocSplitterRightTop>
														<div>
															<div id=ApplicantSupportConfidenceEmpAssocRules></div>
														</div>
														<div>
															<div id=ApplicantFrequentItemSet></div>
														</div>
													</div>
													
												</div>
												<div>
													<div id=ApplicantAssocDesirableEmp></div>
												</div>
											</div>
											
										</div>
									</div>
								</div>
								<div>
									<div id=ApplicantDesirabilitySplitter>
										<div>
											<div id=ApplicantDesirabilityPosition></div>
										</div>
										<div>
											<div id=ApplicantDesirabilitySplitterRight>
												<div>
													
													<div id=ApplicantDesirabilitySplitterBottom>
														<div>
															<div id=ApplicantDetailsGrid></div>
														</div>
														<div>
															<div id=ApplicantAssocDesirableEmpReference></div>
														</div>
													</div>
												</div>
												<div>
													<div id=ApplicantDesirabilitySplitterBottomSplit>
														<div>
															<div id='chartContainer' style="width:100%; height:100%;"></div>
														</div>
														<div id=AnswerYrs style='padding:15px;overflow-y:scroll;'>
														
														</div>
													</div>
													
												</div>
											</div>
										</div>
									</div>
								</div>
								<div>
									<div id=ComparativeSplitter>
										<div>
											<div id=ComparativeApplicantDesirabilityPosition></div>
										</div>
										<div>
											<p><div id=chartCompareContainer style='width:100%; height: 100%;'></div></p>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					
				</div>
				<div>
					<div id=SetupTab>
						<ul>
							<li><b>Dimensions</b></li>
							<li><b>Questions</b></li>
						</ul>
						<div>
							<div id=MainGridDimension></div>
						</div>
						<div>
							<div id=MainGridQuestions></div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</body>
	<script type='text/javascript' src='js/plugins/jquery.session.js'></script>
	<script type='text/javascript' src='js/plugins/jquery.idle.min.js'></script>
	<script type='text/javascript' src='js/plugins/pdfobject.min.js'></script>
	<script type='text/javascript' src='js/jqwidgets/jqxcore.js'></script>
	<script type='text/javascript' src='js/jqwidgets/jqx-all.js'></script>
	<script type='text/javascript' src='js/core/admin-main.js'></script>
	<script type='text/javascript' src='js/core/core.js'></script>
</html>