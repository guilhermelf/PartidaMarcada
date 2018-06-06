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
    <body>
        <?php if($_SESSION['tipo'] == 'usuario') {
            include 'app/views/header/headerUsuario.php';
         } else {
            include 'app/views/header/headerQuadra.php';
         } ?>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <div class="dialog-title resposta-titulo"></div>
            <div class="dialog-content resposta-mensagem"></div>
        </div>       
        <div class="conteudo container">
            <h3><?php echo $dados->getNome(); ?></h3>
            <hr />
            <br />   
            <div class="row">
                <div class="cell-sm-4">
                    <span class="perfil-label">Endereço: </span> <?php echo $dados->getEndereco() . ", " . $dados->getNumero(); ?>
                </div>
                <div class="cell-sm-2">
                    <span class="perfil-label">Estado: </span> <?php echo $dados->getCidade()->getEstado()->getNome(); ?>
                </div>
                <div class="cell-sm-4">
                    <span class="perfil-label">Cidade: </span> <?php echo $dados->getCidade()->getNome(); ?>
                </div>   
                <div class="cell-sm-2">
                    <span class="perfil-label">CEP: </span> <?php echo $dados->getCEP(); ?>
                </div>     
            </div>           
            <div class="row">
                <div class="cell-sm-4">
                    <span class="perfil-label">Telefone: </span> <?php echo "(" . $dados->getDDD() . ") " . $dados->getNumero(); ?>
                </div>     
                <div class="cell-sm-4">
                    <span class="perfil-label">Site: </span> <?php echo "<a target='_blank' href='http://" . $dados->getSite() . "'>" . $dados->getSite() ."</a>" ; ?>
                </div>                       
                <div class="cell-sm-4">
                    <span class="perfil-label">E-mail: </span> <?php echo "<a target='_blank' href='mailto:" . $dados->getEmail() . "'>" . $dados->getEmail() ."</a>"; ?>
                </div>        
            </div>  
            <br />
            <h3>Serviços disponibilizados</h3>
            <hr />
            <div class="row">
                <div class="cell-sm-3">
                    <span class="perfil-label">Churrasqueiras: </span> <?php echo ($dados->getChurrasqueira() ? 'Sim' : 'Não') ?>
                </div>                     
                <div class="cell-sm-3">
                    <span class="perfil-label">Vestiários: </span> <?php echo ($dados->getVestiario() ? 'Sim' : 'Não') ?>
                </div>
                <div class="cell-sm-3">
                    <span class="perfil-label">Copa/bar: </span> <?php echo ($dados->getCopa() ? 'Sim' : 'Não') ?>
                </div>
                <div class="cell-sm-3">
                    <span class="perfil-label">Agendamento online: </span> <?php echo ($dados->getServicos() ? 'Sim' : 'Não') ?>
                </div>
            </div>
            <br />
            <h4>Estatísticas</h4>
            <hr />
            <div class="row">
                <div class="cell-sm-12">
                    <span class="perfil-label">Partidas: </span> <?php echo $dados->getEstatistica()->getPartidas(); ?>
                </div>    
            </div>
            <br />
            <h4>Avaliações</h4>
            <hr />
            <?php if($dados->getEstatistica()->getAvaliacoes() == 0) {?>
                <div class="row">
                    <div class="cell-sm-12">
                        <span class="perfil-label">Parque esportivo ainda não foi avaliado</span>
                    </div>    
                </div>
            <?php } else { ?>
                <div class="row">
                    <div class="cell-sm-12">
                        <span class="perfil-label">Atendimento: </span><span title="<?php echo ($dados->getEstatistica()->getAtendimento()/$dados->getEstatistica()->getAvaliacoes()); ?>"><input data-static="true" data-role="rating" data-value="<?php echo ($dados->getEstatistica()->getAtendimento()/$dados->getEstatistica()->getAvaliacoes()); ?>"></span>
                    </div>    
                </div>
                <div class="row">
                    <div class="cell-sm-12">
                        <span class="perfil-label">Estrutura: </span><span title="<?php echo ($dados->getEstatistica()->getEstrutura()/$dados->getEstatistica()->getAvaliacoes()); ?>"><input data-static="true" data-role="rating" data-value="<?php echo ($dados->getEstatistica()->getEstrutura()/$dados->getEstatistica()->getAvaliacoes()); ?>"></span>
                    </div>    
                </div>
                <div class="row">
                    <div class="cell-sm-12">
                        <span class="perfil-label">Qualidade: </span><span title="<?php echo ($dados->getEstatistica()->getQualidade()/$dados->getEstatistica()->getAvaliacoes()); ?>"><input data-static="true" data-role="rating" data-value="<?php echo ($dados->getEstatistica()->getQualidade()/$dados->getEstatistica()->getAvaliacoes()); ?>"></span>
                    </div>    
                </div>
                <div class="row">
                    <div class="cell-sm-12">
                        <span>Total de <?php echo $dados->getEstatistica()->getAvaliacoes(); ?> avaliações.</span>
                    </div>    
                </div>
            <?php } ?>
            </div>
        </div>
    </body>
</html>