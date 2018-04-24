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
    <?php include 'app/views/header/headerQuadra.php'; ?>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <div class="dialog-title resposta-titulo"></div>
            <div class="dialog-content resposta-mensagem"></div>
        </div>                     
        <div class="conteudo container">
            <form id="form-quadra-atualizar">
                <h2>Atualizar informações do parque esportivo</h2>
                <br />
                <hr />
                <h4>Dados da quadra</h4>
                <hr />
                <div class="row">
                    <div class="cell-sm-5">  
                        <input type="text" name="nome" id="nome" placeholder="Nome">
                    </div>
                    <div class="cell-sm-4">  
                        <input type="text" name="site" id="site" placeholder="Site">
                    </div>
                    <div class="cell-sm-3">  
                        <input type="text" name="cep" id="cep" placeholder="CEP">
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="cell-sm-6">   
                        <select name="estado" id="select-estado">
                            <option>Estado</option>
                        </select>
                    </div>
                    <div class="cell-sm-6">   
                        <select id="select-cidade" name="cidade">
                            <option>Cidade</option>
                        </select>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="cell-sm-5">  
                        <input type="text" name="endereco" id="endereco" placeholder="Endereço">
                    </div>
                    <div class="cell-sm-2">  
                        <input type="text" name="numero" id="numero" placeholder="Número">
                    </div>
                    <div class="cell-sm-2">  
                        <input type="text" name="ddd" id="ddd" placeholder="DDD">
                    </div>
                    <div class="cell-sm-3">  
                        <input type="text" name="telefone" id="telefone" placeholder="Telefone">
                    </div>
                </div>
                <br />
                <hr />     
                <h4>Serviços e espaços disponíveis</h4>
                <hr />
                <div class="row">
                    <div class="cell-sm-2">
                        <label for vestiario>Vestiários?</label>
                    </div>
                    <div class="cell-sm-1">
                    <select name="vestiario" id="vestiario">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                    <div class="cell-sm-2">
                        <label for vestiario>Churrasqueira?</label>
                    </div>
                    <div class="cell-sm-1">
                    <select name="churrasqueira" id="churrasqueira">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                    <div class="cell-sm-2">
                        <label for vestiario>Copa/bar?</label>
                    </div>
                    <div class="cell-sm-1">
                        <select name="copa" id="copa">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                    <div class="cell-sm-2">
                        <label for vestiario>Agendamento pelo portal?</label>
                    </div>
                    <div class="cell-sm-1">
                        <select name="servicos" id="servicos">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                </div>
                <br />
                <input type="hidden" id="quadra-id" name="id" value="<?php echo $_SESSION['id']; ?>"/>
                <input type="button" class="cell-sm-12 button bg-lightBlue" value="Atualizar informações" id="btn-quadra-atualizar"
                <br />&nbsp;  
            </form>
        </div>
    </body>
</html>