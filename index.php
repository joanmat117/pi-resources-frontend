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
  <body>
    <?= require_components('header',["title"=>"Recursos Prueba de Ingreso Cuba"]) ?>
    <main class="min-h-screen mx-auto max-w-4xl px-2 py-5">
      <button id="files-go-back" class="flex gap-2 items-center justify-center text-xl p-1 rounded-xl border border-2 px-2 cursor-pointer border-indigo-500/40">
        <i class="bi bi-caret-left-fill"></i>
        <p class="text-md font-bold">
          Regresar
        </p>
      </button>
      <section id="files-container" class="grid gap-2 grid-cols-2 md:grid-cols-3">

      </section>


    </main>

  <script>
    window.filesData = <?= json_encode($files, JSON_HEX_TAG | JSON_HEX_APOS) ?>;
    window.initialPath = "<?= addslashes($current_path) ?>";
  </script>
  </body>
</html>
