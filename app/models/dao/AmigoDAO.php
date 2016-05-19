<?php
class AmigoDAO {
    function persist($amigo) {
        try {
            DataBase::getFactory()->persist($amigo);   
            DataBase::getFactory()->flush();
            
            return DataBase::getFactory()->contains($amigo);
        } catch (Exception $ex) {
            return false;
        }
    }
    
    function update($amigo) {
        try {
            DataBase::getFactory()->persist($amigo);   
            DataBase::getFactory()->flush();
            
            return DataBase::getFactory()->contains($amigo);
        } catch (Exception $ex) {
            return false;
        }
    }
    
    function isFriend($usuario1, $usuario2) {
        try {
            $amizade1 = DataBase::getFactory()->getRepository('Amigo')->findOneBy(array('usuario1' => $usuario1, 'usuario2' => $usuario2));
            $amizade2 = DataBase::getFactory()->getRepository('Amigo')->findOneBy(array('usuario2' => $usuario1, 'usuario1' => $usuario2));
            
            return (empty($amizade1 or $amizade2) ? 0 : 1);
        } catch (Exception $ex) {
            return 0;
        }           
    }
    
    function amizadesPendentes($usuario) {
        try {
            $query = DataBase::getFactory()->createQuery("SELECT a FROM Amigo a JOIN a.usuario2 u WHERE u.id = :usuario and a.ativo = '0'");
            $query->setParameter('usuario', $usuario);
            
            $amizades = $query->getResult();           
            
            return (empty($amizades) ? false : $amizades);
        } catch (Exception $ex) {
            return false;
        }  
    }
    
    function getAmigos($usuario) {
        try {
            $query = DataBase::getFactory()->createQuery("SELECT a FROM Amigo a JOIN a.usuario2 u2 JOIN a.usuario1 u1 WHERE (u1.id = :usuario and a.ativo = '1') OR (u2.id = :usuario and a.ativo = '1')");
            $query->setParameter('usuario', $usuario);
            
            $amizades = $query->getResult();           
            
            return (empty($amizades) ? false : $amizades);
        } catch (Exception $ex) {
            return false;
        }  
    }

    static function getById($id) {
        try {
            $amigo =  DataBase::getFactory()->getRepository('Amigo')->find(array('id' => $id));

            return (empty($amigo) ? false : $amigo);
        } catch (Exception $ex) {
            return false;
        }    
    }

    function getAll() {
        try {
            $amigos = DataBase::getFactory()->getRepository('Amigo')->findAll();

            return (empty($amigos) ? false : $amigos);
        } catch (Exception $ex) {
            return false;
        }
        
    }

    function delete($amigo) {
        try {
            DataBase::getFactory()->remove($amigo);
           
            DataBase::getFactory()->flush();
        
            return !DataBase::getFactory()->contains($amigo);
        } catch (Exception $ex) {
            return false;
        }   
    }
}