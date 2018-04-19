<?php

class PartidaDAO {

    function persist($partida) {
        try {
            DataBase::getFactory()->persist($partida);
            DataBase::getFactory()->flush();
            
            return true;
        } catch (Exception $ex) {
            return false;
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
            $query = DataBase::getFactory()->createQuery("SELECT p FROM Partida p JOIN p.usuario u WHERE u.id = :usuario AND p.data < CURRENT_DATE()");
            $query->setParameter('usuario', $usuario);
            
            $partidas = $query->getResult(); 
            
            return (empty($partidas) ? false : $partidas);
        } catch (Exception $ex) {
            return false;
        }
    }
    
    function getNew($usuario) {
        try {
            $query = DataBase::getFactory()->createQuery("SELECT p FROM Partida p JOIN p.usuario u WHERE u.id = :usuario AND p.data > CURRENT_DATE()");
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
