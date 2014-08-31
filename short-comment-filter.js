/**
 * Filter comments that are too short
 */

jQuery(function($){
    $('#commentform').submit(function(e){
        var comment = $('#comment').val().replace(/\s+/g, ' ').replace(/^\s+|\s+$/g, '');
        var filterType = short_comment_settings.filter_type;
        var minCount = short_comment_settings.min_count;
        var filterMessage = short_comment_settings.filter_message
                                .replace('%length%', minCount)
                                .replace('%type%', filterType);

        if ('words' === filterType && comment.split(' ') < minCount){
            alert(filterMessage);
            e.preventDefault();
            return false;
        } else if ('characters' === filterType && comment.length < minCount) {
            alert(filterMessage);
            e.preventDefault();
            return false;
        }

        return true;
    });
});