<?php
header('Content-Type: text/html; charset=utf-8');

try {
    require_once(dirname(__FILE__).'/doctrine.php');
    require_once(dirname(__FILE__).'/define.php');
    require_once(dirname(__FILE__).'/controller.php');
    require_once(dirname(__FILE__).'/route.php');
    require_once(dirname(__FILE__).'/system.php');
    require_once(UTIL.'/Retorno.php');

    $start = new System();
    
    return $start;
} catch (Exception $ex) {
    echo $ex->getMessage();
}
