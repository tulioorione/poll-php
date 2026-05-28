<div class="position-fixed bottom-0 end-0 p-3">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="fw-semibold mb-3">
                <?= $data['poll']['question']; ?>
            </div>
            <form action="vote.php" method="POST" class="vstack gap-2">
                <input type="hidden" name="poll_id" value="<?= (int)$data['poll']['id']; ?>">

                <?php foreach ($data['options'] as $o): ?>
                    <div class="form-check mb-1">
                        <input type="radio" class="form-check-input" name="option_id" id="opt<?= (int)$o['id'] ?>" value="<?= (int)$o['id'] ?>">
                        <label for="opt<?= (int)$o['id'] ?>" class="form-check-label">
                            <?= $o['label']; ?>
                        </label>
                    </div>
                <?php endforeach; ?>

                <button class="btn btn-primary btn-sm mt-2 w-100" type="submit">Votar</button>
            </form>
        </div>
    </div>
</div>