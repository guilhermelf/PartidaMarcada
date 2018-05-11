<?php
use Doctrine\ORM\Query\ResultSetMapping;

class AmigoDAO { 
    function persist($amigo) {
        try {
            DataBase::getFactory()->persist($amigo);   
            DataBase::getFactory()->flush();
            
            return DataBase::getFactory()->contains($amigo);
        } catch (Exception $ex) {
            return false;
        }
    }
    
    function update($amigo) {
        try {
            DataBase::getFactory()->persist($amigo);   
            DataBase::getFactory()->flush();
            
            return DataBase::getFactory()->contains($amigo);
        } catch (Exception $ex) {
            return false;
        }
    }
    
    function isFriend($usuario1, $usuario2) {
        try {
            $amizade1 = DataBase::getFactory()->getRepository('Amigo')->findOneBy(array('usuario1' => $usuario1, 'usuario2' => $usuario2));
            $amizade2 = DataBase::getFactory()->getRepository('Amigo')->findOneBy(array('usuario2' => $usuario1, 'usuario1' => $usuario2));
            
            return (empty($amizade1 or $amizade2) ? 0 : 1);
        } catch (Exception $ex) {
            return 0;
        }           
    }
    
    function amizadesPendentes($usuario) {
        try {
            $query = DataBase::getFactory()->createQuery("SELECT a FROM Amigo a JOIN a.usuario2 u WHERE u.id = :usuario and a.ativo = '0'");
            $query->setParameter('usuario', $usuario);
            
            $amizades = $query->getResult();           
            
            return (empty($amizades) ? false : $amizades);
        } catch (Exception $ex) {
            return false;
        }  
    }
    
    function getAmigos($usuario) {
        try {
            $query = DataBase::getFactory()->createQuery("SELECT a FROM Amigo a JOIN a.usuario1 u1 JOIN a.usuario2 u2 WHERE (u1.id = :usuario and a.ativo = '1') OR (u2.id = :usuario and a.ativo = '1')");
            $query->setParameter('usuario', $usuario);
            
            $amizades = $query->getResult();           
            
            return (empty($amizades) ? false : $amizades);
        } catch (Exception $ex) {
            return 0;
        }  
    }

    static function getById($id) {
        try {
            $amigo =  DataBase::getFactory()->getRepository('Amigo')->find(array('id' => $id));

            return (empty($amigo) ? false : $amigo);
        } catch (Exception $ex) {
            return false;
        }    
    }

    function getAll() {
        try {
            $amigos = DataBase::getFactory()->getRepository('Amigo')->findAll();

            return (empty($amigos) ? false : $amigos);
        } catch (Exception $ex) {
            return false;
        }
        
    }

    function delete($amigo) {
        try {
            DataBase::getFactory()->remove($amigo);
           
            DataBase::getFactory()->flush();
        
            return !DataBase::getFactory()->contains($amigo);
        } catch (Exception $ex) {
            return false;
        }   
    }
    
    function getUsuarioConvidar($usuario, $partida) {
        try {
            
            $rsm = new ResultSetMapping();
            $rsm->addEntityResult('Usuario', 'u');
            $rsm->addFieldResult('u', 'id', 'id');
            $rsm->addFieldResult('u', 'nome', 'nome');
            $rsm->addFieldResult('u', 'sobrenome', 'sobrenome');
            $rsm->addFieldResult('u', 'apelido', 'apelido');
            
            $query = DataBase::getFactory()->createNativeQuery("SELECT DISTINCT
                                                                        u2.id_usuario AS id,
                                                                        u2.nome AS nome,
                                                                        u2.sobrenome AS sobrenome,
                                                                        u2.apelido AS apelido

                                                                        FROM 
                                                                                partidamarcada.usuario u 

                                                                        INNER JOIN amigo a 
                                                                                ON u.id_usuario = a.id_usuario1
                                                                        INNER JOIN usuario u2 
                                                                                ON u2.id_usuario = a.id_usuario2
                                                                        LEFT JOIN participante p 
                                                                                ON u2.id_usuario = p.id_usuario AND p.id_partida = :partida
                                                                        WHERE
                                                                                u.id_usuario = :usuario AND p.id_usuario IS NULL

                                                                UNION    

                                                                SELECT DISTINCT
                                                                        u2.id_usuario AS id,
                                                                        u2.nome AS nome,
                                                                        u2.sobrenome AS sobrenome,
                                                                        u2.apelido AS apelido

                                                                        FROM 
                                                                                partidamarcada.usuario u 

                                                                        INNER JOIN amigo a 
                                                                                ON u.id_usuario = a.id_usuario2
                                                                        INNER JOIN usuario u2 
                                                                                ON u2.id_usuario = a.id_usuario1
                                                                        LEFT JOIN participante p 
                                                                                ON u2.id_usuario = p.id_usuario AND p.id_partida = :partida
                                                                        WHERE
                                                                                u.id_usuario = :usuario AND p.id_usuario IS NULL
                                                                ", $rsm);
            $query->setParameter('partida', $partida);
            $query->setParameter('usuario', $usuario);
            
            $amigos = $query->getResult();           
            
            return (empty($amigos) ? false : $amigos);
        } catch (Exception $ex) {
            return 0;
        }  
    }
}