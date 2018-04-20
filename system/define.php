<?php
define('APP', dirname(dirname(__FILE__))."/app/");

define('CONTROLLERS', APP."controllers/");

define('MODELS', APP."models/");
define('BLL', MODELS.'bll/');
define('DAO', MODELS.'dao/');

define('UTIL', APP.'util/');

define('VIEWS', APP.'views/');
define('PUBLIC_HTML', dirname(__FILE__).'/../public/');