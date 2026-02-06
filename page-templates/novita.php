<?php
/* Template Name: Novità
 *
 * novita template file
 *
 * @package Design_Comuni_Italia
 */
global $post, $with_shadow;
$search_url = esc_url( home_url( '/' ));

get_header();
?>
	<main>
		<?php
		while ( have_posts() ) :
			the_post();

			$with_shadow = false;
			?>
			<div class="bg-100">
			<?php get_template_part("template-parts/hero/hero"); ?>
			<?php get_template_part("template-parts/novita/evidenza"); ?>
			</div>
			<?php get_template_part("template-parts/novita/tutte-novita"); ?>
			<?php get_template_part("template-parts/novita/argomenti"); ?>
		<?php
			endwhile; // End of the loop.
		?>
	</main>

<?php
get_footer();
