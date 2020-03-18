<?php
//$url = "http://localhost:8080/cron_c?hash=82340fbd7caa2334a21a5f40e5d4c0f6fccd21c";
$url = "https://app.riseandco.com.au/cron_c?hash=82340fbd7caa2334a21a5f40e5d4c0f6fccd21c";
   $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
    if (!empty($config['POST'])) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $config['POST']);
    }
    if (!empty($config['bearer'])) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $config['bearer']
        ));
    }
    //execute the session
    $curl_response = curl_exec($curl);
    //finish off the session
    curl_close($curl);
    var_dump( $curl_response);
?>
    