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
            //atualizar senha de parque esportivo
            $("#btn-quadra-alterarsenha").on('click', function () {

                $.ajax({
                    type: "post",
                    dataType: 'json',
                    data: $("#form-quadra-alterarsenha").serialize(),
                    url: "/partidamarcada/parqueEsportivo/atualizarSenha",
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
        <?php include 'app/views/header/headerQuadra.php'; ?>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <div class="dialog-title resposta-titulo"></div>
            <div class="dialog-content resposta-mensagem"></div>
        </div>       
        <div class="conteudo container">
            <form id="form-quadra-alterarsenha">
                <h2>Alterar senha</h2>
                <hr />            
                <div class="row">
                    <div class="cell-sm-4">                    
                        <input type="password" name="senha" placeholder="Senha atual">
                    </div>
                    <div class="cell-sm-4">                    
                        <input type="password" name="nova_senha" placeholder="Novo senha">
                    </div>   
                    <div class="cell-sm-4">                    
                        <input type="password" name="nova_senha2" placeholder="Confirmar nova senha">
                    </div>               
                </div>
                <br />
                <input type="button" class="cell-sm-12 button bg-lightBlue" value="Alterar" id="btn-quadra-alterarsenha">
                <br />&nbsp;
            </form>           
        </div>
    </body>
</html>