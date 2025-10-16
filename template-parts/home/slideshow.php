<?php
  global $scheda;
  $schede = dci_get_option('schede_evidenziate', 'homepage') ?? null;

  if ($schede && count($schede) > 0) { ?>
  <div class="col-12">
    <div class="splide slider_home">
          <div class="splide__track">
            <div class="splide__list">
              <?php
              foreach ($schede as $scheda) {
                  if ($scheda) {
                      echo '<div class="splide__slide">';
                      get_template_part("template-parts/home/scheda-evidenza-full");
                      echo '</div>';
                  }
              } ?>
            </div>
          </div>
    </div>
  </div>
 
<?php } ?>
