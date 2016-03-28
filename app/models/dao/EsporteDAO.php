<?php
class EsporteDAO {
    function persist($esporte) {
        try {
            DataBase::getFactory()->persist($esporte);   
            DataBase::getFactory()->flush();
            
            return DataBase::getFactory()->contains($esporte);
        } catch (Exception $ex) {
            return false;
        }
    }

    static function getById($id) {
        try {
            $esporte =  DataBase::getFactory()->getRepository('Esporte')->find(array('id' => $id));

            return (empty($esporte) ? false : $esporte);
        } catch (Exception $ex) {
            return false;
        }    
    }

    function getAll() {
        try {
            $esportes = DataBase::getFactory()->getRepository('Esporte')->findAll();

            return (empty($esportes) ? false : $esportes);
        } catch (Exception $ex) {
            return false;
        }
        
    }

    function delete($esporte) {
        try {
            DataBase::getFactory()->remove($esporte);
           
            DataBase::getFactory()->flush();
        
            return !DataBase::getFactory()->contains($esporte);
        } catch (Exception $ex) {
            return false;
        }   
    }
}