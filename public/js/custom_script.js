


$(document).ready(function(){
	new WOW().init();
  	 $(document).on("click",".back_top",function(){
  	 	 $('html,body').animate({ scrollTop: 0 }, 'slow');
  	 });
    
	$('#banner').owlCarousel({
	     margin:30,
	     loop:true,
		 slideSpeed : 300,
		paginationSpeed : 400,
		autoplay:true,
		nav:true,
		pagination:false,  dots: false,
		navText: ["<i class='fa fa-angle-left'></i> <span>PREV</span>","<span>NEXT</span> <i class='fa fa-angle-right'></i>"],
	    responsive:{
	        0:{
	            items:1
	        },
	        480:{
	            items:1
	        },
	        700:{
	            items:1
	        },
	        1000:{
	            items:1
	        },
	        1100:{
	            items:1
	        }
	    }
	}); 
	 
});
