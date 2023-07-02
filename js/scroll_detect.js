$(window).scroll(function(){ 
  if ($(this).scrollTop() > 10){      
    $('header').addClass("scroll");
  } 
  else{
    $('header').removeClass("scroll");
  }
});