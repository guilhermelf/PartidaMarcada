<?php 
//namespace db;
// adicionaCategoria.php
 
/*
 * Fazendo o require do arquivo Bootstrap.php, podemos utilizar tudo que lá foi definido.
 * Estou falando principalmente do EntityManager, criado sobre a variável $entityManager
 */
require_once '/system/doctrine.php';
require_once './app/model/dao/EstadoDAO.php';
require_once './app/model/dao/CidadeDAO.php';
require_once './app/model/dao/UsuarioDAO.php';
require_once './app/model/dao/VisibilidadeDAO.php';
require_once './app/model/dao/GeneroDAO.php';
 
/**
 * 
 *  instanciando a entidade Categoria
 */
$teste = new Cidade();
 
//Inicio teste de criação de usuário
$cidadeDAO = new CidadeDAO();
$cidade = $cidadeDAO->getById(1);

$generoDAO = new GeneroDAO();
$genero = $generoDAO->getById(1);

$visibilidadeDAO = new VisibilidadeDAO();
$visibilidade = $visibilidadeDAO->getById(1);

$usuario = new Usuario();

$usuario->setApelido("apelido");
$usuario->setCep("12345678");
$usuario->setAtivo(1);
$usuario->setCidade($cidade);
$usuario->setDataNascimento(new \DateTime('11-11-1190'));
$usuario->setMostrarEndereco(1);
$usuario->setMostrarTelefone(1);
$usuario->setDdd(51);
$usuario->setEmail("email");
$usuario->setEndereco("endereco");
$usuario->setGenero($genero);
$usuario->setNome("nome");
$usuario->setNumero('1234');
$usuario->setSenha("654321");
$usuario->setSobrenome("sobrenome");
$usuario->setTelefone(92930438);
$usuario->setVisibilidade($visibilidade);
$usuarioDAO = new UsuarioDAO();

$usuarioDAO->insert($usuario);
//final do teste de criacao de usuario


/**
 * 
 * utilizando a função setNome 
 * Defino o nome da categoria a ser criada no banco de dados
 */
//$teste->setNome('Rio Grande do Sul 2');
//$teste->setUf("RS");
 

//$dao = new EstadoDAO();
//$dao2 = new CidadeDAO();
////$dao->insert($teste);
////
//$estado = $dao->getById(1);
//$cidade = $dao2->getById(1);
//$lista = $dao->getAll();
//echo $cidade->getEstado()->getNome();
//$json = [];
//
//if(empty($lista)) {
//    echo "vazio!";
//} else {
//    foreach ($lista as $item) {
//        //print_r($item->toJson());
//    }
//}

//echo json_encode($json);


/**
 * 
 * Aqui o EM entra em ação. 
 * A função persist aguarda por um objeto  para colocá-lo na fila
 * de instruções a ser executada sobre o banco de dados
 */
//$em->persist($teste);
 
/**
 * 
 * Novamente o EM age e invoca a função flush.
 * Esta é a responsável por pegar todas as intruções previamente preparadas
 * pelo persist e executá-las no banco de dados. 
 * Só a apartir daqui o banco é alterado de alguma forma.
 */
//$em->flush();