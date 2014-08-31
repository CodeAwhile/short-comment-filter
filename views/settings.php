<div class="wrap">
    <h2>Short Comment Filter Settings</h2>
    <p>
        Comments Filtered: <?php Short_Comment_Filter_Settings::filtered_comment_count() ?> (Doesn't count comments filtered with JavaScript)
    </p>
    <form method="post" action="options.php">
        <?php settings_fields('shortfilter-options'); ?>
        <h3 class="title"><?php _e( 'General Settings'); ?></h3>
        <table class="form-table">
            <tr>
                <th scope="row"><label for="shortfilter_filter_type"><?php _e( 'Filter Type' ); ?></label></th>
                <td>
                    <select id="shortfilter_filter_type" name="shortfilter_filter_type">
                        <?php
                            $filter_type = Short_Comment_Filter_Settings::get_filter_type();
                            $filter_types = array('words' => __( 'Word Count' ), 'characters' => __( 'Character Count' ) );
                            foreach ( $filter_types as $filter_item => $filter_name ) {
                                echo '<option value="' . $filter_item . ($filter_item == $filter_type ? '" selected="selected' : '' ) . '" >' . $filter_name . "</option>\n";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="shortfilter_default_action"><?php _e( 'Default Filter Action' ); ?></label></th>
                <td>
                    <select id="shortfilter_default_action" name="shortfilter_default_action">
                        <?php
                            $default_action = Short_Comment_Filter_Settings::get_default_action();
                            $default_actions = array('delete' => __( 'Delete Comment' ), 'spam' => __( 'Spam Comment' ) );
                            foreach ( $default_actions as $action_name => $action_title ) {
                                echo '<option value="' . $action_name . ($default_action == $action_name ? '" selected="selected' : '') . '" >' . $action_title . "</option>\n";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="shortfilter_filter_users"><?php _e( 'Filter Registered Users' ); ?></label></th>
                <td><input type="checkbox" id="shortfilter_filter_users" name="shortfilter_filter_users" <?php echo Short_Comment_Filter_Settings::get_filter_users() == 'on' ? 'checked="checked"' : ''?> /></td>
            </tr>
            <tr>
                <th scope="row"><label for="shortfilter_js_check"><?php _e( 'Check Length With JavaScript' ); ?></label></th>
                <td><input type="checkbox" id="shortfilter_js_check" name="shortfilter_js_check" <?php echo Short_Comment_Filter_Settings::get_js_check() == 'on' ? 'checked="checked"' : ''?> /></td>
            </tr>
        </table>
        <h3 class="title"><?php _e( 'Short Comment Settings'); ?></h3>
        <table class="form-table">
            <tr>
                <th scope="row"><label for="shortfilter_min_enable"><?php _e( 'Filter Short Comments' ); ?></label></th>
                <td><input type="checkbox" id="shortfilter_min_enable" name="shortfilter_min_enable" <?php echo Short_Comment_Filter_Settings::get_min_enable() == 'on' ? 'checked="checked"' : ''?> /></td>
            </tr>
            <tr>
                <th scope="row"><label for="shortfilter_min_count"><?php _e( 'Minimum Count' ); ?></label></th>
                <td><input type="text" id="shortfilter_min_count" name="shortfilter_min_count" value="<?php Short_Comment_Filter_Settings::min_count() ?>" /></td>
            </tr>
            <tr>
                <th scope="row"><label for="shortfilter_message"><?php _e( 'Short Comment Message' ); ?></label></th>
                <td><textarea id="shortfilter_message" name="shortfilter_message" rows="3" cols="50" ><?php echo htmlentities( Short_Comment_Filter_Settings::get_short_comment_message(), ENT_QUOTES ) ?></textarea></td>
            </tr>
            <tr>
                <th scope="row"><?php _e( 'Message Instructions' ); ?></th>
                <td>
                    <?php _e( 'The following variables will be replaced dynamically with their corresponding values:' ); ?><br />
                    <ul>
                        <li><?php _e( '<strong>%type%</strong> - value of Filter Type (\'words\' or \'characters\')' ); ?></li>
                        <li><?php _e( '<strong>%length%</strong> - value of Minimum Count'); ?></li>
                    </ul>
                </td>
            </tr>
        </table>
        <h3 class="title"><?php _e( 'Long Comment Settings'); ?></h3>
        <table class="form-table">
            <tr>
                <th scope="row"><label for="shortfilter_max_enable"><?php( 'Filter Short Comments' ); ?></label></th>
                <td><input type="checkbox" id="shortfilter_max_enable" name="shortfilter_max_enable" <?php echo Short_Comment_Filter_Settings::get_max_enable() == 'on' ? 'checked="checked"' : ''?> /></td>
            </tr>
            <tr>
                <th scope="row"><label for="shortfilter_max_count"><?php _e( 'Maximum Comment Length' ); ?></label></th>
                <td><input type="text" id="shortfilter_max_count" name="shortfilter_max_count" value="<?php Short_Comment_Filter_Settings::max_count() ?>" /></td>
            </tr>
            <tr>
                <th scope="row"><label for="shortfilter_max_message"><?php _e( 'Short Comment Message' ); ?></label></th>
                <td><textarea id="shortfilter_max_message" name="shortfilter_max_message" rows="3" cols="50" ><?php echo htmlentities( Short_Comment_Filter_Settings::get_long_comment_message(), ENT_QUOTES ) ?></textarea></td>
            </tr>
            <tr>
                <th scope="row"><?php _e( 'Message Instructions' ); ?></th>
                <td>
                    <?php _e( 'The following variables will be replaced dynamically with their corresponding values:' ); ?><br />
                    <ul>
                        <li><?php _e( '<strong>%type%</strong> - value of Filter Type (\'words\' or \'characters\')' ); ?></li>
                        <li><?php _e( '<strong>%length%</strong> - value of Minimum Count'); ?></li>
                    </ul>
                </td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </p>
    </form>
</div>