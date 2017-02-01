<?php

	require '../config.php';

	if(empty($user->rights->upbuttons->useit)) exit;

?>
	 
$(document).ready(function() {
  var $el = $('div.tabsAction');
  
  function scrollButtonsToUp() {
  		 var scrollTop = $(window).scrollTop();
	  	 var wHeight  = $( window ).height();
	  	  
	  	  if(scrollTop + wHeight < originalElementTop ) {
	  	  	console.log("tabsAction not in screen ");
	  	  	
	  	  	$el.css({
	  	  		position:"fixed"
	  	  		,bottom:'0px'
	  	  		,right:'-1px'
				,'width':'88\%'
	  	  		,'background-color':'#fff'
	  	  		,padding:'17px 0 0px 20px'
	  	  		,border: '0px solid #e0e0e0'
	  	  		,'border-radius': '10px 0 0 0'
	  	  		,'margin':'0 0 0 0'
	  	  	});
	  	  }	
	  	  else{
	  	  	console.log("tabsAction in screen ");
	  	  	$el.removeAttr('style');
	  	  }
  }
  
  if($el.length == 1 && ($el.find('.button').length>0 || $el.find('.butAction').length>0) ) {
  	  	
	  	  var originalElementTop = $el.offset().top;
      	  
	  	  $(window).on('scroll', function() {
		  	  scrollButtonsToUp();
	  	  	
	  	  });
		  scrollButtonsToUp();
  	  	
  	  }

 });
  
