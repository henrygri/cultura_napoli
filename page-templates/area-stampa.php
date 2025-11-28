<?php
/* Template Name: Area Stampa
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
			$with_shadow = true;
			$documents = dci_get_meta( 'area_stampa_docs', '_dci_page_', $post->ID );
			$documents = is_array( $documents ) ? $documents : array();
			?>
			<?php get_template_part( 'template-parts/hero/hero' ); ?>
			<section class="py-5">
				<div class="container">
					<div class="row g-5">
						<div class="col-12 col-lg-8">
							<article class="richtext-wrapper">
								<?php the_content(); ?>
							</article>
						</div>
						<div class="col-12 col-lg-4">
							<div class="bg-white border border-light rounded shadow-sm p-4 h-100">
								<h2 class="h4 mb-3"><?php _e( 'Documenti', 'design_comuni_italia' ); ?></h2>
								<?php if ( ! empty( $documents ) ) { ?>
									<div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal">
										<?php
										foreach ( $documents as $document ) {
											$file_url = isset( $document['docs_allegato'] ) ? $document['docs_allegato'] : '';
											if ( empty( $file_url ) ) {
												continue;
											}

											$file_id    = attachment_url_to_postid( $file_url );
											$file_label = ! empty( $document['label_allegato'] ) ? $document['label_allegato'] : '';

											if ( empty( $file_label ) && $file_id ) {
												$file_label = get_the_title( $file_id );
											}

											if ( empty( $file_label ) ) {
												$path       = wp_parse_url( $file_url, PHP_URL_PATH );
												$file_label = $path ? basename( $path ) : __( 'Documento', 'design_comuni_italia' );
											}

											$file_extension = '';
											$file_size      = '';
											$file_path      = $file_id ? get_attached_file( $file_id ) : null;

											if ( $file_path && file_exists( $file_path ) ) {
												$file_extension = strtoupper( pathinfo( $file_path, PATHINFO_EXTENSION ) );
												$file_size      = size_format( filesize( $file_path ), 1 );
											} else {
												$path = wp_parse_url( $file_url, PHP_URL_PATH );
												if ( $path ) {
													$file_extension = strtoupper( pathinfo( $path, PATHINFO_EXTENSION ) );
												}
											}
											$meta_info  = array_filter( array( $file_extension, $file_size ) );
											$aria_label = sprintf( __( 'Scarica %s', 'design_comuni_italia' ), $file_label );
											?>
											<div class="card card-teaser shadow-sm p-4 mt-3 rounded border border-light flex-nowrap">
												<svg class="icon" aria-hidden="true">
													<use xlink:href="#it-clip"></use>
												</svg>
												<div class="card-body">
													<h3 class="card-title h5">
														<a class="text-decoration-none" href="<?php echo esc_url( $file_url ); ?>" aria-label="<?php echo esc_attr( $aria_label ); ?>">
															<?php echo esc_html( $file_label ); ?>
														</a>
													</h3>
													<?php if ( ! empty( $meta_info ) ) { ?>
														<p class="mb-0 small text-secondary">
															<?php echo esc_html( implode( ' · ', $meta_info ) ); ?>
														</p>
													<?php } ?>
												</div>
											</div>
											<?php
										}
										?>
									</div>
								<?php } else { ?>
									<p class="text-secondary mb-0">
										<?php _e( 'Nessun documento disponibile al momento.', 'design_comuni_italia' ); ?>
									</p>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php endwhile; ?>
	</main>
<?php
get_footer();
