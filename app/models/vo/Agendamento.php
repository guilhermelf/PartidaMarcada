<?php
/**
 * Agendamento
 *
 * @Entity
 * @Table(name="agendamento")
 */
class Agendamento {
      
    /**
     * @Id
     * @Column(type="integer", name="id_agendamento")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;    
             
    /**
     * @Column(type="date", name="data")
     */
    private $data;
    
    /**
     * @Column(type="integer", name="inicio")
     */
    private $inicio;
    
    /**
     * @Column(type="integer", name="status")
     */
    private $status;
    
    /**
     * @Column(type="float", name="valor")
     */
    private $valor;
    
    /**
     * @OneToOne(targetEntity="Partida", inversedBy="agendamento")
     * @JoinColumn(name="id_partida", referencedColumnName="id_partida")
     */
    private $partida;
    
    function getId() {
        return $this->id;
    }

    function getData() {
        return $this->data;
    }

    function getInicio() {
        return $this->inicio;
    }

    function getStatus() {
        return $this->status;
    }

    function getValor() {
        return $this->valor;
    }

    function getPartida() {
        return $this->partida;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setInicio($inicio) {
        $this->inicio = $inicio;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setPartida($partida) {
        $this->partida = $partida;
    }

        
    public function toJson() {           
        return array(           
            'id' => $this->getId(),
            'data' => date_format($this->getData(), 'd/m/Y'),
            'inicio' => $this->getInicio(),
            'valor' => $this->getValor(),
            'status' => $this->getStatus(),
            'partida' => $this->getPartida()->toJson()
        );
    } 
}