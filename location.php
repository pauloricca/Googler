<?
//$clientIp = $_SERVER['REMOTE_ADDR'];
try 
{
	$clientIp = exec("curl https://api64.ipify.org");
	$geoLocationUrl = "https://extreme-ip-lookup.com/json/$clientIp";
	//consoleLog( json_decode(file_get_contents($geoLocationUrl), true) );
	//system("curl $geoLocationUrl -o tmp.json");
	$locData = shell_exec("curl $geoLocationUrl");

	//echo $locData;

	$location = json_decode($locData, true)['countryCode'];

	//echo $location;
}
catch (Exception $e)
{
	$location = 'ANY';
}