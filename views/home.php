<?php
$news = [
    'Google melhora vibe coding no AI Studio com integração ao Antigravity',
    'GitHub anuncia exigência por 2FA para publicação de pacotes no npm',
    'Bill Gates revela o código do 1º produto lançado pela Microsoft em 1975',
];
?>

<div class="row g-3">
    <?php foreach($news as $title): ?>
        <div class="col-md-4">
            <article class="card h-100">
                <img
                    src="<?= htmlspecialchars('assets/'.$title.'.webp', ENT_QUOTES, 'UTF-8'); ?>"
                    class="card-img-top object-fit-cover"
                    style="height: 180px;"
                    alt="<?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>"
                >
                <div class="card-body">
                    <h2 class="h5 mb-0"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h2>
                </div>
            </article>
        </div>
    <?php endforeach; ?>
</div>
