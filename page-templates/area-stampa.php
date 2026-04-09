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
											$doc_type = ! empty( $document['docs_tipo'] ) ? $document['docs_tipo'] : 'file';
											$file_url = ( 'link' === $doc_type ) ? ( $document['docs_link'] ?? '' ) : ( $document['docs_allegato'] ?? '' );

											if ( empty( $file_url ) ) {
												continue;
											}

											$file_id    = ( 'file' === $doc_type ) ? attachment_url_to_postid( $file_url ) : 0;
											$file_label = ! empty( $document['label_allegato'] ) ? $document['label_allegato'] : '';

											if ( empty( $file_label ) && $file_id ) {
												$file_label = get_the_title( $file_id );
											}

											if ( empty( $file_label ) ) {
												$path       = wp_parse_url( $file_url, PHP_URL_PATH );
												$file_label = $path ? basename( $path ) : __( 'Documento', 'design_comuni_italia' );
											}

											$upload_date = $file_id ? get_the_date( 'd/m/Y', $file_id ) : '';

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
											<a class="card card-teaser shadow-sm p-4 mt-3 rounded border border-light flex-nowrap no-hover" <?php echo ( 'file' === $doc_type ) ? 'download' : ''; ?> target="_blank" href="<?php echo esc_url( $file_url ); ?>" aria-label="<?php echo esc_attr( $aria_label ); ?>">
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

							<hr class="my-5">

							<div class="p-5 border rounded-3 mt-4 mb-5">
								<script async type='text/javascript' src='https://app.emailchef.com/mcwebscript/7o226163636s756r745s6964223n22383231363636227q'></script>

								<form method="POST" action="https://app.emailchef.com/signupwl/7o22666s726q5s6964223n2237343833227q/it" id="form1">
									<div class="mb-3">
										<h4 class="mc-header mb-4">Iscriviti alla newsletter <br>per gli operatori della Stampa</h4>
									</div>
									<div class="mb-3">
										<label style=""  class="mc-label">Nome<span class="mc-asterisk">*</span></label>
										<input value="" style="" class="mc-inputfield" id="field-2" name="field[-2]" type="text">
									</div>
									<div class="mb-3">
										<label style=""  class="mc-label">Cognome<span class="mc-asterisk">*</span></label>
										<input value="" style="" class="mc-inputfield" id="field-3" name="field[-3]" type="text">
									</div>
									<div class="mb-3">
										<label style=""  class="mc-label">E-mail<span class="mc-asterisk">*</span></label>
										<input value="" style="" class="mc-inputfield" id="field-1" name="field[-1]" type="email">
									</div>
									<div class="mb-3">
										<label style="" class="mc-label">Testata giornalistica<span class="mc-asterisk">*</span></label>
										<input value="" style="" class="mc-inputfield" id="field210094" name="field[210094]" type="text">
									</div>
									<div class="mb-3">
										<label style="" class="mc-label">Telefono</label>
										<input value="" style="" class="mc-inputfield" id="field210098" name="field[210098]" type="number">
									</div>
									<div class="mb-3">
										<p class="mc-privacy">
											<input value="1" class="mc-inputfield" name="field[-4]" type="checkbox" required > Dichiaro di aver letto e compreso la <a href="https://cultura.comune.napoli.it/informativa-privacy/" target="_blank">Privacy Policy.</a><span class="mc-asterisk">*</span>
										</p>
									</div>
									<div class="mb-3">
										<p class="mc-terms">
											<input value="1" class="mc-inputfield" name="field[-5]" type="checkbox" required > Acconsento al trattamento dei miei dati personali per la finalità di invio della newsletter.<span class="mc-asterisk">*</span>
										</p>
									</div>
									<div class="mb-3">
										<input type="submit" class="btn btn-primary mc-signup-button" id="mc-signup-form-button-submit" name="mc-signup-form-button-submit" value="Iscriviti" style="">
									</div>
									<input type="hidden" name="form_id" value="7483" />
									<input type="hidden" name="lang" value="" />
									<input type="hidden" name="referrer" id="ec_referrer" value="" />
									<div id="ec_recaptcha"></div>
								</form>
								<script src="https://app.emailchef.com/signup/form.js/7o22666s726q5s6964223n2237343833227q/it/api"></script>
								<script src="https://www.google.com/recaptcha/api.js?onload=renderRecaptcha&render=explicit"></script>

								<style>
								#form1 .label { width: 100%; }
								#form1 input[type="text"],
								#form1 input[type="number"],
								#form1 input[type="email"] { width: 100%; }
								#form1 input[type="checkbox"] {-webkit-appearance: checkbox !important; }
								#form1 select { width: 100%; height: 3em; margin: .5em 0 0; }
								</style>

							</div>



						</div>
					</div>
				</div>
			</section>
		<?php endwhile; ?>
	</main>
<?php
get_footer();
