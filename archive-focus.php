<?php
/**
 * The template for displaying archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#archive
 *
 * @package Design_Comuni_Italia
 */
?>
<?php get_header(); ?>

<main>
  <?php
    $with_shadow = false;
    $with_description = false;
    get_template_part("template-parts/hero/hero-archive");
  ?>

    <section class="section bg-white border-top border-bottom d-block d-lg-none">
        <div class="container d-flex justify-content-between align-items-center py-3">
            <h3 class="h6 text-uppercase mb-0 label-filter"><strong><?php _e("Filtri", "design_comuni_italia"); ?></strong></h3>
            <a class="toggle-search-results-mobile toggle-menu menu-search push-body mb-0" href="#" aria-label="filtri">
                <svg class="svg-filters"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-filters"></use></svg>
            </a>
        </div>
    </section>
    <section class="section bg-gray-light">
        <div class="container">
            <div class="row ">
      						<?php if ( have_posts() ) : ?>
        							<?php
        							/* Start the Loop */
        							while ( have_posts() ) :
        								the_post();
                        echo '<div class="col-md-6 col-lg-4 h-100 mb-4">';
                        get_template_part( 'template-parts/focus/cards-list', get_post_type() );
                        echo '</div>';

        							endwhile;
        							?>
                      <nav class="pagination-wrapper justify-content-center col-12">
        								<?php echo dci_bootstrap_pagination(); ?>
                      </nav>
      						<?php
      						else :

        							get_template_part( 'template-parts/content', 'none' );

      						endif;
      						?>
            </div><!-- /row -->
        </div><!-- /container -->
    </section>
</main>

<?php
get_footer();
