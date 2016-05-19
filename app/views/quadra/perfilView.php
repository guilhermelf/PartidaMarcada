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
    <body>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <h3 class="resposta-titulo">aa</h3>

            <p class="resposta-mensagem">aa</p>
        </div>

        <?php include 'app/views/header/headerQuadra.php'; ?>
        <div class="conteudo">

            <div class="form-usuario-adicionar grid">

                <h3><?php echo "Parque esportivo: " . $dados->getNome(); ?></h3>
                <hr />
                <br />              
                <div class="row cells3">
                    <div class="cell">
                        <span class="perfil-label">Telefone: </span> <?php echo "(" . $dados->getDDD() . ") " . $dados->getNumero(); ?>
                    </div>                     
                    <div class="cell">
                        <span class="perfil-label">E-mail: </span> <?php echo $dados->getEmail(); ?>
                    </div>
                    <div class="cell">
                        <span class="perfil-label">Site: </span> <?php echo "<a target='_blank' href='http://" . $dados->getSite() . "'>" . $dados->getSite() ."</a>" ; ?>
                    </div>               
                    
                    <div class="row cells3">
                        <div class="cell">
                            <span class="perfil-label">Endereço: </span> <?php echo $dados->getEndereco() . ", " . $dados->getNumero(); ?>
                        </div>
                        <div class="cell">
                            <span class="perfil-label">Estado: </span> <?php echo $dados->getCidade()->getEstado()->getNome(); ?>
                        </div>
                        <div class="cell">
                            <span class="perfil-label">Cidade: </span> <?php echo $dados->getCidade()->getNome(); ?>
                        </div>        
                    </div>
                </div>
                <h3>Serviços disponibilizados</h3>
                <hr />
                <div class="row cells4">
                    <div class="cell">
                        <span class="perfil-label">Churrasqueiras: </span> <?php echo ($dados->getChurrasqueira() ? 'Sim' : 'Não') ?>
                    </div>                     
                    <div class="cell">
                        <span class="perfil-label">Vestiários: </span> <?php echo ($dados->getVestiario() ? 'Sim' : 'Não') ?>
                    </div>
                    <div class="cell">
                        <span class="perfil-label">Copa/bar: </span> <?php echo ($dados->getCopa() ? 'Sim' : 'Não') ?>
                    </div>
                    <div class="cell">
                        <span class="perfil-label">Agendar online: </span> <?php echo ($dados->getServicos() ? 'Sim' : 'Não') ?>
                    </div>
                </div>
                <br />
                <h4>Estatísticas</h4>
                <hr />
                Módulo ainda não terminado. 

                <br />
                <br />
                <h4>Avaliações</h4>
                <hr />

                Informações gráficas levando em conta as avaliações recebidas dos outros usuários. (Próxima Sprint)
            </div>
        </div>
    </div>
</div>
</body>
</html>