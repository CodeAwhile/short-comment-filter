<div class="wrap">
    <h2>Short Comment Filter Settings</h2>
    <p>
        Comments Filtered: <?php Short_Comment_Filter_Settings::filtered_comment_count() ?>
    </p>
    <form method="post" action="options.php">
        <?php settings_fields('shortfilter-options'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="shortfilter_filter_type">Filter Type</label></th>
                <td>
                    <select id="shortfilter_filter_type" name="shortfilter_filter_type">
                        <?php
                            $filter_type = Short_Comment_Filter_Settings::get_filter_type();
                            $filter_types = array('words' => 'Word Count', 'characters' => 'Character Count');
                            foreach ( $filter_types as $filter_item => $filter_name ) {
                                echo '<option value="' . $filter_item . ($filter_item == $filter_type ? '" selected="selected' : '' ) . '" >' . $filter_name . "</option>\n";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="shortfilter_min_count">Minimum Count</label></th>
                <td><input type="text" id="shortfilter_min_count" name="shortfilter_min_count" value="<?php Short_Comment_Filter_Settings::min_count() ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="shortfilter_default_action">Default Filter Action</label></th>
                <td>
                    <select id="shortfilter_default_action" name="shortfilter_default_action">
                        <?php
                            $default_action = Short_Comment_Filter_Settings::get_default_action();
                            $default_actions = array('delete' => 'Delete Comment', 'spam' => 'Spam Comment');
                            foreach ( $default_actions as $action_name => $action_title ) {
                                echo '<option value="' . $action_name . ($default_action == $action_name ? '" selected="selected' : '') . '" >' . $action_title . "</option>\n";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="shortfilter_filter_users">Filter Registered Users</label></th>
                <td><input type="checkbox" id="shortfilter_filter_users" name="shortfilter_filter_users" <?php echo Short_Comment_Filter_Settings::get_filter_users() == 'on' ? 'checked="checked"' : ''?> /></td>
            </tr>
            <tr>
                <th scope="row"><label for="shortfilter_js_check">Check Length With JavaScript</label></th>
                <td><input type="checkbox" id="shortfilter_js_check" name="shortfilter_js_check" <?php echo Short_Comment_Filter_Settings::get_js_check() == 'on' ? 'checked="checked"' : ''?> /></td>
            </tr>
            <tr>
                <th scope="row"><label for="shortfilter_message">Short Comment Message</label></th>
                <td><textarea type="text" id="shortfilter_message" name="shortfilter_message" rows="3" cols="50" ><?php echo htmlentities( Short_Comment_Filter_Settings::get_short_comment_message(), ENT_QUOTES ) ?></textarea></td>
            </tr>
            <tr>
                <th scope="row">Message Instructions</th>
                <td>
                    The following variables will be replaced dynamically with their corresponding values:<br />
                    <ul>
                        <li><strong>%type%</strong> - value of Filter Type ('words' or 'characters')</li>
                        <li><strong>%length%</strong> - value of Minimum Count  </li>
                    </ul>
                </td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </p>
    </form>
</div>