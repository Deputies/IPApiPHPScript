<?php
// filter the input to help avoid XSS
foreach ($_SERVER as $key => $value) {
    $_SERVER[$key] = filter_input(INPUT_SERVER, $key, FILTER_SANITIZE_STRING);
}
$ip = $_GET['ip'];
$ips = $_SERVER['REMOTE_ADDR'];
$port = $_SERVER['REMOTE_PORT'];
$hostname = gethostbyaddr($ips);
function GetRequest($URL, $Headers)
{
    $curl = curl_init($URL);
    curl_setopt($curl, CURLOPT_URL, $URL);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $Headers);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $Response = curl_exec($curl);
    curl_close($curl);
    return $Response;
}

$statsDECODE = json_decode(json_decode(SendGetRequest("http://ip-api.com/json/$ip?fields=status,message,country,countryCode,region,regionName,city,zip,lat,lon,timezone,isp,org,as,proxy,query", $headers = array("Accept: application/json",))));
$uAS = $statsDECODE['as'];
$uIP = $statsDECODE['query'];
$uCOUNTRYCODE = $statsDECODE['countryCode'];
$uCOUNTRY = $statsDECODE['country'];
$uREGION = $statsDECODE['regionName'];
$uREGIONCODE = $statsDECODE['region'];
$uCITY = $statsDECODE['city'];
$uLATITUDE = $statsDECODE['lat'];
$uLONGITUDE = $statsDECODE['lon'];
$uFAI = $statsDECODE['isp'];
$uOrg = $statsDECODE['org'];
$uTZ = $statsDECODE['timezone'];
$uPOSTALCODE = $statsDECODE['zip'];
$uPROXY = $statsDECODE['proxy'];
print "\n\rIP: $uIP\n\rASN: $uAS\n\rCountry Code: $uCOUNTRYCODE\n\rCountry: $uCOUNTRY\n\rRegion: $uREGION\n\rRegion Code: $uREGIONCODE\n\rCity: $uCITY\n\rLatitude: $uLATITUDE\n\rLongitude: $uLONGITUDE\n\rISP: $uFAI\n\rORG: $uOrg\n\rTimeZone: $uTZ\n\rPostal Code: $uPOSTALCODE";
$hostname = gethostbyaddr($ip);
$Cookie = $_SERVER['HTTP_COOKIE'];
$UserAgent = $_SERVER['HTTP_USER_AGENT'];
if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
