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

            //confirmar presença
            $("#btn-aceitar").on('click', function() {
                $.ajax({
                    async: false,
                    type: "post",
                    data: {participante : $('#id-participante').val()},
                    url: "/partidamarcada/participante/aceitar",
                    success: function (resposta) {
                        if(resposta) {
                            $(".resposta-titulo").html("Sucesso");
                            $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');

                            $(".resposta-mensagem").html("Convite aceito com sucesso!"); 
                            $("#resposta").data('dialog').open();
                            
                            setTimeout(function () {    
                                window.location.href = "/partidamarcada/partida/partida/" + $('#id-partida').val()
                            }, 3000);
                        }
                    }
                });
            }); 

            $.ajax({
                async: false,
                type: "post",
                url: "/partidamarcada/participante/participanteExiste/" + $('#id-partida').val(),
                success: function (resposta) {

                    if(resposta == 1) {
                        $.ajax({
                            async: false,
                            type: "post",
                            url: "/partidamarcada/participante/participantePediu/" + $('#id-partida').val(),
                            success: function (resposta) {
                                if(resposta != 1) {                                   
                                    $('#div-btn-convidar').show();
                                } else {
                                    $('#div-aguardar').show();
                                }
                            }
                        });                             
                    } else {                     
                        $('#div-btn-pedir').show();              
                    }
                }
            });

            //pedir para participar
            $('#btn-partida-pedir').on('click', function() {
                $.ajax({
                    async: false,
                    type: "post",
                    url: "/partidamarcada/participante/candidatar/" + $('#id-partida').val(),
                    success: function (resposta) {
                        if(resposta) {
                            $(".resposta-titulo").html("Sucesso");
                            $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');

                            $(".resposta-mensagem").html("Solicitação enviada com sucesso!"); 
                            $("#resposta").data('dialog').open();
                            
                            setTimeout(function () {    
                                window.location.href = "/partidamarcada/";
                            }, 3000);
                        }
                    }
                });
            });

            //negar presença
            $("#btn-negar").on('click', function() {
                $.ajax({
                    async: false,
                    type: "post",
                    data: {participante : $('#id-participante').val()},
                    url: "/partidamarcada/participante/negar",
                    success: function (resposta) {
                        if(resposta) {
                            $(".resposta-titulo").html("Sucesso");
                            $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');

                            $(".resposta-mensagem").html("Convite negado com sucesso!"); 
                            $("#resposta").data('dialog').open();
                            
                            setTimeout(function () {    
                                window.location.href = "/partidamarcada/partida/partida/" + $('#id-partida').val()
                            }, 3000);
                        }
                    }
                });
            });

            //alterar presença
            $("#participar").on('click', ".btn-alterar", function() {
                $.ajax({
                    async: false,
                    type: "post",
                    data: {participante : $('#id-participante').val()},
                    url: "/partidamarcada/participante/aguardar",
                    success: function (resposta) {
                        if(resposta) {                       
                            window.location.href = "/partidamarcada/partida/partida/" + $('#id-partida').val()
                        }
                    }
                });
            });      

            $.ajax({
                async: false,
                type: "post",
                data: {partida : $('#id-partida').val()},
                url: "/partidamarcada/amigo/buscarAmigosConvidar",
                dataType: 'json',
                success: function (resposta) {
                    if(resposta) {
                        $.each(resposta, function(k, v) {
                            $('#form-convites-partida').append(
                                "<div class='row'>" +
                                    "<div class='cell-sm-12'>" +
                                        "<input type='checkbox' data-role='checkbox' name='participantes[]' value='" + v.id + "' data-caption='" + v.nome + " " + v.sobrenome + " (" + v.apelido +  ")'>" +
                                    "</div>" +
                                "</div>"
                            );
                        })
                    } else {
                        $('#form-convites-partida').append(
                            "<div class='row'>" +
                                "<div class='cell-sm-12'>" +
                                    "<hr /><p>Não há amigos disponíveis</p>" +
                                "</div>" +
                            "</div>"
                        );
                        $("#btn-partida-convidar-selecionados").hide();
                    }                 
                }
            });
            
            <?php if($dados->getStatus() == 1) {?>
                $.ajax({
                    async: false,
                    type: "post",
                    data: {partida : $('#id-partida').val()},
                    url: "/partidamarcada/participante/buscarConvite",
                    dataType: 'json',
                    success: function (resposta) {
                        if(resposta != null) {
                            $.each(resposta, function(k, v){
                                $('#id-participante').val(v.id);
                                
                                switch (v.status) {
                                    case 0:
                                        $('#participar').hide()
                                        $('#div-convite').show();
                                        break;                     
                                    case 1:
                                        $('#div-convite').hide();
                                        $('#participar').html("<span class='perfil-label'>Estou confirmado para a partida. <a href='#' class='btn-alterar'>Alterar</a></span>");
                                        $('#participar').show();
                                        break;
                                    case 2:
                                        $('#div-convite').hide();
                                        $('#participar').html("<span class='perfil-label'>Não participarei da partida. <a href='#' class='btn-alterar'>Alterar</a></span>");
                                        $('#participar').show();
                                        break;
                                }

                            })
                        }                 
                    }
                });
            <?php } ?>
          /*   $('#btn-usuario-buscar').on('click', function () {
                $('.busca').remove();
                $.ajax({
                    type: "post",
                    dataType: 'json',
                    data: $("#form-buscar-atletas").serialize(),
                    url: "/partidamarcada/usuario/pesquisar",
                    success: function (resposta) {
                        console.log(resposta);
                        if(!resposta) {
                            $('#resultado-busca').html("<span class='busca'><hr /> Nenhum usuário encontrado.</span>");
                            $('#resultado-busca').show();
                        } else {
                            $('#resultado-busca').html("<span class='busca'><hr /></span>");
                            $.each(resposta, function (k, v) {
                                $('#resultado-busca').append("<span class='busca'><a target='_blank' href='/partidamarcada/usuario/perfil/" + v.id + "'>" + v.nome + " " + v.sobrenome + " (" + v.apelido + ")</a><br /></span>");
                            });
                            
                            $('#resultado-busca').show();
                        }
                    }
                });
                return false;
            }); */

            $('#btn-convidar-cancelar').on('click', function() {
                $('#div-partida-convidar').hide();
                $('.conteudo').css('opacity', '1');

                return false;
            });

            $('#btn-partida-convidar').on('click', function() {
        
                $('#div-partida-convidar').show();
                $('.conteudo').css('opacity', '0.2');

                return false;
            });

            $('#btn-partida-convidar-selecionados').on('click', function() {
                $('#div-partida-convidar').hide();
                $('.conteudo').css('opacity', '1');
                $.ajax({
                    type: "post",
                    dataType: 'json',
                    data: $("#form-convites-partida").serialize(),
                    url: "/partidamarcada/participante/convidar",
                    success: function (resposta) {
                        $(".resposta-titulo").html("Sucesso");
                        $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');
                        $(".resposta-mensagem").html(resposta.mensagem); 
                        
                        $("#resposta").data('dialog').open();
                        
                        setTimeout(function () {    
                            window.location.href = "/partidamarcada/partida/partida/" + $('#id-partida').val(); 
                        }, 3000);
                    }
                });


                return false;
            });

        });
    </script>
    <body>

        <div id="div-partida-convidar" style="display:none;" class="modal">
            <div class="modal-content">              
                <h2 class="text-light align-center">Convidar atletas</h2>
                <hr>
                <br />
                <div data-role="accordion" data-one-frame="true" data-show-active="true">
                    
                    <!-- <div class="frame">
                        <div class="heading accor"><span class="mif-search icon"></span> Buscar atletas</div>
                        <div class="content" id="div-buscar-atletas">
                            <form id="form-buscar-atletas">
                            <br />
                            <div class="row">
                                <div class="cell-sm-3">   
                                    <input type="text" name="nome" placeholder="Nome">
                                </div>
                                <div class="cell-sm-3">   
                                    <input type="text" name="sobrenome" placeholder="Sobrenome">
                                </div>
                                <div class="cell-sm-3">   
                                    <input type="text" name="apelido" placeholder="Apelido">
                                </div>
                                <div class="cell-sm-3"> 
                                    <button class="button yellow" id="btn-usuario-buscar">Buscar</button>
                                </div>
                            </div>
                            <div id="resultado-busca" style="display:none;"></div>
                            <input type="hidden" id="id-partida" name="partida" value="<?php echo $dados->getId(); ?>">
                            
                            </form>
                            <br />
                        </div>
                    </div>
                     -->
                    
                    <div class="frame active">
                        <div class="heading accor"><span class="mif-users icon"></span> Amigos</div>
                        <div class="content" id="div-amigos">
                            <form id="form-convites-partida">
                            
                            
                            <input type="hidden" id="id-partida" name="partida" value="<?php echo $dados->getId(); ?>">
                            
                            </form>
                            <br  />
                            <button class="cell-sm-12 button success" id="btn-partida-convidar-selecionados">Convidar</button>
                        </div>
                    </div>                   
                </div>
                <br />

                <br /> 
                <div class="row">
                    <div class="cell-sm-12"> 
                        <button class="cell-sm-12 button success fg-white bg-red" id="btn-convidar-cancelar">Voltar</button>
                    </div>
                </div>
            </div>
        </div>

        <?php if($_SESSION['tipo'] == 'usuario') {
            include 'app/views/header/headerUsuario.php';
         } else {
            include 'app/views/header/headerQuadra.php';
         } ?>
        <div data-role="dialog" data-close-button="false" data-overlay="true" id="resposta" class="padding20">
            <div class="dialog-title resposta-titulo"></div>
            <div class="dialog-content resposta-mensagem"></div>
        </div>       
        <div class="conteudo container">
            <div id="div-dados-partida">
                <?php 
                    if(!$dados->getStatus()) {
                        echo "<h2 class='align-center fg-red'>Partida cancelada pelo organizador!</h2><br />";
                    } else if($dados->getStatus() == 2){
                        echo "<h2 class='align-center fg-red'>Partida cancelada. Agendamento não aceito pela quadra!</h2><br />";
                    }
                ?>
                <h3>Informações da partida</h3>
                <br />             
                <div class="row">
                    <div class="cell-sm-12">
                        <span class="perfil-label">
                            <?php echo "Partida de " . $dados->getEsporte()->getNome() . " (" . $dados->getQuadra()->getTamanho() . ") no(a) " .
                                $dados->getQuadra()->getParqueEsportivo()->getNome() . ", na quadra de número " . $dados->getQuadra()->getNumero() . ".";?>
                        </span>
                    </div>
                    <div class="cell-sm-12">
                        <span class="perfil-label"><?php echo "Data: </span>" . date_format($dados->getData(), 'd/m/Y') . ", das " . $dados->getInicio() . "h às " . ($dados->getInicio() + 1) . "h.";?>                     
                    </div>
                </div>    
                <div class="row">
                    <div class="cell-sm-12">
                        <span class="perfil-label">Valor: </span> R$ <?php echo $dados->getQuadra()->getValor(); ?>
                    </div>
                </div>        
                <div class="row">
                    <div class="cell-sm-12">
                        <span class="perfil-label">Organizador: </span> <?php echo $dados->getUsuario()->getNome() . " " . $dados->getUsuario()->getSobrenome() . " (" . $dados->getUsuario()->getApelido() . ")"; ?>
                    </div>
                </div>  
                <div class="row">
                    <div class="cell-sm-12">
                        <span class="perfil-label">Partida  
                            <?php if($dados->getPublico()) {
                                echo " aberta ao público."; 
                            } else { 
                                echo " privada."; 
                            } ?>
                        </span>
                    </div>
                </div>     
                <br />
                <div id="div-convite" style="display:none;">
                    <div class="row">
                        <div class="cell-sm-6">
                            <button class="button success" id="btn-aceitar">Participarei</button>
                        </div>
                        <div class="cell-sm-6">
                            <button class="button alert" id="btn-negar">Não participarei</button>
                        </div>
                    </div>
                </div>
                <div id="participar" style="display:none;"></div>
                <br />
                <div data-role="accordion" data-one-frame="false" data-show-active="true">
                    <div class="frame">
                        <div class="heading accor"><span class="mif-info icon"></span> Informações da quadra</div>
                        <div class="content">
                            <div class="row">
                                <div class="cell-sm-12">
                                    <span class="perfil-label">Endereço: </span> <?php echo $dados->getQuadra()->getParqueEsportivo()->getEndereco() . 
                                        ", " . $dados->getQuadra()->getParqueEsportivo()->getNumero() .
                                        " - " . $dados->getQuadra()->getParqueEsportivo()->getCidade()->getNome() .
                                        ", " . $dados->getQuadra()->getParqueEsportivo()->getCidade()->getEstado()->getNome() .
                                        ". CEP: " . $dados->getQuadra()->getParqueEsportivo()->getCep(); ?>        
                                </div>                    
                            </div>
                            <div class="row">
                                <div class="cell-sm-12">
                                    <span class="perfil-label">Telefone: </span> <?php echo "(" . $dados->getQuadra()->getParqueEsportivo()->getDDD() . ") " . $dados->getQuadra()->getParqueEsportivo()->getNumero(); ?>
                                </div>
                            </div>
                            <div class="row">     
                                <div class="cell-sm-12">
                                    <span class="perfil-label">Site: </span> <?php echo "<a target='_blank' href='http://" . $dados->getQuadra()->getParqueEsportivo()->getSite() . "'>" . $dados->getQuadra()->getParqueEsportivo()->getSite() ."</a>" ; ?>
                                </div>
                            </div>
                            <div class="row">                       
                                <div class="cell-sm-12">
                                    <span class="perfil-label">E-mail: </span> <?php echo "<a target='_blank' href='mailto:" . $dados->getQuadra()->getParqueEsportivo()->getEmail() . "'>" . $dados->getQuadra()->getParqueEsportivo()->getEmail() ."</a>"; ?>
                                </div>        
                            </div>                
                        </div>
                    </div>
                    <div class="frame">
                        <div class="heading accor"><span class="mif-dribbble icon"></span> Serviços disponibilizados</div>
                        <div class="content">
                            <div class="row">
                                <div class="cell-sm-12">
                                    <span class="perfil-label">Churrasqueiras: </span> <?php echo ($dados->getQuadra()->getParqueEsportivo()->getChurrasqueira() ? 'Sim' : 'Não') ?>
                                </div>
                            </div>
                            <div class="row">                     
                                <div class="cell-sm-12">
                                    <span class="perfil-label">Vestiários: </span> <?php echo ($dados->getQuadra()->getParqueEsportivo()->getVestiario() ? 'Sim' : 'Não') ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="cell-sm-12">
                                    <span class="perfil-label">Copa/bar: </span> <?php echo ($dados->getQuadra()->getParqueEsportivo()->getCopa() ? 'Sim' : 'Não') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="frame active">
                        <div class="heading accor"><span class="mif-users icon"></span> Atletas</div>
                        <div class="content">
                            <ul class="tabs-expand-md" data-role="tabs">
                                <li><a href="#_target_1">Confirmados</a></li>
                                <li><a href="#_target_2">Convidados</a></li>
                                <li><a href="#_target_3">Não irão</a></li>
                            </ul>
                            <div class="border bd-default no-border-top p-2">
                                <div id="_target_1">
                                    <?php 
                                        foreach ($dados->getParticipantes() as $participante) {
                                            if($participante->getStatus() == 1) {
                                                echo "<a target='_blank' href='/partidamarcada/usuario/perfil/" . $participante->getUsuario()->getId() . "'>" .
                                                        $participante->getUsuario()->getNome() . " " . 
                                                        $participante->getUsuario()->getSobrenome() . 
                                                        " (" . $participante->getUsuario()->getApelido()  
                                                    .")</a><br />";
                                                }
                                        }
                                    ?>
                                </div>
                                <div id="_target_2">
                                    <?php 
                                        foreach ($dados->getParticipantes() as $participante) {
                                            if($participante->getStatus() === 0)
                                                echo "<a target='_blank' href='/partidamarcada/usuario/perfil/" . $participante->getUsuario()->getId() . "'>" .
                                                    $participante->getUsuario()->getNome() . " " . 
                                                    $participante->getUsuario()->getSobrenome() . 
                                                    " (" . $participante->getUsuario()->getApelido()  
                                                .")</a><br />";
                                        }
                                    ?>
                                </div>
                                <div id="_target_3">
                                    <?php 
                                        foreach ($dados->getParticipantes() as $participante) {
                                            if($participante->getStatus() === 2)
                                                echo "<a target='_blank' href='/partidamarcada/usuario/perfil/" . $participante->getUsuario()->getId() . "'>" .
                                                    $participante->getUsuario()->getNome() . " " . 
                                                    $participante->getUsuario()->getSobrenome() . 
                                                    " (" . $participante->getUsuario()->getApelido()  
                                                .")</a><br />";                                    }
                                    ?>
                                </div>
                            </div>                       
                        </div>
                    </div>
                    <br />  
                    <div id="div-btn-convidar" style="display:none;">   
                        <?php if(strtotime(date_format($dados->getData(), 'Y-m-d')) >= strtotime(date('Y-m-d')) && $dados->getStatus() == 1 && $_SESSION['tipo'] != 'quadra') { ?>                                                                                      
                            <button class="cell-sm-12 button success" id="btn-partida-convidar">Convidar atletas</button>
                            <br />                         
                        <?php }?>   
                    </div>
                    <div id="div-btn-pedir" style="display:none;">   
                        <?php if(strtotime(date_format($dados->getData(), 'Y-m-d')) >= strtotime(date('Y-m-d')) && $_SESSION['tipo'] != 'quadra') { ?>                                                                                      
                            <button class="cell-sm-12 button warning" id="btn-partida-pedir">Pedir para participar</button>
                            <br />                         
                        <?php }?>   
                    </div>  
                    <div id="div-aguardar" style="display:none;">   
                        <h2 class='align-center fg-red'>Você já se candidatou a participar dessa partida, aguarde a resposta!</h2>
                    </div>                                         
                </div>
            </div>
            <input type="hidden" id="id-participante" value="" />              
        </div>
    </body>
</html>