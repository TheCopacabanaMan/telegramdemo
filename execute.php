<?php
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if(!$update)
{
  exit;
}

$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$senderId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";

$text = trim($text);
$text = strtolower($text);

/*
$response_message = "Ciccio":

if ( $text == "/start") {
  $response_message = "You asked start";
}  // */

header("Content-Type: application/json");
// $parameters = array('chat_id' => $chatId, "text" => $response_message);
$parameters = array('chat_id' => $chatId, "text" => "Ciao da Ciccio");
$parameters["method"] = "sendMessage";
echo json_encode($parameters);

?>
