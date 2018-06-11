<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
        <link rel="stylesheet" href="/partidamarcada/components/metro-ui-css/css/metro-all.css" />
        <link href="/partidamarcada/components/css/style.css" rel="stylesheet">
        <script src="/partidamarcada/components/jquery/jquery.min.js"></script>
        <script src="/partidamarcada/components/jquery/jquery.mask.min.js"></script>
        <script src="/partidamarcada/components/js/scripts.js"></script>
        <script src="/partidamarcada/components/metro-ui-css/js/metro.js"></script>
        <title>PartidaMarcada.com</title>
    </head>
    <script>
        $(document).ready(function() {
            //funcao validar data passada
            function validarDataPassada() {
                return 0;
            }

            function validarDataPassada(data) {
                var comp = data.split('/');
                var m = parseInt(comp[1], 10);
                var d = parseInt(comp[0], 10);
                var y = parseInt(comp[2], 10);
                var date = new Date(y,m-1,d);     
                
                var data = new Date();
                var day = data.getDate();
                var month = data.getMonth();
                var year = data.getFullYear();

                var hoje = new Date(year, month, day);
                if (date.getFullYear() == y && date.getMonth() + 1 == m && date.getDate() == d) {
                    if(date.getTime() < hoje.getTime()) {
                        return 1;
                    } else {    
                        return 0;
                    }
                } else {
                    return 0;
                }
            }

            //validar form e cadastrar usuário
            $('#btn-usuario-cadastrar').on('click', function() {
                var valid = 1,
                    message = '';
            
                $('#form-usuario-cadastrar input').each(function() {
                    var $this = $(this);
            
                    if(!$this.val()) {
                        var inputName = $this.attr('name');

                        //alert(inputName + " - " + valid);

                        if(inputName == "email2") {
                            inputName = 'confirmar e-mail';
                        }

                        if(inputName == "senha2") {
                            inputName = 'confirmar senha';
                        }

                        if(inputName == "dt_nascimento") {
                            inputName = 'data de nascimento';
                        }

                        valid = 0;
                        message += 'Preencha o campo ' + inputName + '!<br />';
                    }
                });
            
                if(!valid) {
                    $(".resposta-titulo").html("Erro");
                    $(".resposta-mensagem").html(message);
                    $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');

                    $("#resposta").data('dialog').open();

                    return false;
                } else if(!validarDataPassada($('#nascimento').val())) {
    
                    $(".resposta-titulo").html("Erro");
                    $(".resposta-mensagem").html("Data de nascimento inválida!");
                    $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');

                    $("#resposta").data('dialog').open();
                    
                    return false;
                } else {

                    $.ajax({
                        type: "post",
                        dataType: 'json',
                        data: $("#form-usuario-cadastrar").serialize(),
                        url: "/partidamarcada/usuario/salvar",
                        success: function (resposta) {
                            
                            if (resposta.status) {
                                $(".resposta-titulo").html("Sucesso");                             
                                setTimeout(function () {
                                    window.location.href = "/partidamarcada"
                                }, 3000);
                                $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');
                                $(".resposta-mensagem").html(resposta.mensagem);
                                $("#resposta").data('dialog').open();
                            } else {
                                $(".resposta-titulo").html("Erro");
                                $(".resposta-mensagem").html(resposta.mensagem);
                                $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');
                            }
                            $("#resposta").data('dialog').open();
                            
                            return false;
                        }
                    });
                }                
            });

            $("#telefone").mask("99999-9999");
            $("#nascimento").mask("99/99/9999");
        });
    </script>
    <body>
        <?php include 'app/views/header/header.php'; ?>
        <div data-role="dialog" data-close-button="true" data-overlay="true" id="resposta" class="padding20">
            <div class="dialog-title resposta-titulo"></div>
            <div class="dialog-content resposta-mensagem"></div>
        </div>       
        <div class="conteudo container">
                <form id="form-usuario-cadastrar">
                    <h2>Cadastro de atleta</h2>
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
					<h4>Informações pessoais</h4>
                    <hr />
                    <div class="row">
                        <div class="cell-sm-3">              
							<input type="text" name="nome" placeholder="Nome">
                        </div>
                       <div class="cell-sm-3">              
							<input type="text" name="sobrenome" placeholder="Sobrenome">
                        </div>
						<div class="cell-sm-2">              
							<input type="text" name="apelido" placeholder="Apelido">
                        </div>
						
                        <div class="cell-sm-2">              
							<select name="genero" id="select-genero">
								<option value="0">Genero</option>
							</select>
						</div>
					
						<div class="cell-sm-2">         
                            <input type="text" id="nascimento" data-role="calendarpicker" data-format="%d/%m/%Y" name="dt_nascimento" data-locale="pt-BR" placeholder="Nascimento">
						</div>					
					</div>
                    <br />
                    <hr />     
                    <h4>Informações para contato</h4>
                    <hr />
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
                        <div class="cell-sm-3">                
                            <input type="text" name="endereco" placeholder="Endereço">
                        </div>

                        <div class="cell-sm-1">                
                            <input type="text" name="numero" placeholder="Número">
                        </div>

                        <div class="cell-sm-2">                
                            <input type="text" name="cep" placeholder="CEP">
                        </div>
                        <div class="cell-sm-1">                  
                            <input type="text" name="ddd" placeholder="DDD">
                        </div>       
                        <div class="cell-sm-2">                  
                            <input type="text" id="telefone" name="telefone" placeholder="Telefone">
                        </div>     
                    </div>
                    <br />
                    <hr />
                    <input type="button" class="cell-sm-12 button bg-lightBlue" value="Cadastrar" id="btn-usuario-cadastrar">
                    <br />&nbsp;
                </div>
            </form>               
        </div>
        </div>
    </div>
<script>
    buscarVisibilidades();
    buscarEstados();
    buscarGeneros();
</script>
</body>
</html>