<?php
require_once 'vendor/autoload.php';

// o Doctrine utiliza namespaces em sua estrutura, por isto estes uses
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class DataBase {

    private static $_instance;

    public function __construct() {      
    }

    /**
     * Get a factory instance. 
     * @return App_DaoFactory
     */
    public static function getFactory() {
        if (!self::$_instance) {
            
            $entidades = array("../app/models/vo");
            $isDevMode = true;

            // configurações de conexão. Coloque aqui os seus dados
            $dbParams = array(
                'driver' => 'pdo_mysql',
                'user' => 'root',
                'password' => '',
                'dbname' => 'partidamarcada',
            );

            //setando as configurações definidas anteriormente
            $config = Setup::createAnnotationMetadataConfiguration($entidades, $isDevMode);

            //criando o Entity Manager com base nas configurações de dev e banco de dados
            $em = EntityManager::create($dbParams, $config);
            
            self::$_instance = $em;
        }
        return self::$_instance;
    }

    /**
     * Get a Question DAO
     * @return App_Dao_Question_Interface
     */
    public function getQuestionDao() {
        return new App_Dao_Doctrine_Question();
    }
}