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
  // mando la stringa ricevuta al server web
  $destination_url = "http://confienza.between.it/telegramdemo/register.php?first_name=". urlencode($firstname) ."&last_name=". urlencode($lastname) ."&command=". urlencode($text);
  $result_from_server_confienza = file_get_contents($destination_url);

// mettiamo un messaggio di default
$response_message = "Comando non riconosciuto";
$parse_mode = "Markdown";

if ( $text == "/start" || $text == "/help" ) {
  $parse_mode = "HTML";

  $response_message = "Questo bot mostra le news e la ricerca personale di Ermesto Spa";
  $response_message .= "\n\n";
  $response_message .= "Comandi:";
  $response_message .= "\n";
  $response_message .= "<a href='/start'>/start</a> - Mostra l'help" . "\n";
  $response_message .= "<a href='/news'>/news</a> - Mostra le news" . "\n";
  $response_message .= "<a href='/ricerca'>/ricerca</a> - Mostra la ricerca personale" . "\n";
}  

if ( $text == "/news" ) {
  $parse_mode = "HTML";
  $response_message = "";
  $result_decoded = json_decode( $result_from_server_confienza );

  foreach( $result_decoded as $una_news ) {
    /*
    $response_message .= $una_news->data;
    $response_message .= " <b>". $una_news->titolo ."</b> ";
    $response_message .= "<a href='http://confienza.between.it/telegramdemo/leggi_news.php?id='". $una_news->id ."' >Leggi</a>";
    $response_message .= "\n";  // */
  }  
  $response_message = "Messaggio decodificato 2";
}

if ( $text == "/ricerca") {
  $parse_mode = "HTML";
  $response_message = $result_from_server_confienza;
}

  header("Content-Type: application/json");
  $parameters = array('chat_id' => $chatId, "text" => $response_message, parse_mode => $parse_mode);
  $parameters["method"] = "sendMessage";
  echo json_encode($parameters);

?>
