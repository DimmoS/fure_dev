<?php

function url(){
	static $url = null;
	if(!$url){
		$url = explode('/', filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL));
		$cnt = count($url);
		for($i = 1; $i < $cnt; ++$i){
			$n = ['','a','b','c','d','e','f','g'];
			$url[$n[$i]] = $url[$i];
			unset($url[$i]);
		}
		$url = (object)$url;
		$url->a = $url->a == '' ? 'index' : $url->a;
	}
	return $url;
}

function route(){
	static $a = null;
	if(!$a){
		//validate_nameVALIDATE
		if(preg_match('/^validate\_([\w]+)$/', url()->a)){$a = 'validate';}
		//link_shortCode
		else if(preg_match('/^link\_([\w]+)$/', url()->a)){$a = 'link';}
		//default 
		else{ $a = url()->a; }
	}
	return $a;
}

if(!preg_match('/^([\w]+)$/', route())){
	header('Location: /error', true, 404);
	exit;
}

?>
