<?php
class ValorDAO {
    function persist($valor) {
        try {
            DataBase::getFactory()->persist($valor);   
            DataBase::getFactory()->flush();
            
            return DataBase::getFactory()->contains($valor);
        } catch (Exception $ex) {
            return false;
        }
    }

    static function getById($id) {
        try {
            $valor =  DataBase::getFactory()->getRepository('Valor')->find(array('id' => $id));

            return (empty($valor) ? false : $valor);
        } catch (Exception $ex) {
            return false;
        }    
    }

    function getAll() {
        try {
            $valores = DataBase::getFactory()->getRepository('Valor')->findAll();

            return (empty($valores) ? false : $valores);
        } catch (Exception $ex) {
            return false;
        }
        
    }

    function delete($valor) {
        try {
            DataBase::getFactory()->remove($valor);
           
            DataBase::getFactory()->flush();
        
            return !DataBase::getFactory()->contains($valor);
        } catch (Exception $ex) {
            return false;
        }   
    }
}