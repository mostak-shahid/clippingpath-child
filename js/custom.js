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
    $('.base-input').change(function(e){        
        let service = $(this).closest('.settings-wrapper').find('.mos-services').val();
        let price = $(this).closest('.settings-wrapper').find('.mos-services').find(':selected').data('price');
        let quantity = $(this).closest('.settings-wrapper').find('.quantity').val();
        let location = $(this).closest('.part-1').find('.calculator-part').find('.calculated-text').find('.image img').data('src');
        
        let output = 0;
        output = price * quantity;
        service = (service)?service:'defaulf';
        $(this).closest('.part-1').find('.calculator-part').find('.calculated-text').find('.image img').attr('src', location + convertToSlug(service)+'.jpg');
        $(this).closest('.part-1').find('.calculator-part').find('.calculated-text').find('.service .value').html(service);
        $(this).closest('.part-1').find('.calculator-part').find('.calculated-text').find('.quantity .value').html(quantity + ' Images');
        $(this).closest('.part-1').find('.calculator-part').find('.calculated-text').find('.price .value').html('$'+output);
        
        $(this).closest('.part-1').find('.calculator-part').find('.default-text').hide();
        $(this).closest('.part-1').find('.calculator-part').find('.calculated-text').show();
        if (quantity>0) {
            $(this).closest('.part-1').find('.calculator-part').find('.calculated-text').find('.btn-next-step').show();
        } else {
            $(this).closest('.part-1').find('.calculator-part').find('.calculated-text').find('.btn-next-step').hide();            
        }
//        console.log(service);
//        console.log(price);
//        console.log(quantity);
    });
    $('.btn-next-step').on('click',function(){
        $(this).closest('.part-1').hide();
        $(this).closest('.part-1').siblings('.part-2').show();
    });
});

function convertToSlug(Text){
    return Text
        .toLowerCase()
        .replace(/[^\w ]+/g,'')
        .replace(/ +/g,'-')
        ;
}