<?php
use Doctrine\ORM\Query\ResultSetMappingBuilder;

class AvaliacaoQuadraDAO {

    function persist($avaliacaoQuadra) {
        try {
            DataBase::getFactory()->persist($avaliacaoQuadra);
            DataBase::getFactory()->flush();
            
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    static function getById($id) {
        try {
            $avaliacaoQuadra = DataBase::getFactory()->getRepository('AvaliacaoQuadra')->find(array('id' => $id));

            return (empty($avaliacaoQuadra) ? false : $avaliacaoQuadra);
        } catch (Exception $ex) {
            return false;
        }
    }

    function getAll() {
        try {
            $avaliacaoQuadras = DataBase::getFactory()->getRepository('AvaliacaoQuadra')->findAll();

            return (empty($avaliacaoQuadras) ? false : $avaliacaoQuadras);
        } catch (Exception $ex) {
            return false;
        }
    }

    function delete($avaliacaoQuadra) {
        try {
            DataBase::getFactory()->remove($avaliacaoQuadra);

            DataBase::getFactory()->flush();

            return !DataBase::getFactory()->contains($avaliacaoQuadra);
        } catch (Exception $ex) {
            return false;
        }
    }
}