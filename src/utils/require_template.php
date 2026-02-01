<?php
declare(strict_types=1);

function require_components(string $url,array $args){
  
  extract($args);

  require(ROOT . "/src/components/$url.php");

}

