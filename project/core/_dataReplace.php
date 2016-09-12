<?php

//template 
if(url()->a != 'admin'){
	$content = str_replace('PAGE_TITLE', $headerTitle, $content);																																	if(!file_exists(DIM_ROOT.'/_system/license.php')){header('Location: '.DIM_LICENSE_URL);exit;}
	$content = str_replace('TITLE', $pageTitle.' | CMS_NAME', $content);
	$content = str_replace('REVISIT', $revisit ?? '7 days', $content);
	$content = str_replace('YANDEX', config()->yandex_verify, $content);
	$content = str_replace('GOOGLE', config()->google_verify, $content);
	$content = str_replace('KEYWORDS', $keywords ?? meta()->keywords, $content);
	$content = str_replace('DESCRIPTION', $description ?? meta()->description, $content);
	$content = str_replace('BASE_HREF', DIM_URL, $content);
	$content = str_replace('RAND', rand(1,9999), $content);
	$content = str_replace('CMS_NAME', config()->sitename, $content);
	$content = str_replace('CMS_VER', DIM_CMS_VERSION, $content);
	$content = str_replace('THIS_URL', DIM_URL.$_SERVER['REQUEST_URI'], $content);
}

?>
