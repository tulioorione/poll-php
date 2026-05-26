 <?php
require __DIR__."/template.php";
require __DIR__."/lib.php";

$data = get_current_poll();

render('results', [
    'title' => 'Resultado da Enquete',
    'hero' => 'Resultados',
    'heroLead' => 'Veja os percentuais da enquete ativa.',
    'data' => $data
]);