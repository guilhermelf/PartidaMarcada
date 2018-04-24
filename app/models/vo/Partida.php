<?php
/**
 * Partida
 *
 * @Entity
 * @Table(name="partida")
 */
class Partida {
    
    public function __construct() {
        $this->participantes = new \Doctrine\Common\Collections\ArrayCollection();
    }
   
    /**
     * @Id
     * @Column(type="integer", name="id_partida")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;    
    
    /**
     * @OneToMany(targetEntity="Participante", mappedBy="partida")
     */
    private $participantes;
    
    /**
     * @ManyToOne(targetEntity="Quadra", cascade={"persist"})
     * @JoinColumn(name="id_quadra", referencedColumnName="id_quadra")
     */
    private $quadra;
    
    /**
     * @ManyToOne(targetEntity="Esporte", cascade={"persist"})
     * @JoinColumn(name="id_esporte", referencedColumnName="id_esporte")
     */
    private $esporte;
    
    /**
     * @ManyToOne(targetEntity="Usuario", cascade={"persist"})
     * @JoinColumn(name="id_usuario", referencedColumnName="id_usuario")
     */
    private $usuario;
    
    /**
     * @Column(type="date", name="data")
     */
    private $data;
    
    /**
     * @Column(type="integer", name="inicio")
     */
    private $inicio;
    
     /**
     * @Column(type="integer", name="final")
     */
    private $final;
    
     /**
     * @Column(type="integer", name="numero_jogadores")
     */
    private $numeroJogadores;
    
    /**
     * @Column(type="integer", name="publico")
     */
    private $publico;
    
    /**
     * @Column(type="string", name="descricao")
     */
    private $descricao;
    
    /**
     * @Column(type="integer", name="status")
     */
    private $status;
    
    function getId() {
        return $this->id;
    }

    function getQuadra() {
        return $this->quadra;
    }

    function getEsporte() {
        return $this->esporte;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getData() {
        return $this->data;
    }

    function getInicio() {
        return $this->inicio;
    }

    function getFinal() {
        return $this->final;
    }

    function getNumeroJogadores() {
        return $this->numeroJogadores;
    }

    function getPublico() {
        return $this->publico;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setQuadra($quadra) {
        $this->quadra = $quadra;
    }

    function setEsporte($esporte) {
        $this->esporte = $esporte;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setInicio($inicio) {
        $this->inicio = $inicio;
    }

    function setFinal($final) {
        $this->final = $final;
    }

    function setNumeroJogadores($numeroJogadores) {
        $this->numeroJogadores = $numeroJogadores;
    }

    function setPublico($publico) {
        $this->publico = $publico;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    
    function getStatus() {
        return $this->status;
    }
    

    function setStatus($status) {
        $this->status = $status;
    }
    
    function getParticipantes() {
        return $this->participantes;
    }
    
    function setParticipantes($participantes) {
        $this->participantes = $participantes;
    }
    
    function addParticipante($usuario) {
        $this->participantes->add($usuario);
    }
    
    public function toJson() {     
        $participantes = null;
        foreach ($this->getParticipantes() as $part) {
            $participantes[] = $part->toJson();
        }
        
        return array(           
            'id' => $this->getId(),
            'data' => date_format($this->getData(), 'd/m/Y'),
            'publico' => $this->getPublico(),
            'inicio' => $this->getInicio(),
            'final' => $this->getFinal(),
            'esporte' => $this->getEsporte()->toJson(),
            'numeroJogadores' => $this->getNumeroJogadores(),
            'descricao' => $this->getDescricao(),
            'quadra' => $this->getQuadra()->toJson(),
            'usuario' => $this->getUsuario()->toJson(), 
            'status' => $this->getStatus(),
            'participantes' => $participantes
        );
    } 
}