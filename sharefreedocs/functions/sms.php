<?
function sms($m,$mobile_no)
{
$curl_handle=curl_init();
 curl_setopt($curl_handle, CURLOPT_URL, 'http://ubaid.tk/sms/sms.aspx?uid=7276671866&pwd=mohit&msg='.urlencode($m).'&phone='.urlencode($mobileno).'&provider=Site2Sms');
curl_exec($curl_handle);
curl_close($curl_handle);
}?>