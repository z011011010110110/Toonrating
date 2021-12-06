<?php
 
// From URL to get webpage contents
$url1 = "https://www.google.com/";
$url2 = "https://www.webtoons.com/en/challenge/spookman/list?title_no=263735";
 
// Initialize a CURL session.
 function file_get_contents_curl($url) {
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  
	curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
echo file_get_contents($url2);
echo file_get_contents($url1);
echo file_get_contents_curl($url2);
print_r(error_get_last());
?>