<?php
/**
 * Participante
 *
 * @Entity
 * @Table(name="participante")
 */
class Participante {
   
    /**
     * @Id
     * @Column(type="integer", name="id_participante")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;    
    
    /**
     * @ManyToOne(targetEntity="Partida",inversedBy="participantes" , cascade={"persist"}, )
     * @JoinColumn(name="id_partida", referencedColumnName="id_partida")
     */
    private $partida;
    
    /**
     * @ManyToOne(targetEntity="Usuario", cascade={"persist"})
     * @JoinColumn(name="id_usuario", referencedColumnName="id_usuario")
     */
    private $usuario;
    
    /**
     * @Column(type="integer", name="id_status")
     */
    private $status;
       
    function getId() {
        return $this->id;
    }

    function getPartida() {
        return $this->partida;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPartida($partida) {
        $this->partida = $partida;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setStatus($status) {
        $this->status = $status;
    }
    
    public function toJson() {          
        return array(           
            'id' => $this->getId(),
            'usuarioId' => $this->getUsuario()->getId(),
            'usuarioNome' => $this->getUsuario()->getNome(),
            'partidaId' => $this->getPartida()->getId(), 
            'status' => $this->getStatus()
        );
    } 
}