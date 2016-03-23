<?php
class PisoDAO {
    function persist($piso) {
        try {
            DataBase::getFactory()->persist($piso);   
            DataBase::getFactory()->flush();
            
            return DataBase::getFactory()->contains($piso);
        } catch (Exception $ex) {
            return false;
        }
    }

    static function getById($id) {
        try {
            $piso =  DataBase::getFactory()->getRepository('Piso')->find(array('id' => $id));

            return (empty($piso) ? false : $piso);
        } catch (Exception $ex) {
            return false;
        }    
    }

    function getAll() {
        try {
            $pisos = DataBase::getFactory()->getRepository('Piso')->findAll();

            return (empty($pisos) ? false : $pisos);
        } catch (Exception $ex) {
            return false;
        }
        
    }

    function delete($piso) {
        try {
            DataBase::getFactory()->remove($piso);
           
            DataBase::getFactory()->flush();
        
            return !DataBase::getFactory()->contains($piso);
        } catch (Exception $ex) {
            return false;
        }   
    }
}