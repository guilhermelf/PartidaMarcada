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
            $rsm = new ResultSetMappingBuilder(DataBase::getFactory());
            $rsm->addRootEntityFromClassMetadata('Agendamento', 'a');
            
            $query = DataBase::getFactory()->createNativeQuery("SELECT a.id_agendamento, a.status, a.id_quadra, a.valor, a.data, a.inicio FROM agendamento a 
                INNER JOIN quadra q ON q.id_quadra = a.id_quadra 
                WHERE q.id_quadra = :quadra AND a.data = :data AND (a.status = 0 OR a.status = 1)", $rsm);
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