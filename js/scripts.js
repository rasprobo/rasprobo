/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){

    var comandos = [];
    var comando_selecionado = null;

    $('button#executar').click(function(){
        enviarComandos();
    });

    $('button#limpar').click(function(){
        $('figure#container-comandos').html('');
    });

    $('button#remover').click(function(){
        if(comando_selecionado !== null){
            comando_selecionado.remove();
        }
    });

    $('button#up').click(function(){
        $('figure#container-comandos').append(returnHtmlComando('up'));
        $('span.comando').click(function(){
            $('span.comando').removeClass('text-danger');
            $(this).addClass('text-danger');
            comando_selecionado = $(this);
        });
    });

    $('button#left').click(function(){
        $('figure#container-comandos').append(returnHtmlComando('left'));
        $('span.comando').click(function(){
            $('span.comando').removeClass('text-danger');
            $(this).addClass('text-danger');
            comando_selecionado = $(this);
        });
    });

    $('button#right').click(function(){
        $('figure#container-comandos').append(returnHtmlComando('right'));
        $('span.comando').click(function(){
            $('span.comando').removeClass('text-danger');
            $(this).addClass('text-danger');
            comando_selecionado = $(this);
        });
    });

    $('button#down').click(function(){
        $('figure#container-comandos').append(returnHtmlComando('down'));
        $('span.comando').click(function(){
            $('span.comando').removeClass('text-danger');
            $(this).addClass('text-danger');
            comando_selecionado = $(this);
        });
    });

    returnHtmlComando = function(tipo){
        return '<span class="comando" data-comando="' + tipo + '"> <i class="fa fa-arrow-' + tipo + ' fa-4x"></i> </span>';
    };

    enviarComandos = function(){
        comandos = [];
        $('span.comando').each(function(index){
            comandos.push($(this).data('comando'));
        });
        var array_comandos = comandos.toString();
        $.post( "action.php", { comandos: array_comandos })
        .done(function( data ) {
             console.log(data);
        });
    };
});


