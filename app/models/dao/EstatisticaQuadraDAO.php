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
            $estatisticaQuadras = DataBase::getFactory()->getRepository('EstatisticaQuadra')->findAll();

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