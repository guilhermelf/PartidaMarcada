<?php

require_once 'vendor/autoload.php';

// o Doctrine utiliza namespaces em sua estrutura, por isto estes uses
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

//onde irão ficar as entidades do projeto? Defina o caminho aqui
$entidades = array("app/model/");
$isDevMode = true;

// configurações de conexão. Coloque aqui os seus dados
$dbParams = array(
    'driver' => 'pdo_mysql',
    'user' => 'database user',
    'password' => 'database pass',
    'dbname' => 'partidamarcada',
);

//setando as configurações definidas anteriormente
$config = Setup::createAnnotationMetadataConfiguration($entidades, $isDevMode);

//criando o Entity Manager com base nas configurações de dev e banco de dados
$entityManager = EntityManager::create($dbParams, $config);
