jQuery(function($) {

  // Make sure that images get a full with, even if they're in a paragraph _with_ max-width
  $('p').has('img, video, iframe').each(function(){
    $(this).addClass('no-width');
  })

});
