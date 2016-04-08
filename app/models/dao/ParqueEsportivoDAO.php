<?php
class ParqueEsportivoDAO {
    function persist($parqueEsportivo) {
        try {
            DataBase::getFactory()->persist($parqueEsportivo);   
            DataBase::getFactory()->flush();
            
            return DataBase::getFactory()->contains($parqueEsportivo);
        } catch (Exception $ex) {
            return false;
        }
    }

    static function getById($id) {
        try {
            $parqueEsportivo =  DataBase::getFactory()->getRepository('ParqueEsportivo')->find(array('id' => $id));

            return (empty($parqueEsportivo) ? false : $parqueEsportivo);
        } catch (Exception $ex) {
            return false;
        }    
    }

    function getAll() {
        try {
            $parquesEsportivos = DataBase::getFactory()->getRepository('ParqueEsportivo')->findAll();

            return (empty($parquesEsportivos) ? false : $parquesEsportivos);
        } catch (Exception $ex) {
            return false;
        }
        
    }

    function delete($parqueEsportivo) {
        try {
            DataBase::getFactory()->remove($parqueEsportivo);
           
            DataBase::getFactory()->flush();
        
            return !DataBase::getFactory()->contains($parqueEsportivo);
        } catch (Exception $ex) {
            return false;
        }   
    }
    
    function logar($email, $senha) {
        try {
            $parqueEsportivo = DataBase::getFactory()->getRepository('ParqueEsportivo')->findOneBy(array('email' => $email, 'senha' => $senha));
             
            return (empty($parqueEsportivo) ? false : $parqueEsportivo);
        } catch (Exception $ex) {
            return false;
        }  
    }
}