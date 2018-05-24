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
    $(document).ready(function() {
        
        $('#txt-data').on('focusout', function() {
            var data = ($('#txt-data').val() != null ? $('#txt-data').val() : null);
            var quadra = ($('#select-quadra').val() != null ? $('#select-quadra').val() : null);

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

        $('#btn-reservar').on('click', function() { 
            $.ajax({
                data: $('#form-reservar-horario').serialize(),
                async: false,
                type: "post",
                url: "/partidamarcada/agendamento/reservarHorario",
                dataType: "json",
                success: function (resposta) {
                    if (resposta.status) {
                        $(".resposta-titulo").html("Sucesso");
                        $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');
                        $(".resposta-mensagem").html(resposta.mensagem);

                        $("#resposta").data('dialog').open();

                        setTimeout(function () {
                            window.location.href = "/partidamarcada/parqueesportivo/"
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

        //listar quadras
        $('.quadras').remove();
        $.ajax({
            async: false,
            dataType: "json",
            type: 'post',
            url: "/partidamarcada/quadra/listarPorParqueEsportivo",
            success: function (resposta) {
                if(resposta) {
                    $.each(resposta, function(k, v) {
                        $('#select-quadra').append("<option class='quadras' value='" + v.id + "'>Quadra " + v.numero + " - " + v.piso.nome + " </option>");
                    });
                }
            }
        })

        //buscar partidas novas cadastradas pelo usuário
        $('.proximasPartidas').remove();
        $.ajax({
            async: false,
            type: "post",
            url: "/partidamarcada/partida/buscarPartidasParqueEsportivo",
            dataType: "json",
            success: function (resposta) {
                if(resposta) {
                    $.each(resposta, function (k, v) {
                        $("#div-proximas-partidas-parque").find(".p-2").append(
                            "<a href='/partidamarcada/partida/partida/" + v.id + "' class='proximasPartidas'>" + 
                                v.data + ", das " + v.inicio + "h às " + (v.inicio + 1) + "h, partida de " + v.esporte.nome + ", na quadra número " + v.quadra.numero + ".</a><br />"
                        );
                    });
                } else {
                    $("#div-proximas-partidas-parque").find(".p-2").append("<span class='proximasPartidas'>Nenhum agendamento está pendente!</span>");
                }
            }
        });

        $('.agendamentosPendentes').remove();
        $.ajax({
            async: false,
            type: "post",
            url: "/partidamarcada/agendamento/buscarAgendamentosPendentes",
            dataType: "json",
            success: function (resposta) {
                if(resposta) {
                    $.each(resposta, function (k, v) {
                        $("#agendamentos-pendentes").find(".content").find(".p-2").append("<a target='_blank' class='agendamentosPendentes' href='/partidamarcada/partida/partida/" + v.partida.id + "'><span style='display:none;' class=id-agendamento>" + v.id + "</span>" + v.partida.data + ", das " + v.partida.inicio + "h às " + (v.partida.inicio + 1) + "h, partida de " + v.partida.esporte.nome + ", na quadra " + v.partida.quadra.numero + ", organizada por " + v.partida.usuario.nome + "</a>" +
                            "<span class='opcoes-partida'>" +
                                "<a target='_blank' href='/partidamarcada/usuario/perfil/" + v.partida.usuario.id + "'>" +
                                    "<span class='partida-editar mif-user fg-green' title='Ver perfil do organizador'></span>" + 
                                "</a>" +
                                "&nbsp;&nbsp;&nbsp;" +
                                "<span class='agendamento-confirmar mif-thumbs-up fg-green' title='Confirmar agendamento'>" + 
                                    "<span style='display:none;' class='id-confirmar'>" + v.id + "</span>" + 
                                "</span>" +
                                "&nbsp;&nbsp;&nbsp;" +
                                "<span class='agendamento-cancelar mif-cross fg-red' title='Negar agendamento'>" + 
                                    "<span style='display:none;' class='id-cancelar'>" + v.id + "</span>" + 
                                "</span>" +
                            "</span><br />"                           
                        );
                    });
                } else {
                    $("#agendamentos-pendentes").find(".content").find(".p-2").append("<span class='agendamentosPendentes'>Nenhum agendamento está pendente!</span>");
                }
            }
        });
    
        //buscar agendamento para aceitar pelo id
        $(".agendamento-confirmar").on('click', function(){
            var agendamento = $(this).find('.id-confirmar').text();
            Metro.dialog.create({
                title: "Confirmar agendamento",
                content: "<div>Você tem certeza que deseja confirmar o agendamento de horário?<br />Não será possível desfazer essa ação!</div>",
                actions: [
                    {
                        caption: "Tenho certeza",
                        cls: "js-dialog-close alert",
                        onclick: function(){
                            $.ajax({
                                async: false,
                                type: "post",
                                url: "/partidamarcada/agendamento/confirmar/" + agendamento,
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
                                        window.location.href = "/partidamarcada/parqueesportivo"
                                    }, 3000);
                                }
                            });
                        }
                    },
                    {
                        caption: "Não",
                        cls: "js-dialog-close",
                        onclick: function(){
                            return false;
                        }
                    }
                ]
            });
        });

        //buscar agendamento para cancelar pelo id
        $(".agendamento-cancelar").on('click', function(){
            var agendamento = $(this).find('.id-cancelar').text();
            Metro.dialog.create({
                title: "Negar agendamento",
                content: "<div>Você tem certeza que deseja negar o agendamento de horário?<br />Não será possível desfazer essa ação!</div>",
                actions: [
                    {
                        caption: "Tenho certeza",
                        cls: "js-dialog-close alert",
                        onclick: function(){
                            $.ajax({
                                async: false,
                                type: "post",
                                url: "/partidamarcada/agendamento/negar/" + agendamento,
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
                                        window.location.href = "/partidamarcada/parqueesportivo"
                                    }, 3000);
                                }
                            });
                        }
                    },
                    {
                        caption: "Não",
                        cls: "js-dialog-close",
                        onclick: function(){
                            return false;
                        }
                    }
                ]
            });
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
            <div id="div-partidas" style="display: block;">
                <div data-role="accordion" data-one-frame="false" data-show-active="true" data-active-heading-class="bg-cyan fg-white">
                    <div class="frame active" id="agendamentos-pendentes" class="bg-cyan fg-white">
                        <div class="heading accor"><span class="mif-calendar icon"></span> Agendamentos pendentes</div>
                        <div class="content">
                            <div class="p-2"><span class="opcoes-agendamento"></span></div>
                        </div>
                    </div>
                    <div class="frame">
                        <div class="heading bg-cyan fg-white accor"><span class="mif-calendar icon"></span> Próximas partidas</div>
                        <div class="content" id="div-proximas-partidas-parque">
                            <div class="p-2"></div>
                        </div>
                    </div>
                    <div class="frame">
                        <div class="heading bg-cyan fg-white accor"><span class="mif-alarm-on icon"></span> Reservar horário</div>
                        <div class="content">
                            <form id="form-reservar-horario">
                                <br />
                                <div class="row">
                                    <div class="cell-sm-3">   
                                        <select name="quadra" id="select-quadra">
                                            <option>Quadra</option>
                                        </select>
                                    </div>
                                    <div class="cell-sm-3">   
                                        <input type="text" name="data" id="txt-data" placeholder="Data">
                                    </div>
                                    <div class="cell-sm-3">   
                                        <select name="inicio" id="select-inicio">
                                            <option>Início</option>
                                        </select>
                                    </div>                                   
                                    <div class="cell-sm-3"> 
                                        <button class="button success" id="btn-reservar">Reservar</button>
                                    </div>
                                </div>                          
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>