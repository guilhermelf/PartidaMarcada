<?php
/**
 * EstatisticaQuadra
 *
 * @Entity
 * @Table(name="estatistica_quadra")
 */
class EstatisticaQuadra {
    
   
    /**
     * @Id
     * @Column(type="integer", name="id_estatistica_quadra")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;       
    
    /**
     * @OneToOne(targetEntity="ParqueEsportivo", cascade={"persist"}, inversedBy="estatistica")
     * @JoinColumn(name="id_parque_esportivo", referencedColumnName="id_parque_esportivo")
     */
    private $parqueEsportivo;    
        
    /**
    * @Column(type="float", name="estrutura")
    */
    private $estrutura;
    
     /**
    * @Column(type="float", name="atendimento")
    */
    private $atendimento;
    
    /**
    * @Column(type="float", name="qualidade")
    */
    private $qualidade;
         
    /**
     * @Column(type="integer", name="partidas")
     */
    private $partidas;   
    
    /**
     * @Column(type="integer", name="avaliacoes")
     */
    private $avaliacoes;
    
    function getId() {
        return $this->id;
    }

    function getParqueEsportivo() {
        return $this->parqueEsportivo;
    }

    function getEstrutura() {
        return $this->estrutura;
    }

    function getAtendimento() {
        return $this->atendimento;
    }

    function getQualidade() {
        return $this->qualidade;
    }

    function getPartidas() {
        return $this->partidas;
    }

    function getAvaliacoes() {
        return $this->avaliacoes;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setParqueEsportivo($parqueEsportivo) {
        $this->parqueEsportivo = $parqueEsportivo;
    }

    function setEstrutura($estrutura) {
        $this->estrutura = $estrutura;
    }

    function setAtendimento($atendimento) {
        $this->atendimento = $atendimento;
    }

    function setQualidade($qualidade) {
        $this->qualidade = $qualidade;
    }

    function setPartidas($partidas) {
        $this->partidas = $partidas;
    }

    function setAvaliacoes($avaliacoes) {
        $this->avaliacoes = $avaliacoes;
    }
       
    public function toJson() {       
        return array(        
            'id' => $this->getId(),
            'avaliacoes' => $this->getAvaliacoes(),
            'qualidade' => $this->getQualidade(),
            'estrutura' => $this->getEstrutura(),
            'atendimento' => $this->getAtendimento(),
            'partidas' => $this->getPartidas(),
            'nome' => $this->getParqueEsportivo()->getNome()
        );
    } 
}