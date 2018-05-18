<?php
class ParticipanteDAO {
    function persist($participante) {
        try {
            DataBase::getFactory()->persist($participante);   
            DataBase::getFactory()->flush();
            
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    static function getById($id) {
        try {
            $participante =  DataBase::getFactory()->getRepository('Participante')->find(array('id' => $id));

            return (empty($participante) ? false : $participante);
        } catch (Exception $ex) {
            return false;
        }    
    }

    function getAll() {
        try {
            $participantes = DataBase::getFactory()->getRepository('Participante')->findAll();

            return (empty($participantes) ? false : $participantes);
        } catch (Exception $ex) {
            return false;
        }
        
    }

    function delete($participante) {
        try {
            DataBase::getFactory()->remove($participante);
           
            DataBase::getFactory()->flush();
        
            return !DataBase::getFactory()->contains($participante);
        } catch (Exception $ex) {
            return false;
        }   
    }
    
    function getByPartida($partida) {
        try {
            $query = DataBase::getFactory()->createQuery("SELECT p FROM Participante p WHERE p.partida = " . $partida);
            $participantes = $query->getResult();

            return (empty($participantes) ? false : $participantes);
        } catch (Exception $ex) {
            return false;
        }
    }
    
    function getByParticipantePartida($participante, $partida) {
        try {
            $query = DataBase::getFactory()->createQuery("SELECT p FROM Participante p JOIN p.usuario u JOIN p.partida pa WHERE u.id = :usuario AND pa.id = :partida");
            $query->setParameter('usuario', $participante);
            $query->setParameter('partida', $partida);
            
            $participantes = $query->getResult();

            return (empty($participantes) ? false : true);
        } catch (Exception $ex) {
            return false;
        }
    }
    
    function getParticipante($usuario, $partida) {
        try {
            $query = DataBase::getFactory()->createQuery("SELECT p FROM Participante p JOIN p.usuario u JOIN p.partida pa WHERE u.id = :usuario AND pa.id = :partida");
            $query->setParameter('usuario', $usuario);
            $query->setParameter('partida', $partida);
            
            $participante = $query->getResult();

            return (empty($participante) ? false : $participante);
        } catch (Exception $ex) {
            return false;
        }
    }
    
    function getPendentes($usuario) {
        try {
            $query = DataBase::getFactory()->createQuery("SELECT p FROM Participante p JOIN p.usuario u JOIN p.partida pa WHERE u.id = :usuario AND pa.data >= CURRENT_DATE() AND p.status = 0");
            $query->setParameter('usuario', $usuario);
            
            $participantes = $query->getResult();

            return (empty($participantes) ? false : $participantes);
        } catch (Exception $ex) {
            return false;
        }
    }
}