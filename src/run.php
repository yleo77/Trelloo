<?php

require_once('global.php');


list($type, $query) = explode(";", $argv[1]);

if ( $type == 'open' || $type == 'copy' || $type == 'set') {

	list($url, $id) = explode("__SPLITER__", $query);

	if($type == 'open') {
		exec('open '.$url);
	} else if ( $type == 'copy') {
		exec('echo '.$url.' | pbcopy');
		echo 'Copy Success';
	} else if ( $type == 'set') {
		$str = preg_replace( '/\$masterBoard ?= ?"\w*"/si',
							"\$masterBoard = \"$id\"",
							file_get_contents('userconfig.php')
			   );
		file_put_contents('userconfig.php', $str);
		echo 'Set Master Board Success!';
	}
	
} else if ( $type == 'notice') {

	$w = new Workflows();

	$url = $api.'members/me/notifications?read_filter=unread&key='.$key.'&token='.$token;

	$data = $w->request( $url );
	$data = json_decode( $data );

	if( count($data) == 0 ) {
		echo 'Nothing Happened... (-_-) zzz';
	} else {
		exec('open https://trello.com/me/notifications');
		echo 'New Notifications is Here. Check Out. ｡◕‿◕｡';
	}

} else if ( $type == 'pull') {

	$w = new Workflows();
	try {
		///// board
		$url = $api.'members/me/boards?key='.$key.'&token='.$token;
		$data = json_decode( $w->request( $url ));

		foreach( $data as $results ):
			$w->result( $results->id, $results->url . '__SPLITER__' . $results->id, $results->name, strip_tags($results->desc), 'icon.png', 'yes');
			if ( !empty($masterBoard) && $results->id === $masterBoard ):
				$arr = $w->results();
				$temp = $arr[0];
				$pos = count($arr)-1;
				$arr[0] = $arr[$pos];
				$arr[$pos] = $temp;
				$w->results($arr);
				unset($temp);
				unset($pos);
				unset($arr);
			endif;
		endforeach;

		file_put_contents( $datadir . '/boardlist.xml', $w->toxml());	

		///// cards
		$w->reset();

		$url = $api.'members/me/cards?filter=open&fields=id,name,desc,due,dateLastActivity&key='.$key.'&token='.$token;
		$data = json_decode( $w->request( $url ));

		foreach( $data as $results ):
			$w->result( $results->id, $results->url . '__SPLITER__' . $results->id, $results->name, strip_tags($results->desc), 'icon.png' );
		endforeach;

		file_put_contents( $datadir . '/cardlist.xml', $w->toxml());	

		echo 'Pull Success! Data In: ' . $datadir;
		
	} catch (Exception $e) {
		echo 'Error!' . $e;
	}
}



?>