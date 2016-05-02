<?php
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if(!$update)
{
  exit;
}

  // mando la stringa ricevuta al server web
  $destination_url = "http://confienza.between.it/telegramdemo/register.php";
  $parameters = "?stringa=". $content;
  $handle = curl_init($destination_url . $parameters );
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);  
  $result = curl_exec($handle);


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
  $parse_mode = "HTML";

  $response_message = "Questo bot mostra le news, le offerte e la ricerca personale di Ermesto Spa";
  $response_message .= "\n\n";
  $response_message .= "Comandi:";
  $response_message .= "\n";
  $response_message .= "<a href='/start'>/start</a> - Mostra l'help" . "\n";
  $response_message .= "<a href='/news'>/news</a> - Mostra le news" . "\n";
  $response_message .= "<a href='/offerte'>/offerte</a> - Mostra le offerte" . "\n";
  $response_message .= "<a href='/ricerca'>/ricerca</a> - Mostra la ricerca personale" . "\n";
  $response_message .= "\n(ho ricevuto: '". $result ."')\n";
}  

  header("Content-Type: application/json");
  $parameters = array('chat_id' => $chatId, "text" => $response_message, parse_mode => $parse_mode);
  $parameters["method"] = "sendMessage";
  echo json_encode($parameters);

?>
