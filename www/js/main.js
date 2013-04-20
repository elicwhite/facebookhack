'use strict';

var IS_LOGGED_IN = false;
var STATUS_SPACING = '80px';
$(document).ready(function(){
  if (IS_LOGGED_IN) {
    $("#intro").hide();
  	$('#login').hide();
  } else {
  	$('#login-username').hide();
    
  }

    $('#search-button').click(function(){
    window.location.href = document.location.href + "?friend=" + $('#search-field').val();
  });
  //$('div.status:not(div.status:first-child)').css('margin-top', STATUS_SPACING);
  // $(".large").mouseover(function(){
  // 	$(".caption").show();
  // });

  // $(".large").mouseout(function(){
  // 	$(".caption").hide();
  // });
});
