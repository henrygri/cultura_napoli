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

<section class="py-5 bg-200">
  <div class="container">
    <div class="row pt-3 pb-5">
      <div class="col-12">
        <h2>I Luoghi della cultura</h2>
      </div>
      <div class="col-lg-6 pe-5 pt-3 pt-lg-5">
        <?php get_template_part('template-parts/luogo/mappa-svg', null, [ 'slug_municipalita' => $slug_municipalita ]); ?>
      </div>
      <div class="col-lg-6 ps-5 pt-3 pt-lg-5">
        <h3 class="mb-1"><?php echo esc_html($term_random->name); ?></h3>
        <?php if (!empty($quartieri_figli)) : ?>
          <p class="mb-4">
            <?php echo implode(', ', wp_list_pluck($quartieri_figli, 'name')); ?>
          </p>
        <?php endif; ?>
        <div class="row">
          <?php foreach ($luoghi as $luogo) : ?>
          <div class="col-md-6">
            <div class="card rounded no-after mb-3 card-luogo-small bg-white">
              <div class"card-img-wrapper">
                <div class="card-img">
                  <?php echo get_the_post_thumbnail($luogo->ID, 'medium'); ?>
                </div>
              </div>
              <div class="card-body">
                <h4 class="h5"><?php echo esc_html(get_the_title($luogo)); ?></h4>
                <p class="mb-0"><?php echo esc_html(get_post_meta($luogo->ID, 'indirizzo', true)); ?></p>
              </div>
            </div>
          </div>
          <?php endforeach; ?>

        </div>
      </div>
    </div>
  </div>
</section>
