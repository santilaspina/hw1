<?php 
    $tokenURL ="https://accounts.spotify.com/api/token";
    $client_id="2bae09ae31ad44d6bb99c0c9505c9804";
    $client_secret="9fdb386fa4424b8090fa1c35b0982402";

    $richiestaURL="https://api.spotify.com/v1/browse/new-releases";

    $curl=curl_init();
    curl_setopt($curl, CURLOPT_URL, $tokenURL);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    $headers=array("Authorization: Basic ".base64_encode($client_id.":".$client_secret));
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $result= curl_exec($curl);
    curl_close($curl);

    $json_data=json_decode($result);

    
    $token = $json_data->access_token;  //funzione fino a qua
    /*echo "<h1>" . $token ."</h1>";*/ 

    $curl=curl_init();
    curl_setopt($curl, CURLOPT_URL, $richiestaURL);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER, true );
    $headersRichiesta=array("Authorization: Bearer ".$token);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headersRichiesta);

    $resultRichiesta= curl_exec($curl);
    curl_close($curl);  

    echo  $resultRichiesta; 


?>