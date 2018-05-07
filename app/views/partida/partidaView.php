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

            $.ajax({
                async: false,
                type: "post",
                data: {partida : $('#id-partida').val()},
                url: "/partidamarcada/amigo/buscarAmigosConvidar",
                dataType: 'json',
                success: function (resposta) {
                    $.each(resposta, function(k, v) {
                        $('#form-convites-partida').append(
                            "<div class='row'>" +
                                "<div class='cell-sm-12'>" +
                                    "<input type='checkbox' data-role='checkbox' name='convites' value='" + v.id + "' data-caption='" + v.nome + " " + v.sobrenome + " (" + v.apelido +  ")'>" +
                                "</div>" +
                            "</div>"
                        );
                    })
                }
            });

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
                console.log($('#form-convites-partida').serialize());

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
                    
                    <div class="frame">
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
                                    <input type="text" name="Apelido" placeholder="Apelido">
                                </div>
                                <div class="cell-sm-3"> 
                                    <button class="button yellow" id="btn-convidar-buscar-usuario">Buscar</button>
                                </div>
                            </div>
                            
                            <input type="hidden" id="id-partida" name="partida" value="<?php echo $dados->getId(); ?>">
                            
                            </form>
                            <br />
                        </div>
                    </div>
                    
                    
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
                        <button class="cell-sm-12 button success fg-white bg-red" id="btn-convidar-cancelar">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'app/views/header/headerUsuario.php'; ?>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <div class="dialog-title resposta-titulo"></div>
            <div class="dialog-content resposta-mensagem"></div>
        </div>       
        <div class="conteudo container">
            <div id="div-dados-partida">
                <h3>Informações da partida</h3>
                <br />  

                <?php 
                    if(!$dados->getStatus()) {
                        echo "<h2 class='align-center fg-red'>Partida cancelada!</h2><br />";
                    }
                ?>
                <div class="row">
                    <div class="cell-sm-12">
                        <span class="perfil-label">
                            <?php echo "Partida de " . $dados->getEsporte()->getNome() . " (" . $dados->getQuadra()->getTamanho() . ") no(a) " .
                                $dados->getQuadra()->getParqueEsportivo()->getNome() . ", na quadra de número " . $dados->getQuadra()->getNumero() . ".";?>
                        </span>
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
                                            if($participante->getStatus() == 1)
                                                echo "<a target='_blank' href='/partidamarcada/usuario/perfil/" . $participante->getUsuario()->getId() . "'>" .
                                                        $participante->getUsuario()->getNome() . " " . 
                                                        $participante->getUsuario()->getSobrenome() . 
                                                        " (" . $participante->getUsuario()->getApelido()  
                                                    .")</a><br />";
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
                    <?php 
                        if($dados->getUsuario()->getId() == $_SESSION['id']) {
                    ?>
                        <br />
                        <button class="cell-sm-12 button success" id="btn-partida-convidar">Convidar atletas</button>
                        <br />
                    <?php   
                        }
                    ?>              
                </div>
            </div>           
        </div>
    </body>
</html>