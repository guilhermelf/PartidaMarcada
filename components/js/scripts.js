/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    //botao cancelar
    $('#btn-cancelar').on('click', function () {
        $(".app-bar-drop-container").hide();

        return false;
    });

    //logar usuário
    $('#login-usuario').on('click', '.btn-usuario-logar', function () {
        $.ajax({
            type: "post",
            dataType: 'json',
            url: "/partidamarcada/usuario/logar",
            data: $("#login-usuario").serialize(),
            success: function (resposta) {

                if (resposta.status) {
                    $(".resposta-titulo").html("Sucesso");
                    $(".resposta-mensagem").html(resposta.mensagem);
                    $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');

                    window.location.href = "/partidamarcada/usuario";
                } else {
                    $(".resposta-titulo").html("Erro");
                    $(".resposta-mensagem").html(resposta.mensagem);
                    $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');
                }

                $("#resposta").data('dialog').open();
            }
        });

        return false;
    });

    //deslogar usuário
    $("#btn-usuario-deslogar").on('click', function () {

        $.ajax({
            type: "get",
            url: "/partidamarcada/usuario/deslogar",
            success: function (resposta) {
                window.location.href = "/partidamarcada";
            }
        });

        return false;
    });

    //atualizar senha de usuário
    $("#btn-usuario-alterarsenha").on('click', function () {

        $.ajax({
            type: "post",
            dataType: 'json',
            data: $("#form-usuario-alterarsenha").serialize(),
            url: "/partidamarcada/usuario/atualizarSenha",
            success: function (resposta) {
                if (resposta.status) {
                    $(".resposta-titulo").html("Sucesso");
                    $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');
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

    //atualizar e-mail de usuário
    $("#btn-usuario-alteraremail").on('click', function () {

        $.ajax({
            type: "post",
            dataType: 'json',
            data: $("#form-usuario-alteraremail").serialize(),
            url: "/partidamarcada/usuario/atualizarEmail",
            success: function (resposta) {
                if (resposta.status) {
                    $(".resposta-titulo").html("Sucesso");
                    $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');
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

    //cadastrar usuário
    $("#btn-usuario-cadastrar").on('click', function () {

        $.ajax({
            type: "post",
            dataType: 'json',
            data: $("#form-usuario-cadastrar").serialize(),
            url: "/partidamarcada/usuario/salvar",
            success: function (resposta) {

                if (resposta.status) {
                    $(".resposta-titulo").html("Sucesso");
                    $("#resposta").attr('style', 'background-color: #60a917; color: #fff;');
                } else {
                    $(".resposta-titulo").html("Erro");
                    $("#resposta").attr('style', 'background-color: #ce352c; color: #fff;');
                }
                $(".resposta-mensagem").html(resposta.mensagem);


                $("#resposta").data('dialog').open();
                console.log(resposta);
            }
        });
    })

    //listar cidades ao alterar estado
    $("#select-estado").on('change', function () {
        buscarCidades($(this).val());
    });
});

//buscar estados
function buscarEstados() {
    $('.estados').remove();
    $.ajax({
        async: false,
        type: "post",
        url: "/partidamarcada/estado/listar",
        dataType: "json",
        success: function (resposta) {
            $.each(resposta, function (k, v) {
                $("#select-estado").append("<option class='estados' value=" + v.id + ">" + v.nome + "</option>");
            });
        }
    });
}

//buscar cidades
function buscarCidades(estado) {

    $.ajax({
        async: false,
        type: "post",
        data: {estado: estado},
        url: "/partidamarcada/cidade/listarPorEstado",
        dataType: 'json',
        success: function (resposta) {

            $.each(resposta, function (k, v) {
                $("#select-cidade").append("<option class='cidades' value=" + v.id + ">" + v.nome + "</option>");
            });
        }
    });
}

//buscar generos
function buscarGeneros() {
    $('.generos').remove();
    $.ajax({
        async: false,
        type: "post",
        url: "/partidamarcada/genero/listar",
        dataType: "json",
        success: function (resposta) {
            $.each(resposta, function (k, v) {
                $("#select-genero").append("<option class='generos' value=" + v.id + ">" + v.nome + "</option>");
            });
        }
    });
}

//buscar visibilidades
function buscarVisibilidades() {
    $('.visibilidades').remove();
    $.ajax({
        async: false,
        type: "post",
        url: "/partidamarcada/visibilidade/listar",
        dataType: "json",
        success: function (resposta) {
            $.each(resposta, function (k, v) {
                $("#select-visibilidade").append("<option class='visibilidades' value=" + v.id + ">" + v.nome + "</option>");
            });
        }
    });
}

//buscar usuário
function buscarUsuario() {
    $.ajax({
        async: false,
        type: "post",
        url: "/partidamarcada/usuario/buscarUsuario",
        dataType: 'json',
        success: function (resposta) {
            console.log(resposta);

            $('#nome').val(resposta.nome);
            $('#sobrenome').val(resposta.sobrenome);
            $('#apelido').val(resposta.apelido);
            $('#endereco').val(resposta.endereco);
            $('#numero').val(resposta.numero);
            $('#ddd').val(resposta.ddd);
            $('#telefone').val(resposta.telefone);
            $('#dt_nascimento').val(resposta.dataNascimento);
            $('#select-estado').val(resposta.cidade.estado.id);
            buscarCidades(resposta.cidade.estado.id);
            $('#select-cidade').val(resposta.cidade.id);
            $('#cep').val(resposta.cep);
            $('#select-visibilidade').val(resposta.visibilidade.id);
            $('#select-genero').val(resposta.genero.id);
            resposta.mostrarTelefone ? $('#mostrar_telefone').val(1) : $('#mostrar_telefone').val(0) ;
            resposta.mostrarEndereco ? $('#mostrar_endereco').val(1) : $('#mostrar_endereco').val(0) ;
        }
    });
}
