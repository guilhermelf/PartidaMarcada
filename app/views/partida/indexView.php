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

            $('#btn-buscar-partida').on('click', function() { 
                $.ajax({
                    data: $('#buscar-partida-publica').serialize(),
                    async: false,
                    type: "post",
                    url: "/partidamarcada/partida/pesquisar",
                    dataType: "json",
                    success: function (resposta) {
                        if(!resposta) {
                            $('#div-resultado-partidas').find("p").text("Nenhuma partida encontrada!");
                            
                            $('#div-resultado-partidas').show();
                        } else {
                            $('#div-resultado-partidas').find("p").text("");
                            $.each(resposta, function (k, v) {
                                $('#div-resultado-partidas').find("p").append("<a target='_blank' href='/partidamarcada/partida/partida/" + v.id + "'>" +
                                    "Partida de " + v.esporte.nome + " na(o) " + v.quadra.parqueEsportivo.nome + ", dia " +
                                    v.data + ", das " + v.inicio + "h às " + (v.inicio + 1) + "h." +
                                    "</a><br />");

                                $('#div-resultado-partidas').show();
                            });
                        }
                    }
                });
                return false;
            });

            $.ajax({
                async: false,
                type: "post",
                url: "/partidamarcada/usuario/buscarUsuario/",
                dataType: 'json',
                success: function (resposta) {
                    $('#buscar-partida-cidade').val(resposta.cidade.nome);                  
                }
            });


            $('#btn-partida-convidar').on('click', function() {
                window.location.href = "/partidamarcada/partida/partida/" + $('#id-partida-atualizar').val(); 

                return false;
            });

            $('#txt-data').on('focusout', function() {

                if($('#servicos').val() == "true") {
                    var data = ($('#txt-data').val() != null ? $('#txt-data').val() : null);
                    var quadra = ($('#cadastrar-quadra').val() != null ? $('#cadastrar-quadra').val() : null);
                } else {
                    var data = null;
                    var quadra = null;
                }

                $('#select-inicio').html('');
                $.ajax({
                    data: {data : data, quadra : quadra},
                    async: false,
                    type: "post",
                    url: "/partidamarcada/agendamento/buscarHorarios",
                    dataType: "json",
                    success: function (resposta) {
                        if(resposta) {
                            $.each(resposta, function(k, v) {
                                $('#select-inicio').append('<option value="' + k + '">' + k + '</option');
                            })
                        }
                    }
                });
            });

            $('#btn-selecionar-parqueesportivo-cadastrar').on('click', function() {
                $('#div-selecionar-parqueesportivo').show();
                $('#div-resultado-buscar').find("p").text("");
                $('#div-resultado-buscar').hide();

                $('.conteudo').css('opacity', '0.2');

                return false;
            });

            $('#btn-selecionar-parqueesportivo-buscar').on('click', function() { 

                $.ajax({
                    data: $('#buscar-parqueesportivo').serialize(),
                    async: false,
                    type: "post",
                    url: "/partidamarcada/parqueEsportivo/pesquisar",
                    dataType: "json",
                    success: function (resposta) {
                        if(!resposta) {
                            $('#div-resultado-buscar').find("p").text("Nenhuma quadra encontrada!");
                            
                            $('#div-resultado-buscar').show();
                        } else {
                            $('#div-resultado-buscar').find("p").text("");
                            $.each(resposta, function (k, v) {
                                $('#div-resultado-buscar').find("p").append("<a class='selecionar-parque'><span class='parque-servicos' style='display:none;'>" + v.servicos + "</span><span class='parque-id' style='display: none;'>" + v.id + "</span><span class='parque-nome'>" + v.nome + "</span></a><br />");

                                $('#div-resultado-buscar').show();
                            });
                        }
                    }
                });
                return false;
            });

            $('#div-resultado-buscar').on('click', '.selecionar-parque', function() {
                $('#div-quadra-selecionada').hide();
                $('#div-esporte').hide();

                $('#servicos').val($(this).find('.parque-servicos').text());
                $('.id-parqueEsportivo').val($(this).find('.parque-id').text());
                
                $('.parque-nome').val($(this).find('.parque-nome').text())                 
                
                $('#div-selecionar-parqueesportivo').hide();

                buscarQuadras($('.id-parqueEsportivo').val());        
               
                $('.conteudo').css('opacity', '1');

                if($('#servicos').val() == 'true') {
                    $(".resposta-titulo").html("Atenção");
                    $("#resposta").attr('style', 'background-color: #ff9447; color: #fff;');                          
                    
                    $(".resposta-mensagem").html("O agendamento nessa quadra será feito de forma online, não necessitando contato por fora do sistema!"); 
                    $("#resposta").data('dialog').open();
                }
            });

            $('#btn-selecionar-parqueesportivo-cancelar').on('click', function() {
                $('#div-selecionar-parqueesportivo').hide();
                $('.conteudo').css('opacity', '1');

                return false;
            });


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
            
            $('#btn-partida-atualizar-cancelar').on('click', function (){
                $('#div-partidas').show();
                $('#div-atualizar-partida').hide();
                $('.esportes-atualizar').remove();
                return false;
            });

            //buscar parques esportivos
            $('.parquesEsportivos').remove();
            $.ajax({
                async: false,
                type: "post",
                url: "/partidamarcada/parqueEsportivo/listar",
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

            //buscar partidas novas cadastradas pelo usuário
            $('.minhasPartidas').remove();
            $.ajax({
                async: false,
                type: "post",
                url: "/partidamarcada/partida/listarMinhasNovasPartidas",
                dataType: "json",
                success: function (resposta) {

                    $.each(resposta, function (k, v) {
                        
                        if(v.usuario.id == $('#usuario').val() && v.status == 1) {
                            $("#minhas-partidas").find(".content").find(".p-2").append(
                                "<a class='minhas-partidas' href='/partidamarcada/partida/partida/" + v.id + "'>" + 
                                    v.data + ", das " + v.inicio + "h às " + (v.inicio + 1) + "h, partida de " + v.esporte.nome + ", na quadra " + v.quadra.numero + " da(o) " + v.quadra.parqueEsportivo.nome + 
                                "</a>" + 
                                    "<span class='opcoes-partida'>" + 
                                        "<span class='partida-editar mif-pencil fg-orange' title='Editar informações da partida'>" + 
                                            "<span style='display:none;' class='id-editar'>" + v.id + "</span>" + 
                                        "</span>" +
                                        "&nbsp;&nbsp;&nbsp;" +
                                        "<span class='partida-cancelar mif-cross fg-red' title='Cancelar partida'>" + 
                                            "<span style='display:none;' class='id-cancelar'>" + v.id + "</span>" + 
                                        "</span>" +
                                    "</span><br />"                           
                            );
                        } else if(v.status == 1) {
                            $("#minhas-partidas").find(".content").find(".p-2").append(
                                "<a class='minhas-partidas' href='/partidamarcada/partida/partida/" + v.id + "'>" + 
                                    v.data + ", das " + v.inicio + "h às " + (v.inicio + 1) + "h, partida de " + v.esporte.nome + ", na quadra " + v.quadra.numero + " da(o) " + v.quadra.parqueEsportivo.nome + 
                                "</a><br />"                           
                            );
                        } else {
                            $("#minhas-partidas").find(".content").find(".p-2").append(
                                "<a class='minhas-partidas' href='/partidamarcada/partida/partida/" + v.id + "'>" + 
                                    v.data + ", das " + v.inicio + "h às " + (v.inicio + 1) + "h, partida de " + v.esporte.nome + ", na quadra " + v.quadra.numero + " da(o) " + v.quadra.parqueEsportivo.nome + 
                                "<span class='opcoes-partida'>Cancelada</span></a><br />"                           
                            );
                        }          
                    });
                }
            });

            //buscar partidas antigas cadastradas pelo usuário
            $('.minhasPartidas').remove();
            $.ajax({
                async: false,
                type: "post",
                url: "/partidamarcada/partida/listarMinhasAntigasPartidas",
                dataType: "json",
                success: function (resposta) {
                    if(resposta) {
                        $.each(resposta, function (k, v) {
                            $("#minhas-partidas-passadas").find(".content").find(".p-2").append("<a class='partida-passada-ver minhas-partidas-passadas' href='/partidamarcada/partida/partida/" + v.id + "'><span style='display:none;' class=id-ver>" + v.id + "</span>" + v.data + ", das " + v.inicio + "h às " + (v.inicio + 1) + "h, partida de " + v.esporte.nome + ", na quadra " + v.quadra.numero + " da(o) " + v.quadra.parqueEsportivo.nome + "</a><br />");
                        });
                    }
                }
            });

            //buscar partida para cancelar pelo id
            $(".partida-cancelar").on('click', function(){
                var partida = $(this).find('.id-cancelar').text();
                Metro.dialog.create({
                    title: "Cancelar partida",
                    content: "<div>Você tem certeza que deseja cancelar a partida?<br />A partida não poderá ser reativada após o cancelamento!</div>",
                    actions: [
                        {
                            caption: "Tenho certeza",
                            cls: "js-dialog-close alert",
                            onclick: function(){
                                $.ajax({
                                    async: false,
                                    type: "post",
                                    //data: {idPartida: partida},
                                    url: "/partidamarcada/partida/cancelarPartida/" + partida,
                                    dataType: 'json',
                                    success: function (resposta) {
                                        if (resposta.status) {
                                            $(".resposta-titulo").html("Sucesso");
                                            $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');                                  
                                        } else {
                                            $(".resposta-titulo").html("Erro");
                                            $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');                   
                                        }      
                                        
                                        $(".resposta-mensagem").html(resposta.mensagem); 
                                        $("#resposta").data('dialog').open();
                                        
                                        setTimeout(function () {    
                                            window.location.href = "/partidamarcada/partida/gerenciar"
                                        }, 3000);
                                    }
                                });
                            }
                        },
                        {
                            caption: "Não quero cancelar",
                            cls: "js-dialog-close",
                            onclick: function(){
                                return false;
                            }
                        }
                    ]
                });
            });

            //buscar partidas cadastradas pelo id
            $(".partida-editar").on('click', function(){
                var partida = $(this).find('.id-editar').text();
                $.ajax({
                    async: false,
                    type: "post",
                    //data: {idPartida: partida},
                    url: "/partidamarcada/partida/getById/" + partida,
                    dataType: 'json',
                    success: function (resposta) {
                        $('#id-partida-atualizar').val(resposta.id);
                        $('#data-atualizar').val(resposta.data);
                        $('#select-inicio-atualizar').val(resposta.inicio);
                        $('#select-final-atualizar').val(resposta.final);
                        $('#jogadores-atualizar').val(resposta.numeroJogadores);
                        $('#select-publico-atualizar').val(resposta.publico);
                        $('#descricao-atualizar').val(resposta.descricao);

                        $('#parqueEsportivo').val(resposta.quadra.parqueEsportivo.nome);
                        
                        $('#cadastrar-quadra-atualizar').val(resposta.quadra.id);
                        
                        $('.dados-quadra-atualizar').remove();
                        $('#tabela-quadras-selecionada-atualizar').find('tbody').append(
                            "<tr class='dados-quadra-atualizar'><td>" + resposta.quadra.numero + "</td>" +
                            "<td>" + resposta.quadra.tamanho + "</td>" +
                            "<td>" + resposta.quadra.piso.nome + "</td>" +
                            "</tr>"
                        );

                        var esportes = "";
                        
                        if (resposta.quadra.esportes != null) {
                            $.each(resposta.quadra.esportes, function (key, value) {                               
                                $("#select-esporte-atualizar").append("<option class='esportes-atualizar' value='" + value.id + "'>" + value.nome + "</option>");                               
                            });
                        }

                        $('#div-esporte-atualizar').show();
                        $('#div-quadra-selecionada-atualizar').show();

                        $('#select-esporte-atualizar').val(resposta.esporte.id);

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
            function buscarQuadras(parque) {       
                var parqueEsportivo = parque;

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
            }

            //buscar quadras atualizar
            $('#select-parqueEsportivo-atualizar').on('change', function () {         
                var parqueEsportivoAtualizar = $(this).val();
                $('.quadras-atualizar').remove();

                $('#div-esporte-atualizar').hide();
                $('#div-quadra-selecionada-atualizar').hide();
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
           
                $('.quadras-selecionadas').remove();
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
                                "<tr class='quadras-selecionadas'><td>" + resposta.numero + "</td>" +
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

                $('.dados-quadra-atualizar').remove();
                $.ajax({
                    async: false,
                    type: "post",
                    url: "/partidamarcada/quadra/buscarQuadra/" + $(this).parent().find('.id-quadra-atualizar').text(),
                    dataType: 'json',
                    success: function (resposta) {

                        var esportes = "";
                        
                        $('.dados-quadra-atualizar').remove();
                        if (resposta.esportes != null) {
                            $.each(resposta.esportes, function (key, value) {                               
                                $("#select-esporte-atualizar").append("<option class='esportes-atualizar' value='" + value.id + "'>" + value.nome + "</option>");                               
                            });
                        }
                        $('#tabela-quadras-selecionada-atualizar').find('tbody').append(
                                "<tr class='dados-quadra-atualizar'>><td>" + resposta.numero + "</td>" +
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
        <div id="div-selecionar-parqueesportivo" class="modal" style="display: none;">
            <div class="modal-content">
                <form id="buscar-parqueesportivo">
                    <h2 class="text-light align-center">Buscar quadra</h2>
                    <hr>
                    <br />
                    <div class="row">
                        <div class="cell-sm-3">   
                            <input type="text" name="nome" placeholder="Nome">
                        </div>
                        <div class="cell-sm-3">   
                            <input type="text" name="endereco" placeholder="Endereço">
                        </div>
                        <div class="cell-sm-3">   
                            <input type="text" name="cidade" placeholder="Cidade">
                        </div>
                        <div class="cell-sm-2"> 
                            <button class="button success" id="btn-selecionar-parqueesportivo-buscar">Buscar</button>
                        </div>
                        <div class="cell-sm-1"> 
                            <button class="cell-sm-12 button success fg-white bg-red" id="btn-selecionar-parqueesportivo-cancelar">Cancelar</button>
                        </div>
                    </div>
                    <div id="div-resultado-buscar" style="display: none">
                        <hr>
                        <p></p>
                    </div>
                    <br />&nbsp;
                    
                </form>
            </div>
        </div>
        <?php include 'app/views/header/headerUsuario.php'; ?>
        <div data-role="dialog" data-close-button="false" data-overlay="true" id="resposta" class="padding20">
            <div class="dialog-title resposta-titulo"></div>
            <div class="dialog-content resposta-mensagem"></div>
        </div>  
        
        <input type="hidden" id="usuario" value="<?php echo $_SESSION['id']; ?>" />

        <div class="conteudo container">         
            <div id="div-partidas" style="display: block;">
                <div data-role="accordion" data-one-frame="true" data-show-active="true" data-active-heading-class="bg-cyan fg-white">
                    <div class="frame active" id="minhas-partidas" class="bg-cyan fg-white">
                        <div class="heading accor"><span class="mif-calendar icon"></span> Próximas partidas</div>
                        <div class="content">
                            <div class="p-2 resultados-quadra"></div>
                        </div>
                    </div>
                    <div class="frame" id="minhas-partidas-passadas">
                        <div class="heading bg-cyan fg-white accor"><span class="mif-calendar icon"></span> Partidas passadas</div>
                        <div class="content">
                            <div class="p-2"></div>
                        </div>
                    </div>
                    <div class="frame" id="buscar-partidas-publicas">
                        <div class="heading bg-cyan fg-white accor"><span class="mif-dribbble icon"></span> Buscar partidas públicas com vagas</div>
                        <div class="content">
                            <form id="buscar-partida-publica">
                                <br />
                                <div class="row">
                                    <div class="cell-sm-3">   
                                        <input type="text" name="quadra" placeholder="Quadra">
                                    </div>
                                    <div class="cell-sm-3">   
                                        <input type="text" name="esporte" placeholder="Esporte">
                                    </div>
                                    <div class="cell-sm-3">   
                                        <input type="text" name="cidade" id="buscar-partida-cidade" placeholder="Cidade">
                                    </div>
                                    <div class="cell-sm-3"> 
                                        <button class="button success" id="btn-buscar-partida">Buscar</button>
                                    </div>
                                </div>
                                <div id="div-resultado-partidas" style="display: none">
                                    <hr>
                                    <p></p>
                                </div>
                                <br />&nbsp;
                                
                            </form>
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
                <div class="row div-parqueesportivo">
                        <div class="cell-sm-8">            
                            <input type="text" class="parque-nome" readonly="readonly" placeholder="Local do jogo...">
                        </div>
                        <div class="cell-sm-4">
                            <button class="button success" id="btn-selecionar-parqueesportivo-cadastrar">Buscar quadra</button>
                        </div>
                    </div>
                    <br />                
                    <div class="row">
                        <div id="div-quadra" class="cell-sm-12" style="display:none;">
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
                        <div class="cell-sm-12" id="div-quadra-selecionada" style="display:none;">
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
                        <div class="cell-sm-12" id="div-esporte" style="display:none;">
                            <select name="esporte" id="select-esporte">
                                <option value="0">Esporte</option>
                            </select>
                        </div>
					</div>
                    <br />
                    <div class="row">
                        <div class="cell-sm-2">            
                            <input type="text" name="data" placeholder="Data" id="txt-data">
                        </div>
                        <div class="cell-sm-2">
                            <select name="inicio" id="select-inicio">
                                <option value="-1">Início</option>
                            </select>
						</div>
                        <div class="cell-sm-2"> 
							<select name="final" id="select-final">
                                <option value="-1">Final</option>
                            </select>
						</div>
                        <div class="cell-sm-3"> 
                            <input type="text" name="jogadores" placeholder="Quantos atletas?">
                        </div>
                        <div class="cell-sm-3">
                            <select name="publico" id="select-publico">
                                <option value="0">Jogo privado</option>
                                <option value="1">Jogo aberto ao público</option>
                            </select>
                        </div>
					</div>
                    <br />
                    <textarea name="descricao" placeholder="Descrição (opcional)"></textarea>
                    <!--<div class="row">
                        <div class="cell-sm-12">             
                            <select name="parqueEsportivo" id="select-parqueEsportivo">
                                <option value="0">Parque Esportivo</option>
                            </select>
                        </div>
                    </div>-->
                    
                        <input type="hidden" class="id-parqueEsportivo" name="id_parque" />
                        <input type="hidden" id="cadastrar-quadra" name="quadra" />  
                        <br />           
                        <button class="cell-12 button info" id="btn-partida-cadastrar">Cadastrar</button>
                        <br />
                        &nbsp;
                        <button class="cell-12 button warning" id="btn-partida-nova-cancelar">Voltar</button>
                        <br />
                    </form>
                </div>
				<div id="div-atualizar-partida" style="display: none;">
                <h4 class="align-center">Atualizar dados da partida</h4>
                <br />
                <form id="form-partida-atualizar">
                    <div class="row">
                        <div class="cell-sm-2">            
                            <input type="text" id="data-atualizar" name="data" placeholder="Data">
                        </div>
                        <div class="cell-sm-2">
                            <select name="inicio" id="select-inicio-atualizar">
                                <option value="-1">Início</option>
                            </select>
						</div>
                        <div class="cell-sm-2"> 
                            <input type="text" name="final" placeholder="Final">
						</div>
                        <div class="cell-sm-3"> 
                            <input type="text" name="jogadores" id="jogadores-atualizar" placeholder="Quantos atletas?">
                        </div>
                        <div class="cell-sm-3">
                            <select name="publico" id="select-publico-atualizar">
                                <option value="0">Jogo privado</option>
                                <option value="1">Jogo aberto ao público</option>
                            </select>
                        </div>
					</div>
                    <br />
                    <textarea id="descricao-atualizar" data-auto-size="false" id="descricao-atualizar" name="descricao" placeholder="Descrição (opcional)"></textarea>
                    <br />
                    <div class="row">
                        <div class="cell-sm-12">            
                            <input type="text" id="parqueEsportivo" class="parque-nome" readonly="readonly">
                        </div>
                    </div>
                    <div class="row">    
                        <div class="cell-sm-12" id="div-quadra-selecionada-atualizar" style="display:none;">
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
                        <div class="cell-sm-12" id="div-esporte-atualizar" style="display:none;">
                            <select name="esporte" id="select-esporte-atualizar">
                                <option value="0">Esporte</option>
                            </select>
                        </div>
                    </div>
                        <input type="hidden" class="id-parqueEsportivo" name="id_parque" />
                        <input type="hidden" id="id-partida-atualizar" name="id" />  
                        <input type="hidden" id="cadastrar-quadra-atualizar" name="quadra" />  
                        <br />           
                        <button class="cell-sm-12 button info" id="btn-partida-atualizar">Atualizar</button>
                        <br />
                        &nbsp;
						<button class="cell-sm-12 button success" id="btn-partida-convidar">Ir para partida</button>
                        <br />
                        &nbsp;
                        <button class="cell-sm-12 button warning" id="btn-partida-atualizar-cancelar">Voltar</button>
                        <br />
                </form>
            </div>
            <input type="hidden" id="servicos" /> 
		</div>
    </body>
</html>