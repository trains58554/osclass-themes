<?php
    if( Params::getParam("action_specific") != '' ) {
        switch( Params::getParam("action_specific") ) {
            case('upload_logo'):
                $package = Params::getFiles("logo") ;
                if ($package['error'] == UPLOAD_ERR_OK) {
                    if( move_uploaded_file($package['tmp_name'], WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
                        osc_add_flash_ok_message( __('The logo image has been uploaded correctly', 'twitter_bootstrap'), 'admin') ;
                    } else {
                        osc_add_flash_error_message( __("An error has occurred, please try again", 'twitter_bootstrap'), 'admin') ;
                    }
                } else {
                    osc_add_flash_error_message( __("An error has occurred, please try again", 'twitter_bootstrap'), 'admin') ;
                }
            break ;
            case('remove'):
                if( file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
                    unlink( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ;
                    osc_add_flash_ok_message( __('The logo image has been removed', 'twitter_bootstrap'), 'admin') ;
                } else {
                    osc_add_flash_error_message( __("Image not found", 'twitter_bootstrap'), 'admin') ;
                }
            break ;
        }
    }

    osc_show_flash_message('admin') ;
?>
<div id="settings_form" style="border: 1px solid #ccc; background: #eee; ">
    <div style="padding: 20px;">
        <?php if( is_writable( WebThemes::newInstance()->getCurrentThemePath() . "images/") )  { ?>
        <p style="border-bottom: 1px black solid;padding-bottom: 10px;">
            <img style="padding-right: 10px;"src="<?php echo osc_current_admin_theme_url('images/info-icon.png') ; ?>"/>
            <?php _e('The preferred size of the logo is 600x100', 'twitter_bootstrap') ; ?>.
            <?php if( file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) { ?>
            <strong><?php _e('Note: Uploading another logo will overwrite current logo', 'twitter_bootstrap') ; ?>.</strong>
            <?php } ?>
        </p>
        <form action="<?php echo osc_admin_render_theme_url('oc-content/themes/twitter_bootstrap/admin/admin_settings.php') ; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action_specific" value="upload_logo" />
            <p>
                <label for="package"><?php _e('Logo image', 'twitter_bootstrap') ; ?> (png,gif,jpg)</label>
                <input type="file" name="logo" id="package" />
            </p>
            <input id="button_save" type="submit" value="<?php _e('Upload', 'twitter_bootstrap') ; ?>" />
        </form>
        <div>
            <?php if(file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {?>
            <p>
                <?php _e('Preview', 'twitter_bootstrap') ; ?>:<br>
                <img border="0" alt="<?php echo osc_page_title() ; ?>" src="<?php echo osc_current_web_theme_url('images/logo.jpg') ; ?>"/>
                <form action="<?php echo osc_admin_render_theme_url('oc-content/themes/twitter_bootstrap/admin/admin_settings.php') ; ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action_specific" value="remove" />
                    <input id="button_remove" type="submit" value="<?php _e('Remove logo', 'twitter_bootstrap') ; ?>" />
                </form>
            </p>
            <?php } else { ?>
                <p><?php _e('Has not uploaded any logo image', 'twitter_bootstrap') ; ?></p>
            <?php } ?>
        </div>
        <div style="clear: both;"></div>
        <?php } else { ?>
        <div id="flash_message">
            <p>
                <?php
                    $msg  = sprintf(__('The images folder %s is not writable on your server', 'twitter_bootstrap'), WebThemes::newInstance()->getCurrentThemePath() ."images/" ) . ", " ;
                    $msg .= __('OSClass can\'t upload logo image from the administration panel', 'twitter_bootstrap') . '. ' ;
                    $msg .= __('Please make the mentioned images folder writable', 'twitter_bootstrap') . '.' ;
                    echo $msg;
                ?>
            </p>
            <p>
                <?php _e('To make a directory writable under UNIX execute this command from the shell', 'twitter_bootstrap') ; ?>:
            </p>
            <p style="background-color: white; border: 1px solid black; padding: 8px;">
                chmod a+w <?php echo WebThemes::newInstance()->getCurrentThemePath() . "images/" ; ?>
            </p>
        </div>
        <?php } ?>
    </div>
</div>