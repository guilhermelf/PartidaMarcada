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
            $sql = "SELECT DISTINCT IDENTITY(q.parqueEsportivo) FROM Quadra q JOIN q.parqueEsportivo p JOIN p.cidade c JOIN q.esportes e WHERE 1 = 1";

            if ($dados['nome'] != "")
                $sql .= " AND p.nome LIKE :nome";

            if ($dados['esporte'] != "")
                $sql .= " AND e.nome LIKE :esporte";

            if ($dados['cidade'] != "")
                $sql .= " AND c.nome LIKE :cidade";

            $query = DataBase::getFactory()->createQuery($sql);
            
            if ($dados['nome'] != "")
                $query->setParameter('nome', '%' . $dados['nome'] . '%');
            
            if ($dados['esporte'] != "")
                $query->setParameter('esporte', '%' . $dados['esporte'] . '%');
            
            if ($dados['cidade'] != "")
                $query->setParameter('cidade', '%' . $dados['cidade'] . '%');

            $parques = $query->getResult(\Doctrine\ORM\Query::HYDRATE_OBJECT);

            return (empty($parques) ? 0 : $parques);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}