$(document).ready(function () {
    // $('.lazy-init').click(function () {
    //     $('.lazy').lazy({
    //         bind: "click"
    //     });
    // })
    $('.popular-ways-wrap').owlCarousel({
        items: 7,
        center: true,
        loop: true,
        nav: true,
        dots: false,
        infinite: false,
        navContainer: '#customNav',
        navText: ["<img class='lazyload-init' src='./images/L.png'/>",
            "<img class='lazyload-init' src='./images/R.png'/>"],
        // touchDrag: false,
        // mouseDrag: false,
        responsiveClass: true,
        autoWidth: true,
        responsiveRefreshRate: 100,
        lazyLoad: true,
        responsive: {
            0: {
                items: 1,
                nav: true,
                autoWidth: false,
                center: true,
                touchDrag: true,
                mouseDrag: true,
            },
            768: {
                items: 7,
                nav: true,
                autoWidth: true,
            },
        }

    })

    $('.hot-tours').owlCarousel({
        // center: true,
        loop: true,
        nav: true,
        dots: false,
        navContainer: '.hot-tours-nav-wrap',
        navText: ["<img class='lazyload-init' src='./images/L.png'/>",
            "<img class='lazyload-init' src='./images/R.png'/>"],
        lazyLoad: true,
        items: 1,
        touchDrag: false,
        mouseDrag: false,
        swipe: false,
        responsiveClass: true,
        autoWidth: true,
        responsiveRefreshRate: 100,
        margin: 15,
        responsive: {
            0: {
                items: 1,
                autoWidth: false,
                center: true,
                touchDrag: true,
                mouseDrag: true,
                swipe: true,
            },
            767: {
                items: 2,
                nav: true
            },
        }
    })

    $('.review-cards-wrap').slick({
        infinite: true,
        slidesToShow: 3,
        nav: false,
        slidesToScroll: 1,
        arrows: false,
        // nextArrow: '<img class="l-arrow-review" src="./images/R.png"/>',
        // prevArrow: '<img class="r-arrow-review" src="./images/L.png"/>',
        navContainer: '#allReviews',
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    fade: false,
                    items: 1,
                    // cssEase: 'linear'
                }
            },
            {
                breakpoint: 0,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    fade: false,
                    items: 1,
                    centralMode: true
                    // cssEase: 'linear'
                }
            }
        ]
    });
    $('#allReviews .l-arrow-review').on('click', function () {
        $('.review-cards-wrap').slick('slickNext');
    });
    $('#allReviews .r-arrow-review').on('click', function () {
        $('.review-cards-wrap').slick('slickPrev');
    });
    $('.blog-items-wrap').slick({
        nav: false,
        infinite: true,
        arrows: false,
        responsive: [
            {
                breakpoint: 9999,
                settings: "unslick"
            },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    fade: false,
                    cssEase: 'linear'
                }
            }
        ]
    });
    $('#blogNav .l-arrow-review').on('click', function () {
        $('.blog-items-wrap').slick('slickNext');
    });
    $('#blogNav .r-arrow-review').on('click', function () {
        $('.blog-items-wrap').slick('slickPrev');
    });
    $('.insta-photos-block').slick({
        infinite: true,
        arrows: false,
        navContainer: '#instaNav',
        responsiveRefreshRate: 100,
        responsive: [
            {
                breakpoint: 9999,
                settings: "unslick"
            },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    fade: false,
                    cssEase: 'linear',
                    items: 1,
                    centerPadding: '60px',
                }
            }
        ]
    });
    $('#instaNav .l-arrow-review').on('click', function () {
        $('.insta-photos-block').slick('slickNext');
    });
    $('#instaNav .r-arrow-review').on('click', function () {
        $('.insta-photos-block').slick('slickPrev');
    });

    $(window).resize(function () {
        $('.insta-photos-block, .review-cards-wrap, .blog-items-wrap').slick('resize')
    })

    $('.for-slider-wrap').slick({
        arrows: false,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        loop: true,
        navContainer: '#country-example-nav',
        responsive: [
            {
                breakpoint: 9999,
                settings: {
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    fade: false,
                    cssEase: 'linear'
                }
            }
        ]
    }).slickLightbox({
        itemSelector: 'a',
        navigateByKeyboard: true
    });

    $('#country-example-nav .l-arrow-review').on('click', function () {
        $('.for-slider-wrap').slick('slickNext');
    });
    $('#country-example-nav .r-arrow-review').on('click', function () {
        $('.for-slider-wrap').slick('slickPrev');
    });

    $('.mob-hamburger-wrap').on('click', function () {
        $('.mobile-menu-white').toggleClass('active');
        $('.slide-menu').toggleClass('active');
        $('.main-content, .mobile-menu-white').toggleClass('nav-visible ')
    })

    $('.r-arrow, .l-arrow').appendTo(".hot-tours-nav-wrap")
    $('.r-arrow-pop, .l-arrow-pop').appendTo(".pop-ways-nav")

    $(window).resize(function () {
        $('.r-arrow, .l-arrow').appendTo(".hot-tours-nav-wrap")
        $('.r-arrow-pop, .l-arrow-pop').appendTo(".pop-ways-nav")
    });

});

function callModal() {
    let random_modal = Math.floor(Math.random() * 3) + 1;
    random_modal = `#offer${random_modal}`
    $('body').append(`<button type="button" class="d-none call-modal" data-toggle="modal" data-target="${random_modal}">Launch demo modal</button>`)
    $('.call-modal').click()
    ym(49191817, 'reachGoal', `modal_${random_modal}`)
}

checkClasses();
$('.hot-tours').on('translated.owl.carousel', function (event) {
    checkClasses();
});
$(document).ready(function () {
    checkClasses()
})

function checkClasses() {
    let total = $('.hot-tours .owl-stage .owl-item.active').length;

    $('.hot-tours .owl-stage .owl-item').removeClass('first');

    $('.hot-tours .owl-stage .owl-item.active').each(function (index) {
        if (index === 0) {
            // this is the first one
            $(this).addClass('first');
        }
        if (index === total - 1 && total > 1) {
            // this is the last one
            $(this).addClass('last');
        }
    })
}

$(function () {
    $('.hot-tours-section .hot-tour-info .tour-descr, .tour-descr ').succinct({
        size: 120
    });
    $('.hot-tours-section .hot-tour-info .country-name').succinct({
        size: 50
    });
    $('.review-txt').succinct({
        size: 250
    });
    $('.review-author').succinct({
        size: 22

    })
});
let countReview = $('.review-rating').length;
for (let i = 0; i <= countReview - 1; i++) {
    $(`#${i}rating`).barrating({
        theme: 'css-stars',
        readonly: true,
        initialRating: $(`#${i}rating`).attr('data-rating')
    })

    if ($(`#${i}rating`).attr('data-rating') > 1) {
        $(`#${i}rating + .br-widget a.br-selected`).addClass('gold')
    }
}
$(window).scroll(function () {
    $('.mobile-menu-white').toggleClass('fixed', $(this).scrollTop() > 10);
});

let flag = true;
$('#access').on('change', function () {
    flag = !flag;
    if (flag) {
        $('.submit-button').removeAttr('disabled', 'disabled')
    } else {
        $('.submit-button').attr('disabled', 'disabled')
    }
});

if (flag) {
    $('.submit-button').removeAttr('disabled', 'disabled')
} else {
    $('.submit-button').attr('disabled', 'disabled')
}
$(function () {
    $('.lazy').lazy({
        scrollDirection: 'vertical',
        effect: 'fadeIn',
        visibleOnly: true,
        combined: true,
        // delay: 5000
    });
});
// let myCSS = document.createElement( "link" );
// myCSS.rel = "stylesheet";
// myCSS.href = "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css";
// document.head.insertBefore( myCSS, document.head.childNodes[ document.head.childNodes.length - 1 ].nextSibling );

$('.desck-hamburger-wrap').click(function () {
    $('.menu-modal').addClass('active');
    $('html').css('paddingRight', '15px')
    $('body').css('overflow', 'hidden');
})
$('.close-menu').click(function () {
    $('.menu-modal').removeClass('active');
    setTimeout(function () {
        $('body').css('overflow', '');
        $('html').css('paddingRight', '0')
    }, 500)

})

// function getFortunaStatus() {
//     let fortuna = localStorage.getItem('fortuna')
//     if (!fortuna) {
//         localStorage.setItem('fortuna', Date.now())
//         return true
//     } else {
//         let moment = require('moment')
//         fortuna = moment(Number(fortuna))
//         let now = moment(Date.now()),
//             diff = now.diff(fortuna, 'minutes')
//         if (diff >= 1440) {
//             localStorage.setItem('fortuna', Date.now())
//             return true
//         }
//         return false
//     }
// }

// $('.fortune-modal .close').click(() => {
//     setTimeout(() => {
//         callModal();
//     }, 30000)
// })

// let clicked = false,
//     main_height = $('body').height();
//
// $(window).on('scroll', function () {
//     let currentPos = $(window).scrollTop(),
//         percent = currentPos / main_height * 100;
//     if (percent > 2 && getFortunaStatus()) {
//         if (!clicked) {
//             clicked = true;
//             setTimeout(function () {
//               $('.fortune-modal').click();
//             }, 1000 * 60);
//         }
//     }
// })
