'use strict';

var IS_LOGGED_IN = false; 
$(document).ready(function(){
  if (IS_LOGGED_IN) {
  	$('#login').hide();
  } else {
  	$('#login-username').hide();
  }
});
