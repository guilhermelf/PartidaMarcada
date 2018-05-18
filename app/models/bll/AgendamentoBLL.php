<?php
require_once(DAO . '/AgendamentoDAO.php');

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
}