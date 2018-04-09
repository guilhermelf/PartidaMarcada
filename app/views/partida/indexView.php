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
    <script>
        $(document).ready(function () {
            //buscar parques esportivos
            $('.parquesEsportivos').remove();
            $.ajax({
                async: false,
                type: "post",
                url: "/partidamarcada/parqueesportivo/listar",
                dataType: "json",
                success: function (resposta) {
                    $.each(resposta, function (k, v) {
                        $("#select-parqueEsportivo").append("<option class='parquesEsportivos' value=" + v.id + ">" + v.nome + "</option>");
                    });
                }
            });

            //buscar esportes
            $('.esportes').remove();
            $.ajax({
                async: false,
                type: "post",
                url: "/partidamarcada/esporte/listar",
                dataType: "json",
                success: function (resposta) {
                    $.each(resposta, function (k, v) {
                        $("#select-esporte").append("<option class='esportes' value=" + v.id + ">" + v.nome + "</option>");
                    });
                }
            });

            //buscar quadras
            $('#select-parqueEsportivo').on('change', function () {
                $('#div-quadra').show();
                var parqueEsportivo = $(this).val();
                $('.quadras').remove();

                $.ajax({
                    async: false,
                    type: "post",
                    data: {parqueEsportivo: parqueEsportivo},
                    url: "/partidamarcada/quadra/listarPorParqueEsportivo",
                    dataType: 'json',
                    success: function (resposta) {
                        $.each(resposta, function (k, v) {
                            var esportes = "";
                            if (v.esportes != null) {
                                $.each(v.esportes, function (key, value) {
                                    esportes += value.nome + "  ";
                                });
                            }
                            $('#tabela-quadras').find('tbody').append(
                                    "<tr class='quadras'><td>" + v.numero + "</td>" +
                                    "<td>" + v.tamanho + "</td>" +
                                    "<td>" + v.piso.nome + "</td>" +
                                    "<td>" + esportes + "</td>" +
                                    "<td style='text-align:center;'><span title='Selecionar' style='cursor:pointer;'  class='mif-thumbs-up fg-green btn-selecionar-quadra'></span><span class='id-quadra' style='display:none; cursor:pointer;'>" + v.id + "</span></td>" +
                                    "</tr>"
                                    );

                        });
                    }
                });
            });

            //selecionar quadra ao cadastrar
            $('#tabela-quadras').on('click', '.btn-selecionar-quadra', function () {
                $('#div-quadra').hide();
                $('#div-quadra-selecionada').show();
                $('#cadastrar-quadra').val($(this).parent().find('.id-quadra').text());

                $.ajax({
                    async: false,
                    type: "post",
                    url: "/partidamarcada/quadra/buscarQuadra/" + $(this).parent().find('.id-quadra').text(),
                    dataType: 'json',
                    success: function (resposta) {

                        var esportes = "";
                        if (resposta.esportes != null) {
                            $.each(resposta.esportes, function (key, value) {
                                esportes += value.nome + "  ";
                            });
                        }
                        $('#tabela-quadras-selecionada').find('tbody').append(
                                "<tr><td>" + resposta.numero + "</td>" +
                                "<td>" + resposta.tamanho + "</td>" +
                                "<td>" + resposta.piso.nome + "</td>" +
                                "<td>" + esportes + "</td>" +
                                "</tr>"
                                );

                    }
                });
            });
        });
    </script>
    <body>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <h3 class="resposta-titulo"></h3>

            <p class="resposta-mensagem"></p>
        </div>       

        <?php include 'app/views/header/headerUsuario.php'; ?>
        <div class="conteudo">
            <div id="div-partidas" style="display: none;">
                <h4 class="align-center">Listar partidas</h4>
            </div>
            <div id="div-cadastrar-partida grid" style="display: block;">
                <h4 class="align-center">Cadastrar partida</h4>
                <br />
                <div class="row cells2">
                    <div class="cell">
                        <label>Parque Esportivo</label>
                        <hr />
                        <div class="input-control select full-size">
                            <select name="parqueEsportivo" id="select-parqueEsportivo">
                                <option>Selecione</option>
                            </select>
                        </div>
                    </div>
                    <div class="cell" id="div-quadra" style="display:none;">
                        <br />
                        <label>Quadra</label>
                        <hr />
                        <table id='tabela-quadras' class="table striped hovered">
                            <thead>
                            <th style="width: 10%">#</th>
                            <th style="width: 10%">Tamanho</th>
                            <th style="width: 10%">Piso</th>
                            <th>Esportes</th>
                            <th style="width: 10%">Selecionar</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    
                    <div class="cell" id="div-quadra-selecionada" style="display:none;">
                        <br />
                        <label>Quadra</label>
                        <hr />
                        <table id='tabela-quadras-selecionada' class="table striped hovered">
                            <thead>
                            <th style="width: 10%">#</th>
                            <th style="width: 10%">Tamanho</th>
                            <th style="width: 10%">Piso</th>
                            <th>Esportes</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="cell">
                        <label>Esporte</label>
                        <hr />
                        <div class="input-control select full-size">
                            <select name="esporte" id="select-esporte">
                                <option>Selecione</option>
                            </select>
                        </div>
                    </div>
                    
                    <input type="hidden" id="cadastrar-quadra" name="quadra" />
                    <input type="button" id="btn-partida-cadastrar"  class="full-size bg-lightBlue" value="Cadastrar partida">
                </div>
                <div id="div-atualizar-partida" style="display: none;">
                    
                    <h4 class="align-center">Atualizar partida</h4>
                </div>
            </div>
        </div>
    </div>
</body>
</html>