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
    
    function pesquisar($dados) {
        try {
            $sql = "SELECT p FROM ParqueEsportivo p JOIN p.cidade c WHERE 1 = 1";

            if ($dados['nome'] != "")
                $sql .= " AND p.nome LIKE :nome";

            if ($dados['cidade'] != "")
                $sql .= " AND c.cidade LIKE :cidade";

            if ($dados['endereco'] != "")
                $sql .= " AND p.endereco LIKE :endereco";

            $query = DataBase::getFactory()->createQuery($sql);
            
            if ($dados['nome'] != "")
                $query->setParameter('nome', '%' . $dados['nome'] . '%');
            
            if ($dados['cidade'] != "")
                $query->setParameter('cidade', '%' . $dados['cidade'] . '%');
            
            if ($dados['endereco'] != "")
                $query->setParameter('endereco', '%' . $dados['endereco'] . '%');

            $usuarios = $query->getResult();

            return (empty($usuarios) ? false : $usuarios);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}