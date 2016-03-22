<?php
class CidadeDAO {

    function insert($cidade) {
        try {
            DataBase::getFactory()->persist($cidade);   
            DataBase::getFactory()->flush();
            
            return ($cidade->getId() ? true: false);           
        } catch (Exception $ex) {
            return false;
        }
    }

    function update($cidade) {
        try {
            DataBase::getFactory()->persist($cidade);   
            DataBase::getFactory()->flush();
            
            return ($cidade->getId() ? true: false);           
        } catch (Exception $ex) {
            return false;
        }
    }

    static function getById($id) {
        try {
            $cidade = DataBase::getFactory()->getRepository('Cidade')->find(array('id' => $id));

            return (empty($cidade) ? false : $cidade);
        } catch (Exception $ex) {
            return false;
        }
        
    }

    function getAll() {
        try {
            $cidades = DataBase::getFactory()->getRepository('Cidade')->findAll();

            return (empty($cidades) ? false : $cidades); 
        } catch (Exception $ex) {
            return false;
        }
       
    }

    static function getByEstado($estado) {
        $query = DataBase::getFactory()->createQuery("SELECT c FROM Cidade c WHERE c.estado = " . $estado->getId());
        $cidades = $query->getResult();

        return (empty($cidades) ? false : $cidades);
    }

    function delete($cidade) {
        DataBase::getFactory()->remove($cidade);
        
        return DataBase::getFactory()->flush();
    }
}