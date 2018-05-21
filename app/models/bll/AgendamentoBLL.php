<?php
require_once(DAO . '/AgendamentoDAO.php');
require_once(DAO . '/PartidaDAO.php');

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
            Retorno::setStatus(1);
            Retorno::setMensagem("Agendamento negado com sucesso!");
            
            return Retorno::toJson();
        } else {
            Retorno::setStatus(0);
            Retorno::setMensagem("Erro ao negar agendamento!");

            return Retorno::toJson();
        }
    }
}