    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-12">
                <div class="cmp-hero">
                    <section class="it-hero-wrapper bg-transparent align-items-start">
                        <div class="it-hero-text-wrapper pt-0 ps-0 pb-0">
                            <h1 class="text-black hero-title">I Luoghi della cultura</h1>
                            <!--
                            <div class="hero-text">
                              <p>Sezione per la gestione degli itinerari culturali di lungo corso</p>
                            </div>
                            -->
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <?php
    // 1. Recupera tutti i termini di primo livello
    $municipalita = get_terms([
      'taxonomy' => 'quartieri',
      'parent'   => 0,
      'hide_empty' => true,
    ]);

    if (!empty($municipalita) && !is_wp_error($municipalita)) {

      // 2. Scegli una municipalità random
      $term_random = $municipalita[array_rand($municipalita)];
      $slug_municipalita = $term_random->slug;

      // 3. Recupera i quartieri figli
      $quartieri_figli = get_terms([
        'taxonomy' => 'quartieri',
        'parent'   => $term_random->term_id,
        'hide_empty' => false,
      ]);

      // 4. Recupera 6 post random di tipo 'luogo' associati
      $luoghi = get_posts([
        'post_type' => 'luogo',
        'posts_per_page' => 6,
        'orderby' => 'rand',
        'tax_query' => [
          [
            'taxonomy' => 'quartieri',
            'field'    => 'term_id',
            'terms'    => [$term_random->term_id],
            'include_children' => true,
          ],
        ],
      ]);
    }
    ?>
    <div class="container">
      <div class="row">
        <div class="col-lg-6 pe-5 py-3 py-lg-5">
          <?php get_template_part('template-parts/luogo/mappa-svg', null, [ 'slug_municipalita' => $slug_municipalita ]); ?>
        </div>
        <div class="col-lg-6 ps-5 py-3 py-lg-5">
          <h2 class="h3 mb-1"><?php echo esc_html($term_random->name); ?></h2>
          <?php if (!empty($quartieri_figli)) : ?>
            <p class="mb-4">
              <?php echo implode(', ', wp_list_pluck($quartieri_figli, 'name')); ?>
            </p>
          <?php endif; ?>
          <div>
              <?php
              foreach ( $luoghi as $luogo ) {
                  global $luogo_id, $load_card_type, $with_border;

                  $luogo_id = $luogo->ID;
                  $load_card_type = 'luogo';
                  get_template_part('template-parts/luogo/card-light-inverse');
              }
              ?>
          </div>
        </div>
      </div>
    </div>
