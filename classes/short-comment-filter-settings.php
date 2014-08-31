<?php


class Short_Comment_Filter_Settings {

    /**
     * Class initialization function
     * @static
     * @return void
     */
    static function start() {
        add_action( 'admin_menu', array( __CLASS__, 'add_short_comment_filter_settings_page' ) );
        add_action( 'admin_init', array( __CLASS__, 'admin_init' ) );
    }

    static function admin_init() {
        // Register option names to whitelist them
        $general_options = array( 'shortfilter_filter_type', 'shortfilter_filter_users',
                                  'shortfilter_default_action', 'shortfilter_js_check' );
        $short_comment_options = array( 'shortfilter_min_enable', 'shortfilter_min_count', 'shortfilter_message' );
        $long_comment_options = array( 'shortfilter_max_enable', 'shortfilter_max_count', 'shortfilter_max_message' );

        foreach ( array( $general_options, $short_comment_options, $long_comment_options ) as $option_names ) {
            foreach ( $option_names as $option_name ) {
                register_setting( 'shortfilter-options', $option_name );
            }
        }
    }

    /*
     * Add the filter settings page. Called on admin_init
     */
    public static function add_short_comment_filter_settings_page() {
        add_options_page( 'Short Comment Filter Settings', 'Short Comment Filter', 'moderate_comments', basename( __FILE__ ), array( __CLASS__, 'show_settings_page' ) );
    }

    static function show_settings_page() {
        Short_Comment_Filter::show_view( 'settings' );
    }

    /*
     * Get the filter type (word or character length)
     */
    static function get_filter_type() {
        return get_option('shortfilter_filter_type', 'words');
    }

    /*
     * Output the filter type
     */
    static function filter_type() {
        echo self::get_filter_type();
    }

    /*
     * Get whether to enable minimum comment length check
     */
    static function get_min_enable() {
        return get_option('shortfilter_min_enable', 'on');
    }

    /*
     * Output whether to enable minimum comment length check
     */
    static function min_enable() {
        echo self::get_min_enable();
    }

    /*
     * Get whether to enable minimum comment length check
     */
    static function get_max_enable() {
        return get_option('shortfilter_max_enable', '');
    }

    /*
     * Output whether to enable minimum comment length check
     */
    static function max_enable() {
        echo self::get_max_enable();
    }

    /*
     * Get the minimum accepted count.
     */
    static function get_min_count() {
        return get_option('shortfilter_min_count', 5);
    }

    /*
     * Output the minimum accepted count.
     */
    static function min_count() {
        echo self::get_min_count();
    }

    /*
     * Get whether to enable maximum comment length check
     */
    static function get_max_count() {
        return get_option('shortfilter_max_count', 1000);
    }

    /*
     * Output whether to enable maximum comment length check
     */
    static function max_count() {
        echo self::get_max_count();
    }

    /*
     * Get the default filter action (either spam or delete).
     */
    static function get_default_action() {
        return get_option('shortfilter_default_action', 'spam');
    }

    /*
     * Output the default filter action.
     */
    static function default_action() {
        echo self::get_default_action();
    }

    /*
     * Get whether registered users are filtered.
     */
    static function get_filter_users() {
        return get_option('shortfilter_filter_users', '');
    }

    /*
     * Output whether to filter registered users' comments.
     */
    static function filter_users() {
        echo self::get_filter_users();
    }

    /*
     * Get whether to check comment length on client side via JavaScript
     */
    static function get_js_check() {
        return get_option('shortfilter_js_check', '');
    }

    /*
     * Output whether to check comment length client side via JavaScript
     */
    static function js_check() {
        echo self::get_js_check();
    }

    /*
     * Get Short Filtered Comment Message
     */
    static function get_short_comment_message(){
        return get_option('shortfilter_message', __('Comment must be at least %length% %type% long'));
    }

    /*
     * Output Short Filtered Comment Message
     */
    static function short_comment_message(){
        echo self::get_short_comment_message();
    }

    /*
     * Get Long Filtered Comment Message
     */
    static function get_long_comment_message(){
        return get_option('shortfilter_max_message', __('Comment can be at most %length% %type% long'));
    }

    /*
     * Output Long Filtered Comment Message
     */
    static function long_comment_message(){
        echo self::get_long_comment_message();
    }

    /*
     * Get filtered comment count
     */
    static function get_filtered_comment_count() {
        return intval(get_option('shortfilter_comment_count', 0));
    }

    /*
     * Output filtered comment count
     */
    static function filtered_comment_count() {
        echo self::get_filtered_comment_count();
    }

    /*
     * Increment Filtered Comment Count
     */
    static function increment_filtered_comment_count(){
        update_option('shortfilter_comment_count', self::get_filtered_comment_count() + 1);
    }
}