var auctionmodal = (function() {
    var
            method = {},
            $overlay,
            $modal,
            $content,
            $close;

    // Center the modal in the viewport
    method.center = function() {
        var top, left;

     /*   top = Math.max($(window).height() - $modal.outerHeight(), 0) / 2;
        left = Math.max($(window).width() - $modal.outerWidth(), 0) / 2;

       	$modal.css({
         top:top + $(window).scrollTop(), 
         left:left + $(window).scrollLeft()
         });*/
    };

    // Open the modal
    method.open = function(settings) {
        $content.empty().append(settings.content);

     /*  $modal.css({
         width: settings.width || 'auto', 
         height: settings.height || 'auto'
         });*/
    //   $modal.css('z-index',100);
       
        method.center();
        $(window).bind('resize.modal', method.center);
        $modal.show();
        $overlay.show();
    };

    // Close the modal
    method.close = function() {
        $modal.hide();
        $overlay.hide();
        $content.empty();
        $(window).unbind('resize.modal');
    };

    // Generate the HTML and add it to the document
    $overlay = $('<div class="overlay"></div>');
    $modal = $('<div class="popup" id="modal"><h3 class="title">Message</h3></div>');
    $content = $('<div class="cont" id="content"></div>');
    $close = $('<div class="buttons"><a class="btn btn-primary modal-close" href="#"> OK </a></div>');


    $modal.hide();
    $overlay.hide();
    $modal.append($content, $close);

    $(document).ready(function() {
        $('body').append($overlay, $modal);
    });

    $close.click(function(e) {
        e.preventDefault();
        method.close();
    });



    return method;
}());

			
