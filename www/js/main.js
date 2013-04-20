'use strict';

var IS_LOGGED_IN = false; 
$(document).ready(function(){
  if (IS_LOGGED_IN) {
    $("#intro").hide();
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
