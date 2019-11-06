

jQuery( document ).ready(function($) {
    $('.hero').children('.slide').first().addClass('active');
    const slides = $('.slide');
    function cycleImage() {
        
        const active = $('.hero .active');
        const next = active.next().length > 0 ? active.next() : slides.first();
        active.removeClass('active');
        next.addClass('active');
    }
    if (slides.length > 1) {
        setInterval(cycleImage, 7000);
    }

    function coolHolders() {
		$('.gfield [name^="input"]').on('focusin', function() {
		  $(this).parent().prev('label').addClass('label_focus');
		});
		$('.gfield [name^="input"]').on('focusout input change keyup', function() {
			var gInput = $(this);
			checkInputs(gInput);
		});
    }

    $('#gf-form-container').on('click', '.close-form', function() {
        $('#gf-form-container').fadeOut();
    });
    
 

    $( document ).ajaxComplete(function() {
        console.log('ajax complete');
        $('.ginput_container_select select').niceSelect();

        // coolHolders();
      });
});

