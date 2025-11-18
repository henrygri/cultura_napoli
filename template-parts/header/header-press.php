<?php
$current_user = wp_get_current_user();
# use get_user_meta to all data

$last_notification = get_user_meta($current_user->ID,"_dci_last_notification", true);

// $link_notification = get_permalink($last_notification);

// if($last_notification){
    ?>
    <!-- <div class="header-notification-alert has-notifications">
        <a href="<?#php echo $link_notification; ?>" aria-label="Notifiche">
            <svg class="svg-bell-solid"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-bell-solid"></use></svg>
        </a>
    </div>
    /header-notification-alert -->

<?php
// }

?>

<div class="it-user-wrapper nav-item">
    <a class="btn btn-primary btn-icon btn-full" href="#">
        <svg class="icon icon-white d-none d-lg-block">
          <use xlink:href="#it-inbox"></use>
        </svg>
        <span class="d-none d-lg-block">
            Area stampa
        </span>
    </a>
</div>
