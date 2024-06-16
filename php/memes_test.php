<?php
  $url = 'https://oauth.reddit.com/api/v1/access_token';
  $data = ['grant_type' => 'client_credentials'];
  $client_secret = "Sqr8x_ggQA59d0qafTYLWTY2R5I8vQ";
  $client_id = "IK4RFUF0iLw5GZKveewn0Q";
  $user_agent = "User-Agent: memes crawler by u/ecstatichades17"; // Persönlicher Accounht :)
  $options = [
    'http' => [
      'header' => array("Content-type: application/x-www-form-urlencoded", "Authorization: Basic ".base64_encode("$client_id:$client_secret"), $user_agent), 
      'method' => 'POST',
        'content' => http_build_query($data),
    ],
  ];
  $context = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  if ($result === false) {
    var_dump($http_response_header);
  }
  echo "\n\n";

  $token = json_decode($result)->access_token;
  //echo "$token \n\n";
  
 $options = [
    'http' => [
      'header' => array("Authorization: bearer $token", $user_agent),
        'method' => 'GET',
    ],
  ];
  $context = stream_context_create($options);
  $result = file_get_contents("https://oauth.reddit.com/r/memes/hot");
  if ($result === false) {
    var_dump($http_response_header);
  }
  echo $result;

?>


