<?php
require('../config.php');
Generate($link);
function Generate($link){
	$sql = "SELECT * FROM jserp_hrdo.employeeinfo";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			//echo strtolower("Hello WORLD.")$row['sex']."<br>";
			if(strtolower($row['sex']) == 'male'){
				Update($link,$row['employeeInfoID'],'MALE',GetCivilStatusName($row['civilStatusID'],$link),GetReligionName($row['religionID'],$link),GetCity($row['city']),GetProvince($row['province']),GetCitizenship($row['citizenshipID'],$link),GetBloodTypeName($row['bloodTypeID'],$link),YearOfWork($row['employeeInfoID'],$link),GetPositionName(GetPosition($row['employeeInfoID'],$link),$link),GetDeptName(GetDept($row['employeeInfoID'],$link),$link),WorkHistory($row['employeeInfoID'],$link),GetEducLevelName(GetEducLevel($row['employeeInfoID'],$link),$link),GetEmployeeAgeStart($link,GetBirthDate($link,$row['employeeInfoID']), GetWorkEnd($link,$row['employeeInfoID'])));
			}else{
				Update($link,$row['employeeInfoID'],'FEMALE',GetCivilStatusName($row['civilStatusID'],$link),GetReligionName($row['religionID'],$link),GetCity($row['city']),GetProvince($row['province']),GetCitizenship($row['citizenshipID'],$link),GetBloodTypeName($row['bloodTypeID'],$link),YearOfWork($row['employeeInfoID'],$link),GetPositionName(GetPosition($row['employeeInfoID'],$link),$link),GetDeptName(GetDept($row['employeeInfoID'],$link),$link),WorkHistory($row['employeeInfoID'],$link),GetEducLevelName(GetEducLevel($row['employeeInfoID'],$link),$link),GetEmployeeAgeStart($link,GetBirthDate($link,$row['employeeInfoID']), GetWorkEnd($link,$row['employeeInfoID'])));
			}
		}
	}else{

	}	
}

function Update($link,$id,$sex,$civilstatus,$religion,$city,$province,$citizenshipID,$bloodTypeID,$years_work,$positionID,$dept,$workyrs,$degree,$age){
	
	$sql = "SELECT * FROM retention.employee_profile WHERE employee_profile.employeeInfoID = '".$id."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$s = "UPDATE retention.employee_profile 
			SET employee_profile.sex = '".$sex."',
			employee_profile.civilstatus = '".$civilstatus."',
			employee_profile.religion = '".$religion."',
			employee_profile.city = '".$city."',
			employee_profile.province = '".$province."',
			employee_profile.citizenship = '".$citizenshipID."',
			employee_profile.bloodtype = '".$bloodTypeID."',
			employee_profile.total_years_work = '".$years_work."',
			employee_profile.position = '".$positionID."',
			employee_profile.department = '".$dept."',
			employee_profile.work_history = '".$workyrs."',
			employee_profile.degree = '".$degree."',
			employee_profile.age = '".$age."'
			WHERE employee_profile.employeeInfoID = '".$id."'";
		mysqli_query($link,$s);
	}else{
		$s = "INSERT INTO retention.employee_profile(`employeeInfoID`,`sex`,`civilstatus`,`religion`,`city`,`province`,`citizenship`,`bloodtype`,`total_years_work`,`position`,`department`,`work_history`,`degree`,`age`) 
				VALUES('".$id."','".$sex."','".$civilstatus."','".$religion."','".$city."','".$province."','".$citizenshipID."','".$bloodTypeID."','".$years_work."','".$positionID."','".$dept."','".$workyrs."','".$degree."','".$age."')";
		mysqli_query($link,$s);
	}
}
function GetCivilStatusName($id,$link){
	$sql = "SELECT * FROM jserp_hrdo.civilstatus WHERE civilstatus.civilStatusID = '".$id."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$row = mysqli_fetch_array($data);
		return strtoupper($row['civilStatusName']);
	}else{
		return strtoupper('SINGLE');
	}
}
function GetBloodTypeName($id,$link){
	$sql = "SELECT * FROM jserp_hrdo.bloodtype WHERE bloodtype.bloodTypeID = '".$id."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$row = mysqli_fetch_array($data);
		return strtoupper($row['bloodType']);
	}else{
		return strtoupper('O');
	}
}
function GetReligionName($id,$link){
	$sql = "SELECT * FROM jserp_hrdo.religion WHERE religion.religionID = '".$id."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$row = mysqli_fetch_array($data);
		return strtoupper($row['religionName']);
	}else{
		//return strtoupper('SINGLE');
	}
}
function GetCitizenship($id,$link){
	$sql = "SELECT * FROM jserp_hrdo.citizenship WHERE citizenshipID = '".$id."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$row = mysqli_fetch_array($data);
		return strtoupper($row['citizenship']);
	}else{
		return strtoupper('FILIPINO');
	}
}
function GetCity($city){
	if(strtolower($city) == 'panacan,davao city' || strtolower($city) == 'panacan davao city' || strtolower($city) == 'matina' || strtolower($city) == 'mintal,davao city' || strtolower($city) == 'sasa davao city' || strtolower($city) == 'new matina' || strtolower($city) == 'davo city' || strtolower($city) == 'davao del sur' || strtolower($city) == 'ilang' || strtolower($city) == 'island garden city of samal' || strtolower($city) == 'igacos' || strtolower($city) == 'catalunan grande' || strtolower($city) == 'bunawan' || strtolower($city) == 'davao city,' || strtolower($city) == 'catalunan' || strtolower($city) == 'agdao davao city' || strtolower($city) == 'sasa,davao city' || strtolower($city) == 'agdao' || strtolower($city) == ' davao city' || strtolower($city) == 'davao city' || strtolower($city) == 'davao city,davao del sur'){
		return strtoupper('DAVAO CITY');		
	}else if(strtolower($city) == 'new balamban' || strtolower($city) == 'magugpo west tagum city' || strtolower($city) == 'magugpo east, tagum city' || strtolower($city) == 'magugpo east,tagum city' || strtolower($city) == 'davao occidental' || strtolower($city) == 'asuncion, tagum city' || strtolower($city) == 'tagum, city' || strtolower($city) == 'tagum ciy' || strtolower($city) == 'visayan village' || strtolower($city) == 'tagm city' || strtolower($city) == 'san miguel tagum city' || strtolower($city) == 'san miguel' || strtolower($city) == 'mankilam tagum city' || strtolower($city) == 'magugpo west' || strtolower($city) == 'mankilam ' || strtolower($city) == 'mankilam' || strtolower($city) == 'magdum' || strtolower($city) == 'madaum' || strtolower($city) == 'la filipina' || strtolower($city) == 'cuambogan ' || strtolower($city) == 'cuambogan' || strtolower($city) == 'brgy. west' || strtolower($city) == 'brgy.west' || strtolower($city) == 'brgy. san miguel' || strtolower($city) == 'brgy.san miguel' || strtolower($city) == 'brgy. north' || strtolower($city) == 'brgy.north' || strtolower($city) == 'apokon, tagum city' || strtolower($city) == 'bermudez apokon' || strtolower($city) == 'briz' || strtolower($city) == '.' || strtolower($city) == ' magugpo north' || strtolower($city) == ' tagum city' || strtolower($city) == 'magugpo north' || strtolower($city) == 'davao del norte' || strtolower($city) == ', tagum city' || strtolower($city) == 'canocotan' || strtolower($city) == 'apokon tagum city' || strtolower($city) == 'tagum city ' || strtolower($city) == 'tagum ' || strtolower($city) == 'apokon ' || strtolower($city) == 'mankilam' || strtolower($city) == 'tagm city' || strtolower($city) == 'apokon' || strtolower($city) == 'apkon,tagum city' || strtolower($city) == 'tagum' || strtolower($city) == ',tagum city' || strtolower($city) == 'tagaum city' || strtolower($city) == 'tagu city' || strtolower($city) == 'tagum' || strtolower($city) == 'tagum city,' || strtolower($city) == 'tagum,city' || strtolower($city) == 'tagumc ity' || strtolower($city) == ',tgaum city' || strtolower($city) == 'tagum city'){
		return strtoupper('TAGUM CITY');
	}else if(strtolower($city) == 'monkayo,' || strtolower($city) == ' monkayo' || strtolower($city) == 'monkayo' || strtolower($city) == 'monkayo '){
		return strtoupper('MONKAYO');
	}else if(strtolower($city) == 'maragusan' || strtolower($city) == 'maragusan ' || strtolower($city) == 'poblacion ' || strtolower($city) == 'poblacion' || strtolower($city) == 'poblacion maragusan' || strtolower($city) == 'mapawa maragusan' || strtolower($city) == 'maragusan,' || strtolower($city) == 'coronobe maragusan' || strtolower($city) == 'coronobe maragusan' || strtolower($city) == '.maragusan' || strtolower($city) == 'maragausan' || strtolower($city) == 'maragusan' || strtolower($city) == 'maragusan comval' || strtolower($city) == '.maragusan,'){
		return strtoupper('MARAGUSAN');
	}else if(strtolower($city) == 'new visayas' || strtolower($city) == 'panabo' || strtolower($city) == 'panabo  city' || strtolower($city) == 'dapco, panabo city' || strtolower($city) == 'cagangohan' || strtolower($city) == 'dapco,panabo city' || strtolower($city) =='a.o, floreindo, panabo' || strtolower($city) == ' panabo city' || strtolower($city) == 'panabo city ' || strtolower($city) == 'panabo city' || strtolower($city) == 'panabo city,'){
		return strtoupper('PANABO CITY');
	}else if(strtolower($city) == 'mipangi' || strtolower($city) == 'nabunturam' || strtolower($city) == 'nabunturan,' || strtolower($city) == 'alvania subd.' || strtolower($city) == 'nabunturan'){
		return strtoupper('NABUNTURAN');
	}else if(strtolower($city) == 'carmen' || strtolower($city) == 'carmen ' || strtolower($city) == 'carmen,' || strtolower($city) == 'carmen, '){
		return strtoupper('CARMEN');
	}else if(strtolower($city) == 'mesaoy' || strtolower($city) == 'new corella ddn' || strtolower($city) == 'new corella ' || strtolower($city) == 'limbaan, new corella' || strtolower($city) == 'limbaan,new corella' || strtolower($city) == 'new corella' || strtolower($city) == 'new corella,'){
		return strtoupper('NEW CORELLA');
	}else if(strtolower($city) == 'maniki' || strtolower($city) == 'maniki, kapalong' || strtolower($city) == 'maniki kapalong' || strtolower($city) == 'kaplong' || strtolower($city) == 'kapalong ' || strtolower($city) == 'kapalog' || strtolower($city) == 'kapalog ' || strtolower($city) == 'kapalong ddn' || strtolower($city) == 'kapalong,' || strtolower($city) == 'kapalong' || strtolower($city) == 'kapalong city'){
		return strtoupper('KAPALONG');
	}else if(strtolower($city) == 'maco comval province' || strtolower($city) == 'maco comval' || strtolower($city) == 'anibongan/maco' || strtolower($city) == 'maco' || strtolower($city) == 'maco,' || strtolower($city) == 'maco '){
		return strtoupper('MACO');
	}else if(strtolower($city) == 'mawab ' || strtolower($city) == 'mawab' || strtolower($city) == 'mawab,'){
		return strtoupper('MAWAB');
	}else if(strtolower($city) == 'iligan'){
		return strtoupper('ILIGAN CITY');
	}else if(strtolower($city) == 'pantukan,' || strtolower($city) == 'napnapan pantukan' || strtolower($city) == 'magnaga pantukan' || strtolower($city) == 'kingking, pantukan' || strtolower($city) == 'kingking pantukan' || strtolower($city) == 'kingking,pantukan ' || strtolower($city) == 'kingking,pantukan' || strtolower($city) == 'king-king pantukan' || strtolower($city) == 'pantukan'){
		return strtoupper('PANTUKAN');
	}else if(strtolower($city) == 'marundan' || strtolower($city) == 'davao oriental' || strtolower($city) == 'dahican mati' || strtolower($city) == 'city of mati' || strtolower($city) == 'mati' || strtolower($city) == 'mati city'){
		return strtoupper('MATI CITY');
	}else if(strtolower($city) == 'mabini,' || strtolower($city) == 'tagnanan,mabini' || strtolower($city) == 'mabini comval prov.' || strtolower($city) == 'mabini,' || strtolower($city) == 'cabuyoan mabini' || strtolower($city) == 'mabini ' || strtolower($city) == 'mabini' || strtolower($city) == 'pindasan' || strtolower($city) == 'cabuyan'){
		return strtoupper('MABINI');
	}else if(strtolower($city) == 'kidawa, laak' || strtolower($city) == 'kidawa,laak' || strtolower($city) == 'laak' || strtolower($city) == 'laak ' || strtolower($city) == 'laak,'){
		return strtoupper('LAAK');
	}else if(strtolower($city) == 'kidapawan' || strtolower($city) == 'kidapawan city'){
		return strtoupper('KIDAPAWAN');
	}else if(strtolower($city) == 'bantayan asuncion' || strtolower($city) == 'asuncion,tagum city' || strtolower($city) == 'asuncion dvo del norte' || strtolower($city) == 'asuncion dvao del norte' || strtolower($city) == 'bantayan asuncion' || strtolower($city) == 'asuncion ' || strtolower($city) == 'asuncion ddn' || strtolower($city) == 'asuncion' || strtolower($city) == 'asuncion,' || strtolower($city) == 'asuncion,tagum city'){
		return strtoupper('ASUNCION');
	}else if(strtolower($city) == ' sto. tomas,' || strtolower($city) == ' sto. tomas' || strtolower($city) == 'sto. tomas' || strtolower($city) == 'sto.tomas' || strtolower($city) == 'sto. tomas' || strtolower($city) == 'sto.tomas,' || strtolower($city) == 'sto. tomas,' || strtolower($city) == 'sto tomas' || strtolower($city) == 'sto tomas ' || strtolower($city) == 'sto tomas ddn' || strtolower($city) == 'sto tomas panabo city'){
		return strtoupper('STO.TOMAS');
	}else if(strtolower($city) == 'magupising barulio e.dujali' || strtolower($city) == 'magupising barulio e. dujali' || strtolower($city) == 'e. dujali' || strtolower($city) == 'braulio e. dujali' || strtolower($city) == 'barulio e. dujali' || strtolower($city) == 'braulio e. dujali' || strtolower($city) == 'barulio  e. dujali' || strtolower($city) == 'barulio e. dujali' || strtolower($city) == 'b e. dujali' || strtolower($city) == 'dujali' || strtolower($city) == 'b.e. dujali' || strtolower($city) == 'b.e. dujali,' || strtolower($city) == 'b.e dujali'){
		return strtoupper('BRAULIO E. DUJALI');
	}else if(strtolower($city) == 'new bataan ' || strtolower($city) == 'new bataan'){
		return strtoupper('NEW BATAAN');
	}else if(strtolower($city) == 'kiblawan'){
		return strtoupper('KIBLAWAN');
	}else if(strtolower($city) == 'sawata' || strtolower($city) == 'san isidro ddn' || strtolower($city) == 'san isidro'){
		return strtoupper('SAN ISIDRO');
	}else if(strtolower($city) == 'montevista ' || strtolower($city) == 'montevist' || strtolower($city) == 'montevista'){
		return strtoupper('MONTEVISTA');
	}else if(strtolower($city) == 'lupon' || strtolower($city) == 'lupon '){
		return strtoupper('LUPON');
	}else if(strtolower($city) == 'pigcawayan'){
		return strtoupper('PIGCAWAYAN');
	}else if(strtolower($city) == ' banaybnay' || strtolower($city) == 'banaybnay ' || strtolower($city) == 'banaybnay' || strtolower($city) == 'banybanay' || strtolower($city) == 'banay banay' || strtolower($city) == 'banaybanay' || strtolower($city) == 'banay-banay' || strtolower($city) == 'banaybanay ' || strtolower($city) == 'banaybanay,' || strtolower($city) == 'banay2' || strtolower($city) == 'banay2x'){
		return strtoupper('BANAYBANAY');
	}else if(strtolower($city) == 'pigcawayan'){
		return strtoupper('PIGCAWAYAN');
	}else if(strtolower($city) == 'maitim'){
		return strtoupper('MAITIM');
	}else if(strtolower($city) == 'makilala' || strtolower($city) == 'malungon'){
		return strtoupper('MAKILALA');
	}else if(strtolower($city) == 'monkayo'){
		return strtoupper('MONKAYO');
	}else if(strtolower($city) == 'arakan'){
		return strtoupper('ARAKAN');
	}else if(strtolower($city) == 'barobo'){
		return strtoupper('BAROBO');
	}else if(strtolower($city) == 'bayugan city'){
		return strtoupper('BAYUGAN CITY');
	}else if(strtolower($city) == 'siocon' || strtolower($city) == 'kinuban' || strtolower($city) == 'compostela, ' || strtolower($city) == 'compostela,' || strtolower($city) == 'compostela valley province' || strtolower($city) == 'compostela valley' || strtolower($city) == 'amco' || strtolower($city) == 'compostela' || strtolower($city) == ' comval prov.' || strtolower($city) == 'comval prov.' || strtolower($city) == 'compostela province' || strtolower($city) == 'comval province'){
		return strtoupper('COMPOSTELA');
	}else if(strtolower($city) == 'bislig city'){
		return strtoupper('BISLIG CITY');
	}else if(strtolower($city) == 'boston'){
		return strtoupper('BOSTON');
	}else if(strtolower($city) == 'bukidnon'){
		return strtoupper('MALAYBALAY');
	}else if(strtolower($city) == 'north cotabato city' || strtolower($city) == 'cotabato' || strtolower($city) == 'cotabato city'){
		return strtoupper('COTABATO CITY');
	}else if(strtolower($city) == 'agusan del sur' || strtolower($city) == 'cabadbaran'){
		return strtoupper('AGUSAN');
	}else if(strtolower($city) == 'cebu' || strtolower($city) == 'cebu city'){
		return strtoupper('CEBU CITY');
	}else if(strtolower($city) == 'governor generoso'){
		return strtoupper('GOVERNOR GENEROSO');
	}else if(strtolower($city) == 'magpet'){
		return strtoupper('MAGPET');
	}else if(strtolower($city) == 'maniki'){
		return strtoupper('MANIKI');
	}else if(strtolower($city) == 'matanao'){
		return strtoupper('MATANAO');
	}else if(strtolower($city) == 'midsayap'){
		return strtoupper('MIDSAYAP');
	}else if(strtolower($city) == 'tandag city' || strtolower($city) == 'tandag'){
		return strtoupper('TANDAG');
	}else if(strtolower($city) == 'talaingod'){
		return strtoupper('TALAINGOD');
	}else if(strtolower($city) == ''){
		return strtoupper('TAGUM CITY');
	} 
}
function GetProvince($province){
	if(strtolower($province) == 'kapalong' || strtolower($province) == 'new corella' || strtolower($province) == 'davao edl norte' || strtolower($province) == 'tagumcity' || strtolower($province) == 'davnor' || strtolower($province) == 'kapalong' || strtolower($province) == 'daavao del norte' || strtolower($province) == 'panabo city'|| strtolower($province) == ' dvo.del norte' || strtolower($province) == 'davao city' || strtolower($province) == 'davao del norte' || strtolower($province) == 'tagum city' || strtolower($province) == 'dav' || strtolower($province) == 'dvao del norte' || strtolower($province) == 'ddn' || strtolower($province) == 'davo del norte' || strtolower($province) == 'davcao del norte' || strtolower($province) == 'davaop del norte' || strtolower($province) == 'davao el norte' || strtolower($province) == 'daval edl norte' || strtolower($province) == 'daval del norte' || strtolower($province) == 'davao del nore' || strtolower($province) == 'davao del nor te' || strtolower($province) == 'davao del n orte' || strtolower($province) == 'tagum city' || strtolower($province) == 'dvo.del norte' || strtolower($province) == '8100'){
		return strtoupper('DAVAO DEL NORTE');
	}else if(strtolower($province) == 'agusan del sur'){
		return strtoupper('AGUSAN DEL SUR');
	}else if(strtolower($province) == '8806' || strtolower($province) == 'comopostela valley' || strtolower($province) == 'comval province ' || strtolower($province) == 'comval ' || strtolower($province) == 'comval province' || strtolower($province) == 'compostela valley' || strtolower($province) == 'comval' || strtolower($province) == 'da' || strtolower($province) == 'comval' || strtolower($province) == 'compostela valley province ' || strtolower($province) == 'compostela valley province' || strtolower($province) == 'comvalprovince' || strtolower($province) == 'comval rovince' || strtolower($province) == 'comval province' || strtolower($province) == 'comval provicne' || strtolower($province) == 'comval prov.' || strtolower($province) == 'compostela valle' || strtolower($province) == 'compostela valley' || strtolower($province) == 'comopostela' || strtolower($province) == 'comal province' || strtolower($province) == 'comval rovince' || strtolower($province) == 'comval' || strtolower($province) == 'compostella valley' || strtolower($province) == 'compostella valley province' || strtolower($province) == 'comvak province' || strtolower($province) == 'comva province' || strtolower($province) == 'caomval province' || strtolower($province) == 'comal province' || strtolower($province) == 'combal province' || strtolower($province) == 'compostela valle' || strtolower($province) == 'compostela valley'){
		return strtoupper('COMPOSTELA VALLEY PROVINCE');
	}else if(strtolower($province) == 'tagum c ity' || strtolower($province) == 'tagum city' || strtolower($province) == 'davao dl norte' || strtolower($province) == 'davao del norte ' || strtolower($province) == 'daavao delnorte' || strtolower($province) == 'davao delnorte' || strtolower($province) == 'davao del norte' || strtolower($province) == 'daao del norte' || strtolower($province) == 'davao' || strtolower($province) == 'davao del sur' || strtolower($province) == 'del sur'){
		return strtoupper('DAVAO DEL NORTE');
	}else if(strtolower($province) == 'mati city' || strtolower($province) == 'governor generoso' || strtolower($province) == 'davao orriental' || strtolower($province) == 'davao oriental' || strtolower($province) == 'cdavao oriental'){
		return strtoupper('DAVAO ORIENTAL');
	}else if(strtolower($province) == 'lanao del norte'){
		return strtoupper('LANAO DEL NORTE');
	}else if(strtolower($province) == 'sarangani province'){
		return strtoupper('SURANGANI PROVINCE');
	}else if(strtolower($province) == 'surigao del sur'){
		return strtoupper('SURIGAO DEL SUR');
	}else if(strtolower($province) == 'cotabato ' || strtolower($province) == 'cotabato' || strtolower($province) == 'cotabato city' || strtolower($province) == 'north cotabato'){
		return strtoupper('NORTH COTABATO');
	}else if(strtolower($province) == 'south cotabato'){
		return strtoupper('SOUTH COTABATO');
	}else if(strtolower($province) == ''){
		return strtoupper('DAVAO DEL NORTE');
	}
}
function YearOfWork($employeeInfoID,$link){
	$sql = "SELECT * FROM jserp_hrdo.employment
			LEFT JOIN jserp_hrdo.statusofemployment ON
			statusofemployment.employmentID = employment.employmentID
			WHERE employment.employeeInfoID = '".$employeeInfoID."'
			ORDER BY employment.employmentID ASC";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$counter = 1;
		while($row = mysqli_fetch_array($data)){
			if($counter == 1){
				$temp[] = $row['fromDate'];
			}
			if($counter == mysqli_num_rows($data)){
				$temp[] = $row['toDate'];
			}
			$counter ++;
		}
		//var_dump($temp);
		//echo $temp[0]."][".$temp[1]."<hr>"; 
		if(GetNumMonths($temp[0],$temp[1]) > 25){
			return rand(20,30)." ACTUAL WORK YEARS";
		}else{
			return GetNumMonths($temp[0],$temp[1])." ACTUAL WORK YEARS";
		}
	}else{

	}
}

function GetNumMonths($start,$end){
	if($end == '0000-00-00'){
		$end = date('Y-m-d');
	}else{
		
	}
	$d1 = strtotime($start);
	$d2 = strtotime($end);
	$min_date = min($d1, $d2);
	$max_date = max($d1, $d2);
	$i = 0;

	while (($min_date = strtotime("+1 MONTH", $min_date)) <= $max_date) {
		$i++;
	}
	return number_format(($i/12),1,'.','');
}
function GetTotalWorkNumMonths($start,$end){
	$d1 = strtotime($start);
	$d2 = strtotime($end);
	$min_date = min($d1, $d2);
	$max_date = max($d1, $d2);
	$i = 0;

	while (($min_date = strtotime("+1 MONTH", $min_date)) <= $max_date) {
		$i++;
	}
	return number_format(($i/12),0,'','');
	//return number_format(($i/12),1,'','');
}
function GetPosition($id,$link){
	$sql = "SELECT * FROM jserp_hrdo.employment
			WHERE employment.employeeInfoID = '".$id."'
			ORDER BY employment.employmentID DESC
			LIMIT 1";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			return $row['positionID'];
		}
	}else{
		
	}
}
function GetPositionName($id,$link){
	$sql = "SELECT * FROM jserp_hrdo.position WHERE position.positionID = '".$id."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			return strtoupper($row['positionName']);
		}
	}else{
		return "";
	}
}
function GetDept($id,$link){
	$sql = "SELECT * FROM jserp_hrdo.employment
			WHERE employment.employeeInfoID = '".$id."'
			ORDER BY employment.employmentID DESC
			LIMIT 1";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			return $row['saDeptID'];
		}
	}else{
		
	}
}
function GetDeptName($id,$link){
	$sql = "SELECT * FROM jserp_accounting.sadepartment WHERE sadepartment.saDeptID = '".$id."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$row = mysqli_fetch_array($data);
			return strtoupper($row['saDeptName']);
		
	}else{
		return "";
	}
}
function WorkHistory($id,$link){
	$sql = "SELECT * FROM jserp_hrdo.workhistory WHERE employeeInfoID = '".$id."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$total_yrs = 0;
		while($row = mysqli_fetch_array($data)){
			if($row['dateFrom'] == '0000-00-00' || $row['dateTo'] == '0000-00-00'){
				
			}else if($row['dateFrom'] != '0000-00-00' && $row['dateTo'] != '0000-00-00'){
				$total_yrs = $total_yrs + GetTotalWorkNumMonths($row['dateFrom'],$row['dateTo']);
			}
			
		}
		return $total_yrs." WORK HISTORY YEARS";
	}else{
		return "0 WORK HISTORY YEARS";
	}
}
function GetEducLevel($id,$link){
	$sql = "SELECT * FROM jserp_hrdo.educbackground WHERE employeeInfoID = '".$id."' ORDER BY educbackgroundID DESC LIMIT 1";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$row = mysqli_fetch_array($data);
		return $row['educLevelID'];
	}else{
		//return 0;
	}
}
function GetEducLevelName($id,$link){
	$sql = "SELECT * FROM jserp_hrdo.educlevel WHERE educlevel.educLevelID = '".$id."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$row = mysqli_fetch_array($data);
		return strtoupper($row['educLevelName']);
	}else{
		return "";
	}
}

function GetEmployeeAgeStart($link,$birthdate,$work_end){
	if($birthdate != '0000-00-00' && $work_end != '0000-00-00'){
		$d1 = new DateTime($work_end);
		$d2 = new DateTime($birthdate);

		$diff = $d2->diff($d1);
		if($diff->y < 15){
			return 0;
		}else if($diff->y > 18){
			return $diff->y;	
		}
		
	}else if($birthdate != '0000-00-00' && $work_end == '0000-00-00'){
		$d1 = new DateTime(date('Y-m-d'));
		$d2 = new DateTime($birthdate);

		$diff = $d2->diff($d1);
		if($diff->y < 15){
			return 0;
		}else if($diff->y > 18 && $diff->y < 70){
			return $diff->y;	
		}
	}else{
		return 0;
	}
	
}
function GetBirthDate($link,$id){
	$sql = "SELECT * FROM jserp_hrdo.employeeinfo WHERE employeeinfo.employeeInfoID = '".$id."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$row = mysqli_fetch_array($data);
		return $row['birthDate'];
	}else{
		return "0000-00-00";
	}
}
function GetWorkEnd($link,$id){
	$sql = "SELECT * FROM jserp_hrdo.statusofemployment
			WHERE employmentID IN
			(SELECT employmentID FROM jserp_hrdo.employment WHERE employeeInfoID = '".$id."')
			ORDER BY fromDate DESC LIMIT 1";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$row = mysqli_fetch_array($data);
		return $row['toDate'];
	}else{
		return "0000-00-00";
	}
}
mysqli_close($link);
?>