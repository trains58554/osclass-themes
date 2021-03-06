<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()) ; ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
        <!-- only item-post.php -->
        <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('jquery.validate.min.js') ; ?>"></script>
        <?php ItemForm::location_javascript_new(); ?>
        <?php if(osc_images_enabled_at_items()) ItemForm::photos_javascript(); ?>
        <!-- end only item-post.php -->
    </head>
    <body>
        <div class="containerbg">
            <div class="container">
                <?php osc_current_web_theme_path('header.php') ; ?>
                <div class="content add_item">
                    <h1><strong><?php _e('Publish an item', 'bcute') ; ?></strong></h1>
                    <ul id="error_list"></ul>
                    <form name="item" action="<?php echo osc_base_url(true);?>" method="post" enctype="multipart/form-data">
                        <fieldset>
                        <input type="hidden" name="action" value="item_add_post" />
                        <input type="hidden" name="page" value="item" />
                            <div class="box general_info">
                                <h2><?php _e('General Information', 'bcute') ; ?></h2>
                                <div class="row">
                                    <label for="catId"><?php _e('Category', 'bcute') ; ?> *</label>
                                    <?php ItemForm::category_select(null, null, __('Select a category', 'bcute')) ; ?>
                                </div>
                                <div class="row">
                                    <?php ItemForm::multilanguage_title_description() ; ?>
                                </div>
                            </div>
                            <?php if( osc_price_enabled_at_items() ) { ?>
                            <div class="box price">
                                <label for="price"><?php _e('Price', 'bcute'); ?></label>
                                <?php ItemForm::price_input_text(); ?>
                                <?php ItemForm::currency_select(); ?>
                            </div>
                            <?php } ?>
                            <?php if( osc_images_enabled_at_items() ) { ?>
                            <div class="box photos">
                                <h2><?php _e('Photos', 'bcute'); ?></h2>
                                <div id="photos">
                                    <div class="row">
                                        <input type="file" name="photos[]" />
                                    </div>
                                </div>
                                <a href="#" onclick="addNewPhoto(); return false;"><?php _e('Add new photo', 'bcute'); ?></a>
                            </div>
                            <?php } ?>

                            <div class="box location">
                                <h2><?php _e('Item Location', 'bcute'); ?></h2>
                                <div class="row">
                                    <label for="countryId"><?php _e('Country', 'bcute'); ?></label>
                                    <?php ItemForm::country_select(osc_get_countries(), osc_user()) ; ?>
                                </div>
                                <div class="row">
                                    <label for="regionId"><?php _e('State', 'bcute'); ?></label>
                                    <?php ItemForm::region_text(osc_user()) ; ?>
                                </div>
                                <div class="row">
                                    <label for="city"><?php _e('City', 'bcute'); ?></label>
                                    <?php ItemForm::city_text(osc_user()) ; ?>
                                </div>
                                <div class="row">
                                    <label for="city"><?php _e('City Area', 'bcute'); ?></label>
                                    <?php ItemForm::city_area_text(osc_user()) ; ?>
                                </div>
                                <div class="row">
                                    <label for="address"><?php _e('Address', 'bcute'); ?></label>
                                    <?php ItemForm::address_text(osc_user()) ; ?>
                                </div>
                            </div>
                            <!-- seller info -->
                            <?php if(!osc_is_web_user_logged_in() ) { ?>
                            <div class="box seller_info">
                                <h2><?php _e('Seller\'s information', 'bcute'); ?></h2>
                                <div class="row">
                                    <label for="contactName"><?php _e('Name', 'bcute'); ?></label>
                                    <?php ItemForm::contact_name_text() ; ?>
                                </div>
                                <div class="row">
                                    <label for="contactEmail"><?php _e('E-mail', 'bcute'); ?> *</label>
                                    <?php ItemForm::contact_email_text() ; ?>
                                </div>
                                <div class="row">
                                    <div style="width: 120px;text-align: right;float:left;">
                                        <?php ItemForm::show_email_checkbox() ; ?>
                                    </div>
                                    <label for="showEmail" style="width: 250px;"><?php _e('Show e-mail on the item page', 'bcute'); ?></label>
                                </div>
                            </div>
                            <?php } ?>
                            <?php ItemForm::plugin_post_item(); ?>
                            <?php if( osc_recaptcha_items_enabled() ) {?>
                            <div class="box">
                                <div class="row">
                                    <?php osc_show_recaptcha(); ?>
                                </div>
                            </div>
                            <?php }?>
                            <div class="clear"></div>
                            <button  type="submit"><?php _e('Publish', 'bcute'); ?></button>
                        </fieldset>
                     </form>
                </div>
            </div>
            <?php osc_current_web_theme_path('footer.php') ; ?>
        </div>
        <?php osc_show_flash_message() ; ?>
        <?php osc_run_hook('footer') ; ?>
    </body>
</html>