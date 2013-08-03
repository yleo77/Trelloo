<?php 

require_once('global.php');

list($type, $id) = explode(";", $argv[1]);

if ($type == 'board'):
	$filename = $datadir . '/boardlist.xml';
elseif ( $type == 'card'):
	$filename = $datadir . '/cardlist.xml';
endif;
echo file_get_contents($filename);

?>