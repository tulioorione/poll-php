<?php
$db = pdo();
$error = '';

if($_SERVER['REQUEST_METHOD'] === "POST") {
    $q = $_POST['question'];
    $labels = array_values(array_filter(array_map('trim', $_POST['options'] ?? [])));

    if($q === '' || count($labels) < 2) {
        $error = 'Informe a pergunta e pelo menos 2 opções...';
    } else {
        $db->beginTransaction();

        try {
            $st = $db->prepare('INSERT INTO polls (question) VALUES (?)');
            $st->execute([$q]);

            $pid = (int)$db->lastInsertId();

            $st = $db->prepare('INSERT INTO poll_options (poll_id, label) VALUES (?, ?)');
            foreach($labels as $l) {
                $st->execute([$pid, $l]);
            }
            $enq_ativa = $db->exec('UPDATE settings SET current_poll_id={$pid} WHERE od = 1');
            $db->commit();
            header('Location: resultados.php');
            exit;

        } catch (Throwable $e){
            $db->rollBack();
            $error = 'Erro ao criar enquete...';
        }
    }
}
?>
<?php if($error): ?>
    <div class="alert alert-danger py-2"><?= $error ?></div>
<?php endif; ?>    

<div class="card">
    <div class="card-body">
        <form class="vstack gap-2" method="POST">
            <div class="form-floating">
                <input type="text" id="question" name="question" placeholder="Pergunta" required class="form-control">
                <label for="question">Pergunta</label>
            </div>
            <?php for($i = 1; $i <= 5; $i++): ?>
                <input type="text" name="options[]" placeholder="Opção <?= $i ?>" class="form-control">
            <?php endfor; ?>
            <button class="btn btn-primary mt-2" type="submit">Criar enquete</button>
        </form>
    </div>
</div>
<div class="mt-3">
    <a href="resultados.php" class="btn btn-primary btn-sm">Ver resultados</a>
    <a href="index.php" class="btn btn-outline-secondary btn-sm">Home</a>
</div>