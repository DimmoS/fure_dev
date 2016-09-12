<?php

function db(){
	static $db = null;
	if(!$db){
		if(!$db = new mysqli('localhost','login','password','base')) die('Ошибка подключения БД.<br><br>');
		if(!$db->set_charset('utf8')) die('Кодировка библиотеки не установлена');
    }
    return $db;
}

function prepare($query){
	++$_SESSION['db_count'];
	if(!$sql = db()->prepare($query)) die(db()->error);
	return $sql;
}

function query($query){
	++$_SESSION['db_count'];
	if(!$sql = db()->query($query)) die(db()->error);
	return $sql;
}

function multi_query($query){
	++$_SESSION['db_count'];
	if(!$sql = db()->multi_query($query)) die(db()->error);
	return $sql;
}

?>
