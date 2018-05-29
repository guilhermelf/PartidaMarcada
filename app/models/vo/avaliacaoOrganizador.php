<?php
/**
 * AvaliarOrganizador
 *
 * @Entity
 * @Table(name="avaliacao_organizador")
 */
class AvaliacaoOrganizador {  
   
    /**
     * @Id
     * @Column(type="integer", name="id_avaliacao_organizador")
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
     * @OneToOne(targetEntity="ParqueEsportivo", cascade={"persist"})
     * @JoinColumn(name="id_parque_esportivo", referencedColumnName="id_parque_esportivo")
     */
    private $parqueEsportivo;
    
    /**
     * @Column(type="integer", name="avaliacao")
     */
    private $avaliacao;
    
    function getId() {
        return $this->id;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getPartida() {
        return $this->partida;
    }

    function getParqueEsportivo() {
        return $this->parqueEsportivo;
    }

    function getAvaliacao() {
        return $this->avaliacao;
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

    function setParqueEsportivo($parqueEsportivo) {
        $this->parqueEsportivo = $parqueEsportivo;
    }

    function setAvaliacao($avaliacao) {
        $this->avaliacao = $avaliacao;
    }
            
    public function toJson() {           
        return array(           
            'id' => $this->getId(),
            'avaliacao' => $this->getAvaliacao(),
            'usuario' => $this->getUsuario()->toJson(),
            'partida' => $this->getPartida()->toJson(),
            'parqueEsportivo' => $this->getParqueEsportivo()->toJson()
        );
    } 
}