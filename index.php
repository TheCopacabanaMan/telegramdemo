<?php

	/*
	@botfather:
	- mandare un comando ( es. /token )
	- inserire lo username del bot ( es. @Ciccio_TestBot )
	// */
	
	/*
	Esempio: 
	https://github.com/D4RKONION/bobbot/blob/master/bobbot.php
	// */

	$bottoken = "190431457:AAHYkaA3x4P1SSH0pAVVyE61mNO7tfev1mw";
	$website = "https://api.telegram.org/bot".$bottoken;
	
	// $update = file_get_contents($website. "/getupdates?offset=0");
	// $update = file_get_contents($website. "/getme");
	$update = file_get_contents("php://input");
	if ( strlen($update ) == 0) {
		echo "Non ho ricevuto niente";
		return;
	}
	
	$update_array = json_decode($update, TRUE);
	// print_r( $update_array );
	
	$chat_id = $update_array["result"][0]["message"]["chat"]["id"];
	$text = $update_array["result"][0]["message"]["text"];
	// print_r( $text. "<br />" );
	// print_r($chat_id. "<br />"); 
	file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=Ciao");
	
  

/*
@BotFather

@Ciccio_TestBot

Riceve le news, le offerte e la ricerca personale di Ernesto Spa.

/setcommands
@Ciccio_TestBot

start - Mostra un elenco dei comandi
ultima_news - Mostra l'ultima news
ricerca_personale - Mostra le richerche di personale

/setprivacy
@Ciccio_TestBot
// */

?>
