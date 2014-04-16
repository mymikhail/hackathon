/**
 * Created by ypopov on 16.04.14.
 */


;(function($){
    $( function(){

        $('#myTab a').not('[href="#myModal"]').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        })





    } );
})(jQuery);