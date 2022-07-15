<?php
$access_token = 'yWuvnEt8tgaRm7sWSg_UPA0tcnOC_qVG'; // <----- API - Access Token Here
$scopes 	= 'personel,student,templecturer'; 	// <----- Scopes for search account type
$username 	= $_POST['username']; // <----- Username for authen
$password 	= $_POST['password']; 	// <----- Password for authen

$api_url = 'https://api.account.kmutnb.ac.th/api/account-api/user-authen'; // <----- API URL

$ch = curl_init();// Initiate connection
curl_setopt($ch, CURLOPT_URL, $api_url); // set url
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // 10s timeout time for cURL connection
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Allow https verification if true
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Verify the certificate's name against host 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);// Set so curl_exec returns the result instead of outputting it.
curl_setopt($ch, CURLOPT_POST, true);// Set post method
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // automatically follow Location: headers (ie redirects)
curl_setopt($ch, CURLOPT_POSTFIELDS, array('scopes' => $scopes, 'username' => $username, 'password' => $password));
$response = curl_exec($ch);
// echo $response;
// exit();