<?php
require_once(DAO . '/PartidaDAO.php');
require_once(BLL . '/QuadraBLL.php');
require_once(BLL . '/EsporteBLL.php');
require_once(BLL . '/VisibilidadeBLL.php');
require_once(BLL . '/UsuarioBLL.php');
require_once(BLL . '/ParticipanteBLL.php');
require_once(DAO . '/ParticipanteDAO.php');
require_once(DAO . '/AgendamentoDAO.php');

class PartidaBLL {
    public function permitirAcesso($id) {
        $partida = $this->getById($id);
        $bll = new ParticipanteBLL();
        
        if($partida->getPublico()) {
            return true;
        } else {
            if($bll->participanteExiste($_SESSION['id'], $id)) {
                return true;
            } else if($_SESSION['tipo'] == 'quadra' && $partida->getQuadra()->getParqueEsportivo()->getId() == $_SESSION['id']) {
                return true;
            } else {
                return false;
            }
        }      
    }
    
    public function cancel($id) {
        $partida = $this->getById($id);
        $partida->setStatus(0);
        
        if($partida->getQuadra()->getParqueEsportivo()->getServicos()) {
            $agendamentoDAO = new AgendamentoDAO();
            
            $agendamento = $partida->getAgendamento();

            $agendamento->setStatus(2);
            
            $agendamentoDAO->persist($agendamento);
        }
        
        $dao = new PartidaDAO;
        
        if ($dao->persist($partida)) {
            Retorno::setStatus(1);
            Retorno::setMensagem("Partida cancelada com sucesso!");
            
            return Retorno::toJson();
        } else {
            Retorno::setStatus(0);
            Retorno::setMensagem("Erro ao cancelar partida no sistema!");

            return Retorno::toJson();
        }
    }

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
                    $partida->setStatus(1);
                }              
    
                $data = Retorno::invertDate($dados['data']);              
                    
                $partida->setData(new \DateTime($data));
                $partida->setDescricao($dados['descricao']);
                $partida->setEsporte($esporte);
                $partida->setInicio($dados['inicio']);
                $partida->setNumeroJogadores($dados['jogadores']);
                $partida->setPublico($dados['publico']);
                $partida->setQuadra($quadra);
                $partida->setUsuario($usuario);
                        
                $dao = new PartidaDAO();

                if ($dao->persist($partida)) {

                    if($novo) {
                        if($partida->getQuadra()->getParqueEsportivo()->getServicos()) {
                            $agendamento = new Agendamento();

                            $agendamento->setData($partida->getData());
                            $agendamento->setInicio($partida->getInicio());
                            $agendamento->setStatus(0);
                            $agendamento->setPartida($partida);
                            $agendamento->setValor(100);

                            $agendamentoDAO = new AgendamentoDAO();

                            $agendamentoDAO->persist($agendamento);
                        }      
                        
                        $participanteDAO = new ParticipanteDAO();
                        $participante = new Participante();
                        
                        $participante->setPartida($partida);
                        $participante->setUsuario($partida->getUsuario());
                        $participante->setStatus(1);
                        
                        $participanteDAO->persist($participante);
                        
                        Retorno::setStatus(1);
                        Retorno::setMensagem("Partida cadastrada com sucesso!");
                    } else {
                        Retorno::setMensagem("Informações da partida atualizadas!");
                    }    
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
        
        $partidas = $dao->getNew($usuario->getId());

        $json = [];

        if(empty($partidas)) {
            return 0;
        } else {
            foreach ($partidas as $partida) {    
                $json[] = $partida->toJson();          
            }     

            return $json;
        }
    }
    
    function getPast() {
        $dao = new PartidaDAO();
        
        $bll = new UsuarioBLL;
        $usuario = $bll->getById($_SESSION['id']);
        
        $partidas = $dao->getPast($usuario->getId());
       
        $json = [];

        if(empty($partidas)) {
            return 0;
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
    
    function partidaOcorreu($id) {
        $dao = new PartidaDAO();
        
        return $dao->isPast($id);
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