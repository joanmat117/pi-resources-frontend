<?php

declare(strict_types=1);

$config = [
    'title' => 'Recursos para Prueba de Ingreso - Cuba',
    'description' => 'Recursos para pruebas de ingreso cuba, pruebas, resúmenes, ejercicios, respuestas',
    'image' => 'https://i.postimg.cc/vTmDLdHH/public-examination-preparation-concept-23-2149369870.avif',
    'url' => 'https://pruebas-de-ingreso.wasmer.com' . $_SERVER['REQUEST_URI'],
    'site_name' => 'Mi Sitio Web',
    'canonical' => 'https://pruebas-de-ingreso.wasmer.com' . strtok($_SERVER['REQUEST_URI'], '?')
];
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?= htmlspecialchars($config['title']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($config['description']) ?>">
    
    <!-- Canonical -->
    <link rel="canonical" href="<?= htmlspecialchars($config['canonical']) ?>">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?= htmlspecialchars($config['title']) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($config['description']) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($config['image']) ?>">
    <meta property="og:url" content="<?= htmlspecialchars($config['url']) ?>">
    <meta property="og:site_name" content="<?= htmlspecialchars($config['site_name']) ?>">
    <meta property="og:type" content="website">
    
    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($config['title']) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($config['description']) ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($config['image']) ?>">
    
    <!-- Favicon -->
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    
    <!-- TailwindCSS -->
    <link href="src/output.css" rel="stylesheet">

    <!-- Bootstrap Icons --->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:opsz,wght@17..18,400..700&display=swap" rel="stylesheet">

</head>
