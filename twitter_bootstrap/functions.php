<?php

    function chosen_select_standard() {
        View::newInstance()->_exportVariableToView('categories', Category::newInstance()->toTree() ) ;
        
        if( osc_count_categories() > 0 ) {
            echo '<select name="sCategory" data-placeholder="' . __('Select a category...', 'twitter_bootstrap') . '" style="width: auto;" class="chzn-select"">' ;
            echo '<option></option>' ;
            while( osc_has_categories() ) {
                echo '<option value="' . osc_category_name() . '">' . osc_category_name() . '</option>' ;
                if( osc_count_subcategories() > 0 ) {
                    while( osc_has_subcategories() ) {
                        echo '<option value="' . osc_category_name() . '">&nbsp;&nbsp;&nbsp;&nbsp;' . osc_category_name() . '</option>' ;
                    }
                }
            }
            echo '</select>' ;
        }
        
        View::newInstance()->_erase('categories') ;
    }
    
    function chosen_select_optgroup() {
        View::newInstance()->_exportVariableToView('categories', Category::newInstance()->toTree() ) ;
        
        if( osc_count_categories() > 0 ) {
            echo '<select name="sCategory" data-placeholder="' . __('Select a category...', 'twitter_bootstrap') . '" style="width: auto;" class="chzn-select"">' ;
            echo '<option></option>' ;
            while( osc_has_categories() ) {
                echo '<optgroup label="' . osc_category_name() . '">' ;
                if( osc_count_subcategories() > 0 ) {
                    while( osc_has_subcategories() ) {
                        echo '<option value="' . osc_category_name() . '">' . osc_category_name() . '</option>' ;
                    }
                }
                echo '</optgroup>' ;
            }
            echo '</select>' ;
        }
        
        View::newInstance()->_erase('categories') ;
    }

    function chosen_region_select() {
        View::newInstance()->_exportVariableToView('list_regions', Search::newInstance()->listRegions('%%%%', '>=', 'region_name ASC') ) ;
        
        if( osc_count_list_regions() > 0 ) {
            echo '<select name="sRegion" style="width: 200px;" class="chzn-select"">' ;
            echo '<option>' . __('Select a region...', 'twitter_bootstrap') . '</option>' ;
            while( osc_has_list_regions() ) {
                echo '<option value="' . osc_list_region_name() . '">' . osc_list_region_name() . '</option>' ;
            }
            echo '</select>' ;
        }
        
        View::newInstance()->_erase('list_regions') ;
    }

    if( !function_exists('twitter_show_flash_message') ) {
        function twitter_show_flash_message() {
            $message = Session::newInstance()->_getMessage('pubMessages') ;

            if (isset($message['msg']) && $message['msg'] != '') {
                if( $message['type'] == 'ok' ) $message['type'] = 'success' ;
                echo '<div class="alert-message ' . $message['type'] . '">' ;
                echo '<a class="close" href="#">×</a>';
                echo '<p>' . $message['msg'] . '</p>';
                echo '</div>' ;

                Session::newInstance()->_dropMessage('pubMessages') ;
            }
        }
    }

    if ( !function_exists('twitter_user_menu') ) {
        function twitter_user_menu( ) {
            $options = array();
            $options[] = array('name' => __('Dashboard', 'twitter_bootstrap'), 'url' => osc_user_dashboard_url(), 'class' => osc_is_user_dashboard() ? 'active opt_dashboard' : 'opt_dashboard' ) ;
            $options[] = array('name' => __('Manage your items', 'twitter_bootstrap'), 'url' => osc_user_list_items_url(), 'class' => osc_is_user_manage_items() ? 'active opt_items' : 'opt_items') ;
            $options[] = array('name' => __('Manage your alerts', 'twitter_bootstrap'), 'url' => osc_user_alerts_url(), 'class' => osc_is_user_manage_alerts() ? 'active opt_alerts' : 'opt_alerts') ;
            $options[] = array('name' => __('My account', 'twitter_bootstrap'), 'url' => osc_user_profile_url(), 'class' => osc_is_user_profile() ? 'active opt_dashboard' : 'opt_account' ) ;

            echo '<ul class="tabs">' ;

            $var_l = count($options) ;
            for($var_o = 0 ; $var_o < $var_l ; $var_o++) {
                echo '<li class="' . $options[$var_o]['class'] . '" ><a href="' . $options[$var_o]['url'] . '" >' . $options[$var_o]['name'] . '</a></li>' ;
            }

            osc_run_hook('user_menu') ;
            echo '</ul>' ;
        }
    }

    if ( !function_exists('osc_is_user_dashboard') ) {
        function osc_is_user_dashboard() {
            $location = Rewrite::newInstance()->get_location();
            $section  = Rewrite::newInstance()->get_section();
            if( $location == 'user' && $section == 'dashboard' ) {
                return true;
            }
            return false;
        }
    }

    if ( !function_exists('osc_is_user_manage_items') ) {
        function osc_is_user_manage_items() {
            $location = Rewrite::newInstance()->get_location();
            $section  = Rewrite::newInstance()->get_section();
            if( $location == 'user' && $section == 'items' ) {
                return true;
            }
            return false;
        }
    }

    if ( !function_exists('osc_is_user_manage_alerts') ) {
        function osc_is_user_manage_alerts() {
            $location = Rewrite::newInstance()->get_location();
            $section  = Rewrite::newInstance()->get_section();
            if( $location == 'user' && $section == 'alerts' ) {
                return true;
            }
            return false;
        }
    }

    if ( !function_exists('osc_is_user_profile') ) {
        function osc_is_user_profile() {
            $location = Rewrite::newInstance()->get_location();
            $section  = Rewrite::newInstance()->get_section();
            if( $location == 'user' && ( $section == 'profile' || $section == 'change_password' || $section == 'change_email' ) ) {
                return true;
            }
            return false;
        }
    }

    if( !function_exists('add_logo_header') ) {
        function add_logo_header() {
            $title = osc_page_title() ;
            $logo  = osc_current_web_theme_url('images/logo.jpg') ;
            $js   = <<<JAVASCRIPT
                <script>
                    var title = '$title' ;
                    var logo  = '$logo' ;
                    var img   = $("<img>").attr('border', '0').attr('alt', '$title').attr('title', '$title').attr('src', '$logo') ;
                    $(document).ready(function () {
                        $('.logo').html(img) ;
                    });
                </script>
JAVASCRIPT;

             if( file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
                echo $js ;
             }
        }

        osc_add_hook("header", "add_logo_header") ;
    }

    if( !function_exists('twitter_admin_menu') ) {
        function twitter_admin_menu() {
            echo '<h3><a href="#">' . __('Twitter theme','twitter_bootstrap') . '</a></h3>
            <ul>
                <li><a href="' . osc_admin_render_theme_url('oc-content/themes/twitter_bootstrap/admin/admin_settings.php') . '">&raquo; ' . __('Settings theme', 'twitter_bootstrap') . '</a></li>
            </ul>' ;
        }

        osc_add_hook('admin_menu', 'twitter_admin_menu') ;
    }
    
    if( !function_exists('meta_title') ) {
        function meta_title( ) {
            $location = Rewrite::newInstance()->get_location() ;
            $section  = Rewrite::newInstance()->get_section() ;

            switch ($location) {
                case ('item'):
                    switch ($section) {
                        case 'item_add':    $text = __('Publish an item', 'twitter_bootstrap') . ' - ' . osc_page_title() ; break ;
                        case 'item_edit':   $text = __('Edit your item', 'twitter_bootstrap') . ' - ' . osc_page_title() ; break ;
                        case 'send_friend': $text = __('Send to a friend', 'twitter_bootstrap') . ' - ' . osc_item_title() . ' - ' . osc_page_title() ; break ;
                        case 'contact':     $text = __('Contact seller', 'twitter_bootstrap') . ' - ' . osc_item_title() . ' - ' . osc_page_title() ; break ;
                        default:            $text = osc_item_title() . ' - ' . osc_page_title() ; break ;
                    }
                break ;
                case('page'):
                    $text = osc_static_page_title() . ' - ' . osc_page_title() ;
                break ;
                case('error'):
                    $text = __('Error', 'twitter_bootstrap') . ' - ' . osc_page_title() ;
                break ;
                case('search'):
                    $region   = Params::getParam('sRegion') ;
                    $city     = Params::getParam('sCity') ;
                    $pattern  = Params::getParam('sPattern') ;
                    $category = osc_search_category_id() ;
                    $category = ((count($category) == 1) ? $category[0] : '') ;
                    $s_page   = '' ;
                    $i_page   = Params::getParam('iPage') ;

                    if($i_page != '' && $i_page > 0) {
                        $s_page = __('page', 'twitter_bootstrap') . ' ' . ($i_page + 1) . ' - ' ;
                    }

                    $b_show_all = ($region == '' && $city == '' & $pattern == '' && $category == '') ;
                    $b_category = ($category != '') ;
                    $b_pattern  = ($pattern != '') ;
                    $b_city     = ($city != '') ;
                    $b_region   = ($region != '') ;

                    if($b_show_all) {
                        $text = __('Show all items', 'twitter_bootstrap') . ' - ' . $s_page . osc_page_title() ;
                    }

                    $result = '' ;
                    if($b_pattern) {
                        $result .= $pattern . ' &raquo; ' ;
                    }

                    if($b_category) {
                        $list        = array() ;
                        $aCategories = Category::newInstance()->toRootTree($category) ;
                        if(count($aCategories) > 0) {
                            foreach ($aCategories as $single) {
                                $list[] = $single['s_name'] ;
                            }
                            $result .= implode(' &raquo; ', $list) . ' &raquo; ' ;
                        }
                    }

                    if($b_city) {
                        $result .= $city . ' &raquo; ' ;
                    }

                    if($b_region) {
                        $result .= $region . ' &raquo; ' ;
                    }

                    $result = preg_replace('|\s?&raquo;\s$|', '', $result) ;

                    if($result == '') {
                        $result = __('Search', 'twitter_bootstrap') ;
                    }

                    $text = $result . ' - ' . $s_page . osc_page_title() ;
                break ;
                case('login'):
                    switch ($section) {
                        case('recover'): $text = __('Recover your password', 'twitter_bootstrap') . ' - ' . osc_page_title() ;
                        default:         $text = __('Login', 'twitter_bootstrap') . ' - ' . osc_page_title() ;
                    }
                break ;
                case('register'):
                    $text = __('Create a new account', 'twitter_bootstrap') . ' - ' . osc_page_title() ;
                break ;
                case('user'):
                    switch ($section) {
                        case('dashboard'):       $text = __('Dashboard', 'twitter_bootstrap') . ' - ' . osc_page_title() ; break ;
                        case('items'):           $text = __('Manage my items', 'twitter_bootstrap') . ' - ' . osc_page_title() ; break ;
                        case('alerts'):          $text = __('Manage my alerts', 'twitter_bootstrap') . ' - ' . osc_page_title() ; break ;
                        case('profile'):         $text = __('Update my profile', 'twitter_bootstrap') . ' - ' . osc_page_title() ; break ;
                        case('change_email'):    $text = __('Change my email', 'twitter_bootstrap') . ' - ' . osc_page_title() ; break ;
                        case('change_password'): $text = __('Change my password', 'twitter_bootstrap') . ' - ' . osc_page_title() ; break ;
                        case('forgot'):          $text = __('Recover my password', 'twitter_bootstrap') . ' - ' . osc_page_title() ; break ;
                        default:                 $text = osc_page_title() ; break ;
                    }
                break ;
                case('contact'):
                    $text = __('Contact','twitter_bootstrap') . ' - ' . osc_page_title() ;
                break ;
                default:
                    $text = osc_page_title() ;
                break ;
            }
            
            $text = str_replace('"', "'", $text) ;
            return ($text) ;
         }
     }

     if( !function_exists('meta_description') ) {
         function meta_description( ) {
            $location = Rewrite::newInstance()->get_location() ;
            $section  = Rewrite::newInstance()->get_section() ;
            $text     = '' ;

            switch ($location) {
                case ('item'):
                    switch ($section) {
                        case 'item_add':    $text = '' ; break ;
                        case 'item_edit':   $text = '' ; break ;
                        case 'send_friend': $text = '' ; break ;
                        case 'contact':     $text = '' ; break ;
                        default:
                            $text = osc_item_category() . ', ' . osc_highlight(strip_tags(osc_item_description()), 140) . '..., ' . osc_item_category() ;
                            break;
                    }
                break;
                case('page'):
                    $text = osc_highlight(strip_tags(osc_static_page_text()), 140) ;
                break;
                case('search'):
                    $result = '' ;

                    if( osc_count_items() == 0 ) {
                        $text = '' ;
                    }

                    if( osc_has_items () ) {
                        $result = osc_item_category() . ', ' . osc_highlight(strip_tags(osc_item_description()), 140) . '..., ' . osc_item_category() ;
                    }

                    osc_reset_items() ;
                    $text = $result ;
                case(''): // home
                    $result = '' ;

                    if(osc_count_latest_items() == 0) {
                        $text = '' ;
                    }

                    if(osc_has_latest_items()) {
                        $result = osc_item_category() . ', ' . osc_highlight(strip_tags(osc_item_description()), 140) . '..., ' . osc_item_category() ;
                    }

                    osc_reset_items() ;
                    $text = $result ;
                break ;
            }
            
            $text = str_replace('"', "'", $text) ;
            return ($text) ;
         }
     }

     class TwitterPagination extends Pagination
     {
        public function __construct($params = null) {
            parent::__construct($params);
        }

        public function get_links()
        {
            $pages = $this->get_pages();
            $links = array();

            if(isset($pages['prev'])) {
                $links[] = '<li class="' . $this->class_prev . '"><a href="' . str_replace('{PAGE}', $pages['prev'], str_replace(urlencode('{PAGE}'), $pages['prev'], $this->url)) . '">' . $this->text_prev . '</a></li>';
            }

            foreach($pages['pages'] as $p) {
                if($p==$this->selected) {
                    $links[] = '<li class="' . $this->class_selected . '"><a href="' . str_replace('{PAGE}', $p, str_replace(urlencode('{PAGE}'), $p, $this->url)) . '">' . ($p + 1) . '</a></li>';
                } else {
                    $links[] = '<li class="' . $this->class_non_selected . '"><a href="' . str_replace('{PAGE}', $p, str_replace(urlencode('{PAGE}'), $p, $this->url)) . '">' . ($p + 1) . '</a></li>';
                }
            }

            if(isset($pages['next'])) {
                $links[] = '<li class="' . $this->class_next . '"><a href="' . str_replace('{PAGE}', $pages['next'], str_replace(urlencode('{PAGE}'), $pages['next'], $this->url)) . '">' . $this->text_next . '</a></li>';
            }

            return $links;
        }
     }

?>