<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Design_Comuni_Italia
 */
?>
<?php get_template_part("template-parts/common/search-modal"); ?>

<footer class="it-footer" id="footer">
    <div class="it-footer-main">
        <div class="container">
            <div class="row">
                <div class="col-12 footer-items-wrapper logo-wrapper">
                <img class="ue-logo" src="<?php echo esc_url( get_template_directory_uri()); ?>/assets/img/logo-eu-inverted.svg" alt="logo Unione Europea">
                <div class="it-brand-wrapper">
                  <a href="https://www.comune.napoli.it" class="" data-focus-mouse="false">
                    <svg width="82" height="82" class="icon" aria-hidden="true">
                      <image xlink:href="https://static-www.comune.napoli.it/wp-content/uploads/2024/03/Logo-Napoli.png" width="82" height="82"></image>
                    </svg>
                    <div class="it-brand-text">
                      <h2 class="no_toc">Comune di Napoli</h2>
                    </div>
                  </a>
                </div>
                <div class="it-brand-wrapper">
                  <a href="<?php echo home_url() ?>">
                      <?php get_template_part("template-parts/common/logo");?>
                      <?php /*
                      <div class="it-brand-text">
                          <h2 class="no_toc"><?php echo dci_get_option("nome_comune");?></h2>
                      </div>
                      */ ?>
                  </a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 footer-items-wrapper">
                  <?php
                  $location = "menu-footer-col-1";
                  if ( has_nav_menu( $location ) ) {
                      $theme_locations = get_nav_menu_locations();
                      $menu = get_term( $theme_locations[$location], 'nav_menu' );
                      $menu_count = $menu->count;
                  ?>
                      <h3 class="footer-heading-title">
                        Mappa del sito
                        <?php // echo wp_get_nav_menu_name($location); ?>
                      </h3>
                      <div class="row">
                          <div class="col-md-6">
                          <?php wp_nav_menu(array(
                              "theme_location" => $location,
                              "depth" => 0,
                              "menu_class" => "footer-list",
                              "li_slice" => array(0, ceil($menu_count / 2)),
                              'walker' => new Footer_Menu_Walker()
                          ));?>
                          </div>
                          <div class="col-md-6">
                          <?php wp_nav_menu(array(
                              "theme_location" => $location,
                              "depth" => 0,
                              "menu_class" => "footer-list",
                              "li_slice" => array(ceil($menu_count / 2), $menu_count),
                              'walker' => new Footer_Menu_Walker()
                          ));?>
                          </div>
                      </div>
                  <?php } ?>
              </div>
              <div class="col-md-3 footer-items-wrapper">
                    <?php
                    $location = "menu-footer-col-2";
                    if ( has_nav_menu( $location ) ) { ?>
                        <h3 class="footer-heading-title">
                          Argomenti
                          <?php // echo wp_get_nav_menu_name($location); ?>
                        </h3>
                        <?php wp_nav_menu(array(
                            "theme_location" => $location,
                            "depth" => 0,
                            "menu_class" => "footer-list",
                            'walker' => new Footer_Menu_Walker()
                        ));
                    }
                    ?>
              </div>
              <div class="col-md-3 footer-items-wrapper">
                  <?php
                  $location = "menu-footer-col-3-1";
                  if ( has_nav_menu( $location ) ) { ?>
                      <h3 class="footer-heading-title">
                        Legal
                        <?php // echo wp_get_nav_menu_name($location); ?>
                      </h3>
                      <?php wp_nav_menu(array(
                          "theme_location" => $location,
                          "depth" => 0,
                          "menu_class" => "footer-list",
                          "container_class" => "footer-list",
                          'walker' => new Footer_Menu_Walker()
                      ));
                  }
                  ?>
                  <?php /*
                  $location = "menu-footer-col-3-2";
                  if ( has_nav_menu( $location ) ) { ?>
                      <h3 class="footer-heading-title">
                          <?php echo wp_get_nav_menu_name($location); ?>
                      </h3>
                      <?php wp_nav_menu(array(
                          "theme_location" => $location,
                          "depth" => 0,
                          "menu_class" => "footer-list",
                          'walker' => new Footer_Menu_Walker()
                      ));
                  } */
                  ?>
              </div>
                <div class="col-md-9 mt-md-4 footer-items-wrapper">
                    <h3 class="footer-heading-title">Contatti</h3>
                    <div class="row">
                      <div class="col-md-6">
                        <strong>Area Cultura</strong><br>
                        Sede di Palazzo Cavalcanti<br>
                        Via Toledo 348 - 80134 - Napoli
                      </div>
                      <div class="col-md-6">
                        <br>
                        <strong>Telefono:</strong> 0039 0817955237<br>
                        <strong>E-mail:</strong> area.cultura.turismo@comune.napoli.it
                      </div>
                      <?php /*
                        <div class="col-md-4">
                            <p class="footer-info">
                                <?php echo dci_get_option("nome_comune"); ?>
                                <br /><?php echo dci_get_option("contatti_indirizzo",'footer'); ?>
                                <br /><?php if(dci_get_option("contatti_CF_PIVA",'footer')) echo 'Codice fiscale / P. IVA:' . dci_get_option("contatti_CF_PIVA",'footer'); ?>
                                <br /><br />
                                <?php
                                    $ufficio_id = dci_get_option("contatti_URP",'footer');
                                    $ufficio = get_post($ufficio_id);
                                    if ($ufficio_id) { ?>
                                        <a href="<?php echo get_post_permalink($ufficio_id); ?>" class="list-item" title="Vai alla pagina: URP">
                                            <?php echo $ufficio->post_title ?>
                                        </a>
                                <?php } ?>
                                <?php if(dci_get_option("numero_verde",'footer')) echo '<br />Numero verde: ' . dci_get_option("numero_verde",'footer'); ?>
                                <?php if(dci_get_option("SMS_Whatsapp",'footer')) echo '<br />SMS e WhatsApp: ' . dci_get_option("SMS_Whatsapp",'footer'); ?>
                                <?php
                                    if (dci_get_option("contatti_PEC",'footer')) echo '<br />PEC: '; ?>
                                    <a href="mailto:<?php echo dci_get_option("contatti_PEC",'footer'); ?>" class="list-item" title="PEC <?php echo dci_get_option("nome_comune");?>"><?php echo dci_get_option("contatti_PEC",'footer'); ?></a>
                    								<?php if(dci_get_option("centralino_unico",'footer')) echo '<br />Centralino unico: ' . dci_get_option("centralino_unico",'footer'); ?>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <?php
                            $location = "menu-footer-info-1";
                            if ( has_nav_menu( $location ) ) {
                                wp_nav_menu(array(
                                    "theme_location" => $location,
                                    "depth" => 0,
                                    "menu_class" => "footer-list",
                                    'walker' => new Footer_Menu_Walker()
                                ));
                            }
                            ?>
                        </div>
                        <div class="col-md-4">
                            <?php
                            $location = "menu-footer-info-2";
                            if ( has_nav_menu( $location ) ) {
                                wp_nav_menu(array(
                                    "theme_location" => $location,
                                    "depth" => 0,
                                    "menu_class" => "footer-list",
                                    'walker' => new Footer_Menu_Walker()
                                ));
                            }
                            ?>
                        </div>
                      */ ?>
                    </div>
                </div>
                <div class="col-md-3 mt-md-4 footer-items-wrapper">
                    <?php
                        $socials = dci_get_option('link_social', 'socials');
                        if (is_array($socials) && count($socials)) {
                    ?>
                        <h3 class="footer-heading-title">Seguici su</h3>
                        <ul class="list-inline text-start social">
                            <?php foreach ($socials as $social) { ?>
                                    <li class="list-inline-item">
                                        <a href="<?php echo $social['url_social'] ?>" target="_blank" class="p-2 text-white">
                                            <svg class="icon icon-sm icon-white align-top"><use xmlns:xlink="http://www.w3.org/1999/xlink" href="#<?php echo $social['icona_social'] ?>"></use>
                                            </svg>
                                            <span class="visually-hidden"><?php echo $social['nome_social']; ?></span>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul><!-- /header-social-wrapper -->
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 footer-items-wrapper">
                    <div class="footer-bottom">
						<?php if(dci_get_option("media_policy",'footer')) { ?>
							<a href="<?php echo dci_get_option("media_policy",'footer'); ?>">Media policy</a>
						<?php } ?>
						<?php if(dci_get_option("sitemap",'footer')) { ?>
							<a href="<?php echo dci_get_option("sitemap",'footer'); ?>">Mappa del sito</a>
						<?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.2/color-thief.umd.js"></script>
<script>
// document.addEventListener('DOMContentLoaded', function() {
//     const colorThief = new ColorThief();
//
//     document.querySelectorAll('.card:not(.card-full) img').forEach(img => {
//         if (img.complete) {
//             setColor(img);
//         } else {
//             img.addEventListener('load', () => setColor(img));
//         }
//     });
//
//     function setColor(img) {
//         const rgb = colorThief.getColor(img);
//         const card = img.closest('.card:not(.card-full)');
//         card.style.setProperty('--card-bg', `rgba(${rgb[0]}, ${rgb[1]}, ${rgb[2]}, 0.3)`);
//     }
// });
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const colorThief = new ColorThief();

    document.querySelectorAll('.card:not(.card-full) img').forEach(img => {
        if (img.complete) {
            setColor(img);
        } else {
            img.addEventListener('load', () => setColor(img));
        }
    });

    function setColor(img) {
        const rgb = colorThief.getColor(img); // [r,g,b]
        const hsl = rgbToHsl(rgb[0], rgb[1], rgb[2]);

        // Normalizza la lightness tra 40% e 60%
        hsl.l = Math.max(40, Math.min(70, hsl.l));

        // Normalizza la lightness tra 40% e 60%
        hsl.s = Math.max(0, Math.min(30, hsl.s));

        // Converti di nuovo in rgb
        const rgbNormalized = hslToRgb(hsl.h, hsl.s, hsl.l);

        const card = img.closest('.card:not(.card-full)');
        card.style.setProperty('--card-bg', `rgba(${rgbNormalized.r}, ${rgbNormalized.g}, ${rgbNormalized.b}, 0.3)`);
        // console.log('Colore normalizzato:', rgbNormalized, 'HSL:', hsl);
    }

    // Funzioni di conversione
    function rgbToHsl(r, g, b) {
        r /= 255; g /= 255; b /= 255;
        const max = Math.max(r,g,b), min = Math.min(r,g,b);
        let h, s, l = (max + min) / 2;

        if(max === min){
            h = s = 0; // achromatic
        } else {
            const d = max - min;
            s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
            switch(max){
                case r: h = (g - b) / d + (g < b ? 6 : 0); break;
                case g: h = (b - r) / d + 2; break;
                case b: h = (r - g) / d + 4; break;
            }
            h /= 6;
        }

        return { h: h*360, s: s*100, l: l*100 };
    }

    function hslToRgb(h, s, l) {
        h /= 360; s /= 100; l /= 100;
        let r, g, b;

        if(s === 0){
            r = g = b = l; // achromatic
        } else {
            const hue2rgb = (p, q, t) => {
                if(t < 0) t += 1;
                if(t > 1) t -= 1;
                if(t < 1/6) return p + (q - p) * 6 * t;
                if(t < 1/2) return q;
                if(t < 2/3) return p + (q - p) * (2/3 - t) * 6;
                return p;
            }

            const q = l < 0.5 ? l * (1 + s) : l + s - l * s;
            const p = 2 * l - q;
            r = hue2rgb(p, q, h + 1/3);
            g = hue2rgb(p, q, h);
            b = hue2rgb(p, q, h - 1/3);
        }

        return { r: Math.round(r*255), g: Math.round(g*255), b: Math.round(b*255) };
    }
});
</script>
</body>
</html>
