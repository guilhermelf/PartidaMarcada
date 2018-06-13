<?php
use Doctrine\ORM\Query\ResultSetMappingBuilder;

class AvaliacaoOrganizadorDAO {

    function persist($avaliacaoOrganizador) {
        try {
            DataBase::getFactory()->persist($avaliacaoOrganizador);
            DataBase::getFactory()->flush();
            
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    static function getById($id) {
        try {
            $avaliacaoOrganizador = DataBase::getFactory()->getRepository('AvaliacaoOrganizador')->find(array('id' => $id));

            return (empty($avaliacaoOrganizador) ? false : $avaliacaoOrganizador);
        } catch (Exception $ex) {
            return false;
        }
    }

    function getAll() {
        try {
            $avaliacaoOrganizadors = DataBase::getFactory()->getRepository('AvaliacaoOrganizador')->findAll();

            return (empty($avaliacaoOrganizadors) ? false : $avaliacaoOrganizadors);
        } catch (Exception $ex) {
            return false;
        }
    }

    function delete($avaliacaoOrganizador) {
        try {
            DataBase::getFactory()->remove($avaliacaoOrganizador);

            DataBase::getFactory()->flush();

            return !DataBase::getFactory()->contains($avaliacaoOrganizador);
        } catch (Exception $ex) {
            return false;
        }
    }
    
    function avaliacaoOrganizadorExiste($parqueEsportivo, $partida) {
        try {
            $query = DataBase::getFactory()->createQuery("SELECT a FROM AvaliacaoOrganizador a JOIN a.partida p JOIN p.quadra q JOIN q.parqueEsportivo par WHERE par.id = :parqueEsportivo AND p.id = :partida");
            $query->setParameter('parqueEsportivo', $parqueEsportivo);
            $query->setParameter('partida', $partida);
            
            $participantes = $query->getResult();

            return (empty($participantes) ? 0 : 1);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}