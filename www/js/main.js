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
  $('div.status:not(div.status:first-child)').css('margin-top', STATUS_SPACING);
  // $(".large").mouseover(function(){
  // 	$(".caption").show();
  // });

  // $(".large").mouseout(function(){
  // 	$(".caption").hide();
  // });
});
