<?php

$path = 'files/'.$_FILES['file']['name'];

move_uploaded_file($_FILES['file']['tmp_name'], $path);

$data = explode($_POST['separator'], file_get_contents($path));

$stats = [];
foreach($data as $str){
	$stats[] = preg_match_all('/[0-9]/', $str);
}

$html = '';
foreach($stats as $i => $stat){
	$html .= '<div>Строка №'.$i.' = '.$stat.'</div>';
}

echo json_encode([
	'result' => $html
], JSON_UNESCAPED_UNICODE);