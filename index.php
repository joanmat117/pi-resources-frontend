<?php
  declare(strict_types=1);
  define('ROOT', __DIR__);

  require(ROOT . "src/utils/require_template.php");
  require(ROOT . "src/models/resource_repo.php");

  $resource_repo = new ResourceRepo();

  $files = $resource_repo->get_all_files_mock();
?>

<html>
  <?= require_components("head",[]) ?>
  <body>
    <?= require_components('header',["title"=>"Recursos Prueba de Ingreso Cuba"]) ?>
    <main class="min-h-screen mx-auto max-w-3xl shadow shadow-xl border-x border-black/20">
      <pre class="max-h-[200px] overflow-auto">
      <?= json_encode($files,JSON_PRETTY_PRINT) ?>
      </pre>
      <?php require_components('render_files',["files"=>$files]) ?>
    


    </main>
  </body>
</html>
