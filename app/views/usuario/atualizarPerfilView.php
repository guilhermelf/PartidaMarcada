<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="/partidamarcada/components/metro-ui-css/css/metro-all.css" />
        <link href="/partidamarcada/components/css/style.css" rel="stylesheet">
        <script src="/partidamarcada/components/jquery/jquery.min.js"></script>
        <script src="/partidamarcada/components/js/scripts.js"></script>
        <script src="/partidamarcada/components/metro-ui-css/js/metro.js"></script>
        <title>Partida Marcada</title>
    </head>
    <script>
        $(document).ready(function () {

            //buscar estados
            $('.estados').remove();
            $.ajax({
                async: false,
                type: "post",
                url: "/partidamarcada/estado/listar",
                dataType: "json",
                success: function (resposta) {
                    $.each(resposta, function (k, v) {
                        $("#select-estado").append("<option class='estados' value=" + v.id + ">" + v.nome + "</option>");
                    });
                }
            });

            //buscar generos
            $('.generos').remove();
            $.ajax({
                async: false,
                type: "post",
                url: "/partidamarcada/genero/listar",
                dataType: "json",
                success: function (resposta) {
                    $.each(resposta, function (k, v) {
                        $("#select-genero").append("<option class='generos' value=" + v.id + ">" + v.nome + "</option>");
                    });
                }
            });

            //buscar visibilidades
            $('.visibilidades').remove();
            $.ajax({
                async: false,
                type: "post",
                url: "/partidamarcada/visibilidade/listar",
                dataType: "json",
                success: function (resposta) {
                    $.each(resposta, function (k, v) {
                        $("#select-visibilidade").append("<option class='visibilidades' value=" + v.id + ">" + v.nome + "</option>");
                    });
                }
            });

            //buscar cidades
            $('#select-estado').on('change', function () {
                var estado = $(this).val();
                $('.cidades').remove();
                $.ajax({
                    async: false,
                    type: "post",
                    data: {estado: estado},
                    url: "/partidamarcada/cidade/listarPorEstado",
                    dataType: 'json',
                    success: function (resposta) {

                        $.each(resposta, function (k, v) {
                            $("#select-cidade").append("<option class='cidades' value=" + v.id + ">" + v.nome + "</option>");
                        });
                    }
                });
            });

            //buscar usuário
            $.ajax({
                async: false,
                type: "post",
                url: "/partidamarcada/usuario/buscarUsuario",
                dataType: 'json',
                success: function (resposta) {

                    buscarCidades(resposta.cidade.estado.id);
                    $('#nome').val(resposta.nome);
                    $('#sobrenome').val(resposta.sobrenome);
                    $('#apelido').val(resposta.apelido);
                    $('#endereco').val(resposta.endereco);
                    $('#numero').val(resposta.numero);
                    $('#ddd').val(resposta.ddd);
                    $('#telefone').val(resposta.telefone);
                    $('#dt_nascimento').val(resposta.dataNascimento);
                    $('#select-estado').val(resposta.cidade.estado.id);
                    $('#cep').val(resposta.cep);
                    $('#select-visibilidade').val(resposta.visibilidade.id);
                    $('#select-genero').val(resposta.genero.id);
                    resposta.mostrarTelefone ? $('#mostrar_telefone').val(1) : $('#mostrar_telefone').val(0);
                    resposta.mostrarEndereco ? $('#mostrar_endereco').val(1) : $('#mostrar_endereco').val(0);

                    $('#select-estado').change();
                    $('#select-cidade').val(resposta.cidade.id);
                }
            });

            //atualizar perfil de usuário
            $("#btn-usuario-atualizar").on('click', function () {

                $.ajax({
                    type: "post",
                    dataType: 'json',
                    data: $("#form-usuario-atualizar").serialize(),
                    url: "/partidamarcada/usuario/atualizar",
                    success: function (resposta) {
                        if (resposta.status) {
                            $(".resposta-titulo").html("Sucesso");
                            $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');
                            $(".resposta-mensagem").html(resposta.mensagem);

                            $("#resposta").data('dialog').open();

                            setTimeout(function () {
                                window.location.href = "/partidamarcada/usuario"
                            }, 2000);
                        } else {
                            $(".resposta-titulo").html("Erro");
                            $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');
                            $(".resposta-mensagem").html(resposta.mensagem);

                            $("#resposta").data('dialog').open();
                        }
                        console.log(resposta);
                    }
                });
            })
        });
    </script>
    <body>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <h3 class="resposta-titulo"></h3>

            <p class="resposta-mensagem"></p>
        </div>       

        <?php include 'app/views/header/headerUsuario.php'; ?>
        <div class="conteudo">

            <div class="form-cadastro grid">
                <form id="form-usuario-atualizar">
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
                                    <label>Telefone</label>
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
                        <input type="hidden" id="usuario-id" name="id" value="<?php echo $_SESSION['id']; ?>"/>
                </form>
                <input type="button" class="full-size bg-lightBlue" value="Atualizar informações" id="btn-usuario-atualizar">                
            </div>
        </div>
    </div>
</div>
</body>
</html>