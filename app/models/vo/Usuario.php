<?php
/**
 * Usuario
 *
 * @Entity
 * @Table(name="usuario")
 */
class Usuario {
   
    /**
     * @Id
     * @Column(type="integer", name="id_usuario")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @Column(type="string", name="nome")
     */
    private $nome;
    
    /**
     * @Column(type="string", name="apelido")
     */
    private $apelido;
    
    /**
     * @Column(type="boolean", name="ativo")
     */
    private $ativo;
    
    
    /**
     * @Column(type="boolean", name="mostrar_endereco")
     */
    private $mostrarEndereco;
    
    
    /**
     * @Column(type="boolean", name="mostrar_telefone")
     */
    private $mostrarTelefone;
    
    /**
     * @Column(type="integer", name="cep")
     */
    private $cep;
    
    /**
     * @Column(type="integer", name="ddd")
     */
    private $ddd;
    
    /**
     * @Column(type="date", name="dt_nascimento")
     */
    private $DataNascimento;
    
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
     * @Column(type="string", name="sobrenome")
     */
    private $sobrenome;
    
    /**
     * @Column(type="string", name="senha")
     */
    private $senha;
    
    /**
     * @ManyToOne(targetEntity="Cidade", cascade={"persist"}, inversedBy="usuarios")
     * @JoinColumn(name="id_cidade", referencedColumnName="id_cidade")
     */
    private $cidade;
    
    /**
     * @ManyToOne(targetEntity="Genero", cascade={"persist"})
     * @JoinColumn(name="id_genero", referencedColumnName="id_genero")
     */
    private $genero;
    
    /**
     * @ManyToOne(targetEntity="Visibilidade", cascade={"persist"})
     * @JoinColumn(name="id_visibilidade", referencedColumnName="id_visibilidade")
     */
    private $visibilidade; 
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getApelido() {
        return $this->apelido;
    }

    function isAtivo() {
        return $this->ativo;
    }

    function getCep() {
        return $this->cep;
    }

    function getDdd() {
        return $this->ddd;
    }

    function getDataNascimento() {
        return $this->DataNascimento;
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

    function getSobrenome() {
        return $this->sobrenome;
    }

    function getSenha() {
        return $this->senha;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getGenero() {
        return $this->genero;
    }

    function getVisibilidade() {
        return $this->visibilidade;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setApelido($apelido) {
        $this->apelido = $apelido;
    }

    function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setDdd($ddd) {
        $this->ddd = $ddd;
    }

    function setDataNascimento($DataNascimento) {
        $this->DataNascimento = $DataNascimento;
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

    function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setGenero($genero) {
        $this->genero = $genero;
    }

    function setVisibilidade($visibilidade) {
        $this->visibilidade = $visibilidade;
    }
    
    function isMostrarEndereco() {
        return $this->mostrarEndereco;
    }

    function isMostrarTelefone() {
        return $this->mostrarTelefone;
    }

    function setMostrarEndereco($mostrarEndereco) {
        $this->mostrarEndereco = $mostrarEndereco;
    }

    function setMostrarTelefone($mostrarTelefone) {
        $this->mostrarTelefone = $mostrarTelefone;
    }
    
    public function toJson() {
        return array(           
            'nome' => $this->getNome(),
            'cidade' => $this->getCidade()->toJson(),
            'sobrenome' => $this->getSobrenome(),
            'apelido' => $this->getApelido(),
            'dataNascimento' => $this->getDataNascimento(),
            'cep' => $this->getCep(),
            'ddd' => $this->getDdd(),
            'endereco' => $this->getEndereco(),
            'numero' => $this->getNumero(),        
            'ativo' => $this->getAtivo(),
            'email' => $this->getEmail(),
            'telefone' => $this->getTelefone(),
            'senha' => $this->getSenha()           
        );
    } 
}