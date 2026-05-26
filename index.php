 <?php
require __DIR__."/template.php";

render('home', [
    'title' => 'Home do site',
    'hero' => 'Bem-vindo',
    'heroLead' => 'Site de Notícias: leia o que quiser'
]);