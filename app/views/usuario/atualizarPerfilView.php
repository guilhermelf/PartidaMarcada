<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/partidamarcada/components/metro-ui-css/build/css/metro.css" />
        <link href="/partidamarcada/components/metro-ui-css/build/css/metro-icons.css" rel="stylesheet" />
        <link href="/partidamarcada/components/metro-ui-css/build/css/metro-schemes.css" rel="stylesheet">
        <link href="/partidamarcada/components/metro-ui-css/build/css/metro-responsive.css" rel="stylesheet">
        <link href="/partidamarcada/components/css/style.css" rel="stylesheet">
        <script src="/partidamarcada/components/jquery/jquery.min.js"></script>
        <script src="/partidamarcada/components/js/scripts.js"></script>
        <script src="/partidamarcada/components/metro-ui-css/build/js/metro.js"></script>
        <title>PartidaMarcada.com</title>
    </head>
    <body>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <h3 class="resposta-titulo"></h3>

            <p class="resposta-mensagem"></p>
        </div>       

        <?php include 'app/views/header/headerUsuario.php'; ?>
        <div class="conteudo">

            <div class="form-cadastro grid">
                <form id="form-usuario-alterarperfil">
                    <h2>Atualizar pefil</h2>
                    <hr />
                    <br />
                    <br />                   
                    <h4>Informações pessoais</h4>
                    <hr />
                    <div class="row cells2">
                        <div class="cell">
                            <label>Nome</label>
                            <div class="input-control text full-size">                       
                                <input type="text" name="nome" id="nome">
                            </div>
                        </div>

                        <div class="cell">
                            <label>Sobrenome</label>
                            <div class="input-control cell text full-size">                      
                                <input type="text" name="sobrenome" id="sobrenome">
                            </div>
                        </div>

                        <div class="row cells3">
                            <div class="cell">
                                <label>Genero</label>
                                <div class="input-control select full-size">
                                    <select id="select-genero" name="genero" id="genero">
                                        <option>Selecione</option>
                                    </select>
                                </div>
                            </div>

                            <div class="cell">
                                <label>Apelido</label>
                                <div class="input-control cell text full-size">                      
                                    <input type="text" name="apelido" id="apelido">
                                </div>
                            </div>
                            <div class="cell">
                                <label>Data de nascimento</label>
                                <div class="input-control cell text full-size">                      
                                    <input type="text" maxlength="10" placeholder="00/00/0000" name="dt_nascimento" id="dt_nascimento">
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4>Informações para contato</h4>
                    <hr />
                    <div class="row cells2">
                        <div class="cell">
                            <label>Estado</label>
                            <div class="input-control select full-size">
                                <select name="estado" id="select-estado">
                                    <option>Selecione</option>
                                </select>
                            </div>
                        </div>

                        <div class="cell">
                            <label>Cidade</label>
                            <div class="input-control select full-size">
                                <select id="select-cidade" name="cidade">
                                    <option>Selecione</option>
                                </select>
                            </div>
                        </div>
                        <div class="row cells3">

                            <div class="cell">
                                <label>Endereço</label>
                                <div class="input-control cell text full-size">                      
                                    <input type="text" name="endereco" id="endereco">
                                </div>
                            </div>

                            <div class="cell">
                                <label>Número</label>
                                <div class="input-control text full-size">                       
                                    <input type="text" name="numero" id="numero">
                                </div>
                            </div>

                            <div class="cell">
                                <label>CEP</label>
                                <div class="input-control text full-size">                       
                                    <input type="text" name="cep" id="cep">
                                </div>
                            </div>
                            <div class="row cells2">
                                <div class="cell">
                                    <label>DDD</label>
                                    <div class="input-control text full-size">                       
                                        <input type="text" name="ddd" id="ddd">
                                    </div>
                                </div>
                                <div class="cell">
                                    <label>telefone</label>
                                    <div class="input-control cell text full-size">                      
                                        <input type="text" name="telefone" id="telefone">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4>Opções de privacidade</h4>
                        <div class="row cells3">
                            <div class="cell">
                                <label>Exibir endereço</label>
                                <div class="input-control select full-size">
                                    <select name="mostrar_endereco"  id="mostrar_endereco">
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                </div>
                            </div>
                            <div class="cell">
                                <label>Exibir telefone</label>
                                <div class="input-control select full-size">
                                    <select name="mostrar_telefone" id="mostrar_telefone">
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                </div>
                            </div>
                            <div class="cell">
                                <label>Visibilidade do perfil</label>
                                <div class="input-control select full-size">
                                    <select id="select-visibilidade" name="visibilidade">
                                        <option>Selecione</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </form>
                <input type="button" class="full-size bg-lightBlue" value="Atualizar informações" id="btn-usuario-atualizarperfil">
                <input type="hidden" id="usuario-id" value="<?php echo $_SESSION['id']; ?>"/>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
    buscarEstados();
    buscarGeneros();
    buscarVisibilidades();
    buscarUsuario();
</script>