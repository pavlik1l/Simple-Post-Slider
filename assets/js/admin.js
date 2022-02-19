jQuery(document).ready(function($) {
  $('#copy-wpsps-short-btn').click(function() {
    var $text_copy = $('#copy-wpsps-short');
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($text_copy.val()).select();
    document.execCommand("copy");
    $temp.remove();
    $('.copy_link_mess').fadeIn(400);
    setTimeout(function(){$('.copy_link_mess').fadeOut(400);},5000);
  });

  // $('#toplevel_page_wpsps').hover(function() {
  //   $(this).find('img').attr('src', '/wp-content/plugins/wp-simple-post-slider-1/assets/img/wpsps-icon-hover.png');
  // }, function() {
  //   $(this).find('img').attr('src', '/wp-content/plugins/wp-simple-post-slider-1/assets/img/slidericon.fw.png');
  // });
});