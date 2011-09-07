<!DOCTYPE html>
<html dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
        <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('fancybox/jquery.fancybox-1.3.4.js') ; ?>"></script>
        <link href="<?php echo osc_current_web_theme_js_url('fancybox/jquery.fancybox-1.3.4.css') ; ?>" rel="stylesheet" type="text/css" />
        <script type="text/javascript">
            $(document).ready(function(){
                $("a[rel=image_group]").fancybox({
                    'transitionIn'		: 'none',
                    'transitionOut'		: 'none',
                    'titlePosition' 	: 'over',
                    'titleFormat'       : function(title, currentArray, currentIndex) {
                        return '<span id="fancybox-title-over"><?php _e('Image', 'modern'); ?>  ' +  (currentIndex + 1) + ' / ' + currentArray.length + ' ' + title + '</span>';
                    }
                });
            });
        </script>
        <?php if( osc_item_is_expired () ) { ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
        <?php } else { ?>
        <meta name="robots" content="index, follow" />
        <meta name="googlebot" content="index, follow" />
        <?php } ?>
    </head>
    <body>
        <?php osc_current_web_theme_path('header.php') ; ?>
        <div class="container margin-top-10">
            <?php twitter_show_flash_message() ; ?>
        </div>
        <div class="container item-detail">
            <div class="row">
                <div class="span16 columns">
                    <h1><?php if( osc_price_enabled_at_items() ) { ?><small><?php echo osc_item_formated_price() ; ?></small> <?php } ?><?php echo osc_item_title(); ?></h1>
                    <p><em><?php if ( osc_item_pub_date() != '' ) echo __('Published date', 'twitter_bootstrap') . ': ' . osc_format_date( osc_item_pub_date() ) ; ?></em></p>
                </div>
            </div>
        </div>
        <?php
            $is_expired     = osc_item_is_expired () ;
            $is_user        = osc_logged_user_id() != osc_item_user_id() ;
            $is_can_contact = osc_reg_user_can_contact() && osc_is_web_user_logged_in() || !osc_reg_user_can_contact() ;
        ?>
        <?php if ( !$is_expired && $is_user && $is_can_contact ) { ?>
        <div class="modal item-contact">
            <form class="form-stacked" action="<?php echo osc_base_url(true) ; ?>" method="post" name="contact_form" id="contact_form" onsubmit="return doContact() ;">
                <input type="hidden" name="action" value="contact_post" />
                <input type="hidden" name="page" value="item" />
                <input type="hidden" name="id" value="<?php echo osc_item_id() ; ?>" />
                <div class="modal-header">
                    <h3><?php _e('Contact publisher', 'twitter_bootstrap') ; ?></h3>
                    <a href="#" class="close">×</a>
                </div>
                <div class="modal-body">
                    <?php osc_prepare_user_info() ; ?>
                    <div class="clearfix">
                        <label for="yourName"><?php _e('Your name', 'twitter_bootstrap') ; ?></label>
                        <div class="input">
                            <input class="xlarge" id="yourName" name="yourName" type="text" value="">
                        </div>
                    </div>
                    <div class="clearfix">
                        <label for="yourEmail"><?php _e('Your e-mail address', 'twitter_bootstrap') ; ?></label>
                        <div class="input">
                            <input class="xlarge" id="yourEmail" name="yourEmail" type="text" value="">
                        </div>
                    </div>
                    <div class="clearfix">
                        <label for="phoneNumber"><?php _e('Phone number', 'twitter_bootstrap') ; ?></label>
                        <div class="input">
                            <input class="xlarge" id="phoneNumber" name="phoneNumber" type="text" value="">
                        </div>
                    </div>
                    <div class="clearfix">
                        <label for="message"><?php _e('Message', 'twitter_bootstrap') ; ?></label>
                        <div class="input">
                            <textarea class="xlarge" id="message" name="message" rows="6"></textarea>
                        </div>
                    </div>
                    <div class="clearfix">
                        <?php osc_show_recaptcha() ; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" type="submit"><?php _e('Send', 'twitter_bootstrap') ; ?></button>
                </div>
            </form>
        </div>
        <?php } ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".item-contact.modal").hide();
            }) ;
        </script>
        <script type="text/javascript">
            var text_error_required = '<?php _e('This field is required', 'twitter_bootstrap') ; ?>' ;
            var text_valid_email    = '<?php _e('Enter a valid e-mail address', 'twitter_bootstrap') ; ?>' ;
        </script>
        <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('item_contact.js') ; ?>"></script>
        <?php osc_current_web_theme_path('footer.php') ; ?>
    </body>
</html>