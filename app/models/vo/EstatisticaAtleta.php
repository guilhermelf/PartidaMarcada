<?php
/**
 * EstatisticaAtleta
 *
 * @Entity
 * @Table(name="estatistica_atleta")
 */
class EstatisticaAtleta {
    
   
    /**
     * @Id
     * @Column(type="integer", name="id_estatistica_atleta")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;       
    
    /**
     * @OneToOne(targetEntity="Usuario", cascade={"persist"}, inversedBy="estatistica")
     * @JoinColumn(name="id_usuario", referencedColumnName="id_usuario")
     */
    private $usuario;    
        
    /**
    * @Column(type="float", name="habilidade")
    */
    private $habilidade;
    
     /**
    * @Column(type="float", name="pontualidade")
    */
    private $pontualidade;
    
    /**
    * @Column(type="float", name="comportamento")
    */
    private $comportamento;
    
    /**
    * @Column(type="float", name="organizador")
    */
    private $organizador;
    
    /**
     * @Column(type="integer", name="pontos")
     */
    private $pontos;
    
    /**
     * @Column(type="integer", name="partidas_marcadas")
     */
    private $partidasMarcadas;
    
    /**
     * @Column(type="integer", name="organizadas_online")
     */
    private $organizadasOnline;
    
    /**
     * @Column(type="integer", name="participacoes")
     */
    private $participacoes;
    
    /**
     * @Column(type="integer", name="avaliacoes")
     */
    private $avaliacoes;
    
    function getId() {
        return $this->id;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getHabilidade() {
        return $this->habilidade;
    }

    function getPontualidade() {
        return $this->pontualidade;
    }

    function getComportamento() {
        return $this->comportamento;
    }

    function getOrganizador() {
        return $this->organizador;
    }

    function getPontos() {
        return $this->pontos;
    }

    function getPartidasMarcadas() {
        return $this->partidasMarcadas;
    }

    function getParticipacoes() {
        return $this->participacoes;
    }

    function getAvaliacoes() {
        return $this->avaliacoes;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setHabilidade($habilidade) {
        $this->habilidade = $habilidade;
    }

    function setPontualidade($pontualidade) {
        $this->pontualidade = $pontualidade;
    }

    function setComportamento($comportamento) {
        $this->comportamento = $comportamento;
    }

    function setOrganizador($organizador) {
        $this->organizador = $organizador;
    }

    function setPontos($pontos) {
        $this->pontos = $pontos;
    }

    function setPartidasMarcadas($partidasMarcadas) {
        $this->partidasMarcadas = $partidasMarcadas;
    }

    function setParticipacoes($participacoes) {
        $this->participacoes = $participacoes;
    }

    function setAvaliacoes($avaliacoes) {
        $this->avaliacoes = $avaliacoes;
    }
    
    function getOrganizadasOnline() {
        return $this->organizadasOnline;
    }

    function setOrganizadasOnline($organizadasOnline) {
        $this->organizadasOnline = $organizadasOnline;
    }
    
    public function toJson() {       
        return array(        
            'id' => $this->getId(),
            'avaliacoes' => $this->getAvaliacoes(),
            'comportamento' => $this->getComportamento(),
            'habilidade' => $this->getHabilidade(),
            'organizador' => $this->getOrganizador(),
            'participacoes' => $this->getParticipacoes(),
            'partidasMarcadas' => $this->getPartidasMarcadas(),
            'pontos' => $this->getPontos(),
            'pontualidade' => $this->getPontualidade(),
            'organizadasOnline' => $this->getOrganizadasOnline(),
            'nome' => $this->getUsuario()->getNome()." ".$this->getUsuario()->getSobrenome(). " (".$this->getUsuario()->getApelido().")",
        );
    } 
}