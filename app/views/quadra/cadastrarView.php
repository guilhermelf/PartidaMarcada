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
            buscarEstados();
            buscarGeneros();
            buscarVisibilidades();
        })    
    </script>
    <body>
        <?php include 'app/views/header/header.php'; ?>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <div class="dialog-title resposta-titulo"></div>
            <div class="dialog-content resposta-mensagem"></div>
        </div>                     
        <div class="conteudo container">
            <form id="form-quadra-cadastrar">
                <h2>Cadastro de parque esportivo</h2>
                <hr />
                <h4>Informações de login</h4>
                <hr />
                <div class="row">
                    <div class="cell-sm-6">                 
                        <input type="text" name="email" placeholder="E-mail">
                    </div>
                    <div class="cell-sm-6">                 
                        <input type="text" name="email2" placeholder="Confirmar e-mail">
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="cell-sm-6">                     
                        <input type="password" name="senha" placeholder="Senha">
                    </div>
                    <div class="cell-sm-6">                    
                        <input type="password" name="senha2" placeholder="Confirmar senha">
                    </div>
                </div>
                <br />
                <hr />
                <h4>Dados da quadra</h4>
                <hr />
                <div class="row">
                    <div class="cell-sm-5">  
                        <input type="text" name="nome" placeholder="Nome">
                    </div>
                    <div class="cell-sm-4">  
                        <input type="text" name="site" placeholder="Site">
                    </div>
                    <div class="cell-sm-3">  
                        <input type="text" name="cep" placeholder="CEP">
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="cell-sm-6">   
                        <select name="estado" id="select-estado">
                            <option>Estado</option>
                        </select>
                    </div>
                    <div class="cell-sm-6">   
                        <select id="select-cidade" name="cidade">
                            <option>Cidade</option>
                        </select>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="cell-sm-5">  
                        <input type="text" name="endereco" placeholder="Endereço">
                    </div>
                    <div class="cell-sm-2">  
                        <input type="text" name="numero" placeholder="Número">
                    </div>
                    <div class="cell-sm-2">  
                        <input type="text" name="ddd" placeholder="DDD">
                    </div>
                    <div class="cell-sm-3">  
                        <input type="text" name="telefone" placeholder="Telefone">
                    </div>
                </div>
                <br />
                <hr />     
                <h4>Serviços e espaços disponíveis</h4>
                <hr />
                <div class="row">
                    <div class="cell-sm-2">
                        <label for vestiario>Vestiários?</label>
                    </div>
                    <div class="cell-sm-1">
                    <select name="vestiario" id="vestiario">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                    <div class="cell-sm-2">
                        <label for vestiario>Churrasqueira?</label>
                    </div>
                    <div class="cell-sm-1">
                    <select name="churrasqueira" id="churrasqueira">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                    <div class="cell-sm-2">
                        <label for vestiario>Copa/bar?</label>
                    </div>
                    <div class="cell-sm-1">
                        <select name="copa" id="copa">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                    <div class="cell-sm-2">
                        <label for vestiario>Agendamento pelo portal?</label>
                    </div>
                    <div class="cell-sm-1">
                        <select name="servicos" id="servicos">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                </div>
                <br />
                <input type="button" class="cell-sm-12 button bg-lightBlue" value="Cadastrar" id="btn-quadra-cadastrar">
                <br />&nbsp;  
            </form>
        </div>
    </body>
</html>