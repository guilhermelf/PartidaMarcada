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
            $('#btn-usuario-alteraremail').on('click', function() {
                //console.log($('#form-usuario-alteraremail').serialize());
 
                $.ajax({
                    type: "post",
                    dataType: 'json',
                    data: $('#form-usuario-alteraremail').serialize(),
                    url: "/partidamarcada/partida/avaliar2",
                    success: function (resposta) {
                        console.log(resposta);
                    }
                });
                return false;
            });
        });
    </script>
    <body>
        <?php include 'app/views/header/headerUsuario.php'; ?>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <div class="dialog-title resposta-titulo"></div>
            <div class="dialog-content resposta-mensagem"></div>
        </div>       
        <div class="conteudo container">
            <form id="form-usuario-alteraremail">
                <h2 class="text-center">Avaliar partida</h2>
                <hr />            
                <br />
                <table class="table striped">
                    <thead>
                        <tr>
                            <th>Quadra</th>
                            <th>Qualidade (piso/gramado)</th>
                            <th>Estrutura da quadra (vestiários/bar)</th>
                            <th>Atendimento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Quadra do Guilherme</td>
                            <td><input data-role="rating" data-value="3"
                                    name="piso[]">
                            </td>
                            <td><input data-role="rating" data-value="3"
                                    name="estrutura[]">
                            </td>
                            <td><input data-role="rating" data-value="3"
                                    name="atendimento[]">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table striped">
                    <thead>
                        <tr>
                            <th style="display: none">Id</th>
                            <th>Atleta</th>
                            <th>Habilidade</th>
                            <th>Comportamento</th>
                            <th>Pontualidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="display: none"><input type="hidden" name="idAvaliado[]" value="1"></td>
                            <td>Fulano da Silva</td>
                            <td><input data-role="rating" data-value="3"
                                    name="habilidade[]">
                            </td>
                            <td><input data-role="rating" data-value="3"
                                    name="comportamento[]">
                            </td>
                            <td><input data-role="rating" data-value="3"
                                    name="pontualidade[]">
                            </td>
                        </tr>
                        <tr>
                            <td style="display: none"><input type="hidden" name="idAvaliado[]" value="2"></td>
                            <td>Beltrano da Silva</td>
                            <td><input data-role="rating" data-value="3"
                                    name="habilidade[]">
                            </td>
                            <td><input data-role="rating" data-value="3"
                                    name="comportamento[]">
                            </td>
                            <td><input data-role="rating" data-value="3"
                                    name="pontualidade[]">
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <br />
                <input type="hidden" name="partida" value="40">
                <input type="button" class="cell-sm-12 button bg-lightBlue" value="Enviar avaliação" id="btn-usuario-alteraremail">
                <br />&nbsp;
            </form>           
        </div>
    </body>
</html>