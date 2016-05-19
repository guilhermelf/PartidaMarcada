<?php
/**
 * ParqueEsportivo
 *
 * @Entity
 * @Table(name="parque_esportivo")
 */
class ParqueEsportivo {
   
    /**
     * @Id
     * @Column(type="integer", name="id_parque_esportivo")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @Column(type="string", name="nome")
     */
    private $nome;
    
    /**
     * @Column(type="string", name="site")
     */
    private $site;
    
    /**
     * @Column(type="boolean", name="ativo")
     */
    private $ativo;
      
    /**
     * @Column(type="boolean", name="churrasqueira")
     */
    private $churrasqueira;
    
    /**
     * @Column(type="boolean", name="vestiario")
     */
    private $vestiario;
    
    /**
     * @Column(type="boolean", name="servicos")
     */
    private $servicos;
    
    /**
     * @Column(type="boolean", name="copa")
     */
    private $copa;
    
    /**
     * @Column(type="integer", name="cep")
     */
    private $cep;
    
    /**
     * @Column(type="integer", name="ddd")
     */
    private $ddd;
    
    /**
     * @Column(type="string", name="email")
     */
    private $email;
    
    /**
     * @Column(type="string", name="endereco")
     */
    private $endereco;
    
    /**
     * @Column(type="integer", name="numero")
     */
    private $numero;
    
    /**
     * @Column(type="integer", name="telefone")
     */
    private $telefone;
    
    /**
     * @Column(type="string", name="senha")
     */
    private $senha;
    
    /**
     * @ManyToOne(targetEntity="Cidade", cascade={"persist"}, inversedBy="parqueEsportivos")
     * @JoinColumn(name="id_cidade", referencedColumnName="id_cidade")
     */
    private $cidade;
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getSite() {
        return $this->site;
    }

    function getAtivo() {
        return $this->ativo;
    }

    function getChurrasqueira() {
        return $this->churrasqueira;
    }

    function getVestiario() {
        return $this->vestiario;
    }

    function getCopa() {
        return $this->copa;
    }

    function getCep() {
        return $this->cep;
    }

    function getDdd() {
        return $this->ddd;
    }

    function getEmail() {
        return $this->email;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getNumero() {
        return $this->numero;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getSenha() {
        return $this->senha;
    }

    function getCidade() {
        return $this->cidade;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSite($site) {
        $this->site = $site;
    }

    function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    function setChurrasqueira($churrasqueira) {
        $this->churrasqueira = $churrasqueira;
    }

    function setVestiario($vestiario) {
        $this->vestiario = $vestiario;
    }

    function setCopa($copa) {
        $this->copa = $copa;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setDdd($ddd) {
        $this->ddd = $ddd;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }
    
    function getServicos() {
        return $this->servicos;
    }

    function setServicos($servicos) {
        $this->servicos = $servicos;
    }
    
    public function toJson() {
        return array(        
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'cidade' => $this->getCidade()->toJson(),
            'site' => $this->getSite(),
            'ativo' => $this->getAtivo(),
            'churrasqueira' => $this->getChurrasqueira(),
            'vestiario' => $this->getVestiario(),
            'servicos' => $this->getServicos(),
            'copa' => $this->getCopa(),
            'cep' => $this->getCep(),
            'ddd' => $this->getDdd(),
            'endereco' => $this->getEndereco(),
            'numero' => $this->getNumero(),
            'email' => $this->getEmail(),
            'telefone' => $this->getTelefone(),
            'senha' => $this->getSenha()
        );
    }
}