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
			$with_shadow = false;
			$documents = dci_get_meta( 'area_stampa_docs', '_dci_page_', $post->ID );
			$documents = is_array( $documents ) ? $documents : array();
			?>
			<?php get_template_part( 'template-parts/hero/hero' ); ?>
			<section class="pb-5">
				<div class="container">
					<div class="row g-5">
						<div class="col-12 col-lg-8">
							<article class="richtext-wrapper">
								<?php the_content(); ?>
								<?php if ( ! empty( $documents ) ) { ?>
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

											if ( $file_id ) {
											    $upload_date = get_the_date( 'd/m/Y', $file_id );
											} else {
											    $upload_date = '';
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
											$meta_info  = array_filter( array( $file_extension, $file_size, $upload_date ? "File caricato il $upload_date" : '' ) );
											$aria_label = sprintf( __( 'Scarica %s', 'design_comuni_italia' ), $file_label );
											?>
											<a class="card card-teaser shadow-sm p-4 mt-3 rounded border border-light flex-nowrap" download target="_blank" href="<?php echo esc_url( $file_url ); ?>" aria-label="<?php echo esc_attr( $aria_label ); ?>">
												<svg class="icon" aria-hidden="true">
													<use xlink:href="#it-clip"></use>
												</svg>
												<div class="card-body">
													<h3 class="card-title h5"><?php echo esc_html( $file_label ); ?></h3>
													<?php if ( ! empty( $meta_info ) ) { ?>
														<p class="mb-0 small text-secondary">
															<?php echo esc_html( implode( ' · ', $meta_info ) ); ?>
														</p>
													<?php } ?>
												</div>
											</a>
										<?php } ?>
								<?php } else { ?>
									<p class="text-secondary mb-0">
										<?php _e( 'Nessun documento disponibile al momento.', 'design_comuni_italia' ); ?>
									</p>
								<?php } ?>

							</article>
						</div>
					</div>
				</div>
			</section>
		<?php endwhile; ?>
	</main>
<?php
get_footer();
