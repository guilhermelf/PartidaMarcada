<?php
use Doctrine\ORM\Query\ResultSetMappingBuilder;

class EstatisticaAtletaDAO {

    function persist($estatisticaAtleta) {
        try {
            DataBase::getFactory()->persist($estatisticaAtleta);
            DataBase::getFactory()->flush();
            
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    static function getById($id) {
        try {
            $estatisticaAtleta = DataBase::getFactory()->getRepository('EstatisticaAtleta')->find(array('id' => $id));

            return (empty($estatisticaAtleta) ? false : $estatisticaAtleta);
        } catch (Exception $ex) {
            return false;
        }
    }

    function getAll() {
        try {          
            $query = DataBase::getFactory()->createQuery("SELECT a FROM EstatisticaAtleta a WHERE 1 = 1 ORDER BY a.pontos DESC")->setMaxResults(10);

            $estatisticaAtletas = $query->getResult();
            
            return (empty($estatisticaAtletas) ? false : $estatisticaAtletas);
        } catch (Exception $ex) {
            return false;
        }
    }

    function delete($estatisticaAtleta) {
        try {
            DataBase::getFactory()->remove($estatisticaAtleta);

            DataBase::getFactory()->flush();

            return !DataBase::getFactory()->contains($estatisticaAtleta);
        } catch (Exception $ex) {
            return false;
        }
    }
}