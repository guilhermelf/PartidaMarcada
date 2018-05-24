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
                url: "/partidamarcada/quadra/listarPorParqueEsportivo",
                success: function (resposta) {
                    if(resposta) {
                        $.each(resposta, function (k, v) {
                            var esportes = "";
                            if (v.esportes != null) {
                                $.each(v.esportes, function (key, value) {
                                    if(esportes == "") {
                                        esportes += value.nome;
                                    } else {
                                        esportes += " - " + value.nome;
                                    }                            
                                });
                            }
                            $('#tabela-quadras').find('tbody').append(
                                    "<tr>" + 
                                        "<td>" + v.numero + "</td>" +
                                        "<td>" + v.tamanho + "</td>" +
                                        "<td>" + v.piso.nome + "</td>" +
                                        "<td>" + esportes + "</td>" +
                                        "<td>" + 
                                            "<span style='cursor:pointer' class='mif-pencil btn-editar-quadra'></span>" +
                                            "<span class='id-quadra' style='display:none; cursor:pointer;'>" + v.id + "</span>" +
                                        "</td>" +
                                        "<td class='calendario'>" + 
                                            "<a href='/partidamarcada/parqueesportivo/horarios/" + v.id + "'><span style='cursor:pointer;' class='mif-calendar btn-calendario'></span></a>" + 
                                        "</td>" + 
                                    "</tr>"
                                    );

                        });
                    } else {
                        $('#tabela-quadras').find('tbody').append(
                                    "<tr>" + 
                                        "<td colspan='6'>Nenhuma quadra foi cadastrada ainda.</td>" +                                     
                                    "</tr>"
                                    );
                    }
                    $.ajax({
                        async: false,
                        type: "post",
                        url: "/partidamarcada/parqueEsportivo/isOnline",
                        success: function (resposta) {
                            if(resposta == 0) {
                                $('.calendario').remove();
                            }
                        }
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
        <?php include 'app/views/header/headerQuadra.php'; ?>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <div class="dialog-title resposta-titulo"></div>
            <div class="dialog-content resposta-mensagem"></div>
        </div>       
        <div class="conteudo container">
            <h4 class="align-center">Relação de quadras</h4>
            <div id="gerenciar-quadras">
                <table id='tabela-quadras' class="table striped hovered">
                    <thead>
                        <th style="width: 10%">#</th>
                        <th style="width: 10%">Tamanho</th>
                        <th style="width: 10%">Piso</th>
                        <th>Esportes</th>
                        <th style="width: 10%">Editar</th>
                        <th style="width: 10%" class="calendario">Horários</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <input type="button" id="btn-quadras-cadastrar-mostrar" class="button cell-sm-12 bg-lightBlue" value="Cadastrar quadra">
            </div>

            <div id="div-atualizar-quadras" style="display:none;">
                <center><h4>Atualizar quadra</h4></center>
                <hr />
                <form id="form-quadras-atualizar">
                    <input type="hidden" id="editar-id" name="id">

                    <div class="row">
                        <div class="cell-sm-2">
                            <label>Número da quadra</label>
                        </div>                 
                        <div class="cell-sm-2">                      
                            <input type="text" name="numero" id="atnumero">
                        </div>
                        <div class="cell-sm-1">
                            <label>Piso</label>
                        </div>
                        <div class="cell-sm-2">      
                            <select name="piso" id="select-atpiso">
								<option value="0">Piso</option>
							</select>                
                        </div>
                        <div class="cell-sm-3">
                            <label>Número de jogadores</label>
                        </div>
                        <div class="cell-sm-1">                      
                            <input type="text" name="tamanho" id="attamanho">
                        </div>
                    </div>
                    <br />
                    <h3>Esportes</h3>
                    <br />
                    <div id='check-atesportes' class="row"></div>
                    <br />
                    <input type="button" id="btn-quadras-atualizar"  class="button cell-sm-12 bg-lightBlue" value="Atualizar">
                    <br />&nbsp;
                    <input type="button" id="btn-quadras-atualizar-voltar"  class="button cell-sm-12 full-size bg-orange" value="Voltar">
                </form>
            </div>

            <div id="div-cadastrar-quadras" style="display:none;">
                <div class="form-cadastro grid">
                    <center><h4>Cadastrar quadra</h4></center>
                    <hr />
                    <br />
                    <form id="form-quadras-cadastrar">
                        <div class="row">
                            <div class="cell-sm-2">
                                <label>Número da quadra</label>
                            </div>
                            <div class="cell-sm-2">               
                                <input type="text" name="numero" id="numero">
                            </div>
                            <div class="cell-sm-1">
                                <label>Piso</label>
                            </div>
                            <div class="cell-sm-2">
                                <select name="piso" id="select-piso">
                                    <option>Selecione</option>
                                </select>
                            </div>
                            <div class="cell-sm-3">
                                <label>Número de jogadores</label>
                            </div>
                            <div class="cell-sm-2">
                                <input type="text" name="tamanho" id="tamanho">
                            </div>
                        </div>
                        <br />
                        <h5>Esportes</h5>
                        <hr />
                        <div id='check-esportes' class="row">

                        </div>
                        <br />&nbsp;
                        <input type="button" id="btn-quadras-cadastrar"  class="button cell-sm-12 success" value="Cadastrar">
                        <br />&nbsp;
                        <input type="button" id="btn-quadras-cadastrar-voltar"  class="button cell-sm-12 warning" value="Voltar">

                    </form>
                </div>
            </div>
        </div>
    </body>
</html>