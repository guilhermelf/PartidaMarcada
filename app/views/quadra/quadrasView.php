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
            //buscar esportes
            $('.esportes').remove();
            $.ajax({
                async: false,
                type: "post",
                url: "/partidamarcada/esporte/listar",
                dataType: "json",
                success: function (resposta) {
                    $.each(resposta, function (k, v) {
                        $('#check-esportes').append(
                                "<div class='cell .esportes'><label class='input-control checkbox small-check'>" +
                                "<input type='checkbox' value='" + v.id + "' name='esportes[]'>" +
                                "<span class='check'></span>" +
                                "<span class='caption'>" + v.nome + "</span>" +
                                "</label></div>");
                        $('#check-atesportes').append(
                                "<div class='cell .esportes'><label class='input-control checkbox small-check'>" +
                                "<input type='checkbox' id='" + v.nome + "' value='" + v.id + "' name='esportes[]'>" +
                                "<span class='check'></span>" +
                                "<span class='caption'>" + v.nome + "</span>" +
                                "</label></div>");
                    });
                }
            });

            //listar quadras
            $('.quadras').remove();
            $.ajax({
                async: false,
                dataType: "json",
                type: 'post',
                url: "/partidamarcada/quadra/listar",
                success: function (resposta) {
                    console.log(resposta);
                    $.each(resposta, function (k, v) {
                        var esportes = "";
                        if (v.esportes != null) {
                            $.each(v.esportes, function (key, value) {
                                esportes += value.nome + "  ";
                            });
                        }
                        $('#tabela-quadras').find('tbody').append(
                                "<tr><td>" + v.numero + "</td>" +
                                "<td>" + v.tamanho + "</td>" +
                                "<td>" + v.piso.nome + "</td>" +
                                "<td>" + esportes + "</td>" +
                                "<td><span style='cursor:pointer' class='mif-pencil btn-editar-quadra'></span><span class='id-quadra' style='display:none; cursor:pointer;'>" + v.id + "</span></td>" +
                                "<td style='text-align: center;'><span style='cursor:pointer;' class='mif-calendar'></span></td></tr>"
                                );

                    });
                }
            });

            //atualizar dados quadra
            $('#btn-quadras-atualizar').on('click', function () {
                $.ajax({
                    async: false,
                    type: "post",
                    data: $('#form-quadras-atualizar').serialize(),
                    url: "/partidamarcada/quadra/atualizar",
                    dataType: "json",
                    success: function (resposta) {
                        if (resposta.status) {
                            $(".resposta-titulo").html("Sucesso");
                            $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');
                            $(".resposta-mensagem").html(resposta.mensagem);

                            $("#resposta").data('dialog').open();

                            setTimeout(function () {
                                window.location.href = "/partidamarcada/parqueesportivo/quadras"
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
                return false;
            });

            //voltar ao gerenciar do atualizar
            $('#btn-quadras-atualizar-voltar').on('click', function () {
                $('#div-atualizar-quadras').slideUp();
                $('#gerenciar-quadras').slideDown();
            });

            //voltar ao gerenciar do cadastrar
            $('#btn-quadras-cadastrar-voltar').on('click', function () {
                $('#div-cadastrar-quadras').slideUp();
                $('#gerenciar-quadras').slideDown();
            });

            //mostrar menu cadastrar
            $('#btn-quadras-cadastrar-mostrar').on('click', function () {
                $('#gerenciar-quadras').slideUp();
                $('#div-cadastrar-quadras').slideDown();
            });

            //editar quadra
            $('#tabela-quadras').on('click', '.btn-editar-quadra', function () {
                $('#gerenciar-quadras').slideUp();
                $('#div-atualizar-quadras').slideDown();
                $.ajax({
                    async: false,
                    dataType: "json",
                    type: 'post',
                    url: "/partidamarcada/quadra/buscarquadra/" + $(this).parent().find('.id-quadra').text(),
                    success: function (resposta) {
                        $('#editar-id').val(resposta.id);
                        $('#atnumero').val(resposta.numero);
                        $('#attamanho').val(resposta.tamanho);
                        $('#select-atpiso').val(resposta.piso.id);

                        $.each(resposta.esportes, function (key, value) {
                            var item = $("<div/>").html(value.nome).text();
                            $('#' + item).attr("checked", true);
                        });
                    }
                });
            });

            //buscar pisos
            $('.pisos').remove();
            $.ajax({
                async: false,
                type: "post",
                url: "/partidamarcada/piso/listar",
                dataType: "json",
                success: function (resposta) {
                    $.each(resposta, function (k, v) {
                        $("#select-piso").append("<option class='pisos' value=" + v.id + ">" + v.nome + "</option>");
                        $("#select-atpiso").append("<option class='pisos' value=" + v.id + ">" + v.nome + "</option>");
                    });
                }
            });

            //cadastrar quadra
            $('#btn-quadras-cadastrar').on('click', function () {
                console.log($('#form-quadras-cadastrar').serialize());
                $.ajax({
                    async: false,
                    type: "post",
                    data: $('#form-quadras-cadastrar').serialize(),
                    url: "/partidamarcada/quadra/salvar",
                    dataType: "json",
                    success: function (resposta) {
                        if (resposta.status) {
                            $(".resposta-titulo").html("Sucesso");
                            $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');
                            $(".resposta-mensagem").html(resposta.mensagem);

                            $("#resposta").data('dialog').open();

                            setTimeout(function () {
                                window.location.href = "/partidamarcada/parqueesportivo/quadras"
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
                return false;
            });
        });
    </script>
    <body>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <h3 class="resposta-titulo">aa</h3>

            <p class="resposta-mensagem">aa</p>
        </div>
        <?php include 'app/views/header/headerQuadra.php'; ?>
        <div class="conteudo">
            <h4 class="align-center">Relação de quadras</h4>
            <div id="gerenciar-quadras">
                <table id='tabela-quadras' class="table striped hovered">
                    <thead>
                    <th style="width: 10%">#</th>
                    <th style="width: 10%">Tamanho</th>
                    <th style="width: 10%">Piso</th>
                    <th>Esportes</th>
                    <th style="width: 10%">Editar</th>
                    <th style="width: 10%">Horários</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <input type="button" id="btn-quadras-cadastrar-mostrar"  class="full-size bg-lightBlue" value="Cadastrar quadra">
            </div>

            <div id="div-atualizar-quadras" style="display:none;">
                <div class="form-cadastro grid">
                    <center><h4>Atualizar quadra</h4></center>
                    <hr />
                    <form id="form-quadras-atualizar">
                        <input type="hidden" id="editar-id" name="id">

                        <div class="row cells3">
                            <div class="cell">
                                <label>Número da quadra</label>
                                <div class="input-control cell text full-size">                      
                                    <input type="text" name="numero" id="atnumero">
                                </div>
                            </div>
                            <div class="cell">
                                <label>Piso</label>
                                <div class="input-control select full-size">
                                    <select name="piso" id="select-atpiso">
                                        <option>Selecione</option>
                                    </select>
                                </div>
                            </div>
                            <div class="cell">
                                <label>Número de jogadores</label>
                                <div class="input-control cell text full-size">                      
                                    <input type="text" name="tamanho" id="attamanho">
                                </div>
                            </div>
                        </div>
                        <h5>Esportes</h5>
                        <div id='check-atesportes' class="row cells5">

                        </div>
                        <div class="row cells2">
                            <div class="cell">
                                <input type="button" id="btn-quadras-atualizar"  class="full-size bg-lightBlue" value="Atualizar">
                            </div>
                            <div class="cell">
                                <input type="button" id="btn-quadras-atualizar-voltar"  class="full-size bg-lightBlue" value="Voltar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div id="div-cadastrar-quadras" style="display:none;">
                <div class="form-cadastro grid">
                    <center><h4>Cadastrar quadra</h4></center>
                    <hr />
                    <form id="form-quadras-cadastrar">

                        <div class="row cells3">
                            <div class="cell">
                                <label>Número da quadra</label>
                                <div class="input-control cell text full-size">                      
                                    <input type="text" name="numero" id="numero">
                                </div>
                            </div>
                            <div class="cell">
                                <label>Piso</label>
                                <div class="input-control select full-size">
                                    <select name="piso" id="select-piso">
                                        <option>Selecione</option>
                                    </select>
                                </div>
                            </div>
                            <div class="cell">
                                <label>Número de jogadores</label>
                                <div class="input-control cell text full-size">                      
                                    <input type="text" name="tamanho" id="tamanho">
                                </div>
                            </div>
                        </div>
                        <h5>Esportes</h5>
                        <div id='check-esportes' class="row cells5">

                        </div>
                        <div class="row cells2">
                            <div class="cell">
                                <input type="button" id="btn-quadras-cadastrar"  class="full-size bg-lightBlue" value="Cadastrar">
                            </div>
                            <div class="cell">
                                <input type="button" id="btn-quadras-cadastrar-voltar"  class="full-size bg-lightBlue" value="Voltar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>