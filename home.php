<?php
/**
 * The template for displaying home
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 */

get_header();
?>
    <main id="main-container" class="main-container redbrown">
        <h1 class="visually-hidden">
            <?php echo dci_get_option("nome_comune"); ?>
        </h1>

        <section class="it-hero-wrapper it-wrapped-container custom-overlapping" aria-describedby="contenuti_evidenza">
          <div class="container">
            <h2 id="contenuti_evidenza" class="visually-hidden">Contenuti in evidenza</h2>
            <div class="row">
                <?php get_template_part("template-parts/home/slideshow"); ?>

                <!--
                  <li class="splide__slide it-hero-card it-hero-bottom-overlapping rounded drop-shadow ">
                    <figure class="figure px-0 img-full w-100">
                        <img src="https://dev.studiolabo.it/cultura-napoli/wp-content/uploads/2025/09/banner_aggiornato_Jori.png" class="figure-img img-fluid rounded" alt="" />
                    </figure>
                  </li>
                -->
            </div>
          </div>
        </section>

        <section>
          <div class="container py-5 border-top border-bottom">
            <p class="h2">
              Il calendario ufficiale della cultura a Napoli, <br>
              scopri cosa succede ogni giorno in città.
            </p>
          </div>
        </section>

        <?php get_template_part("template-parts/evento/prossimi-eventi"); ?>

        <?php get_template_part("template-parts/common/bolli-argomenti"); ?>


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
            <div class="row py-3">
              <div class="col-12">
                <h2>I Luoghi della cultura</h2>
              </div>
              <div class="col-lg-6 pe-5 pt-3 pt-lg-5">
                <?php get_template_part('template-parts/luogo/mappa-svg', null, [ 'slug_municipalita' => $slug_municipalita ]); ?>
              </div>
              <div class="col-lg-6 ps-5 pt-3 pt-lg-5">
                <h3><?php echo esc_html($term_random->name); ?></h3>
                <?php if (!empty($quartieri_figli)) : ?>
                  <p class="text-secondary">
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

        <?php /*
        <section id="head-section">
            <h2 class="visually-hidden">Contenuti in evidenza</h2>
            <?php
          			$messages = dci_get_option( "messages", "home_messages" );
                if($messages && !empty($messages)) {
                    get_template_part("template-parts/home/messages");
                }
    		    ?>
            <?php get_template_part("template-parts/home/notizie"); ?>
            <?php get_template_part("template-parts/home/calendario"); ?>
        </section>
        */ ?>

        <?php /*
        <section id="evidenza" class="evidence-section">
            <div class="section py-5 pb-lg-80 px-lg-5 position-relative" style="<?php if (file_exists(get_stylesheet_directory().'/assets/img/evidenza-header.png')){ ?>background-image: url('<?php echo esc_url( get_stylesheet_directory_uri()); ?>/assets/img/evidenza-header.png');<?php }else{ ?>background-image: url('<?php echo esc_url( get_template_directory_uri()); ?>/assets/img/evidenza-header.png');<?php } ?>">
                <?php get_template_part("template-parts/home/argomenti"); ?>
                <?php get_template_part("template-parts/home/siti","tematici"); ?>
            </div>
        </section>
        <?php get_template_part("template-parts/home/ricerca"); ?>
        */?>

        <?php get_template_part("template-parts/evento/prossimi-eventi"); ?>

    </main>
<?php
get_footer();
