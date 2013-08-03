<?php

require_once('global.php');

if ( !isset($masterBoard) || empty($masterBoard)) {
	echo 'Please set master board id first';
	die();
}

$w = new Workflows();

$query = $argv[1];

$params = explode(' ', $query);

if( count($params) >= 2) {
	$listnu = $params[0];
	if( !is_numeric($listnu) ){
		$listnu = 0;
		$cardname = urlencode($query);
	} else {
		$cardname = urlencode($params[1]);
	}
	if( $listnu > 0) {
		$listnu = $listnu-1;
	}
} else {
	$listnu = 0;
	$cardname = urlencode($query);
}

$url = $api.'boards/'.$masterBoard.'?lists=open&list_fields=name&key='.$key.'&token='.$token;

$data = $w->request( $url );
$data = json_decode( $data );

if( $listnu >= count($data->lists) ) {
	$listnu = count($data->lists) - 1;
}

$listid = $data->lists[$listnu]->id;  

$url = $api. 'cards'; 
$postopt = array(
    CURLOPT_SSL_VERIFYPEER => false,  
    CURLOPT_RETURNTRANSFER => true,  
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS => http_build_query(array( 
        'key'    => $key,
        'token'  => $token,
        'idList' => $listid,
        'name'   => $cardname
    ))
);

$data = $w->request( $url, $postopt);
$data = json_decode($data);

echo ($data->url) ? 'Card : ' .urldecode( $cardname ) . ' Add Success!｡◕‿◕｡'
	: 'Something Wrong! m(_ _)m';

?>


