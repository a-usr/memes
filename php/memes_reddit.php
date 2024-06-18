[<?php
  $url = 'https://oauth.reddit.com/api/v1/access_token';
  $client_secret = "Sqr8x_ggQA59d0qafTYLWTY2R5I8vQ";
  $client_id = "IK4RFUF0iLw5GZKveewn0Q";
  $user_agent = "User-Agent: memes crawler by u/ecstatichades17"; // Persönlicher Account :)
  $options = [
    'http' => [
      'header' => array("Content-type: application/x-www-form-urlencoded", "Authorization: Basic ".base64_encode("$client_id:$client_secret"), $user_agent), 
      'method' => 'POST',
      'content' => http_build_query(['grant_type' => 'client_credentials']),
    ],
  ];
  $context = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  if ($result === false) {
    var_dump($http_response_header);
  }
  //echo "\n\n";
  
  $token = json_decode($result)->access_token;
  //echo "$token \n\n";
  $params = ["raw_json"=> "1", "limit"=>"50", "after"=>"t3_1bug5i6"];
  if (!is_null($_POST)){
    if (array_key_exists("after", $_POST)){
      $params["after"]="t3_".$_POST["after"];
    }
  }
  //echo http_build_query($query);
  $options = [
    'http' => [
      'header' => array("Authorization: bearer $token", $user_agent),
      'method' => 'GET'
    ],
  ];
  $context = stream_context_create($options);
  $result = file_get_contents("https://oauth.reddit.com/r/memes/hot?".http_build_query($params), false, $context);
  if ($result === false) {
    var_dump($http_response_header);
  }
  //echo $result;
  $first = true;
  foreach  (json_decode($result)->data->children as &$post){
    if ($post->data->is_video){
      continue;
    }
    $data = $post->data;
    if ($first){
      $first = false;
    }
    else {
      echo ",";
    }
    echo '{"url":"https://www.reddit.com'.$data->permalink.'","img":"'.$data->url.'"}'; // wer hat sich die api ausgedacht, das ist so dumm wtf
    unset($data);
  }
  unset($post);
  //AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAa
?>]


