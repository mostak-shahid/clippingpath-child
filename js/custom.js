jQuery(document).ready(function($){	
    $('.mos-iconbox-owl-carousel').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        dots:false,
        navContainer: '.carousel-controller',
        navText : ["<i class='fa fa-angle-double-left'></i>","<i class='fa fa-angle-double-right'></i>"],
        responsive:{
            0:{
                items:1
            },
            1200:{
                items:2
            }
        }
    }); 
});