<?php
require_once(DAO . '/AvaliacaoAtletaDAO.php');
require_once(DAO . '/PartidaDAO.php');
require_once(BLL . '/QuadraBLL.php');
require_once(BLL . '/UsuarioBLL.php');
require_once(BLL . '/PartidaBLL.php');

class AvaliacaoAtletaBLL {

    function getAll() {
        $dao = new AvaliacaoAtletaDAO();
        
        $avaliacaoAtletas = $dao->getAll();
       
        $json = [];

        if(empty($avaliacaoAtletas)) {
            echo "vazio!";
        } else {
            foreach ($avaliacaoAtletas as $avaliacaoAtleta) {                         
                $json[] = $avaliacaoAtleta->toJson();
            }
            
            return json_encode($json);
        }
    }
    
    function getById($id) {
        $dao = new AvaliacaoAtletaDAO();
        
        $avaliacaoAtleta = $dao->getById($id);
        
        return $avaliacaoAtleta;
    }
    
    function insert($dados) {
        try {
            if (empty($dados)) {
                return 0;
            } else {
                $usuarioBLL = new UsuarioBLL();
                $usuario2BLL = new UsuarioBLL();
                $partidaBLL = new PartidaBLL();
                
                $avaliador = $usuarioBLL->getById($dados['avaliador']);
                $usuario = $usuario2BLL->getById($dados['usuario']);
                $partida = $partidaBLL->getById($dados['partida']);
                
                $avaliacaoAtleta = new AvaliacaoAtleta();
                
                $avaliacaoAtleta->setAvaliador($avaliador);
                $avaliacaoAtleta->setUsuario($usuario);
                $avaliacaoAtleta->setPartida($partida);
                $avaliacaoAtleta->setComportamento($dados['comportamento']);
                $avaliacaoAtleta->setHabilidade($dados['habilidade']);
                $avaliacaoAtleta->setPontualidade($dados['pontualidade']);

                $dao = new AvaliacaoAtletaDAO();

                if ($dao->persist($avaliacaoAtleta)) {
                    Retorno::setStatus(1);
                    Retorno::setMensagem("Avaliação cadastrada com sucesso!");

                    return Retorno::toJson();
                } else {
                    Retorno::setStatus(0);
                    Retorno::setMensagem("Erro ao cadastrar avaliação!");

                    return Retorno::toJson();
                }
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    function avaliacaoExiste($usuario, $partida) {
        $dao = new AvaliacaoAtletaDAO();        
        
        return $dao->avaliacaoExiste($usuario, $partida);
    }
}