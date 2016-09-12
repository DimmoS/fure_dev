<?php

define('DIM_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('DIM_DEBUG', true);

session_name('dimcms');
session_save_path(realpath(dirname(DIM_ROOT).'/../tmp'));
session_start();

$mt = microtime(1);
$ver = $_SESSION['device'] ?? ($_COOKIE['device'] ?? 'unknown');
$_SESSION['device'] = $ver;

require_once 'core/_pageRoute.php';
require_once 'core/_siteConfig.php';
require_once 'core/_dbConnection.php';
require_once 'core/_systemFunctions.php';
require_once 'core/_userFunctions.php';
require_once 'core/_userInterface.php';

if(file_exists(DIM_ACTION_PATH.'/'.route().'.php')) require_once DIM_ACTION_PATH.'/'.route().'.php';
if(!file_exists(DIM_TPL_PATH.'/'.config()->theme.'.html')) showInfo('Отсутствует шаблон '.config()->theme);

$tpl = !file_exists(DIM_PAGE_PATH.'/'.($template ?? url()->a).'.html') ? null : ($template ?? url()->a);

$c = round(microtime(1) - $mt, 5);
$mtt = microtime(1);

//$lastmod = getTpl()->lastmod ?? (meta()->lastmod ?? config()->lastmod);
$headerTitle = $header ?? meta()->title;
$pageTitle = $title ?? meta()->title;

ob_start('ob_gzhandler');
ob_start();
require_once 'templates/'.config()->theme.'.html';

$content = ob_get_contents();
$len = ob_get_length();

require_once 'core/_dataReplace.php';

ob_end_clean();

header('Content-Length: '.$len);
header('Content-Type: text/html; charset=utf-8');
header('Content-Language: ru');

echo $content;
require_once 'core/pageInfo.php';

db()->close();
ob_end_flush();

die;

?>
