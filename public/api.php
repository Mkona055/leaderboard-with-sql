<?php
include 'config.php';
  header('Content-Type: application/json');
  $all = getallheaders();
  $token = $all['partner-api-key'];

  if(authenticate($token,$dbconn)){
    $success = ["Success"=>"Connected Successfully. Copy and paste the above URL into your browser "];
    echo json_encode($success);
    echo "\n";
    header("URL_TO_COPY:http://localhost:4000/partners_space.php?identifier=$token");
  }else{
    http_response_code(401);
    $error = ["Authentication error"=>'Please provide a valid secret-key'];
    echo json_encode($error);
  }

?>
