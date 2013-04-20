'use strict';

var IS_LOGGED_IN = true; 
$(document).ready(function(){
  if (IS_LOGGED_IN) {
  	$('#login').hide();
  } else {
  	$('#login-username').hide();
  }

  // $(".large").mouseover(function(){
  // 	$(".caption").show();
  // });

  // $(".large").mouseout(function(){
  // 	$(".caption").hide();
  // });
});
