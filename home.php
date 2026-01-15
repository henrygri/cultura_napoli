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
        $home_itinerari_args = array(
            's' => $query,
            'posts_per_page' => 6,
            'post_type'      => 'itinerario',
        		'post_status'    => 'publish',
            'orderby'        => 'rand'
        );
        $home_itinerari_query = new WP_Query( $home_itinerari_args );

        $posts = $home_itinerari_query->posts;

        ?>
        <section class="py-5 bg-200">
    			<?php /*
            global $is_home;
            $is_home = true;
            get_template_part("template-parts/luogo/mappa-quartieri");
          */ ?>
          <div class="container">
            <div class="row">
              <div class="col-12 col-md-8">
                <h2>Itinerari</h2>
              </div>
              <div class="d-none d-md-block col-md-4 text-end">
                <a class="btn btn-xs btn-outline-dark btn-round" href="<?php echo get_post_type_archive_link('itinerario'); ?>">
                  Scopri tutti gli itinerari
                  <svg class="icon ms-2">
                    <use xlink:href="#it-arrow-right" aria-hidden="true"></use>
                  </svg>
                </a>
              </div>
            </div>
            <?php if ( $home_itinerari_query->have_posts() ) : ?>
            <div class="pt-3 pb-4">
              <div class="splide slider_itinerari" data-splide='{
                    "type":"slide",
                    "perPage":2,
                    "perMove":1,
                    "gap":"24px",
                    "arrows":false,
                    "pagination":true,
                    "mediaQuery":"max",
                    "breakpoints":{
                      "992":{"perPage":1}
                    }
                  }'>
                <div class="splide__track">
                  <ul class="splide__list">
                    <?php
                    while ( $home_itinerari_query->have_posts() ) :
                      $home_itinerari_query->the_post(); ?>
                      <li class="splide__slide">
                        <?php get_template_part( 'template-parts/itinerario/cards-list', get_post_type() ); ?>
                    </li>
                    <?php endwhile; ?>
                    </ul>
                </div>
              </div>
            </div>
            <?php endif; wp_reset_postdata(); ?>
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

        <?php
        $array_of_pages = get_posts([
            'title' => 'Gli spazi della cultura',
            'post_type' => 'any',
        ]);
        $id = $array_of_pages[0];//Be sure you have an array with single post or page
        $id = $id->ID;
        $link = get_permalink($id);


        $max_posts = isset($_GET['max_posts']) ? $_GET['max_posts'] : 12;
        $query = isset($_GET['search']) ? dci_removeslashes($_GET['search']) : null;
        $args = array(
            's' => $query,
            'posts_per_page' => $max_posts,
            'post_type'      => 'luogo',
        		'post_status'    => 'publish',
            'meta_query'     => array(
              array(
                'key'     => '_dci_luogo_in_elenco',
                'value'   => 'on',
                'compare' => '='
              )
            ),
            'orderby'        => 'post_title',
            'order'          => 'ASC'
        );
        $the_query = new WP_Query( $args );

        $posts = $the_query->posts;

        ?>
        <section class="py-5" id="home-spazi-cultura" ?>
          <div class="container">
            <div class="row">
              <div class="col-12 col-md-8">
                <h2>Gli spazi della cultura</h2>
              </div>
              <div class="d-none d-md-block col-md-4 text-end">
                <a class="btn btn-xs btn-outline-dark btn-round" href="<?php echo esc_url(  $link  ); ?>">
                  Esplora tutti i luoghi
                  <svg class="icon ms-2">
                    <use xlink:href="#it-arrow-right" aria-hidden="true"></use>
                  </svg>
                </a>
              </div>
            </div>
            <div class="row pt-3 pb-4">
              <?php
              foreach ( $posts as $post ) {
                  $load_card_type = 'luogo';
                  get_template_part('template-parts/luogo/card');
              }
              wp_reset_query();
              ?>
            </div>
          </div>
        </section>

    </main>
<?php
get_footer();
