<?php
require_once(DAO.'/PartidaDAO.php');
require_once(BLL . '/QuadraBLL.php');
require_once(BLL . '/EsporteBLL.php');
require_once(BLL . '/VisibilidadeBLL.php');
require_once(BLL . '/UsuarioBLL.php');

class partidaBLL {

    public function insert($dados) {
        try {
            if (empty($dados)) {
                Retorno::setStatus(0);
                Retorno::setMensagem("Dados não recebidos!");

                return Retorno::toJson();
            } else {
                $usuarioBLL = new UsuarioBLL();
                $usuario = $usuarioBLL->getById($_SESSION['id']);                                
                
                $quadraBLL = new QuadraBLL();
                $quadra = $quadraBLL->getById($dados['quadra']);

                $esporteBLL = new EsporteBLL();
                $esporte = $esporteBLL->getById($dados['esporte']);       
                
                if(isset($dados['id'])) {                
                    $partida = $this->getById($dados['id']);
                    $novo = 0;
                } else {
                    $partida = new Partida(); 
                    $novo = 1;
                }              
    
                $data = Retorno::invertDate($dados['data']);              
                    
                $partida->setData(new \DateTime($data));
                $partida->setDescricao($dados['descricao']);
                $partida->setEsporte($esporte);
                $partida->setFinal($dados['final']);
                $partida->setInicio($dados['inicio']);
                $partida->setNumeroJogadores($dados['jogadores']);
                $partida->setPublico($dados['publico']);
                $partida->setQuadra($quadra);
                $partida->setUsuario($usuario);
  
                $dao = new PartidaDAO();
                
                if ($dao->persist($partida)) {
                    Retorno::setStatus(1);
                    if($novo)
                        Retorno::setMensagem("Partida cadastrada com sucesso!");
                    else
                        Retorno::setMensagem("Informações da partida atualizadas!");
                        
                    return Retorno::toJson();
                } else {
                    Retorno::setStatus(0);
                    
                    if($novo)
                        Retorno::setMensagem("Erro ao cadastrar partida no sistema!");
                    else
                        Retorno::setMensagem("Erro ao atualizar informações da partida!");

                    return Retorno::toJson();
                }
            }
        } catch (Exception $ex) {
            Retorno::setStatus(0);
            Retorno::setMensagem($ex->getMessage());
            
            return Retorno::toJson();
        }
    }


    function getAll() {
        $dao = new PartidaDAO();
        
        $partidas = $dao->getAll();
       
        $json = [];

        if(empty($partidas)) {
            echo "vazio!";
        } else {
            foreach ($partidas as $partida) {                         
                $json[] = $partida->toJson();
            }
            
            return json_encode($json);
        }
    }
    
    function getNew() {
        $dao = new PartidaDAO();
        
        $bll = new UsuarioBLL;
        $usuario = $bll->getById($_SESSION['id']);
        
        $partidas = $dao->getNew($usuario);
       
        $json = [];

        if(empty($partidas)) {
            echo "vazio!";
        } else {
            foreach ($partidas as $partida) {                         
                $json[] = $partida->toJson();
            }
            
            return json_encode($json);
        }
    }
    
    function getPast() {
        $dao = new PartidaDAO();
        
        $bll = new UsuarioBLL;
        $usuario = $bll->getById($_SESSION['id']);
        
        $partidas = $dao->getPast($usuario);
       
        $json = [];

        if(empty($partidas)) {
            echo "vazio!";
        } else {
            foreach ($partidas as $partida) {                         
                $json[] = $partida->toJson();
            }
            
            return json_encode($json);
        }
    }
    
    function getById($id) {
        $dao = new PartidaDAO();
        
        $partida = $dao->getById($id);
        
        return $partida;
    }   
    
    function getByUsuario() {
        $bll = new UsuarioBLL;
        $usuario = $bll->getById($_SESSION['id']);

        $dao = new PartidaDAO();

        $dados = $dao->getByUsuario($usuario);

        $partidas = [];

        if (empty($dados)) {
            return 0;
        } else {
            foreach ($dados as $value) {
                $partidas[] = $value->toJson();
            }
            return json_encode($partidas);
        }
        return null;
    }
}