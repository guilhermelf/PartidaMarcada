<?php
use Doctrine\ORM\Query\ResultSetMappingBuilder;

class EstatisticaQuadraDAO {

    function persist($estatisticaQuadra) {
        try {
            DataBase::getFactory()->persist($estatisticaQuadra);
            DataBase::getFactory()->flush();
            
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    static function getById($id) {
        try {
            $estatisticaQuadra = DataBase::getFactory()->getRepository('EstatisticaQuadra')->find(array('id' => $id));

            return (empty($estatisticaQuadra) ? false : $estatisticaQuadra);
        } catch (Exception $ex) {
            return false;
        }
    }

    function getAll() {
        try {
            $query = DataBase::getFactory()->createQuery("SELECT a FROM EstatisticaQuadra a WHERE 1 = 1 ORDER BY a.partidas DESC")->setMaxResults(10);

            $estatisticaQuadras = $query->getResult();

            return (empty($estatisticaQuadras) ? false : $estatisticaQuadras);
        } catch (Exception $ex) {
            return false;
        }
    }

    function delete($estatisticaQuadra) {
        try {
            DataBase::getFactory()->remove($estatisticaQuadra);

            DataBase::getFactory()->flush();

            return !DataBase::getFactory()->contains($estatisticaQuadra);
        } catch (Exception $ex) {
            return false;
        }
    }
}