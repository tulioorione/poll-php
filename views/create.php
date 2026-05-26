
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