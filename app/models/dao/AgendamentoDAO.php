<?php
use Doctrine\ORM\Query\ResultSetMappingBuilder;

class AgendamentoDAO {

    function persist($agendamento) {
        try {
            DataBase::getFactory()->persist($agendamento);
            DataBase::getFactory()->flush();
            
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    static function getById($id) {
        try {
            $agendamento = DataBase::getFactory()->getRepository('Agendamento')->find(array('id' => $id));

            return (empty($agendamento) ? false : $agendamento);
        } catch (Exception $ex) {
            return false;
        }
    }

    function getAll() {
        try {
            $agendamentos = DataBase::getFactory()->getRepository('Agendamento')->findAll();

            return (empty($agendamentos) ? false : $agendamentos);
        } catch (Exception $ex) {
            return false;
        }
    }

    function delete($agendamento) {
        try {
            DataBase::getFactory()->remove($agendamento);

            DataBase::getFactory()->flush();

            return !DataBase::getFactory()->contains($agendamento);
        } catch (Exception $ex) {
            return false;
        }
    }
    
    function buscarHorarios($quadra = null, $data = null) {
        try {
            $query = DataBase::getFactory()->createQuery("SELECT a FROM Agendamento a JOIN a.partida p JOIN p.quadra q WHERE q.id = :quadra AND a.data = :data AND (a.status = 0 OR a.status = 1)");
            $query->setParameter('quadra', $quadra);
            $query->setParameter('data', $data);
            
            $agendamentos = $query->getResult();           
            
            return (empty($agendamentos) ? false : $agendamentos);
        } catch (Exception $ex) {
            return false;
        }
    }
    
    function buscarAgendamentosPendentes($parqueEsportivo) {
        try {
            $query = DataBase::getFactory()->createQuery("SELECT a FROM Agendamento a JOIN a.partida p JOIN p.quadra q JOIN q.parqueEsportivo pq WHERE a.status = 0 AND pq.id = :parqueEsportivo AND a.data >= CURRENT_DATE() ORDER BY p.data, p.inicio ASC");
            $query->setParameter('parqueEsportivo', $parqueEsportivo);
            
            $agendamentos = $query->getResult();           
            
            return (empty($agendamentos) ? false : $agendamentos);
        } catch (Exception $ex) {
            return false;
        }
    }
}