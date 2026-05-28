<?php
$pollWidgetData = $pollWidgetData ?? null;

if(!$pollWidgetData) {
    return;
}
?>
<div class="position-fixed bottom-0 end-0 p-3">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="fw-semibold mb-3">
                <?= htmlspecialchars($pollWidgetData['poll']['question'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
            <?php if(has_voted($pollWidgetData['poll']['id'])): ?>
                <div class="alert alert-success py-2">Você já votou!</div>
            <?php else: ?>
                <form action="vote.php" method="POST" class="vstack gap-2">
                    <input type="hidden" name="poll_id" value="<?= (int)$pollWidgetData['poll']['id']; ?>">

                    <?php foreach ($pollWidgetData['options'] as $o): ?>
                        <div class="form-check mb-1">
                            <input type="radio" class="form-check-input" name="option_id" id="opt<?= (int)$o['id'] ?>" value="<?= (int)$o['id'] ?>">
                            <label for="opt<?= (int)$o['id'] ?>" class="form-check-label">
                                <?= htmlspecialchars($o['label'], ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                        </div>
                    <?php endforeach; ?>

                    <button class="btn btn-primary btn-sm mt-2 w-100" type="submit">Votar</button>
                </form>
            <?php endif; ?>


        </div>
    </div>
</div>
