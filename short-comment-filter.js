/**
 * Filter comments that are too short
 */

jQuery(document).ready(function($){
    $('#commentform').submit(function(e){
        var comment = $('#comment').val().replace(/\s+/g, ' ').replace(/^\s+|\s+$/g, '');
        var filterType = short_comment_settings.filter_type;
        var minCount = short_comment_settings.min_count;
        var filterMessage = short_comment_settings.filter_message;
        filterMessage = filterMessage.replace('%length%', minCount).replace('%type%', filterType);
        if (filterType == 'words'){
            var words = comment.split(' ');
            if ( words.length < minCount ) {
                alert(filterMessage);
                e.preventDefault();
                return false;
            }
            return true;
        } else if ( filterType == 'characters' ) {
            if ( comment.length < minCount ) {
                alert(filterMessage);
                e.preventDefault();
                return false;
            }
            return true;
        }
        return true;
    });
});