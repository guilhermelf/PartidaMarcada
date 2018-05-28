<?php
/**
 * AvaliarAtleta
 *
 * @Entity
 * @Table(name="avaliacao_atleta")
 */
class AvaliacaoAtleta {  
   
    /**
     * @Id
     * @Column(type="integer", name="id_avaliacao_atleta")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;          
    
    /**
     * @OneToOne(targetEntity="Usuario", cascade={"persist"})
     * @JoinColumn(name="avaliador", referencedColumnName="id_usuario")
     */
    private $avaliador;
    
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
     * @Column(type="integer", name="habilidade")
     */
    private $habilidade;
    
    /**
     * @Column(type="integer", name="comportamento")
     */
    private $comportamento;
    
    /**
     * @Column(type="integer", name="pontualidade")
     */
    private $pontualidade;
       
    function getId() {
        return $this->id;
    }

    function getAvaliador() {
        return $this->avaliador;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getPartida() {
        return $this->partida;
    }

    function getHabilidade() {
        return $this->habilidade;
    }

    function getComportamento() {
        return $this->comportamento;
    }

    function getPontualidade() {
        return $this->pontualidade;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setAvaliador($avaliador) {
        $this->avaliador = $avaliador;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setPartida($partida) {
        $this->partida = $partida;
    }

    function setHabilidade($habilidade) {
        $this->habilidade = $habilidade;
    }

    function setComportamento($comportamento) {
        $this->comportamento = $comportamento;
    }

    function setPontualidade($pontualidade) {
        $this->pontualidade = $pontualidade;
    }
    
    public function toJson() {           
        return array(           
            'id' => $this->getId(),
            'avaliador' => $this->getAvaliador()->toJson(),
            'usuario' => $this->getUsuario()->toJson(),
            'partida' => $this->getPartida()->toJson(),
            'habilidade' => $this->getHabilidade(),
            'comportamento' => $this->getComportamento(),
            'pontualidade' => $this->getPontualidade()
        );
    } 
}