<?php if(!$data): ?>
    <div class="alert alert-warning">Nenhuma enquete ativa.</div>
<?php else: ?>
    <div class="card">
        <div class="card-body">
            <div class="mb-2 fw-semibold"><?= $data['poll']['question']; ?></div>
        </div>
    </div>
<?php endif; ?>

<div class="mt-3">
    <a href="criar.php" class="btn btn-primary btn-sm">Criar nova enquete</a>
    <a href="index.php" class="btn btn-outline-secondary btn-sm">Home</a>
</div>