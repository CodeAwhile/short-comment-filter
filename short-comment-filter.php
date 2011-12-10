<?php
/*

Plugin Name: Short Comment Filter
Plugin URI: http://www.itsananderson.com/plugins/short-comment-filter
Description: Automatically Spams or Deletes comments that don't meet a specified length requirement.
Author: Will Anderson
Version: 2.2
Author URI: http://www.itsananderson.com/
*/

class Short_Comment_Filter {

    const VERSION = '2.2';

    /**
     * Function for initializing this class
     * @static
     * @return void
     */
    public static function start() {
        add_filter( 'preprocess_comment',array( __CLASS__, 'filter_short_comments' ) );
        add_action( 'get_header', array( __CLASS__, 'maybe_add_js_check' ) );
    }

    /*
     * Filter applied to comments.
     * Removes comments that don't meet a specific length requirement.
     */
    public static function filter_short_comments($comment) {
        if ( self::filter_comment_check($comment) ) {
            Short_Comment_Filter_Settings::increment_filtered_comment_count();
            self::filter_short_comment($comment);
        }
        return $comment;
    }

    /*
     * Check whether the comment should be filtered.
     */
    public static function filter_comment_check($comment) {
        // Only filter registered users if that option is enabled
        if ( $comment['user_ID'] && !Short_Comment_Filter_Settings::get_filter_users() ) return false;
        if ( $comment['comment_type'] ) return false; // don't filter trackbacks
        $comment_content = preg_replace('/\s+/', ' ', $comment['comment_content']);
        $filter_type = Short_Comment_Filter_Settings::get_filter_type();
        if ( 'words' == $filter_type ) {
            $words = explode(' ', $comment_content);
            return count($words) < Short_Comment_Filter_Settings::get_min_count();
        }
        if ( 'characters' == $filter_type ) {
            return strlen($comment_content) < Short_Comment_Filter_Settings::get_min_count();
        }
        return false;
    }

    /*
     * At the end of the request, remove the comment.
     */
    public static function filter_short_comment() {

        // Leaving room for more actions
        switch ( Short_Comment_Filter_Settings::get_default_action() ){
            case 'delete':
                $type = Short_Comment_Filter_Settings::get_filter_type();
                $length = Short_Comment_Filter_Settings::get_min_count();
                $message = Short_Comment_Filter_Settings::get_short_comment_message();
                $message = str_replace('%type%', $type, $message);
                $message = str_replace('%length%', $length, $message);
                wp_die($message);
            case 'spam':
            default: // default to spam
                add_filter('pre_comment_approved', create_function('$a', 'return \'spam\';'));
        }

    }

    /*
     * If JavaScript checking is enabled, queue the script and add the variable settings via wp_localize_script
     */
    public static function maybe_add_js_check(){
        if ( Short_Comment_Filter_Settings::get_js_check() == 'on' &&
             ( !is_user_logged_in() || Short_Comment_Filter_Settings::get_filter_users() == 'on' ) ) {
            $data = array(
                'filter_type' => Short_Comment_Filter_Settings::get_filter_type(),
                'min_count' => Short_Comment_Filter_Settings::get_min_count(),
                'filter_message' => preg_replace('/[\r\n]+/', '\r\n', addslashes( Short_Comment_Filter_Settings::get_short_comment_message() ) )
            );
            wp_enqueue_script( 'short-comment-filter', plugins_url( 'short-comment-filter.js', __FILE__ ),
                               array( 'jquery', 'jquery-form' ), self::VERSION );
            wp_localize_script( 'short-comment-filter', 'short_comment_settings', $data );
        }
    }

    /**
     * Utility function for showing a plugin view
     * @param $view
     * @param array $args
     * @return void
     */
    public static function show_view( $view, $args = array() ) {
        $view_path = plugin_dir_path( __FILE__ ) . "views/$view.php";
        if ( file_exists( $view_path ) ) {
            extract( $args );
            include $view_path;
        } else {
            echo "View '$view' does not exist";
        }
    }
}

include plugin_dir_path( __FILE__ ) . 'classes/short-comment-filter-settings.php';

Short_Comment_Filter::start();
Short_Comment_Filter_Settings::start();