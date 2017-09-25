<?php


require_once __DIR__ . '/Class.Create.WS.php';

$cws = new \Create\CreateWS( );
$simpleKeyboard = [
	0 => [ '/start'],
];


$cws->addNewContent( json_encode( $cws->getAllAnswerFields( ) ) );

$currentState = $cws->getAnswerField( 'state' );
$cws->setState( ++$currentState );

$cws->setReturnUrl( true );

$cws->setKeyboard( $simpleKeyboard );

$cws->outputJson( );

