/* ================================= */
    /*===== Owl Caserol =====*/
/* ================================= */

/* ========== Home Slider =========== */
$("#home-slider").owlCarousel({
    rtl:true,
    loop:true,
    items: 6,
    margin:30,
    nav:true,
    dots:false,

    navText: ['<i  data-feather="arrow-left"></i>', '<i data-feather="arrow-right"></i>'],
    responsive: {
        0: {
            items: 1,
            nav: true,
            dots: false,
        },
        400: {
            items: 1,
            nav: true,
            dots: false,
        },
        600: {
            items: 1,
            nav: true,
            dots: false,
        },
        768: {
            items: 1,
            nav: true,
            dots: false,
        },
        1000: {
            items: 1,
            nav: true,
            dots: false,
        }
    }
});

/* ========== Flash Deal Slider =========== */
$("#flash-deal-slider").owlCarousel({
    loop: true,
    items: 1,
    dots: false,
    nav: true,      
    autoplayTimeout: 10000,
    smartSpeed: 2000,
    autoHeight: false,
    touchDrag: true,
    mouseDrag: true,
    margin: 30,
    autoplay: true,
    lazyLoad:true,
    slideSpeed: 600,
    navText: ['<i data-feather="arrow-left"></i>', '<i data-feather="arrow-right"></i>'],
    responsive: {
        0: {
            items: 1,
            nav: true,
            dots: false,
        },
        400: {
            items: 1,
            nav: true,
            dots: false,
        },
        600: {
            items: 1,
            nav: true,
            dots: false,
        },
        768: {
            items: 1,
            nav: true,
            dots: false,
        },
        1000: {
            items: 1,
            nav: true,
            dots: false,
        }
    }
});

/* ========== Client Slider =========== */
$("#clients-slider").owlCarousel({
    loop: true,
    items: 6,
    dots: false,
    nav: false,      
    autoplayTimeout: 10000,
    smartSpeed: 2000,
    autoHeight: false,
    touchDrag: true,
    mouseDrag: true,
    margin: 30,
    autoplay: true,
    lazyLoad:true,
    slideSpeed: 600,
    navText: ['<i data-feather="arrow-left"></i>', '<i data-feather="arrow-right"></i>'],
    responsive: {
        0: {
            items: 2,
            nav: false,
            dots: false,
        },
        400: {
            items: 2,
            nav: false,
            dots: false,
        },
        600: {
            items: 3,
            nav: false,
            dots: false,
        },
        768: {
            items: 3,
            nav: false,
            dots: false,
        },
        992: {
            items: 5,
            nav: false,
            dots: false,
        },
        1000: {
            items: 6,
            nav: false,
            dots: false,
        }
    }
});

/* ========== Footer Slider =========== */
$("#footer-payment-slider").owlCarousel({
    loop: true,
    items: 6,
    dots: false,
    nav: false,      
    autoplayTimeout: 10000,
    smartSpeed: 2000,
    autoHeight: false,
    touchDrag: true,
    mouseDrag: true,
    margin: 20,
    autoplay: true,
    lazyLoad:true,
    slideSpeed: 600,
    navText: ['<i data-feather="arrow-left"></i>', '<i data-feather="arrow-right"></i>'],
    responsive: {
        0: {
            items: 5,
            nav: false,
            dots: false,
        },
        400: {
            items: 5,
            nav: false,
            dots: false,
        },
        600: {
            items: 5,
            nav: false,
            dots: false,
        },
        768: {
            items: 3,
            nav: false,
            dots: false,
        },
        992: {
            items: 6,
            nav: false,
            dots: false,
        },
        1000: {
            items: 6,
            nav: false,
            dots: false,
        }
    }
});

/* ========== topseler-slidersr Slider =========== */

$('#topseler-slider').slick({
    slidesToShow: 6,
    infinite: true,
    slidesToScroll: 3,
    autoplay: true,
    arrows:true,
    margin:30,
    autoplaySpeed: 4000,
    nextArrow:'<button type="button" class="slick-next ">Next</button>',

});
// $("#topseler-slider").owlCarousel({
//
//     rtl:true,
//     loop:true,
//     items: 6,
//     margin:20,
//     nav:true,
//     dots:false,
//
//     navText: [ '<i class="position-absolute top-50 start-100 translate-middle "  data-feather="chevron-right"></i>','<i class="position-absolute top-50 start-0 translate-middle" data-feather="chevron-left"></i>'],
//     // navText: [ '<button type="button" class="position-absolute top-50 start-100 translate-middle btn btn-primary btn-sm"><i class=" "  data-feather="chevron-right"></i></button>','<i class="position-absolute top-50 start-0 translate-middle" data-feather="chevron-left"></i>'],
//     // navText: [   '<div class="position-absolute top-50 start-100 translate-middle"><i data-feather="chevron-right"></i></div>', '<div class="owl-next">next</div>'],
//     responsive:{
//         0:{
//             items:1
//         },
//         600:{
//             items:3
//         },
//         1000:{
//             items:6
//         }
//     }
// });

/* ========== Feature Brand Slider =========== */
$("#featured-brand-slider").owlCarousel({
    loop: true,
    items: 6,
    dots: false,
    nav: false,
    autoplayTimeout: 10000,
    smartSpeed: 2000,
    autoHeight: false,
    touchDrag: true,
    mouseDrag: true,
    margin: 20,
    autoplay: true,
    lazyLoad:true,
    slideSpeed: 600,
    navText: ['<i data-feather="arrow-left"></i>', '<i data-feather="arrow-right"></i>'],
    responsive: {
        0: {
            items: 2,
            nav: false,
            dots: false,
        },
        400: {
            items: 2,
            nav: false,
            dots: false,
        },
        600: {
            items: 3,
            nav: false,
            dots: false,
        },
        768: {
            items: 3,
            nav: false,
            dots: false,
        },
        992: {
            items: 6,
            nav: false,
            dots: false,
        },
        1000: {
            items: 6,
            nav: false,
            dots: false,
        }
    }
});

/* ========== bcs-book-slider =========== */
$("#bcs-book-slider").owlCarousel({
    loop: true,
    items: 6,
    dots: false,
    nav: false,
    autoplayTimeout: 10000,
    smartSpeed: 2000,
    autoHeight: false,
    touchDrag: true,
    mouseDrag: true,
    margin: 20,
    autoplay: true,
    lazyLoad:true,
    slideSpeed: 600,
    navText: ['<i data-feather="fa-arrow-left"></i>', '<i data-feather="arrow-right"></i>'],
    responsive: {
        0: {
            items: 2,
            nav: false,
            dots: false,
        },
        400: {
            items: 2,
            nav: false,
            dots: false,
        },
        600: {
            items: 3,
            nav: false,
            dots: false,
        },
        768: {
            items: 3,
            nav: false,
            dots: false,
        },
        992: {
            items: 6,
            nav: false,
            dots: false,
        },
        1000: {
            items: 6,
            nav: false,
            dots: false,
        }
    }
});

/* ========== bank-book-slider =========== */
$("#bank-book-slider").owlCarousel({
    loop: true,
    items: 6,
    dots: false,
    nav: false,
    autoplayTimeout: 10000,
    smartSpeed: 2000,
    autoHeight: false,
    touchDrag: true,
    mouseDrag: true,
    margin: 20,
    autoplay: true,
    lazyLoad:true,
    slideSpeed: 600,
    navText: ['<i data-feather="arrow-left"></i>', '<i data-feather="arrow-right"></i>'],
    responsive: {
        0: {
            items: 2,
            nav: false,
            dots: false,
        },
        400: {
            items: 2,
            nav: false,
            dots: false,
        },
        600: {
            items: 3,
            nav: false,
            dots: false,
        },
        768: {
            items: 3,
            nav: false,
            dots: false,
        },
        992: {
            items: 6,
            nav: false,
            dots: false,
        },
        1000: {
            items: 6,
            nav: false,
            dots: false,
        }
    }
});

/* ========== academic-slider =========== */
$("#academic-slider").owlCarousel({
    loop: true,
    items: 6,
    dots: false,
    nav: false,
    autoplayTimeout: 10000,
    smartSpeed: 2000,
    autoHeight: false,
    touchDrag: true,
    mouseDrag: true,
    margin: 20,
    autoplay: true,
    lazyLoad:true,
    slideSpeed: 600,
    navText: ['<i data-feather="arrow-left"></i>', '<i data-feather="arrow-right"></i>'],
    responsive: {
        0: {
            items: 2,
            nav: false,
            dots: false,
        },
        400: {
            items: 2,
            nav: false,
            dots: false,
        },
        600: {
            items: 3,
            nav: false,
            dots: false,
        },
        768: {
            items: 3,
            nav: false,
            dots: false,
        },
        992: {
            items: 6,
            nav: false,
            dots: false,
        },
        1000: {
            items: 6,
            nav: false,
            dots: false,
        }
    }
});


$(function() { 
    // for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
    $('a[data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
        // save the latest tab; use cookies if you like 'em better:
        localStorage.setItem('lastTab', $(this).attr('href'));
    });

    // go to the latest tab, if it exists:
    var lastTab = localStorage.getItem('lastTab');
    if (lastTab) {
        $('[href="' + lastTab + '"]').tab('show');
    }
}); 


$(document).ready(function() {

    var sync1 = $("#sync1");
    var sync2 = $("#sync2");
    var slidesPerPage = 4; //globaly define number of elements per page
    var syncedSecondary = true;

    sync1.owlCarousel({
        items: 1,
        slideSpeed: 2000,
        nav: true,
        autoplay: false, 
        dots: true,
        loop: true,
        responsiveRefreshRate: 200,
        navText: ['<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>', '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],
    }).on('changed.owl.carousel', syncPosition);

    sync2
        .on('initialized.owl.carousel', function() {
            sync2.find(".owl-item").eq(0).addClass("current");
        })
        .owlCarousel({
            items: slidesPerPage,
            dots: true,
            nav: true,
            smartSpeed: 200,
            slideSpeed: 500,
            slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
            responsiveRefreshRate: 100
        }).on('changed.owl.carousel', syncPosition2);

    function syncPosition(el) {
        //if you set loop to false, you have to restore this next line
        //var current = el.item.index;

        //if you disable loop you have to comment this block
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - (el.item.count / 2) - .5);

        if (current < 0) {
            current = count;
        }
        if (current > count) {
            current = 0;
        }

        //end block

        sync2
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
        var onscreen = sync2.find('.owl-item.active').length - 1;
        var start = sync2.find('.owl-item.active').first().index();
        var end = sync2.find('.owl-item.active').last().index();

        if (current > end) {
            sync2.data('owl.carousel').to(current, 100, true);
        }
        if (current < start) {
            sync2.data('owl.carousel').to(current - onscreen, 100, true);
        }
    }

    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            sync1.data('owl.carousel').to(number, 100, true);
        }
    }

    sync2.on("click", ".owl-item", function(e) {
        e.preventDefault();
        var number = $(this).index();
        sync1.data('owl.carousel').to(number, 300, true);
    });
});


/* ================================= */
    /*===== Password =====*/
/* ================================= */
$(".toggle-password").click(function() {

    $(this).toggleClass("slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "text") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
});

/* ================================= */
    /*===== Sidebar =====*/
/* ================================= */

$(document).ready(function() {
    // start: Sidebar
    $('.sidebar-dropdown-menu').slideUp('fast')

    $('.sidebar-menu-item.has-dropdown > a, .sidebar-dropdown-menu-item.has-dropdown > a').click(function(e) {
        e.preventDefault()

        if(!($(this).parent().hasClass('focused'))) {
            $(this).parent().parent().find('.sidebar-dropdown-menu').slideUp('fast')
            $(this).parent().parent().find('.has-dropdown').removeClass('focused')
        }

        $(this).next().slideToggle('fast')
        $(this).parent().toggleClass('focused')
    })

    $('.sidebar-toggle').click(function() {
        $('.sidebar').toggleClass('collapsed')

        $('.sidebar.collapsed').mouseleave(function() {
            $('.sidebar-dropdown-menu').slideUp('fast')
            $('.sidebar-menu-item.has-dropdown, .sidebar-dropdown-menu-item.has-dropdown').removeClass('focused')
        })
    })

    $('.sidebar-overlay').click(function() {
        $('.sidebar').addClass('collapsed')

        $('.sidebar-dropdown-menu').slideUp('fast')
        $('.sidebar-menu-item.has-dropdown, .sidebar-dropdown-menu-item.has-dropdown').removeClass('focused')
    })

    if(window.innerWidth < 768) {
        $('.sidebar').addClass('collapsed')
    }
    
})

/* ================================= */
    /*===== Language Dropdown =====*/
/* ================================= */
$('.language-dropdown .current-language').on('click', function(e){
    if ( $(e.target).closest('.language-dropdown').hasClass('open') ){
        $(e.target).closest('.language-dropdown').removeClass('open') 
    } else {
        $(e.target).closest('.language-dropdown').addClass('open')
    }
})

$('.language-dropdown .dropdown li').on('click', function(e){
    var newLang = $(e.target).html()
    $(e.target).closest('.language-dropdown').children('.current-language').html( newLang );
    console.log(newLang)
    $(e.target).closest('.language-dropdown').removeClass('open')
})


/* ================================= */
    /*===== Navbar Nav =====*/
/* ================================= */
$( '.menubar .navbar-nav a' ).on( 'click', function () {
	$( '.menubar .navbar-nav' ).find( 'li.active' ).removeClass( 'active' );
	$( this ).parent( 'li' ).addClass( 'active' );
});

/* ================================= */
    /*===== Slick Slider =====*/
/* ================================= */
$(".fade-home-slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    fade: true,
    loop: true,
    arrows: true,
    prevArrow: '<span class="slider-btn slider-prev position-absolute top-50 start-100 translate-middle border-0"><i data-feather="arrow-left"></i></span>',
    nextArrow: '<span class="slider-btn slider-next position-absolute top-50 start-0 translate-middle border-0"><i data-feather="arrow-right"></i></span>',
    autoplay: true
});
$('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    arrows: false,
    dots: false,
    centerMode: true,
    focusOnSelect: true
});
$(".fade-slider-block").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    fade: true,
    loop: true,
    dots: true,
    autoplay: true
});

/* ================================= */
    /*===== Filter =====*/
/* ================================= */
$('.deals-size-filter').each(function () {
    $(this).find('a').on('click', function (event) {
        event.preventDefault();
        $(this).parent().siblings().removeClass('active');
        $(this).parent().toggleClass('active');
    });
});
$('.deals-style-filter').each(function () {
    $(this).find('a').on('click', function (event) {
        event.preventDefault();
        $(this).parent().siblings().removeClass('active');
        $(this).parent().toggleClass('active');
    });
});
$('.deals-colour-filter').each(function () {
    $(this).find('a').on('click', function (event) {
        event.preventDefault();
        $(this).parent().siblings().removeClass('active');
        $(this).parent().toggleClass('active');
    });
});

/* ================================= */
    /*===== Dropdown =====*/
/* ================================= */
document.addEventListener("DOMContentLoaded", function(){
    // make it as accordion for smaller screens
    if (window.innerWidth < 992) {

      // close all inner dropdowns when parent is closed
      document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
        everydropdown.addEventListener('hidden.bs.dropdown', function () {
          // after dropdown is hidden, then find all submenus
            this.querySelectorAll('.submenu').forEach(function(everysubmenu){
              // hide every submenu as well
              everysubmenu.style.display = 'none';
            });
        })
    });

    document.querySelectorAll('.dropdown-menu a').forEach(function(element){
        element.addEventListener('click', function (e) {
            let nextEl = this.nextElementSibling;
            if(nextEl && nextEl.classList.contains('submenu')) {	
              // prevent opening link if link needs to open dropdown
              e.preventDefault();
              if(nextEl.style.display == 'block'){
                nextEl.style.display = 'none';
              } else {
                nextEl.style.display = 'block';
              }

            }
        });
      })
    }
    // end if innerWidth
}); 

/* ================================= */
    /*===== Sidenav =====*/
/* ================================= */
function openNav() {
    document.getElementById("mySidenav").style.width = "370px";
}
  
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

/* ================================= */
    /*===== Feather Icon =====*/
/* ================================= */
feather.replace()

/* ================================= */
    /*===== Owl Carousel =====*/
/* ================================= */
$(document).ready(function(){
    $(".owl-carousel").owlCarousel();
});

/* ================================= */
    /*===== Search Bar =====*/
/* ================================= */
$('.btn-search').click(function () {
    $('.searchbar').toggleClass('clicked');
    if ($('.searchbar').hasClass('clicked')) {
      $('.btn-extended').focus();
    }
});

/* ================================= */
    /*===== Counter =====*/
/* ================================= */
$(".js-num").each(countUp);

function countUp() {
  var num = $(this).text();
  var decimal = 0;
  if (num.indexOf(".") > 0) { // if number is Decimal
    decimal = num.toString().split(".")[1].length;
  }
  $(this)
    .prop("Counter", 0.0)
    .animate(
      {
        Counter: $(this).text()
      },
      {
        duration: 2000,
        easing: "swing",
        step: function (now) {
          $(this).text(parseFloat(now).toFixed(decimal));
        }
      }
    );
}