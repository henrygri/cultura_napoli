<?php
/* Template Name: Newsletter
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
			?>
			<?php get_template_part( 'template-parts/hero/hero' ); ?>
			<section class="pb-5">
				<div class="container">
					<div class="row g-5">
						<div class="col-12 col-lg-8">
							<article class="richtext-wrapper">
								<?php the_content(); ?>

								<div class="p-5 border rounded-3 mt-4 mb-5">
									<script async type='text/javascript' src='https://app.emailchef.com/mcwebscript/7o226163636s756r745s6964223n22383231363636227q'></script>

									<form method="POST" action="https://app.emailchef.com/signupwl/7o22666s726q5s6964223n2237343835227q/it" id="form1">
										<div class="mb-3">
											<h4 class="mc-header">Iscriviti alla newsletter</h4>
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
										<div class="mb-3 pb-3">
											<label style="" class="mc-label">Fascia d'età (anni)</label>
											<!-- you can set the default values by adding the mc-select class in the <select></select> tag -->
											<select style="" class="mc-inputfield mc-select" id="field210162" name="field[210162]" >
											<option  value="18 - 25">18 - 25</option>
											<option  value="26 - 40">26 - 40</option>
											<option  value="41 - 60">41 - 60</option>
											<option  value="60 +">60 +</option>
											</select>
										</div>
										<div class="mb-3">
											<label style="" class="mc-label">Città di residenza<span class="mc-asterisk">*</span></label>
											<input value="" style="" class="mc-inputfield" id="field210161" name="field[210161]" type="text">
										</div>
										<div class="mb-3 pb-3">
											<p class="mc-footer">Desidero ricevere aggiornamenti su eventi e iniziative di*</p>
											<input value="" style="" class="mc-inputfield" id="field212532" name="field[212532]" type="checkbox">
											<label style="" class="mc-label me-3">Arte</label>
											<input value="0" style="" class="mc-inputfield" id="field212533" name="field[212533]" type="checkbox">
											<label style="" class="mc-label me-3">Cinema</label>
											<input value="0" style="" class="mc-inputfield" id="field212534" name="field[212534]" type="checkbox">
											<label style="" class="mc-label me-3">Danza</label>
											<input value="0" style="" class="mc-inputfield" id="field212535" name="field[212535]" type="checkbox">
											<label style="" class="mc-label me-3">Letteratura</label>
											<input value="0" style="" class="mc-inputfield" id="field212536" name="field[212536]" type="checkbox">
											<label style="" class="mc-label me-3">Musica</label>
											<input value="0" style="" class="mc-inputfield" id="field212537" name="field[212537]" type="checkbox">
											<label style="" class="mc-label me-3">Teatro</label>
										</div>
										<div class="mb-3">
											<p class="mc-privacy">
												<input value="1" class="mc-inputfield" name="field[-4]" type="checkbox" required > Dichiaro di aver letto e compreso la <a href="https://cultura.comune.napoli.it/informativa-privacy/" target="_blank">Privacy Policy.</a><span class="mc-asterisk">*</span>
											</p>
										</div>
										<div class="mb-3">
											<p class="mc-newsletter">
												<input value="1" class="mc-inputfield" name="field[-6]" type="checkbox" required > Acconsento al trattamento dei miei dati personali per la finalità di invio della newsletter.<span class="mc-asterisk">*</span>
											</p>
										</div>
										<div class="mb-3">
											<input type="submit" class="btn btn-primary mc-signup-button" id="mc-signup-form-button-submit" name="mc-signup-form-button-submit" value="Iscriviti" style="">
										</div>
										<input type="hidden" name="form_id" value="7485" />
										<input type="hidden" name="lang" value="" />
										<input type="hidden" name="referrer" id="ec_referrer" value="" />
										<div id="ec_recaptcha"></div>
									</form>
									<script src="https://app.emailchef.com/signup/form.js/7o22666s726q5s6964223n2237343835227q/it/api"></script>
									<script src="https://www.google.com/recaptcha/api.js?onload=renderRecaptcha&render=explicit"></script>

									<style>
									#form1 .label { width: 100%; }
									#form1 input[type="text"],
									#form1 input[type="email"] { width: 100%; }
									#form1 input[type="checkbox"] {-webkit-appearance: checkbox !important; }
									#form1 select { width: 100%; height: 3em; margin: .5em 0 0; }
									</style>

								</div>

								<div class="card p-5 rounded-3 my-5 no-pop no-glow no-hover no-after bg-200">
									<h4>Lavori nel settore cultura/eventi?</h4>
									<p>Iscriviti alla nostra newsletter dedicata agli operatori: uno spazio pensato per chi crea, organizza e promuove cultura. Riceverai contenuti selezionati, aggiornamenti utili, segnalazioni di eventi e strumenti concreti per il tuo lavoro.</p>
									<a class="btn btn-md btn-primary" href="https://cultura.comune.napoli.it/newsletter-operatori/">Iscriviti alla newsletter operatori</a>
								</div>


							</article>
						</div>
					</div>
				</div>
			</section>
		<?php endwhile; ?>
	</main>
<?php
get_footer();
