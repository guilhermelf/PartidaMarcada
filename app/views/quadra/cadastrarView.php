<!DOCTYPE html>
<html>
    <head>
        <link href="/partidamarcada/components/metro-ui-css/build/css/metro-icons.css" rel="stylesheet" />
        <link href="/partidamarcada/components/metro-ui-css/build/css/metro-schemes.css" rel="stylesheet">
        <link href="/partidamarcada/components/metro-ui-css/build/css/metro-responsive.css" rel="stylesheet">
        <link href="/partidamarcada/components/css/style.css" rel="stylesheet">
        <script src="/partidamarcada/components/jquery/jquery.min.js"></script>
        <script src="/partidamarcada/components/js/scripts.js"></script>
        <script src="/partidamarcada/components/metro-ui-css/js/metro.js"></script>
        <title>PartidaMarcada.com</title>
    </head>
    <script>
        $(document).ready(function () {
            buscarEstados();
            buscarGeneros();
            buscarVisibilidades();
        })    
    </script>
    <body>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <h3 class="resposta-titulo"></h3>

            <p class="resposta-mensagem"></p>
        </div>       
        
        <?php include 'app/views/header/header.php'; ?>
        <div class="conteudo">

            <div class="form-cadastro grid">
                <form id="form-quadra-cadastrar">
                    <h2>Cadastro de parque esportivo</h2>
                    <hr />
                    <br />
                    <br />
                    <h4>Informações de login</h4>
                    <hr />
                    <div class="row cells2">
                        <div class="cell">
                            <label>E-mail</label>
                            <div class="input-control text full-size">                       
                                <input type="text" name="email">
                            </div>
                        </div>
                        <div class="cell">
                            <label>Confirmar e-mail</label>
                            <div class="input-control cell text full-size">                      
                                <input type="text" name="email2">
                            </div>
                        </div>

                        <div class="row cells2">
                            <div class="cell">
                                <label>Senha</label>
                                <div class="input-control password full-size">                       
                                    <input type="password" name="senha">
                                </div>
                            </div>
                            <!-- input[type=password] -->
                            <div class="cell">
                                <label>Confirmar senha</label>
                                <div class="input-control password full-size">                       
                                    <input type="password" name="senha2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4>Informações da quadra</h4>
                    <hr />
                    <div class="row cells2">
                        <div class="cell">
                            <label>Nome</label>
                            <div class="input-control text full-size">                       
                                <input type="text" name="nome">
                            </div>
                        </div>
                        <!-- input[type=password] -->
                        <div class="cell">
                            <label>Site</label>
                            <div class="input-control cell text full-size">                      
                                <input type="text" name="site">
                            </div>
                        </div>
                    </div>
                    <div class="row cells2">
                        <div class="cell">
                            <label>Estado</label>
                            <div class="input-control select full-size">
                                <select name="estado" id="select-estado">
                                    <option>Selecione</option>
                                </select>
                            </div>
                        </div>
                        <!-- input[type=password] -->
                        <div class="cell">
                            <label>Cidade</label>
                            <div class="input-control select full-size">
                                <select id="select-cidade" name="cidade">
                                    <option>Selecione</option>
                                </select>
                            </div>
                        </div>
                        <div class="row cells3">
                            <!-- input[type=password] -->
                            <div class="cell">
                                <label>Endereço</label>
                                <div class="input-control cell text full-size">                      
                                    <input type="text" name="endereco">
                                </div>
                            </div>

                            <div class="cell">
                                <label>Número</label>
                                <div class="input-control text full-size">                       
                                    <input type="text" name="numero">
                                </div>
                            </div>

                            <div class="cell">
                                <label>CEP</label>
                                <div class="input-control text full-size">                       
                                    <input type="text" name="cep">
                                </div>
                            </div>
                            <div class="row cells2">
                                <div class="cell">
                                    <label>DDD</label>
                                    <div class="input-control text full-size">                       
                                        <input type="text" name="ddd">
                                    </div>
                                </div>
                                <!-- input[type=password] -->
                                <div class="cell">
                                    <label>Telefone</label>
                                    <div class="input-control cell text full-size">                      
                                        <input type="text" name="telefone">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4>Serviços e espaços disponíveis</h4>
                        <div class="row cells4">
                            <div class="cell">
                                <label>Vestiários</label>
                                <div class="input-control select full-size">
                                    <select name="vestiario" id="vestiario">
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                </div>
                            </div>
                            <div class="cell">
                                <label>Churrasqueira</label>
                                <div class="input-control select full-size">
                                    <select name="churrasqueira" id="churrasqueira">
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                </div>
                            </div>                         
                            <div class="cell">
                                <label>Copa/Bar</label>
                                <div class="input-control select full-size">
                                    <select name="copa" id="copa">
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                </div>
                            </div>
                            <div class="cell">
                                <label>Agendar horários pelo site?</label>
                                <div class="input-control select full-size">
                                    <select name="servicos" id="servicos">
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </form>
                <input type="button" class="full-size bg-lightBlue" value="Cadastrar" id="btn-quadra-cadastrar">
            </div>
        </div>
    </div>
</div>
</body>
</html>