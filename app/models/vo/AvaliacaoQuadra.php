<?php
/**
 * AvaliarQuadra
 *
 * @Entity
 * @Table(name="avaliacao_quadra")
 */
class AvaliacaoQuadra {  
   
    /**
     * @Id
     * @Column(type="integer", name="id_avaliacao_quadra")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;          
       
    /**
     * @OneToOne(targetEntity="Usuario", cascade={"persist"})
     * @JoinColumn(name="id_usuario", referencedColumnName="id_usuario")
     */
    private $usuario;
    
    /**
     * @OneToOne(targetEntity="Partida", cascade={"persist"})
     * @JoinColumn(name="id_partida", referencedColumnName="id_partida")
     */
    private $partida;
    
    /**
     * @OneToOne(targetEntity="Quadra", cascade={"persist"})
     * @JoinColumn(name="id_quadra", referencedColumnName="id_quadra")
     */
    private $quadra;   
    
    /**
     * @Column(type="integer", name="qualidade")
     */
    private $qualidade;
    
    /**
     * @Column(type="integer", name="estrutura")
     */
    private $estrutura;
    
    /**
     * @Column(type="integer", name="atendimento")
     */
    private $atendimento;
       
    function getId() {
        return $this->id;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getPartida() {
        return $this->partida;
    }

    function getQuadra() {
        return $this->quadra;
    }

    function getQualidade() {
        return $this->qualidade;
    }

    function getEstrutura() {
        return $this->estrutura;
    }

    function getAtendimento() {
        return $this->atendimento;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setPartida($partida) {
        $this->partida = $partida;
    }

    function setQuadra($quadra) {
        $this->quadra = $quadra;
    }

    function setQualidade($qualidade) {
        $this->qualidade = $qualidade;
    }

    function setEstrutura($estrutura) {
        $this->estrutura = $estrutura;
    }

    function setAtendimento($atendimento) {
        $this->atendimento = $atendimento;
    }
        
    public function toJson() {           
        return array(           
            'id' => $this->getId(),
            'avaliador' => $this->getAvaliador()->toJson(),
            'usuario' => $this->getUsuario()->toJson(),
            'partida' => $this->getPartida()->toJson(),
            'quadra' => $this->getQuadra()->toJson(),
            'estrutura' => $this->getEstrutura(),
            'qualidade' => $this->getQualidade(),
            'atendimento' => $this->getAtendimento()
        );
    } 
}