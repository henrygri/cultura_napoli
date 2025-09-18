<?php
/* Template Name: amministrazione
 *
 * amministrazione template file
 *
 * @package Design_Comuni_Italia
 */
global $post;
get_header();

?>
	<main>
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<?php get_template_part("template-parts/hero/hero"); ?>
			<?php get_template_part("template-parts/amministrazione/evidenza"); ?>
			<?php get_template_part("template-parts/amministrazione/cards-list"); ?>
							
		<?php 
			endwhile; // End of the loop.
		?>
	</main>

<?php
get_footer();



