<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="/partidamarcada/components/metro-ui-css/css/metro-all.css" />
        <link href="/partidamarcada/components/css/style.css" rel="stylesheet">
        <script src="/partidamarcada/components/jquery/jquery.min.js"></script>
        <script src="/partidamarcada/components/js/scripts.js"></script>
        <script src="/partidamarcada/components/metro-ui-css/js/metro.js"></script>
        <title>PartidaMarcada.com</title>
    </head>
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
                            <input type="text" data-role="calendarpicker" data-format="%d/%m/%Y" name="dt_nascimento" data-locale="pt-BR" placeholder="Nascimento">
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
                            <input type="text" name="telefone" placeholder="Telefone">
                        </div>     
                    </div>
                    <br />
                    <hr />
                    <h4>Opções de privacidade</h4>
                    <hr />
                    <div class="row">
                        <div class="cell-sm-2"> 
                            <label>Exibir endereço?</label>
                        </div>
                        <div class="cell-sm-2"> 
                            <select name="mostrar_endereco" placeholder="">
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                        </div>
                        <div class="cell-sm-2">
                            <label>Exibir telefone?</label>
                        </div>
                        <div class="cell-sm-2"> 
                            <select name="mostrar_telefone">
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                        </div>
                        <div class="cell-sm-2">
                            <label>Visibilidade do perfil</label>
                        </div>
                        <div class="cell-sm-2"> 
                            <select id="select-visibilidade" name="visibilidade">
                                <option>Selecione</option>
                            </select>
                        </div>
                    </div>
                    <br />
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