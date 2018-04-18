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
         <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <h3 class="resposta-titulo">aa</h3>

            <p class="resposta-mensagem">aa</p>
        </div>
        <?php include 'app/views/header/headerQuadra.php'; ?>
        <div class="conteudo">
            <div class="contorno">
                <div class="accordion large-heading" data-role="accordion">
                    <div class="frame active">
                        <div class="heading">Partidas futuras <span class="mif-calendar icon"></span></div>
                        <div class="content">Frame content</div>
                    </div>
                    <div class="frame active ">
                        <div class="heading">Avaliações pendentes <span class="mif-pencil icon"></div>
                        <div class="content">Módulo ainda não desenvolvido.</div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>