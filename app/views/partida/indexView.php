<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/partidamarcada/components/metro-ui-css/css/metro-all.css" />
        <link href="/partidamarcada/components/css/style.css" rel="stylesheet">
        <script src="/partidamarcada/components/jquery/jquery.min.js"></script>
        <script src="/partidamarcada/components/js/scripts.js"></script>
        <script src="/partidamarcada/components/metro-ui-css/js/metro.js"></script>
        <title>PartidaMarcada.com</title>
    </head>
    <script>
        $(document).ready(function () {

            $('#btn-partida-nova').on('click', function (){
                $('#div-partidas').hide();
                $('#div-cadastrar-partida').show();
                return false;
            });

            $('#btn-partida-nova-cancelar').on('click', function (){
                $('#div-partidas').show();
                $('#div-cadastrar-partida').hide();
                return false;
            });

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

            $('.parquesEsportivosAtualizar').remove();
            $.ajax({
                async: false,
                type: "post",
                url: "/partidamarcada/parqueesportivo/listar",
                dataType: "json",
                success: function (resposta) {
                    $.each(resposta, function (k, v) {
                        $("#select-parqueEsportivo-atualizar").append("<option class='parquesEsportivosAtualizar' value=" + v.id + ">" + v.nome + "</option>");
                    });
                }
            });

            //buscar partidas cadastradas pelo usuário
            $('.minhasPartidas').remove();
            $.ajax({
                async: false,
                type: "post",
                url: "/partidamarcada/partida/getByUsuario",
                dataType: "json",
                success: function (resposta) {
                    $.each(resposta, function (k, v) {
                        console.log(resposta);
                        $("#minhas-partidas").find(".content").find(".p-2").append("<a class='partida-editar minhas-partidas' href='#'><span style='display:none;' class=id-editar>" + v.id + "</span>" + v.data + ", das " + v.inicio + "h às " + v.final + "h na quadra " + v.quadra.numero + " da(o) " + v.quadra.parqueEsportivo.nome + "</a><br />");
                    });
                }
            });

            //buscar partidas cadastradas pelo id
            $(".partida-editar").on('click', function(){
                var partida = $(this).find('.id-editar').text();
                $.ajax({
                    async: false,
                    type: "post",
                    //data: {idPartida: partida},
                    url: "/partidamarcada/partida/getById/" + $(this).parent().find('.id-editar').text(),
                    dataType: 'json',
                    success: function (resposta) {
                        $('#data-atualizar').val(resposta.data);
                        $('#select-parqueEsportivo-atualizar').val(resposta.quadra.parqueEsportivo.id);

                        //atualizarQuadras(resposta.quadra.parqueEsportivo.id);
                        $('#cadastrar-quadra-atualizar').val(resposta.quadra.id);
                        //$('#select-quadra-atualizar').val(resposta.quadra.id);

                        $('#div-partidas').hide();
                        $('#div-atualizar-partida').show();
                        return false;
                    }
                });
            });
           


            //buscar esportes
            /*$('.esportes').remove();
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
            */

            //buscar quadras
            $('#select-parqueEsportivo').on('change', function () {               
                var parqueEsportivo = $(this).val();

                $('.quadras').remove();
                if(parqueEsportivo != 0) {
                    $('#div-quadra').show();
                    $.ajax({
                        async: false,
                        type: "post",
                        data: {parqueEsportivo: parqueEsportivo},
                        url: "/partidamarcada/quadra/listarPorParqueEsportivo",
                        dataType: 'json',
                        success: function (resposta) {
                            $('.esportes').remove();
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
                                        "<tr class='quadras'><td>" + v.numero + "</td>" +
                                        "<td>" + v.tamanho + "</td>" +
                                        "<td>" + v.piso.nome + "</td>" +
                                        "<td>" + esportes + "</td>" +
                                        "<td style='text-align:center;'><span title='Selecionar' style='cursor:pointer;' class='btn-selecionar-quadra'>Selecionar</span><span class='id-quadra' style='display:none; cursor:pointer;'>" + v.id + "</span></td>" +
                                        "</tr>"
                                );

                            });
                        }
                    });
                } else {
                    $('#div-quadra').hide();
                }
            });

            //buscar quadras atualizar
            $('#select-parqueEsportivo-atualizar').on('change', function () {         
                var parqueEsportivoAtualizar = $(this).val();
                $('.quadras-atualizar').remove();
                if(parqueEsportivoAtualizar != 0) {
                    $('#div-quadra-atualizar').show();
                    $.ajax({
                        async: false,
                        type: "post",
                        data: {parqueEsportivo: parqueEsportivoAtualizar},
                        url: "/partidamarcada/quadra/listarPorParqueEsportivo",
                        dataType: 'json',
                        success: function (resposta) {
                            $('.esportes-atualizar').remove();
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

                                $('#tabela-quadras-atualizar').find('tbody').append(
                                        "<tr class='quadras-atualizar'><td>" + v.numero + "</td>" +
                                        "<td>" + v.tamanho + "</td>" +
                                        "<td>" + v.piso.nome + "</td>" +
                                        "<td>" + esportes + "</td>" +
                                        "<td style='text-align:center;'><span title='Selecionar' style='cursor:pointer;' class='btn-selecionar-quadra-atualizar'>Selecionar</span><span class='id-quadra-atualizar' style='display:none; cursor:pointer;'>" + v.id + "</span></td>" +
                                        "</tr>"
                                );

                            });
                        }
                    });
                } else {
                    $('#div-quadra-atualizar').hide();
                }
            });

            //selecionar quadra ao cadastrar
            $('#tabela-quadras').on('click', '.btn-selecionar-quadra', function () {
                $('#div-quadra').hide();
                $('#div-quadra-selecionada').show();
                $('#div-esporte').show();
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
                                $("#select-esporte").append("<option class='esportes' value='" + value.id + "'>" + value.nome + "</option>");                               
                            });
                        }
                        $('#tabela-quadras-selecionada').find('tbody').append(
                                "<tr><td>" + resposta.numero + "</td>" +
                                "<td>" + resposta.tamanho + "</td>" +
                                "<td>" + resposta.piso.nome + "</td>" +
                                "</tr>"
                        );
                        $('#tabela-quadra').show();

                    }
                });
            });

            //selecionar quadra ao atualizar
            $('#tabela-quadras-atualizar').on('click', '.btn-selecionar-quadra-atualizar', function () {
                $('#div-quadra-atualizar').hide();
                $('#div-quadra-selecionada-atualizar').show();
                $('#div-esporte-atualizar').show();
                $('#cadastrar-quadra-atualizar').val($(this).parent().find('.id-quadra-atualizar').text());

                $.ajax({
                    async: false,
                    type: "post",
                    url: "/partidamarcada/quadra/buscarQuadra/" + $(this).parent().find('.id-quadra-atualizar').text(),
                    dataType: 'json',
                    success: function (resposta) {
                        console.log(resposta);
                        var esportes = "";
                        
                        if (resposta.esportes != null) {
                            $.each(resposta.esportes, function (key, value) {                               
                                $("#select-esporte-atualizar").append("<option class='esportes-atualizar' value='" + value.id + "'>" + value.nome + "</option>");                               
                            });
                        }
                        $('#tabela-quadras-selecionada-atualizar').find('tbody').append(
                                "<tr><td>" + resposta.numero + "</td>" +
                                "<td>" + resposta.tamanho + "</td>" +
                                "<td>" + resposta.piso.nome + "</td>" +
                                "</tr>"
                        );
                        $('#tabela-quadra-atualizar').show();

                    }
                });
            });
            
            /*botão cadastrar partida
            $("#btn-partida-cadastrar").on('click', function () { 
               
                var teste = $("#form-partida-cadastrar").serialize();
                console.log(teste);
                return false;
            });
            */

        });
    </script>
    <body>
        <?php include 'app/views/header/headerUsuario.php'; ?>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <div class="dialog-title resposta-titulo"></div>
            <div class="dialog-content resposta-mensagem">
        </div>
        </div>       
        <div class="conteudo container">
            <div id="div-partidas" style="display: block;">
                <div data-role="accordion" data-one-frame="true" data-show-active="true" data-active-heading-class="bg-cyan fg-white">
                    <div class="frame active" id="minhas-partidas">
                        <div class="heading">Minhas partidas</div>
                        <div class="content">
                            <div class="p-2"></div>
                        </div>
                    </div>
                    <div class="frame active">
                        <div class="heading">Partidas passadas</div>
                        <div class="content">
                            <div class="p-2">Bitter turkey can be made tasty by brushing with...</div>
                        </div>
                    </div>
                </div>
                <br />
                <br />
                <button class="cell-12 button info" id="btn-partida-nova">Nova partida</button>              
            </div>
            <div id="div-cadastrar-partida" style="display: none;">
                <h4 class="align-center">Cadastrar partida</h4>
                <br />
                <form id="form-partida-cadastrar">
                    <div class="row">
                        <div class="cell-2">            
                            <input type="text" name="data" placeholder="Data">
                        </div>
                        <div class="cell-2">
                            <select name="inicio" id="select-inicio">
                                <option value="-1">Início</option>
                                <option value="0">00</option>
                                <option value="1">01</option>
                                <option value="2">02</option>
                                <option value="3">03</option>
                                <option value="4">04</option>
                                <option value="5">05</option>
                                <option value="6">06</option>
                                <option value="7">07</option>
                                <option value="8">08</option>
                                <option value="9">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                            </select>
						</div>
                        <div class="cell-2"> 
							<select name="final" id="select-final">
                                <option value="-1">Final</option>
                                <option value="0">00</option>
                                <option value="1">01</option>
                                <option value="2">02</option>
                                <option value="3">03</option>
                                <option value="4">04</option>
                                <option value="5">05</option>
                                <option value="6">06</option>
                                <option value="7">07</option>
                                <option value="8">08</option>
                                <option value="9">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                            </select>
						</div>
                        <div class="cell-3"> 
                            <input type="text" name="jogadores" placeholder="Quantos atletas?">
                        </div>
                        <div class="cell-3">
                            <select name="publico" id="select-publico">
                                <option value="0">Jogo privado</option>
                                <option value="1">Jogo aberto ao público</option>
                            </select>
                        </div>
					</div>
                    <br />
                    <textarea class="cell-12" data-role="textarea" data-auto-size="false" name="descricao" placeholder="Descrição (opcional)"></textarea>
                    <br />
                    <div class="row">
                        <div class="cell">             
                            <select name="parqueEsportivo" id="select-parqueEsportivo">
                                <option value="0">Parque Esportivo</option>
                            </select>
                        </div>
					</div>
                    <div class="row">
                        <div id="div-quadra" class="cell" style="display:none;">
                            <table id='tabela-quadras' class="table striped hovered">
                                <thead>
                                <th>Número da quadra</th>
                                <th>Tamanho</th>
                                <th>Piso</th>
                                <th>Esportes</th>
                                <th style="width: 10%"></th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">    
                        <div class="cell" id="div-quadra-selecionada" style="display:none;">
                            <br />
                            <table id='tabela-quadras-selecionada' class="table striped hovered">
                                <thead>
                                <th style="width: 10%">Número da quadra</th>
                                <th style="width: 10%">Tamanho</th>
                                <th style="width: 10%">Piso</th>                               
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
					<div class="row">
                        <div class="cell" id="div-esporte" style="display:none;">
                            <select name="esporte" id="select-esporte">
                                <option value="0">Esporte</option>
                            </select>
                        </div>
					</div>
                        
                        <input type="hidden" id="cadastrar-quadra" name="quadra" />  
                        <br />           
                        <button class="cell-12 button info" id="btn-partida-cadastrar">Cadastrar</button>
                        <br />
                        &nbsp;
                        <button class="cell-12 button warning" id="btn-partida-nova-cancelar">Cancelar</button>
                        <br />
                    </form>
                </div>
				<div id="div-atualizar-partida" style="display: none;">
                <h4 class="align-center">Atualizar dados da partida</h4>
                <br />
                <form id="form-partida-atualizar">
                    <div class="row">
                        <div class="cell-2">            
                            <input type="text" id="data-atualizar" name="data" placeholder="Data">
                        </div>
                        <div class="cell-2">
                            <select name="inicio" id="select-inicio-atualizar">
                                <option value="-1">Início</option>
                                <option value="0">00</option>
                                <option value="1">01</option>
                                <option value="2">02</option>
                                <option value="3">03</option>
                                <option value="4">04</option>
                                <option value="5">05</option>
                                <option value="6">06</option>
                                <option value="7">07</option>
                                <option value="8">08</option>
                                <option value="9">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                            </select>
						</div>
                        <div class="cell-2"> 
							<select name="final" id="select-final-atualizar">
                                <option value="-1">Final</option>
                                <option value="0">00</option>
                                <option value="1">01</option>
                                <option value="2">02</option>
                                <option value="3">03</option>
                                <option value="4">04</option>
                                <option value="5">05</option>
                                <option value="6">06</option>
                                <option value="7">07</option>
                                <option value="8">08</option>
                                <option value="9">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                            </select>
						</div>
                        <div class="cell-3"> 
                            <input type="text" name="jogadores" id="jogadores-atualizar" placeholder="Quantos atletas?">
                        </div>
                        <div class="cell-3">
                            <select name="publico" id="select-publico-atualizar">
                                <option value="0">Jogo privado</option>
                                <option value="1">Jogo aberto ao público</option>
                            </select>
                        </div>
					</div>
                    <br />
                    <textarea class="cell-12" data-role="textarea" data-auto-size="false" id="descricao-atualizar" name="descricao" placeholder="Descrição (opcional)"></textarea>
                    <br />
                    <div class="row">
                        <div class="cell">             
                            <select name="parqueEsportivo" id="select-parqueEsportivo-atualizar">
                                <option value="0">Parque Esportivo</option>
                            </select>
                        </div>
					</div>
                    <div class="row">
                        <div id="div-quadra-atualizar" class="cell" style="display:none;">
                            <table id='tabela-quadras-atualizar' class="table striped hovered">
                                <thead>
                                <th>Número da quadra</th>
                                <th>Tamanho</th>
                                <th>Piso</th>
                                <th>Esportes</th>
                                <th style="width: 10%"></th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">    
                        <div class="cell" id="div-quadra-selecionada-atualizar" style="display:none;">
                            <br />
                            <table id='tabela-quadras-selecionada-atualizar' class="table striped hovered">
                                <thead>
                                <th style="width: 10%">Número da quadra</th>
                                <th style="width: 10%">Tamanho</th>
                                <th style="width: 10%">Piso</th>                               
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
					<div class="row">
                        <div class="cell" id="div-esporte-atualizar" style="display:none;">
                            <select name="esporte" id="select-esporte-atualizar">
                                <option value="0">Esporte</option>
                            </select>
                        </div>
					</div>
                        
                        <input type="hidden" id="cadastrar-quadra-atualizar" name="quadra" />  
                        <br />           
                        <button class="cell-12 button info" id="btn-partida-atualizar">Cadastrar</button>
                        <br />
                        &nbsp;
						<button class="cell-12 button success" id="btn-partida-convidar">Convidar jogadores</button>
                        <br />
                        &nbsp;
                        <button class="cell-12 button warning" id="btn-partida-atualizar-cancelar">Cancelar</button>
                        <br />
                    </form>
                </div>
		</div>
</body>
</html>