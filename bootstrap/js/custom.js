 jQuery(document).ready(function($) {

    $("#demo6").maskMoney();
        var meta_image_frame;

      $('.meta-image-button').live('click', function(e){
            e.preventDefault();

            if( meta_image_frame ){
                //wp.media.editor.open();
             meta_image_frame.open();
                return;
            }

            meta_image_frame = wp.media.frames.file_frame = wp.media({
                title: 'Add Images',
                button: {text: 'Add to Images'},
                library: { type: 'image'}
            });

            meta_image_frame.on('select', function(){
                var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

                   var url = '';

                $('#meta-image').val(media_attachment.url);


            });

            meta_image_frame.open();

      });
      
      

}); //end main jquery function