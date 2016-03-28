<?php
class QuadraDAO {
    function persist($quadra) {
        try {
            DataBase::getFactory()->persist($quadra);   
            DataBase::getFactory()->flush();
            
            return DataBase::getFactory()->contains($quadra);
        } catch (Exception $ex) {
            return false;
        }
    }

    static function getById($id) {
        try {
            $quadra =  DataBase::getFactory()->getRepository('Quadra')->find(array('id' => $id));

            return (empty($quadra) ? false : $quadra);
        } catch (Exception $ex) {
            return false;
        }    
    }

    function getAll() {
        try {
            $quadras = DataBase::getFactory()->getRepository('Quadra')->findAll();

            return (empty($quadras) ? false : $quadras);
        } catch (Exception $ex) {
            return false;
        }
        
    }

    function delete($quadra) {
        try {
            DataBase::getFactory()->remove($quadra);
           
            DataBase::getFactory()->flush();
        
            return !DataBase::getFactory()->contains($quadra);
        } catch (Exception $ex) {
            return false;
        }   
    }
}