<script src="/partidamarcada/vendor/components/jquery/jquery.min.js"></script>

<script type="text/javascript">


</script>

<h1>Cadastrar usuário</h1>
<form id="form-cadastro" class="form-horizontal">
    <fieldset>

        <!-- Form Name -->
        <legend>Informações gerais</legend>
        <p class="erros">
            &nbsp;
        </p>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="nome">Nome</label>  
            <div class="col-md-4">
                <input id="nome" name="nome" type="text" placeholder="" class="form-control input-md">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="sobrenome">Sobrenome</label>  
            <div class="col-md-4">
                <input id="sobrenome" name="sobrenome" type="text" placeholder="" class="form-control input-md">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="email">E-mail</label>  
            <div class="col-md-4">
                <input id="email" name="email" type="text" placeholder="" class="form-control input-md">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="apelido">Apelido</label>  
            <div class="col-md-4">
                <input id="apelido" name="apelido" type="text" placeholder="" class="form-control input-md">

            </div>
        </div>

        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="senha">Senha</label>
            <div class="col-md-4">
                <input id="senha" name="senha" type="password" placeholder="" class="form-control input-md">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="">Data de nascimento</label>  
            <div class="col-md-4">
                <input id="dtNascimento" name="dtNascimento" type="date" placeholder="" class="form-control input-md">
            </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="genero">Gênero</label>
            <div class="col-md-4">
                <select id="genero" name="genero" class="form-control">
                    <option value="0">Selecione</option>
                </select>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="cep">CEP</label>  
            <div class="col-md-4">
                <input id="cep" name="cep" type="text" placeholder="" class="form-control input-md">

            </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="estado">Estado</label>
            <div class="col-md-4">
                <select id="estado" name="estado" class="form-control">
                    <option value="0">Selecione</option>
                </select>
            </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="cidade">Cidade</label>
            <div class="col-md-4">
                <select id="cidade" name="cidade" class="form-control">
                    <option value="0">Selecione</option>
                </select>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="endereco">Endereço</label>  
            <div class="col-md-4">
                <input id="endereco" name="endereco" type="text" placeholder="" class="form-control input-md">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="numero">Número</label>  
            <div class="col-md-4">
                <input id="numero" name="numero" type="text" placeholder="" class="form-control input-md">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="ddd">DDD</label>  
            <div class="col-md-4">
                <input id="ddd" maxlength="2" name="ddd" type="text" placeholder="" class="form-control input-md">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="telefone">Telefone</label>  
            <div class="col-md-4">
                <input id="telefone" maxlength="8" name="telefone" type="text" placeholder="" class="form-control input-md">

            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Opções de privacidade</legend>
        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="visibilidade">Visibilidade do perfil</label>
            <div class="col-md-4">
                <select id="visibilidade" name="visibilidade" class="form-control">
                    <option value="0">Selecione</option>
                </select>
            </div>
        </div>
        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="mostrarTelefone">Exibir telefone</label>
            <div class="col-md-4">
                <select id="visibilidade" name="mostrarTelefone" class="form-control">
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
            </div>
        </div>
        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="mostrarEndereco">Exibir endereço</label>
            <div class="col-md-4">
                <select id="visibilidade" name="mostrarEndereco" class="form-control">
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
            </div>
        </div>
    </fieldset>
    <br />
    <br />
    <fieldset>
        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="btnCadastrar"></label>
            <div class="col-md-4">
                <button id="btnCadastrar" name="btnCadastrar" class="btn btn-info">Cadastrar</button>
            </div>
        </div>
    </fieldset>
</form>
