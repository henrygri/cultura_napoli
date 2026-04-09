<?php
/* Template Name: Newsletter Operatori
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


									<form method="POST" action="https://app.emailchef.com/signupwl/7o22666s726q5s6964223n2237343834227q/it" id="form1">
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
											<label style="" class="mc-label">Settore di appartenenza<span class="mc-asterisk">*</span></label>
											<!-- you can set the default values by adding the mc-select class in the <select></select> tag -->
											<select style="" class="mc-inputfield mc-select" id="field210155" name="field[210155]" >
												<option  value="Musica">Musica</option>
												<option  value="Teatro">Teatro</option>
												<option  value="Danza">Danza</option>
												<option  value="Cinema e Audiovisivo">Cinema e Audiovisivo</option>
												<option  value="Arti Visive">Arti Visive</option>
												<option  value="Editoria e Letteratura">Editoria e Letteratura</option>
												<option  value="Beni Culturali">Beni Culturali</option>
												<option  value="Altro">Altro</option>
											</select>
										</div>
										<div class="mb-3">
											<label style="" class="mc-label">Se hai selezionato "Altro", specifica quale</label>
											<input value="" style="" class="mc-inputfield" id="field210156" name="field[210156]" type="text">
										</div>
										<div class="mb-3">
											<p class="mc-privacy"><input value="1" class="mc-inputfield" name="field[-4]" type="checkbox" required > Dichiaro di aver letto e compreso la <a href="#" target="_blank">Privacy Policy.</a><span class="mc-asterisk">*</span></p>
										</div>
										<div class="mb-3">
											<p class="mc-newsletter"><input value="1" class="mc-inputfield" name="field[-6]" type="checkbox" required > Acconsento al trattamento dei miei dati personali per la finalità di invio della newsletter.<span class="mc-asterisk">*</span></p>
										</div>
										<div class="mb-3">
											<input type="submit" class="btn btn-primary mc-signup-button" id="mc-signup-form-button-submit" name="mc-signup-form-button-submit" value="Iscriviti" style="">
										</div>
										<input type="hidden" name="form_id" value="7484" />
										<input type="hidden" name="lang" value="" />
										<input type="hidden" name="referrer" id="ec_referrer" value="" />
										<div id="ec_recaptcha"></div>
									</form>
									<script src="https://app.emailchef.com/signup/form.js/7o22666s726q5s6964223n2237343834227q/it/api"></script>
									<script src="https://www.google.com/recaptcha/api.js?onload=renderRecaptcha&render=explicit"></script>


									<style>
									#form1 .label { width: 100%; }
									#form1 input[type="text"],
									#form1 input[type="email"] { width: 100%; }
									#form1 input[type="checkbox"] {-webkit-appearance: checkbox !important; }
									#form1 select { width: 100%; height: 3em; margin: .5em 0 0; }
									</style>

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
