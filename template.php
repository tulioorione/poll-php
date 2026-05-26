<?php
// [nome, idade] => extract => $nome e idade
function render($view, $vars = []) {
    extract($vars);
    // Cabeçalho
    require __DIR__.'/partials/head.php';
    // Miolo do site
    require __DIR__.'/views/'. $view .'.php';
    // Rodapé
    require __DIR__.'/partials/footer.php';

    }