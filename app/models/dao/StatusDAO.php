<?php
class StatusDAO {
    function persist($status) {
        try {
            DataBase::getFactory()->persist($status);   
            DataBase::getFactory()->flush();
            
            return DataBase::getFactory()->contains($status);
        } catch (Exception $ex) {
            return false;
        }
    }

    static function getById($id) {
        try {
            $status =  DataBase::getFactory()->getRepository('Status')->find(array('id' => $id));

            return (empty($status) ? false : $status);
        } catch (Exception $ex) {
            return false;
        }    
    }

    function getAll() {
        try {
            $statuss = DataBase::getFactory()->getRepository('Status')->findAll();

            return (empty($statuss) ? false : $statuss);
        } catch (Exception $ex) {
            return false;
        }
        
    }

    function delete($status) {
        try {
            DataBase::getFactory()->remove($status);
           
            DataBase::getFactory()->flush();
        
            return !DataBase::getFactory()->contains($status);
        } catch (Exception $ex) {
            return false;
        }   
    }
}