<?php
  declare(strict_types=1);
  define('ROOT', __DIR__ . '/');

  require(ROOT . "src/utils/require_template.php");
  require(ROOT . "src/models/resource_repo.php");

  $resource_repo = new ResourceRepo();

  $files = $resource_repo->get_all_files_mock();
?>
<!DOCTYPE html>
<html lang="es-ES"> 
  <?= require_components("head",['files'=>$files]) ?>
  <body class="bg-background text-foreground">
    <?= require_components('header',["title"=>"Recursos Prueba de Ingreso Cuba"]) ?>
  
    <main class="min-h-screen mx-auto max-w-4xl px-2 py-5">
    <div id="files-breadcrumb" class="border rounded-full px-3 mb-2 border-foreground/30 p-1" ></div>
    <div id="go-back-btn"></div>
      
      <section id="files-container" class="grid gap-2 grid-cols-2 md:grid-cols-3">

      </section>


    </main>

   <script>
        // Este script se ejecuta en scope global
        window.filesData = <?= json_encode($files, JSON_HEX_TAG | JSON_HEX_APOS) ?>;
        window.initialPath = "<?= addslashes($current_path ?? '') ?>";
    </script>

  <script type="module" src="src/js/main.js"></script>
  <script type="module" src="src/js/fileBrowser.js"></script>
  </body>
</html>
