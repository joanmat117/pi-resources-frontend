<?php

declare(strict_types=1);

$config = [
    'title' => 'Mi Sitio Web - Productos Increíbles',
    'description' => 'Descubre nuestros productos exclusivos con la mejor calidad.',
    'image' => 'https://tudominio.com/images/og-image.jpg',
    'url' => 'https://tudominio.com' . $_SERVER['REQUEST_URI'],
    'site_name' => 'Mi Sitio Web',
    'canonical' => 'https://tudominio.com' . strtok($_SERVER['REQUEST_URI'], '?')
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
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
