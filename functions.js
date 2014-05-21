jQuery( document ).ready( function($) {
    // function to give you back a random number between 0 - whatever you pass as high
    function random_number( high ){
      return Math.floor( ( Math.random() * high ) );
    };

    // This function is for creating placeholders in mainly gravity forms bc they dont support placeholder attr.
    // Add the class to each element you want to add a placeholder to and call it on this function
    // e.g. $('.class').ldmCreatePlaceholder
    // RECOMMENDED ADD-ON: https://github.com/mathiasbynens/jquery-placeholder
    // Takes care of IE8 + 7 
    // NOTES: Troubleshoot IE7
    $.fn.ldmCreatePlaceholder = function() {
      return this.each(function() {
        var theInput = $(this).find('.ginput_container').children()[0];
        var theLabel = $(this).find('label')[0];
        // Get the label and remove the * for the required fields
        var theText = $(theLabel).text().replace(/\*+/, '');
        $(theInput).attr('placeholder', theText);
      });
    };
}