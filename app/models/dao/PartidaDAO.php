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
                                                                    par.id_usuario = :usuario AND p.data < CURRENT_DATE() AND par.id_status <> 3 AND p.status <> 0 AND p.status <> 2
                                                                ORDER BY
                                                                    p.data, p.inicio DESC", $rsm);
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
                                                                    par.id_usuario = :usuario AND p.data > CURRENT_DATE() AND par.id_status <> 3 AND p.status <> 0 AND p.status <> 2
                                                                ORDER BY
                                                                    p.data, p.inicio ASC", $rsm);
            $query->setParameter('usuario', $usuario);
            
            $partidas = $query->getResult(); 
            
            return (empty($partidas) ? false : $partidas);
        } catch (Exception $ex) {
            return false;
        }
    }
    
    function getCancelled($usuario) {
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
                                                                    par.id_usuario = :usuario AND par.id_status <> 3 AND (p.status = 0 OR p.status = 2)
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
    
    function pesquisar($dados) {
        try {
            $sql = "SELECT p FROM Partida p JOIN p.quadra q JOIN q.parqueEsportivo pq JOIN pq.cidade c JOIN p.esporte e WHERE p.publico = 1 AND p.status = 1 AND p.data > CURRENT_DATE()";

            if ($dados['quadra'] != "")
                $sql .= " AND pq.nome LIKE :quadra";

            if ($dados['cidade'] != "")
                $sql .= " AND c.nome LIKE :cidade";

            if ($dados['esporte'] != "")
                $sql .= " AND e.nome LIKE :esporte";

            $query = DataBase::getFactory()->createQuery($sql);
            
            if ($dados['quadra'] != "")
                $query->setParameter('quadra', '%' . $dados['quadra'] . '%');
            
            if ($dados['cidade'] != "")
                $query->setParameter('cidade', '%' . $dados['cidade'] . '%');
            
            if ($dados['esporte'] != "")
                $query->setParameter('esporte', '%' . $dados['esporte'] . '%');

            $partidas = $query->getResult();

            return (empty($partidas) ? false : $partidas);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    function buscarPartidasParqueEsportivo($parqueEsportivo) {
        try {
            $sql = "SELECT p FROM Partida p JOIN p.quadra q JOIN q.parqueEsportivo pq JOIN p.agendamento a WHERE pq.id = :parqueEsportivo AND p.status = 1 AND pq.servicos = 1 AND a.status = 1 ORDER BY p.data, p.inicio ASC";        
            $query = DataBase::getFactory()->createQuery($sql);
            
            $query->setParameter('parqueEsportivo', $parqueEsportivo);
        
            $partidas = $query->getResult();

            return (empty($partidas) ? false : $partidas);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}