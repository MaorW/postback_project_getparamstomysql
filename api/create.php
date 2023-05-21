<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../config/Database.php';
  include_once '../models/Postback.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Postback object
  $postback= new Postback($db);
  $param = '';
  // Check if there is a GET method for 'postback_params' parameter or not
  if (!empty(array_diff($_GET, [''])))
  {
    foreach ($_GET as $getParam => $value) {
      if ($param != ""){
        $param = "$param" . '&' ;
      }
      $param = "$param" . "$getParam" . "=" . "$value" ;
    }
      // echo $param;
      // die();
      // $postback->postback_params = $param;
      $postback->postback_params = $param;
      // Send the query to the create func for the insert query
      if($postback->create()) {
        echo json_encode(
          array('message' => 'postback record has been createded')
        );
      }
  } else {
    echo json_encode(
      array('message' => 'postback record has been not been createded. Please send args')
    );
  }
