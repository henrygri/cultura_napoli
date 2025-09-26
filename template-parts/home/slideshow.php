<?php
global $scheda;
  $schede = dci_get_option('schede_evidenziate', 'homepage') ?? null;
  if ($schede && count($schede) > 0) { ?>

  <?php $count = 1;
  foreach ($schede as $scheda) {
      if ($scheda) {
          get_template_part("template-parts/home/scheda-evidenza-full");
      }
      ++$count;
      break;
  } ?>

<?php } ?>
