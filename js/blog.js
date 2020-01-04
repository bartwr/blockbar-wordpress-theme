
$ = jQuery;

$(function(){
  $('#menu-toggle').on('click', function(){
  	$('#menu-nav').toggle();
  })
})

$.b = $.b || {};
$.extend($.b, {
  /**
   * Open external links in new window.
   */
  addLinkTargets: function() {
  	if($(this).attr('href').indexOf('blockbar.nl') > -1)
  	  return;
    if($(this).attr('target') == null){
      $(this).attr("target", "_blank");
    }
  }
  /**
   * Hover links that link to the same URL.
   */
  , contextHover: function() {
    $("a").each(function() {
      var a = $("a[href='"+$(this).attr("href")+"']");
      $(this).hover(
        function() {a.addClass("hover");},
        function() {a.removeClass("hover");}
      );
    });
  }
  /**
   * Give current URL the `active` class.
   */
  , highlightCurrentPage: function() {
    var a = $("a[href='"+window.location.pathname+"']");
    $("a").each(function() {
      a.addClass('active');
    });
  }
});

$(function(){

  //Init contextHover.
  $.b.contextHover();

  //Highlight current page by adding `active` class.
  $.b.highlightCurrentPage();

  // Open external links in new window.
  $("a[href^='http://']").each($.b.addLinkTargets);
  $("a[href^='https://']").each($.b.addLinkTargets);

  $('a:has(> img)').css({
    'padding': 0,
    'background': 'transparent'
  });

});

/** home navigation */

/* 
  On scroll: make top navigation smaller
*/

$(window).on('scroll', function(e){

  if ( $('body').scrollTop() > 20 )
    $('body').addClass('small-nav');
  else
    $('body').removeClass('small-nav');

});