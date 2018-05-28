<?php
use Doctrine\ORM\Query\ResultSetMappingBuilder;

class AvaliacaoAtletaDAO {

    function persist($avaliacaoAtleta) {
        try {
            DataBase::getFactory()->persist($avaliacaoAtleta);
            DataBase::getFactory()->flush();
            
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    static function getById($id) {
        try {
            $avaliacaoAtleta = DataBase::getFactory()->getRepository('AvaliacaoAtleta')->find(array('id' => $id));

            return (empty($avaliacaoAtleta) ? false : $avaliacaoAtleta);
        } catch (Exception $ex) {
            return false;
        }
    }

    function getAll() {
        try {
            $avaliacaoAtletas = DataBase::getFactory()->getRepository('AvaliacaoAtleta')->findAll();

            return (empty($avaliacaoAtletas) ? false : $avaliacaoAtletas);
        } catch (Exception $ex) {
            return false;
        }
    }

    function delete($avaliacaoAtleta) {
        try {
            DataBase::getFactory()->remove($avaliacaoAtleta);

            DataBase::getFactory()->flush();

            return !DataBase::getFactory()->contains($avaliacaoAtleta);
        } catch (Exception $ex) {
            return false;
        }
    }
    
    function avaliacaoExiste($usuario, $partida) {
        try {
            $query = DataBase::getFactory()->createQuery("SELECT a FROM AvaliacaoQuadra a JOIN a.usuario u JOIN a.partida p WHERE u.id = :usuario AND p.id = :partida");
            $query->setParameter('usuario', $usuario);
            $query->setParameter('partida', $partida);
            
            $participantes = $query->getResult();

            return (empty($participantes) ? 0 : 1);
        } catch (Exception $ex) {
            return false;
        }
    }
}