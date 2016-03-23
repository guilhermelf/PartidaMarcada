<?php
class VisibilidadeDAO {
    function persist($visibilidade) {
        try {
            DataBase::getFactory()->persist($visibilidade);   
            DataBase::getFactory()->flush();
            
            return DataBase::getFactory()->contains($visibilidade);
        } catch (Exception $ex) {
            return false;
        }
    }

    static function getById($id) {
        try {
            $visibilidade =  DataBase::getFactory()->getRepository('Visibilidade')->find(array('id' => $id));

            return (empty($visibilidade) ? false : $visibilidade);
        } catch (Exception $ex) {
            return false;
        }    
    }

    function getAll() {
        try {
            $visibilidades = DataBase::getFactory()->getRepository('Visibilidade')->findAll();

            return (empty($visibilidades) ? false : $visibilidades);
        } catch (Exception $ex) {
            return false;
        }
        
    }

    function delete($visibilidade) {
        try {
            DataBase::getFactory()->remove($visibilidade);
           
            DataBase::getFactory()->flush();
        
            return DataBase::getFactory()->contains($visibilidade);
        } catch (Exception $ex) {
            return false;
        }   
    }
}