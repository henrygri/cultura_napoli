<?php
global $the_query, $load_posts, $load_card_type;

    $max_posts = isset($_GET['max_posts']) ? $_GET['max_posts'] : 12;
    $load_posts = 12;
    $query = isset($_GET['search']) ? dci_removeslashes($_GET['search']) : null;
    $date_from = isset($_GET['date_from']) ? sanitize_text_field($_GET['date_from']) : '';
    $date_to = isset($_GET['date_to']) ? sanitize_text_field($_GET['date_to']) : '';
    $accessibile = isset($_GET['accessibile']) && $_GET['accessibile'];
    $argomenti_options = dci_get_terms_options('argomenti');
    $argomenti_ids = array_keys((array)$argomenti_options);
    $argomenti_selected = isset($_GET['argomenti']) ? array_map('intval', (array)$_GET['argomenti']) : array();
    $target_options = dci_get_terms_options('target');
    $target_ids = array_keys((array)$target_options);
    $target_selected = isset($_GET['target']) ? array_map('intval', (array)$_GET['target']) : array();
    $quartieri_parents = get_terms(array(
        'taxonomy' => 'quartieri',
        'parent'   => 0,
        'hide_empty' => false,
    ));
    $quartieri_selected = isset($_GET['quartieri']) ? array_map('intval', (array)$_GET['quartieri']) : array();

    $date_from_ts = $date_from ? strtotime($date_from) : null;
    $date_to_ts = $date_to ? strtotime($date_to . ' 23:59:59') : null;

    $meta_query = array(
        'relation' => 'AND',
        array(
            'relation' => 'OR',
            array(
                'key'     => '_dci_evento_rassegna',
                'value'   => 'on',
                'compare' => '!=', // Prende quelli diversi da "on"
            ),
            array(
                'key'     => '_dci_evento_rassegna',
                'compare' => 'NOT EXISTS', // Prende quelli senza il meta
            ),
        ),
    );

    if ( $date_from_ts ) {
        $meta_query[] = array(
            'key'     => '_dci_evento_data_orario_fine',
            'value'   => $date_from_ts,
            'compare' => '>=',
            'type'    => 'NUMERIC',
        );
    }

    if ( $date_to_ts ) {
        $meta_query[] = array(
            'key'     => '_dci_evento_data_orario_inizio',
            'value'   => $date_to_ts,
            'compare' => '<=',
            'type'    => 'NUMERIC',
        );
    }

    if ( $accessibile ) {
        $meta_query[] = array(
            'key'     => '_dci_evento_accessibile',
            'value'   => 'on',
            'compare' => '=',
        );
    }

    $tax_query = array();
    if ( ! empty( $argomenti_selected ) ) {
        $tax_query[] = array(
            'taxonomy' => 'argomenti',
            'field'    => 'term_id',
            'terms'    => $argomenti_selected,
            'operator' => 'IN',
        );
    }
    if ( ! empty( $target_selected ) ) {
        $tax_query[] = array(
            'taxonomy' => 'target',
            'field'    => 'term_id',
            'terms'    => $target_selected,
            'operator' => 'IN',
        );
    }
    if ( ! empty( $quartieri_selected ) ) {
        $tax_query[] = array(
            'taxonomy' => 'quartieri',
            'field'    => 'term_id',
            'terms'    => $quartieri_selected,
            'operator' => 'IN',
        );
    }
    if ( ! empty( $tax_query ) ) {
        $tax_query['relation'] = 'AND';
    }

    $args = array(
        's' => $query,
        'posts_per_page' => $max_posts,
        'post_type'      => 'evento',
    		'post_status'    => 'publish',
        // Filtra: escludi eventi con rassegna flaggato e applica intervallo date
        'meta_query'   => $meta_query,
        'tax_query'    => $tax_query,
        // Ordina per data di inizio crescente
        'meta_key' => '_dci_evento_data_orario_inizio',
        'orderby'  => 'meta_value_num',
        'order'    => 'DESC'
    );
    $the_query = new WP_Query( $args );

    $posts = $the_query->posts;

?>


<div class="py-5">
    <form role="search" id="search-form" method="get" class="search-form">
        <button type="submit" class="d-none"></button>
        <div class="container">
            <input type="hidden" name="date_from" id="filter-date-from-hidden" value="<?php echo esc_attr($date_from); ?>">
            <input type="hidden" name="date_to" id="filter-date-to-hidden" value="<?php echo esc_attr($date_to); ?>">
            <input type="hidden" name="accessibile" id="filter-accessibile-hidden" value="<?php echo $accessibile ? '1' : ''; ?>">
            <div id="argomenti-hidden-inputs">
                <?php foreach ( $argomenti_selected as $selected_id ) { ?>
                    <input type="hidden" name="argomenti[]" value="<?php echo esc_attr($selected_id); ?>">
                <?php } ?>
            </div>
            <div id="target-hidden-inputs">
                <?php foreach ( $target_selected as $selected_id ) { ?>
                    <input type="hidden" name="target[]" value="<?php echo esc_attr($selected_id); ?>">
                <?php } ?>
            </div>
            <div id="quartieri-hidden-inputs">
                <?php foreach ( $quartieri_selected as $selected_id ) { ?>
                    <input type="hidden" name="quartieri[]" value="<?php echo esc_attr($selected_id); ?>">
                <?php } ?>
            </div>
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-3">
                <h2 class="title-xlarge mb-0">
                    Esplora tutti gli eventi
                </h2>
                <button
                    type="button"
                    class="btn btn-sm btn-outline btn-round"
                    data-bs-toggle="modal"
                    data-bs-target="#modal-filtri-eventi"
                    aria-controls="modal-filtri-eventi"
                >
                    <svg class="icon icon-sm" aria-hidden="true">
                        <use href="#it-funnel"></use>
                    </svg>
                    <span class="ms-2">Filtra eventi</span>
                </button>
            </div>
            <div>
                <div class="cmp-input-search">
                    <div class="form-group autocomplete-wrapper mb-0">
                        <?php /*
                        <div class="input-group">
                            <label for="autocomplete-two" class="visually-hidden">Cerca</label>
                            <input type="search" class="autocomplete form-control" placeholder="Cerca per parola chiave"
                                id="autocomplete-two" name="search" value="<?php echo esc_attr($query); ?>"
                                data-bs-autocomplete="[]" />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" id="button-3">
                                    Invio
                                </button>
                            </div>
                            <span class="autocomplete-icon" aria-hidden="true"><svg class="icon icon-sm icon-primary"
                                    role="img" aria-labelledby="autocomplete-label">
                                    <use href="#it-search"></use>
                                </svg>
                            </span>
                        </div>
                        */ ?>
                        <p id="autocomplete-label" class="u-grey-light text-paragraph-card mt-2 mb-30 mt-lg-3 mb-lg-40 border-top border-dark pt-2">
                            <?php echo $the_query->found_posts; ?> eventi trovati
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-4" id="load-more">
                <?php
                foreach ( $posts as $post ) {
                    $load_card_type = 'evento';
                    get_template_part('template-parts/evento/card');
                }
                ?>
            </div>
            <?php get_template_part("template-parts/search/more-results"); ?>
        </div>
    </form>
</div>
<div
    class="modal it-dialog-scrollable fade"
    id="modal-filtri-eventi"
    tabindex="-1"
    role="dialog"
    aria-labelledby="modal-filtri-eventi-title"
>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title h5 mb-0" id="modal-filtri-eventi-title">
                    Filtra eventi
                </h2>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Chiudi finestra filtri"
                ></button>
            </div>
            <div class="modal-body">
                <div class="events-filter-form">
                  <div class="row">
                    <button type="button" data-bs-toggle="collapse" data-bs-target="#search_date" aria-expanded="false" aria-controls="search_date">
                      <h3 class="h6 mb-0">Date</h6>
                    </button>
                    <div class="collapse" id="search_date">
                      <div class="row mx-0 pb-4">
                        <div class="col-12 col-md-6">
                          <div class="date-selector">
                            <label class="form-label" for="filter-date-from">Dal</label>
                            <input
                                type="date"
                                id="filter-date-from"
                                class="form-control"
                                value="<?php echo esc_attr($date_from); ?>"
                                aria-label="Data inizio intervallo"
                            />
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="date-selector">
                            <label class="form-label" for="filter-date-to">Al</label>
                            <input
                                type="date"
                                id="filter-date-to"
                                class="form-control"
                                value="<?php echo esc_attr($date_to); ?>"
                                aria-label="Data fine intervallo"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <button type="button" data-bs-toggle="collapse" data-bs-target="#search_argomenti" aria-expanded="false" aria-controls="search_argomenti">
                      <h3 class="h6 mb-0">Argomenti</h6>
                    </button>
                    <div class="collapse" id="search_argomenti">
                      <div class="row mx-0 pb-3">
                          <div class="col-12">
                              <div class="d-flex flex-wrap">
                                  <?php
                                  if ( is_array( $argomenti_ids ) ) {
                                      foreach ( $argomenti_ids as $arg_id ) {
                                          $argomento = get_term_by('id', $arg_id, 'argomenti');
                                          if ( ! $argomento ) {
                                              continue;
                                          }
                                          $is_checked = in_array( $arg_id, $argomenti_selected );
                                          ?>
                                          <input
                                              type="checkbox"
                                              class="btn-check"
                                              id="argomento-<?php echo esc_attr($arg_id); ?>"
                                              value="<?php echo esc_attr($arg_id); ?>"
                                              <?php echo $is_checked ? 'checked' : ''; ?>
                                              data-argomento-checkbox
                                          />
                                          <label
                                              class="chip chip-simple"
                                              for="argomento-<?php echo esc_attr($arg_id); ?>"
                                          >
                                              <span class="chip-label"><?php echo esc_html( $argomento->name ); ?></span>
                                          </label>
                                          <?php
                                      }
                                  }
                                  ?>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <button type="button" data-bs-toggle="collapse" data-bs-target="#search_target" aria-expanded="false" aria-controls="search_target">
                      <h3 class="h6 mb-0">Adatto a</h6>
                    </button>
                    <div class="collapse" id="search_target">
                      <div class="row mx-0 pb-3">
                        <div class="col-12">
                            <div class="d-flex flex-wrap">
                                <?php
                                if ( is_array( $target_ids ) ) {
                                    foreach ( $target_ids as $target_id ) {
                                        $target_term = get_term_by('id', $target_id, 'target');
                                        if ( ! $target_term ) {
                                            continue;
                                        }
                                        $is_checked_target = in_array( $target_id, $target_selected );
                                        ?>
                                        <input
                                            type="checkbox"
                                            class="btn-check"
                                            id="target-<?php echo esc_attr($target_id); ?>"
                                            value="<?php echo esc_attr($target_id); ?>"
                                            <?php echo $is_checked_target ? 'checked' : ''; ?>
                                            data-target-checkbox
                                        />
                                        <label
                                            class="chip chip-simple"
                                            for="target-<?php echo esc_attr($target_id); ?>"
                                        >
                                            <span class="chip-label"><?php echo esc_html( $target_term->name ); ?></span>
                                        </label>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <button type="button" data-bs-toggle="collapse" data-bs-target="#search_quartieri" aria-expanded="false" aria-controls="search_quartieri">
                      <h3 class="h6 mb-0">Municipalità e quartieri</h6>
                    </button>
                    <div class="collapse" id="search_quartieri">
                      <div class="accordion" id="accordion-municipalita">
                          <?php
                          if ( ! empty( $quartieri_parents ) && ! is_wp_error( $quartieri_parents ) ) {
                              $idx = 0;
                              foreach ( $quartieri_parents as $parent_term ) {
                                  $idx++;
                                  $collapse_id = 'collapse-muni-' . $idx;
                                  $heading_id = 'heading-muni-' . $idx;
                                  $children = get_terms(array(
                                      'taxonomy' => 'quartieri',
                                      'parent'   => $parent_term->term_id,
                                      'hide_empty' => false,
                                  ));
                                  ?>
                                  <div class="accordion-item">
                                      <div class="accordion-header" id="<?php echo esc_attr($heading_id); ?>">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr($collapse_id); ?>" aria-expanded="false" aria-controls="<?php echo esc_attr($collapse_id); ?>">
                                              <?php echo esc_html( $parent_term->name ); ?>
                                          </button>
                                      </div>
                                      <div id="<?php echo esc_attr($collapse_id); ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo esc_attr($heading_id); ?>" data-bs-parent="#accordion-municipalita">
                                          <div class="accordion-body py-2">
                                              <div class="row g-2">
                                                  <?php
                                                  if ( ! empty( $children ) && ! is_wp_error( $children ) ) {
                                                      foreach ( $children as $child ) {
                                                          $is_checked_quartiere = in_array( $child->term_id, $quartieri_selected );
                                                          ?>
                                                          <div class="col-12">
                                                              <div class="form-check">
                                                                  <input
                                                                      class="form-check-input"
                                                                      type="checkbox"
                                                                      id="quartiere-<?php echo esc_attr($child->term_id); ?>"
                                                                      value="<?php echo esc_attr($child->term_id); ?>"
                                                                      <?php echo $is_checked_quartiere ? 'checked' : ''; ?>
                                                                      data-quartiere-checkbox
                                                                  />
                                                                  <label class="form-check-label" for="quartiere-<?php echo esc_attr($child->term_id); ?>">
                                                                      <?php echo esc_html( $child->name ); ?>
                                                                  </label>
                                                              </div>
                                                          </div>
                                                          <?php
                                                      }
                                                  } else {
                                                      ?>
                                                      <span class="text-muted small">Nessun quartiere disponibile.</span>
                                                      <?php
                                                  }
                                                  ?>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <?php
                              }
                          } else {
                              ?>
                              <p class="text-muted small mb-0">Nessuna municipalità disponibile.</p>
                          <?php
                          }
                          ?>
                      </div>
                    </div>
                  </div>

                  <div class="row accessibility">
                    <div class="col ps-0">
                      <h3 class="h6 mb-0">Consigliato per accessibilità</h3>
                    </div>
                    <div class="col-auto pe-0">
                        <div class="form-check form-check-inline mb-0">
                          <div class="toggles">
                            <label for="filter-accessibile">
                              <span class="visually-hidden">Mostra solo eventi consigliati per accessibilità</span>
                              <input
                                type="checkbox"
                                role="switch"
                                id="filter-accessibile"
                                <?php echo $accessibile ? 'checked' : ''; ?>
                                >
                              <span class="lever"></span>
                            </label>
                          </div>
                        </div>
                    </div>
                  </div>

                </div>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-outline-secondary me-auto"
                    data-bs-dismiss="modal"
                    aria-label="Chiudi modale Filtri"
                >
                    Chiudi
                </button>
                <button
                    type="button"
                    class="btn btn-primary"
                    id="apply-date-filters"
                >
                    Applica filtri
                </button>
            </div>
        </div>
    </div>
</div>
<style>
.modal-body { padding: 0 !important; }
@media (min-width: 768px) {
  .modal.it-dialog-scrollable .modal-dialog { margin: 0 0 0 auto; }
}
@media (min-width: 992px) {
  .modal-lg, .modal-xl { --bs-modal-width: 600px; }
}
.modal.it-dialog-scrollable .modal-dialog .modal-content { height: calc(100vh); }
@media (min-width: 768px) {
  .modal.it-dialog-scrollable .modal-dialog .modal-content { height: calc(100vh); }
}
</style>
<script>
    (function() {
        const applyBtn = document.getElementById('apply-date-filters');
        const form = document.getElementById('search-form');
        const fromInput = document.getElementById('filter-date-from');
        const toInput = document.getElementById('filter-date-to');
        const hiddenFrom = document.getElementById('filter-date-from-hidden');
        const hiddenTo = document.getElementById('filter-date-to-hidden');
        const accessibileSwitch = document.getElementById('filter-accessibile');
        const accessibileHidden = document.getElementById('filter-accessibile-hidden');
        const argomentoHiddenContainer = document.getElementById('argomenti-hidden-inputs');
        const targetHiddenContainer = document.getElementById('target-hidden-inputs');
        const quartieriHiddenContainer = document.getElementById('quartieri-hidden-inputs');

        if (applyBtn && form) {
            applyBtn.addEventListener('click', function() {
                if (hiddenFrom && fromInput) hiddenFrom.value = fromInput.value || '';
                if (hiddenTo && toInput) hiddenTo.value = toInput.value || '';
                if (accessibileHidden && accessibileSwitch) {
                    accessibileHidden.value = accessibileSwitch.checked ? '1' : '';
                }
                if (argomentoHiddenContainer) {
                    argomentoHiddenContainer.innerHTML = '';
                    const checkboxes = document.querySelectorAll('[data-argomento-checkbox]');
                    checkboxes.forEach(function(cb) {
                        if (cb.checked) {
                            const hidden = document.createElement('input');
                            hidden.type = 'hidden';
                            hidden.name = 'argomenti[]';
                            hidden.value = cb.value;
                            argomentoHiddenContainer.appendChild(hidden);
                        }
                    });
                }
                if (targetHiddenContainer) {
                    targetHiddenContainer.innerHTML = '';
                    const targetCheckboxes = document.querySelectorAll('[data-target-checkbox]');
                    targetCheckboxes.forEach(function(cb) {
                        if (cb.checked) {
                            const hidden = document.createElement('input');
                            hidden.type = 'hidden';
                            hidden.name = 'target[]';
                            hidden.value = cb.value;
                            targetHiddenContainer.appendChild(hidden);
                        }
                    });
                }
                if (quartieriHiddenContainer) {
                    quartieriHiddenContainer.innerHTML = '';
                    const quartieriCheckboxes = document.querySelectorAll('[data-quartiere-checkbox]');
                    quartieriCheckboxes.forEach(function(cb) {
                        if (cb.checked) {
                            const hidden = document.createElement('input');
                            hidden.type = 'hidden';
                            hidden.name = 'quartieri[]';
                            hidden.value = cb.value;
                            quartieriHiddenContainer.appendChild(hidden);
                        }
                    });
                }
                form.submit();
            });
        }
    })();
</script>
<?php wp_reset_query(); ?>
