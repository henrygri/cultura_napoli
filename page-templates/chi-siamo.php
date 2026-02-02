<?php
/* Template Name: Chi siamo
 *
 * Area Stampa template file
 *
 * @package Design_Comuni_Italia
 */
global $post, $with_shadow;

get_header();
?>
	<main>
		<?php
		while ( have_posts() ) :
			the_post();
			$with_shadow = false;
			$documents = dci_get_meta( 'area_stampa_docs', '_dci_page_', $post->ID );
			$documents = is_array( $documents ) ? $documents : array();
			?>
			<div class="bg-100 pb-5">
				<?php get_template_part( 'template-parts/hero/hero' ); ?>
				<div class="container">
					<div class="row">
						<div class="col-12 col-lg-8 offset-lg-4">
							<article class="richtext-wrapper">
								<?php the_content(); ?>
							</article>
						</div>
					</div>
				</div>
			</div>

			<?php
			$array_of_pages = get_posts([
					'title' => 'Gli spazi della cultura',
					'post_type' => 'any',
			]);
			$id = $array_of_pages[0];//Be sure you have an array with single post or page
			$id = $id->ID;
			$link = get_permalink($id);
			?>
			<section class="py-5 bg-200">
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
				</div>
			</section>

			<section class="py-5">
				<div class="container">
					<div class="row g-5">
						<div class="col-12 col-lg-8">
							<h2>Aree Tematiche</h2>
						</div>
					</div>
				</div>
			</section>
			<?php get_template_part("template-parts/common/bolli-argomenti"); ?>

			<section class="py-5 bg-100">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<h2>Bandi e Gare</h2>
						</div>
					</div>
				</div>
			</section>


		<?php endwhile; ?>
	</main>
<?php
get_footer();
