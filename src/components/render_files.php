<?php
$current_path = "";
$current_files = [];
$current_files_name = [];

foreach ($files as $file) {
    $file_path = $file["path"];

    if($current_path === "" || str_starts_with($file_path, $current_path)) {
        $relative_file_path = $current_path === "" 
            ? $file_path 
            : str_replace($current_path, "", $file_path);

        $relative_file_path = ltrim($relative_file_path, "/");
        $current_file_name = explode("/", $relative_file_path)[0];

        if(!in_array($current_file_name, $current_files_name)) {
            $current_files_name[] = $current_file_name;
            $file['display_name'] = $current_file_name;
            $current_files[] = $file;
        }
    }
}
?>

<ul class="flex gap-2 flex-wrap p-2">
    <?php foreach($current_files as $file) : ?>
    <li class="p-2 flex-1 min-w-[100px] cursor-pointer hover:scale-105 hover:border-black/40 transition-all flex flex-col gap-1 items-center justify-center border border-black/20 rounded-xl text-md">
        <small class="text-2xl">
            <?= $file["type"] === "tree" 
                ? "<i class=\"bi bi-folder2\"></i>" 
                : "<i class=\"bi bi-file-earmark-text\"></i>" // ← CORREGIDO
            ?>
        </small>
        <h2 class="capitalize text-md font-bold">
            <?= htmlspecialchars($file["display_name"]) ?>
        </h2>
    </li>
    <?php endforeach; ?>
</ul>

<script>

const allFiles = <?= json_encode($files, JSON_HEX_TAG | JSON_HEX_APOS) ?>;
console.log('AllFiles: ===>', allFiles);
console.log('Tipo:', typeof allFiles);

</script>
