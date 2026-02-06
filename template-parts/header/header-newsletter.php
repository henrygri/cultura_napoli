<?php $newsletter_url = dci_get_template_page_url('page-templates/newsletter.php') ?: '#'; ?>
<div class="it-user-wrapper nav-item">
    <a class="btn btn-primary btn-icon btn-full" href="<?php echo esc_url($newsletter_url); ?>" aria-label="<?php esc_attr_e('Iscriviti alla newsletter', 'design_comuni_italia'); ?>">
        <svg class="icon icon-white d-none d-lg-block me-1">
          <use xlink:href="#it-mail"></use>
        </svg>
        <span class="d-none d-lg-block">
            Newsletter
        </span>
    </a>
</div>
