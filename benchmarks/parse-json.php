<?
$_all = timer();
$_read = timer();


// Read json file
$fn = './example.json';
$fp	= fopen($fn, 'r');
$json_str = fread($fp, filesize($fn));
fclose($fp);


echo "json.read: ". (timer() - $_read) ."ms\n";
$_parse	= timer();

// JSON parse
for ($i = 0; $i < 100; $i++)
	$json = json_decode($json_str, true);
$json = $json['data']['messages'];

echo "json.parse100: ". (timer() - $_parse) ."ms\n";
$_trasnform = timer();

// JSON transform
$clone = array();
for( $i = 0; $i < count($json); $i++ ){
	$clone[$i] = array();
	foreach( $json[$i] as $key => $value  ){
		$clone[$i][$key] = $value;
	}
}

echo "json.transform: ". (timer() - $_trasnform) ."ms\n";
echo "all: ". (timer() - $_all) ."ms\n";


function timer (){
	return round(microtime(true) * 1000);
}
?>
