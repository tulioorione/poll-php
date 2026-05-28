<?php
include_once("resultados.php");
?>
<?php if(!$data): ?>
    <div class="alert alert-warning">Nenhuma enquete ativa.</div>
<?php else: ?>
    <div class="card">
        <div class="card-body">
            <div class="mb-2 fw-semibold"><?= $data['poll']['question']; ?></div>
        <?php
            $total = max(1, (int) $data['total']);
            foreach($data['options'] as $o): 
                $pct = round(((int) $o['votes']) * 100/$total);
        ?>
            <div class="mb-2">
                <div class="d-flex justify-content-between">
                    <span><?= $o['label'] ?></span>
                    <span class="text-muted"><?= (int)$o['votes'] ?>( <?= $pct ?>%)</span>
                </div>
                <div class="progress">
                    <div class="progress-bar" style="width: <?= $pct ?>%"></div>
                </div>
            </div>

        <?php endforeach; ?>
        <div class="text-muted small">Total de votos: <?= (int)$data['total']; ?></div>
        </div>
    </div>
<?php endif; ?>

<div class="mt-3">
    <a href="criar.php" class="btn btn-primary btn-sm">Criar nova enquete</a>
    <a href="index.php" class="btn btn-outline-secondary btn-sm">Home</a>
</div>