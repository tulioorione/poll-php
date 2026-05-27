 <?php
require __DIR__."/template.php";
require __DIR__."/lib.php";


render('create', [
    'title' => 'Criação de Enquete',
    'hero' => 'Criar Enquete',
    'heroLead' => 'Crie uma nova enquete para o site'
]);