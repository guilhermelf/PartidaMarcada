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
            //liberar horario cancelando reserva
            $('#tabela-horarios').on('click', '.cancelar-reserva', function() {
                agendamento = $(this).find('.id-reserva').text();

                Metro.dialog.create({
                        title: "Liberar horário",
                        content: "<div>Você tem certeza que deseja cancelar a reserva desse horário, disponibilizando o horário para agendamento?</div>",
                        actions: [
                        {
                            caption: "Tenho certeza",
                            cls: "js-dialog-close alert",
                            onclick: function(){
                                $.ajax({
                                    type: "post",
                                    dataType: 'json',
                                    data: {agendamento: agendamento},
                                    url: "/partidamarcada/agendamento/liberar",
                                    success: function (resposta) {
                                        if (resposta.status) {
                                            $(".resposta-titulo").html("Sucesso");
                                            $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');
                                            $(".resposta-mensagem").html(resposta.mensagem);

                                            $("#resposta").data('dialog').open();

                                            setTimeout(function () {
                                                window.location.href = "/partidamarcada/parqueesportivo/horarios"
                                            }, 3000);
                                        } else {
                                            $(".resposta-titulo").html("Erro");
                                            $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');
                                            $(".resposta-mensagem").html(resposta.mensagem);

                                            $("#resposta").data('dialog').open();
                                        }
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

                        if($('#quadra-passada').val() != "") {
                            $('#select-quadra').val($('#quadra-passada').val());
                        }
                    }
                }
            });
            
            //buscar horários
            $('#btn-buscar-horarios').on('click', function() {
                if($('#txt-data').val() == "" || $('#select-quadra').val() == "-1") {
                    $(".resposta-titulo").html("Atenção");
                    $("#resposta").attr('style', 'background-color: #ff9447; color: #fff;');                          
                    
                    $(".resposta-mensagem").html("Selecione uma quadra e escolha uma data!"); 
                    $("#resposta").data('dialog').open();

                    return false;
                }

                var data = ($('#txt-data').val() != null ? $('#txt-data').val() : null);
                var quadra = ($('#select-quadra').val() != null ? $('#select-quadra').val() : null);
                
                $('.horarios').remove();
                $.ajax({
                    data: {data : data, quadra : quadra},
                    async: false,
                    type: "post",
                    url: "/partidamarcada/agendamento/buscarHorariosQuadraData",
                    dataType: "json",
                    success: function (resposta) {
                        $.each(resposta, function(k, v) {
                            if(v.status == "Horário reservado pela quadra") {
                                $('#tabela-horarios').find('tbody').append(
                                    "<tr class='horarios'>" + 
                                        "<td>" + v.horario + "h</td>" +
                                        "<td>" + v.status + "<span class='opcoes-partida'><span class='cancelar-reserva mif-cross fg-red' title='Cancelar reserva'>" +
                                            "<span class='id-reserva' style='display:none;'>" + v.idAgendamento + "</span" +
                                        "</span></span></td>" +
                                    "</tr>"
                                );
                            } else if(v.status == "Horário disponível"){
                                $('#tabela-horarios').find('tbody').append(
                                    "<tr class='horarios'>" + 
                                        "<td>" + v.horario + "h</td>" +
                                        "<td>" + v.status + "</td>" +
                                    "</tr>"
                                );
                            } else {
                                $('#tabela-horarios').find('tbody').append(
                                    "<tr class='horarios'>" + 
                                        "<td>" + v.horario + "h</td>" +
                                        "<td>" + v.status + "<span class='opcoes-partida'><a target='_blank' href='/partidamarcada/partida/partida/" + v.idPartida + "'><span class='mif-dribbble fg-green' title='Ver partida'></span></a></span></td>" +
                                    "</tr>"
                                );
                            }                          
                        })
                        $('#div-lista-horarios').show();                     
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
            <h2>Horários</h2>
            <hr />
            <form id="form-buscar-horarios">
                <div class="row">
                    <div class="cell-sm-4">                 
                        <select name="quadra" id="select-quadra">
                            <option value='-1'>Quadra</option>
                        </select>
                    </div>
                    <div class="cell-sm-4">                 
                        <input type="text" name="data" id="txt-data" placeholder="Data">
                    </div>
                    <div class="cell-sm-4">                 
                        <button class="button success" id="btn-buscar-horarios">Buscar</button>
                    </div>                 
                </div>   
                <div style="display: none;" id="div-lista-horarios">
                    <table id='tabela-horarios' class="table striped hovered">
                        <thead>
                            <th>Horário</th>
                            <th>Status</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <input type="hidden" id="quadra-passada" value="<?php if(isset($dados)) echo $dados; ?>">   
            </form>
        </div>
    </body>
</html>