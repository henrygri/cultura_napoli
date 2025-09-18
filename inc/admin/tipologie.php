<?php
// STUDIOLABO: Lista di file da escludere (solo nome file, non path)
$exclude_files = [
    'tipologia_dataset.php',
    'tipologia_fase.php',
    'tipologia_incarico.php',
    'tipologia_messaggio.php',
    'tipologia_pagamento.php',
    'tipologia_persona_pubblica.php',
    'tipologia_pratica.php',
    'tipologia_servizio.php',
    'tipologia_sito_tematico.php',
    'tipologia_unita_organizzativa.php',
];

//include tutti i file che descrivono i custom post type del Sito dei Comuni
foreach (glob(get_template_directory() . "/inc/admin/tipologie/*.php") as $file) {
  if (!in_array(basename($file), $exclude_files)) {
    require $file;
  }
}
