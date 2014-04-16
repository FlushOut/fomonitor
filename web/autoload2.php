<?php
//////////////////////////////////////////////////////
// Arquivo de autoload para classes do REST Airclic //
//////////////////////////////////////////////////////

// cria a função de autoload para as classes
function my_autoload2($pClassName)
{
    if (is_file("classes/" . $pClassName . ".php")) {

        // tenta incluir uma classe de regra de negócio
        require_once("classes/" . $pClassName . ".php");

    } else if (is_file("sys/" . $pClassName . ".php")) {

        // tenta incluir uma classe de sistema
        require_once("sys/" . $pClassName . ".php");

    } else {

        // não encontrou a classe solicitada. Mostre erro na tela em formato HTML
        die("'" . $pClassName . "' class was called, but the file was not encountered.");

    }
}

// coloca o autoload na memória
spl_autoload_register("my_autoload2");
?>