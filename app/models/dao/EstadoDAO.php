<?php
class EstadoDAO {
    function persist($estado) {
        try {
            DataBase::getFactory()->persist($estado);   
            DataBase::getFactory()->flush();
            
            return DataBase::getFactory()->contains($estado);
        } catch (Exception $ex) {
            return false;
        }
    }

    static function getById($id) {
        try {
            $estado =  DataBase::getFactory()->getRepository('Estado')->find(array('id' => $id));

            return (empty($estado) ? false : $estado);
        } catch (Exception $ex) {
            return false;
        }    
    }

    function getAll() {
        try {
            $estados = DataBase::getFactory()->getRepository('Estado')->findAll();

            return (empty($estados) ? false : $estados);
        } catch (Exception $ex) {
            return false;
        }
        
    }

    function delete($estado) {
        try {
            DataBase::getFactory()->remove($estado);
           
            DataBase::getFactory()->flush();
        
            return !DataBase::getFactory()->contains($estado);
        } catch (Exception $ex) {
            return false;
        }   
    }
}