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

            //buscar parque esportivo
            $.ajax({
                async: false,
                type: "post",
                url: "/partidamarcada/parqueesportivo/buscarparqueesportivo",
                dataType: 'json',
                success: function (resposta) {

                    buscarCidades(resposta.cidade.estado.id);
                    $('#nome').val(resposta.nome);
                    $('#site').val(resposta.site);
                    $('#endereco').val(resposta.endereco);
                    $('#numero').val(resposta.numero);
                    $('#ddd').val(resposta.ddd);
                    $('#telefone').val(resposta.telefone);
                    $('#select-estado').val(resposta.cidade.estado.id);
                    $('#cep').val(resposta.cep);
                    resposta.churrasqueira ? $('#churrasqueira').val(1) : $('#churrasqueira').val(0);
                    resposta.vestiario ? $('#vestiario').val(1) : $('#vestiario').val(0);
                    resposta.servicos ? $('#servicos').val(1) : $('#servicos').val(0);
                    resposta.copa ? $('#copa').val(1) : $('#copa').val(0);

                    $('#select-estado').change();
                    $('#select-cidade').val(resposta.cidade.id);
                }
            });

            //atualizar perfil de parque esportivo
            $("#btn-quadra-atualizar").on('click', function () {

                $.ajax({
                    type: "post",
                    dataType: 'json',
                    data: $("#form-quadra-atualizar").serialize(),
                    url: "/partidamarcada/parqueesportivo/atualizar",
                    success: function (resposta) {
                        if (resposta.status) {
                            $(".resposta-titulo").html("Sucesso");
                            $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');
                            $(".resposta-mensagem").html(resposta.mensagem);

                            $("#resposta").data('dialog').open();

                            setTimeout(function () {
                                window.location.href = "/partidamarcada/parqueesportivo"
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

        <?php include 'app/views/header/headerQuadra.php'; ?>
        <div class="conteudo">

            <div class="form-cadastro grid">
                <form id="form-quadra-atualizar">
                    <h2>Atualizar perfil de parque esportivo</h2>
                    <hr />
                    <br />
                    <br />
                    <h4>Informações da quadra</h4>
                    <hr />
                    <div class="row cells2">
                        <div class="cell">
                            <label>Nome</label>
                            <div class="input-control text full-size">                       
                                <input type="text" name="nome" id="nome">
                            </div>
                        </div>
                        <!-- input[type=password] -->
                        <div class="cell">
                            <label>Site</label>
                            <div class="input-control cell text full-size">                      
                                <input type="text" name="site" id="site">
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
                                <!-- input[type=password] -->
                                <div class="cell">
                                    <label>Telefone</label>
                                    <div class="input-control cell text full-size">                      
                                        <input type="text" name="telefone" id="telefone">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4>Serviços e espaços disponíveis</h4>
                        <div class="row cells4">
                            <div class="cell">
                                <label>Vestiários</label>
                                <div class="input-control select full-size">
                                    <select name="vestiario" id="vestiario" id="vestiario">
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                </div>
                            </div>
                            <div class="cell">
                                <label>Churrasqueira</label>
                                <div class="input-control select full-size">
                                    <select name="churrasqueira" id="churrasqueira" id="churrasqueira">
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                </div>
                            </div>                         
                            <div class="cell">
                                <label>Copa/Bar</label>
                                <div class="input-control select full-size">
                                    <select name="copa" id="copa" id="copa">
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                </div>
                            </div>
                            <div class="cell">
                                <label>Agendar online?</label>
                                <div class="input-control select full-size">
                                    <select name="servicos" id="servicos" id="servicos">
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="quadra-id" name="id" value="<?php echo $_SESSION['id']; ?>"/>
                </form>
                <input type="button" class="full-size bg-lightBlue" value="Atualizar informações" id="btn-quadra-atualizar">                
            </div>
        </div>
    </div>
</div>
</body>
</html>