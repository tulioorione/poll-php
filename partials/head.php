<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Meu Site' ?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/css/bootstrap.min.css" integrity="sha512-2bBQCjcnw658Lho4nlXJcc6WkV/UxpE/sAokbXPxQNGqmNdQrWqtw26Ns9kFF/yG792pKR1Sx8/Y1Lf1XN4GKA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/js/bootstrap.bundle.min.js" integrity="sha512-HvOjJrdwNpDbkGJIG2ZNqDlVqMo77qbs4Me4cah0HoDrfhrbA+8SBlZn1KrvAQw7cILLPFJvdwIgphzQmMm+Pw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <nav class="navbar navbar-light bg-light border-bottom">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Meu site</span>
        </div>
    </nav>
    <header class="bg-white">
        <div class="container py-5">
            <h1 class="display-6 mb-1"><?= $hero ?></h1>
            <p class="text-muted mb-0"><?= $heroLead ?></p>

        </div>
    </header>
    <main class="container py-4 flex-grow-1">