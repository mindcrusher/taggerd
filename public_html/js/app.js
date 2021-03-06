jQuery(function(){

    $('#menu button').click(function(){
        $( "#menu .collapsible-area" ).toggle('fast');
    });

    $('.teaser-image, .teaser-title').click(function(){
        $('.main-page__principles-block .teaser-caption').css({'display':'none'});
        $(this).parent().find('.teaser-caption').css({'display':'block'});
    });

    $('.main-page__principles-block .teaser-caption').click(function(){
        $(this).parent().find('.teaser-caption').css('display','none');
    });

    $('#show-menu').click(function(){
        $('.header-navbar-menu').toggle();
    });


    jQuery(document).on('click', '.showModalButton', function(){
        if (jQuery('#pending-form').data('bs.modal').isShown) {
            jQuery('#pending-form').find('#modalContent')
                .load($(this).attr('href'));
            //dynamiclly set the header for the modal
            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        } else {
            //if modal isn't open; open it and load content
            jQuery('#pending-form').modal('show')
                .find('#modalContent')
                .load($(this).attr('href'));
            //dynamiclly set the header for the modal
            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        }
    });
    });