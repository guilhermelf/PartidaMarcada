<?php

require_once(DAO . '/QuadraDAO.php');
require_once(BLL . '/ParqueEsportivoBLL.php');
require_once(BLL . '/EsporteBLL.php');
require_once(BLL . '/PisoBLL.php');
require_once(BLL . '/AgendamentoBLL.php');

class QuadraBLL {

    function getAll() {
        $dao = new QuadraDAO();

        $quadras = $dao->getAll();

        $json = [];

        if (empty($quadras)) {
            echo "vazio!";
        } else {
            foreach ($quadras as $quadra) {
                $json[] = $quadra->toJson();
            }

            return json_encode($json);
        }
    }

    function insert($dados) {
        try {
            if (empty($dados)) {
                return "!vazio";
            } else {
                $quadra = new Quadra();

                $pisoBLL = new PisoBLL();
                $piso = $pisoBLL->getById($dados['piso']);

                foreach ($dados['esportes'] as $esp) {
                    $esporteBLL = new esporteBLL();

                    $quadra->addEsporte($esporteBLL->getById($esp));
                }

                $parqueEsportivoBLL = new ParqueEsportivoBLL();
                $parqueEsportivo = $parqueEsportivoBLL->getById($_SESSION['id']);

                $quadra->setAtivo(1);
                $quadra->setPiso($piso);
                $quadra->setTamanho($dados['tamanho']);
                $quadra->setNumero($dados['numero']);
                $quadra->setParqueEsportivo($parqueEsportivo);              

                $dao = new QuadraDAO();

                if ($dao->persist($quadra)) {
                    Retorno::setStatus(1);
                    Retorno::setMensagem("Quadra cadastrada com sucesso!");                   

                    return Retorno::toJson();
                } else {
                    Retorno::setStatus(0);
                    Retorno::setMensagem("Erro ao cadastrar quadra no sistema!");

                    return Retorno::toJson();
                }
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    function update($dados) {
        try {
            if (empty($dados)) {
                return "!vazio";
            } else {
                $quadra = $this->getById($dados['id']);

                $pisoBLL = new PisoBLL();
                $piso = $pisoBLL->getById($dados['piso']);
                
                $quadra->removeEsportes(); 

                foreach ($dados['esportes'] as $esp) {
                    $esporteBLL = new esporteBLL();

                    $quadra->addEsporte($esporteBLL->getById($esp));
                }
                
                $quadra->setAtivo(1);
                $quadra->setPiso($piso);
                $quadra->setTamanho($dados['tamanho']);
                $quadra->setNumero($dados['numero']);

                $dao = new QuadraDAO();

                if ($dao->persist($quadra)) {
                    Retorno::setStatus(1);
                    Retorno::setMensagem("Quadra atualizada com sucesso!");

                    return Retorno::toJson();
                } else {
                    Retorno::setStatus(0);
                    Retorno::setMensagem("Erro ao atualizar quadra no sistema!");

                    return Retorno::toJson();
                }
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    function getById($id) {
        $dao = new QuadraDAO();

        $quadra = $dao->getById($id);

        return $quadra;
    }
    
    function getByParqueEsportivo($parqueEsportivo) {
        $dao = new QuadraDAO();
        
        $quadras = $dao->getByParqueEsportivo($parqueEsportivo);
       
        $json = [];

        if(empty($quadras)) {
            return 0;
        } else {
            foreach ($quadras as $quad) {                         
                $json[] = $quad->toJson();
            }
            
            return json_encode($json);
        }
    }
}