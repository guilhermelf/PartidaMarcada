/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    //logar usuário
    $('#login-usuario').on('click', '.btn-usuario-logar', function () {
        $.ajax({
            type: "post",
            url: "/partidamarcada/usuario/logar",
            data: $("#login-usuario").serialize(),
            success: function (resposta) {
                alert(resposta);
                window.location.href = "/partidamarcada/usuario";
            }
        });

        return false;
    });
    
    //logar usuário
    $('#login-usuario').on('click', '.btn-usuario-logar', function () {
        $.ajax({
            type: "post",
            url: "/partidamarcada/usuario/logar",
            data: $("#login-usuario").serialize(),
            success: function (resposta) {
                alert(resposta);
                window.location.href = "/partidamarcada/usuario";
            }
        });

        return false;
    });

    //cadastrar usuário
    $("#btn-usuario-cadastrar").on('click', function () {

        $.ajax({
            type: "post",
            data: $("#form-usuario-cadastrar").serialize(),
            url: "/partidamarcada/usuario/salvar",
            success: function (resposta) {
                console.log(resposta);
            }
        });
    })

    //listar cidades ao alterar estado
    $("#select-estado").on('change', function () {
        
        $('.cidades').remove();
        var est = $('#select-estado').val();
        
        $.ajax({
            type: "post",
            data: {estado: est},
            url: "/partidamarcada/cidade/listarPorEstado",
            dataType: 'json',
            success: function (resposta) {    

                $.each(resposta, function (k, v) {
                    $("#select-cidade").append("<option class='cidades' value=" + v.id + ">" + v.nome + "</option>");
                });
            }
        });
    });
});

//buscar estados
function buscarEstados() {
    $('.estados').remove();
    $.ajax({
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

//buscar generos
function buscarGeneros() {
    $('.generos').remove();
    $.ajax({
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
