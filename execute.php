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

$response_message = "Ciccio";
$parse_mode = "Markdown";

if ( $text == "/start" || $text == "/help" ) {
  $response_message = "Questo bot mostra le news, le offerte e la ricerca personale di Ermesto Spa";
  $response_message .= "\n\n";
  $response_message .= "Comandi:";
  $response_message .= "\n";
  $response_message .= "<b>/start</b> - Mostra l'help" . "\n";
  $response_message .= "<b>/news</b> - Mostra le news" . "\n";
  $response_message .= "<b>/offerte</b> - Mostra le offerte" . "\n";
  $response_message .= "<b>/ricerca</b> - Mostra la ricerca personale" . "\n";  // */
  
   $parse_mode = "HTML";
}  

header("Content-Type: application/json");
$parameters = array('chat_id' => $chatId, "text" => $response_message, parse_mode => $parse_mode);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);

?>
