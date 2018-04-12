<!DOCTYPE html>
<html>
    <head>
        <link href="/partidamarcada/components/metro-ui-css/build/css/metro-icons.css" rel="stylesheet" />
        <link href="/partidamarcada/components/metro-ui-css/build/css/metro-schemes.css" rel="stylesheet">
        <link href="/partidamarcada/components/metro-ui-css/build/css/metro-responsive.css" rel="stylesheet">
        <link href="/partidamarcada/components/css/style.css" rel="stylesheet">
        <script src="/partidamarcada/components/jquery/jquery.min.js"></script>
        <script src="/partidamarcada/components/js/scripts.js"></script>
        <script src="/partidamarcada/components/metro-ui-css/js/metro.js"></script>
        <title>PartidaMarcada.com</title>
    </head>
    <script>
        $(document).ready(function () {
            //atualizar e-mail de parque esportivo
            $("#btn-quadra-alteraremail").on('click', function () {

                $.ajax({
                    type: "post",
                    dataType: 'json',
                    data: $("#form-quadra-alteraremail").serialize(),
                    url: "/partidamarcada/parqueesportivo/atualizarEmail",
                    success: function (resposta) {
                        if (resposta.status) {
                            $(".resposta-titulo").html("Sucesso");
                            $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');
                            setTimeout(function () {
                                window.location.href = "/partidamarcada/parqueEsportivo";
                            }, 2000);
                        } else {
                            $(".resposta-titulo").html("Erro");
                            $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');
                        }
                        $(".resposta-mensagem").html(resposta.mensagem);


                        $("#resposta").data('dialog').open();
                        console.log(resposta);
                    }
                });

                return false;
            });
        });
    </script>
    <body>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <h3 class="resposta-titulo"></h3>

            <p class="resposta-mensagem"></p>
        </div>

        <?php include 'app/views/header/headerQuadra.php'; ?>
        <div class="conteudo">

            <div class="form-cadastro grid">
                <form id="form-quadra-alteraremail">
                    <br />
                    <br />
                    <h4>Alterar e-mail</h4>
                    <hr />


                    <div class="row cells3">
                        <div class="cell">
                            <label>E-mail atual</label>
                            <div class="input-control text full-size">                       
                                <input type="text" name="email">
                            </div>
                        </div>
                        <div class="cell">
                            <label>Novo e-mail</label>
                            <div class="input-control text full-size">                       
                                <input type="text" name="novo_email">
                            </div>
                        </div>

                        <div class="cell">
                            <label>Confirmar novo e-mail</label>
                            <div class="input-control text full-size">                       
                                <input type="text" name="novo_email2">
                            </div>
                        </div>
                    </div>
                </form>
                <input type="button" class="full-size bg-lightBlue" value="Alterar" id="btn-quadra-alteraremail">
            </div>
        </div>
    </div>
</body>
</html>