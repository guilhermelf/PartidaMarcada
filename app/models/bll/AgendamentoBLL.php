<?php
require_once(DAO . '/AgendamentoDAO.php');
require_once(DAO . '/PartidaDAO.php');
require_once(BLL . '/QuadraBLL.php');

class AgendamentoBLL {

    function getAll() {
        $dao = new AgendamentoDAO();
        
        $agendamentos = $dao->getAll();
       
        $json = [];

        if(empty($agendamentos)) {
            echo "vazio!";
        } else {
            foreach ($agendamentos as $agendamento) {                         
                $json[] = $agendamento->toJson();
            }
            
            return json_encode($json);
        }
    }
    
    function getById($id) {
        $dao = new AgendamentoDAO();
        
        $agendamento = $dao->getById($id);
        
        return $agendamento;
    }
    
    function buscarHorarios($quadra = null, $data = null) {
        $dao = new AgendamentoDAO();
        
        $agendamentos = $dao->buscarHorarios($quadra, $data);
       
        $horarios = [];
        
        for ($i = 0; $i < 24; $i++) {
            $horarios[] = $i;
        }
        
        if(empty($agendamentos)) {
            return $horarios;
        } else {
            foreach ($agendamentos as $agendamento) {                         
                unset($horarios[$agendamento->getInicio()]);
            }
            
            return $horarios;
        }
    }
    function buscarHorariosQuadraData($quadra = null, $data = null) {
        $dao = new AgendamentoDAO();
        
        $agendamentos = $dao->buscarHorarios($quadra, $data);
       
        $horarios = [];
        
        for ($i = 0; $i < 24; $i++) {
            $horarios[] = array(
                            "horario" => $i,
                            "status" => "Horário disponível",
                        );
        }
        
        if(empty($agendamentos)) {
            return $horarios;
        } else {
            foreach ($agendamentos as $agendamento) {    
                if($agendamento->getPartida() != null) {
                    $horarios[$agendamento->getInicio()]['status'] = 'Partida de ' . $agendamento->getPartida()->getEsporte()->getNome() . " agendada.";
                    $horarios[$agendamento->getInicio()]['idPartida'] = $agendamento->getPartida()->getId();
                    $horarios[$agendamento->getInicio()]['idAgendamento'] = $agendamento->getId();
                } else {
                    $horarios[$agendamento->getInicio()]['status'] = 'Horário reservado pela quadra';
                    $horarios[$agendamento->getInicio()]['idAgendamento'] = $agendamento->getId();
                }
            }
            
            return $horarios;
        }
    }
    
    
    function buscarAgendamentosPendentes() {
        $dao = new AgendamentoDAO();
        
        $parqueEsportivo = $_SESSION['id'];
        
        $agendamentos = $dao->buscarAgendamentosPendentes($parqueEsportivo);
     
        $json = [];

        if(empty($agendamentos)) {
            return 0;
        } else {
            foreach ($agendamentos as $agendamento) {                         
                $json[] = $agendamento->toJson();
            }        
            return json_encode($json);
        }
    }
    
    public function negar($id) {
        $partidaDAO = new PartidaDAO();
        
        $agendamento = $this->getById($id);
        $agendamento->setStatus(2);
        
        $partida = $agendamento->getPartida();
        $partida->setStatus(2);
        
        $partidaDAO->persist($partida);
        $dao = new AgendamentoDAO();
        
        if ($dao->persist($agendamento)) {
            
            $estatistica = $partida->getUsuario()->getEstatistica();
            
            $estatisticaQuadra = $partida->getQuadra()->getParqueEsportivo()->getEstatistica();   
            
            $estatisticaQuadra->setPartidas($estatisticaQuadra->getPartidas() - 1);
            
            $estatisticaQuadraDAO = new EstatisticaQuadraDAO();
            
            $estatisticaQuadraDAO->persist($estatisticaQuadra);
                
            $estatistica->setPontos($estatistica->getPontos() - 50);
            $estatistica->setPartidasMarcadas($estatistica->getPartidasMarcadas() - 1);
            $estatisticaDAO = new EstatisticaAtletaDAO();
            
            $estatisticaDAO->persist($estatistica);
            
            foreach ($partida->getParticipantes() as $participante) {                           
                if($participante->getStatus() == 1) {                 
                    $participante->getUsuario()->getEstatistica()->setParticipacoes($participante->getUsuario()->getEstatistica()->getParticipacoes() - 1);
                    $participante->getUsuario()->getEstatistica()->setPontos($participante->getUsuario()->getEstatistica()->getPontos() - 10);

                    $estatisticaDAO->persist($participante->getUsuario()->getEstatistica());
                }               
            }       
            
            Retorno::setStatus(1);
            Retorno::setMensagem("Agendamento negado com sucesso!");
            
            return Retorno::toJson();
        } else {
            Retorno::setStatus(0);
            Retorno::setMensagem("Erro ao negar agendamento!");

            return Retorno::toJson();
        }
    }
    
    public function confirmar($id) {
        $partidaDAO = new PartidaDAO();
        
        $agendamento = $this->getById($id);
        $agendamento->setStatus(1);
        
        $partida = $agendamento->getPartida();
        $partida->setStatus(1);
        
        $partidaDAO->persist($partida);
        $dao = new AgendamentoDAO();
        
        if ($dao->persist($agendamento)) {
            Retorno::setStatus(1);
            Retorno::setMensagem("Agendamento confirmado com sucesso!");
            
            return Retorno::toJson();
        } else {
            Retorno::setStatus(0);
            Retorno::setMensagem("Erro ao confirmar agendamento!");

            return Retorno::toJson();
        }
    }
    
    public function reservarHorario($dados) {
        try {
            $dao = new AgendamentoDAO();   
            $agendamento = new Agendamento();
            $quadraBLL = new QuadraBLL();
            
            $inicio = $dados['inicio'];
            $quadra = $quadraBLL->getById($dados['quadra']);
            $data = Retorno::invertDate($dados['data']);

            $agendamento->setStatus(1);
            $agendamento->setPartida(null);
            $agendamento->setInicio($inicio);
            $agendamento->setData(new \DateTime($data));
            $agendamento->setQuadra($quadra);

            if ($dao->persist($agendamento)) {
                Retorno::setStatus(1);
                Retorno::setMensagem("Reserva de horário confirmada!");

                return Retorno::toJson();
            } else {
                Retorno::setStatus(0);
                Retorno::setMensagem("Erro ao confirmar reserva!");

                return Retorno::toJson();
            }
        } catch (Exception $exc) {
            return 0;
        }  
    }
    
    public function liberar($id) {     
        $agendamento = $this->getById($id);

        $dao = new AgendamentoDAO();
        
        if ($dao->delete($agendamento)) {
            Retorno::setStatus(1);
            Retorno::setMensagem("Reserva cancelada, horário disponível para agendamento!");
            
            return Retorno::toJson();
        } else {
            Retorno::setStatus(0);
            Retorno::setMensagem("Erro ao cancelar reserva!");

            return Retorno::toJson();
        }
    }
}