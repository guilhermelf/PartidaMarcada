<?php
use Doctrine\ORM\Query\ResultSetMappingBuilder;

class PartidaDAO {

    function persist($partida) {
        try {
            DataBase::getFactory()->persist($partida);
            DataBase::getFactory()->flush();
            
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    static function getById($id) {
        try {
            $partida = DataBase::getFactory()->getRepository('Partida')->find(array('id' => $id));

            return (empty($partida) ? false : $partida);
        } catch (Exception $ex) {
            return false;
        }
    }

    function getAll() {
        try {
            $partidas = DataBase::getFactory()->getRepository('Partida')->findAll();

            return (empty($partidas) ? false : $partidas);
        } catch (Exception $ex) {
            return false;
        }
    }
    
    function getPast($usuario) {
        try {
            $query = DataBase::getFactory()->createQuery("SELECT p FROM Partida p JOIN p.usuario u WHERE (u.id = :usuario AND p.data < CURRENT_DATE()) OR (u.id = :usuario AND p.data = CURRENT_DATE()) ORDER BY p.data DESC");
            $query->setParameter('usuario', $usuario);
            
            $partidas = $query->getResult(); 
            
            return (empty($partidas) ? false : $partidas);
        } catch (Exception $ex) {
            return false;
        }
    }
    
    function isPast($partida) {
        try {
            $query = DataBase::getFactory()->createQuery("SELECT p FROM Partida p WHERE (p.id = :partida AND p.data < CURRENT_DATE()) OR (p.id = :partida AND p.data = CURRENT_DATE() AND p.inicio <= :hora)");
            $query->setParameter('partida', $partida);
            $query->setParameter('hora', date('H')-5);
            
            $partida = $query->getResult(); 
            
            return (empty($partida) ? 0 : 1);
        } catch (Exception $ex) {
            return false;
        }
    }
    
    function getNew($usuario) {
        try {
            $rsm = new ResultSetMappingBuilder(DataBase::getFactory());
            $rsm->addRootEntityFromClassMetadata('Partida', 'p');
            //$rsm->addJoinedEntityFromClassMetadata('Usuario', 'u', 'p', 'usuario', array('id' => 'id_usuario'));
            //$rsm->addEntityResult('Partida', 'p');
            //$rsm->addFieldResult('p', 'id_partida', 'id');
            
            $query = DataBase::getFactory()->createNativeQuery("SELECT DISTINCT
                                                                    p.id_partida,
                                                                    p.id_quadra,
                                                                    p.id_esporte,
                                                                    p.inicio,
                                                                    p.publico,
                                                                    p.numero_jogadores,
                                                                    p.descricao,
                                                                    p.id_usuario,
                                                                    p.data,
                                                                    p.status
                                                                FROM 
                                                                    partidamarcada.partida p 
                                                                INNER JOIN participante par
                                                                    ON p.id_partida = par.id_partida
                                                                INNER JOIN usuario u
                                                                    ON u.id_usuario = par.id_usuario
                                                                WHERE
                                                                    par.id_usuario = :usuario AND p.data > CURRENT_DATE() AND par.id_status <> 3 
                                                                ORDER BY
                                                                    p.data, p.inicio ASC", $rsm);
            $query->setParameter('usuario', $usuario);
            
            $partidas = $query->getResult(); 
            
            return (empty($partidas) ? false : $partidas);
        } catch (Exception $ex) {
            return false;
        }
    }

    function delete($partida) {
        try {
            DataBase::getFactory()->remove($partida);

            DataBase::getFactory()->flush();

            return !DataBase::getFactory()->contains($partida);
        } catch (Exception $ex) {
            return false;
        }
    }
    
    function getByUsuario($usuario) {
        try {
            $query = DataBase::getFactory()->createQuery("SELECT a FROM Partida a JOIN a.usuario u WHERE u.id = :usuario");
            $query->setParameter('usuario', $usuario);
            
            $partidas = $query->getResult();           
            
            return (empty($partidas) ? false : $partidas);
        } catch (Exception $ex) {
            return false;
        }  
    }
}