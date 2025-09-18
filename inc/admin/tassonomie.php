<?php

// STUDIOLABO: Lista di file da escludere (solo nome file, non path)
$exclude_files = [
    'tassonomia_tipi_documento.php',
    'tassonomia_tipi_doc_albo_pretorio.php',
    'tassonomia_tipi_unita_organizzativa.php',
    'tassonomia_tipi_incarico.php',
    'tassonomia_stati_pratica.php'

];

//include tutti i file che descrivono le tassonomie del Sito dei Comuni
foreach(glob(get_template_directory() . "/inc/admin/tassonomie/*.php") as $file){
  if (!in_array(basename($file), $exclude_files)) {
    require $file;
  }
}