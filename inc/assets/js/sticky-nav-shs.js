jQuery(document).ready(function ($) {

    function checkSpecialSectionTop() {
        const distanceFromTop = specialSectionTop - $(window).scrollTop();

        // Check if the special section is 10px from the top
        if (distanceFromTop <= 30) {
            setTimeout(function () {
                sticky_header.addClass("abs_active")
            }, 300);
            // You can add your custom code or actions here
        }

        // Check if the special section is 10px from the top
        if (distanceFromTop >= 31) {
            setTimeout(function () {
                sticky_header.removeClass("abs_active")
            }, 300);
            // You can add your custom code or actions here
        }
    }

    const sticky_header = $('.sticky_header');
    const specialSectionTop = sticky_header.offset().top;
    const selected_sections = $('.sticky_header ul li a');
    // Attach scroll event listener
    $(window).scroll(function () {
        checkSpecialSectionTop();

        selected_sections.each(function(){
            const distanceFromTop = $(window).scrollTop();
            const item = $(this);
            const itemTop = $(item.data('href'))?.offset()?.top;
            if((distanceFromTop + 150) > itemTop){
                // setTimeout(function () {
                    $('li').addClass('d-sm-none')
                    item.addClass("active")
                    item.closest("li").addClass('w-50').removeClass('d-sm-none')
                // }, 300);

            }else{
                // setTimeout(function () {
                    item.removeClass("active")
                    item.closest("li").removeClass('w-50')
                // }, 300);

            }
        })

    });
});
