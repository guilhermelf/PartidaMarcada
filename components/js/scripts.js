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
            dataType: 'json',
            url: "/partidamarcada/usuario/logar",
            data: $("#login-usuario").serialize(),
            success: function (resposta) {
                
                if(resposta.status) {
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
                if(resposta.status) {
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
                if(resposta.status) {
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
                
                if(resposta.status) {
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
