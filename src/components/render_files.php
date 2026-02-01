<?php

$current_path = "";

$current_files = [];
$current_files_name = [];


foreach ($files as $file) {

  $file_path = $file["path"];

  if($current_path === "" || str_starts_with($file_path,$current_path)){

    $relative_file_path = $current_path === "" 
      ? $file_path 
      : str_replace($current_path,"",$file_path);

    $relative_file_path = ltrim($relative_file_path, "/");
    $current_file_name = explode("/",$relative_file_path)[0];

    if(!in_array($current_file_name,$current_files_name)) {

      $current_files_name[] = $current_file_name;
      $file['display_name'] = $current_file_name;
      $current_files[] = $file;
    }
  }
}

?>

<ul class="flex gap-2 flex-wrap">
  <?php foreach($current_files as $file) : ?>
  <li class=" p-2 flex-1 min-w-[100px] border rounded-xl text-md">
      <h2>
        <?= htmlspecialchars($file["display_name"]) ?>
      </h2>
      <small><?= $file["type"] === "tree" ? "📁 Carpeta" : "📄 Archivo" ?></small>
    </li>
  <?php endforeach; ?>
</ul>
