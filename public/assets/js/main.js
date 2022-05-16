var _gameCode;
var _uid;
var _countdowntime;
var _countdownTimer;
var domain = location.origin + location.pathname.replace('lottery-results/', '');
var lotteryAPILink = domain + '/lotteryv3/controllers/controller.php';
var wpAPILink = './wpapi';

var _utcOffset = '+09:00';

var sourceLatest;
var sourceRecent;
var sourceHistory;

(function($) {
    "use strict";

    // if (typeof(Handlebars) !== 'undefined') {

    //     Handlebars.registerHelper('ifCond', function(v1, operator, v2, options) {

    //         if (typeof(v1) === 'string') {
    //             v1 = v1.toLowerCase();
    //         }

    //         if (typeof(v2) === 'string') {
    //             v2 = v2.toLowerCase();
    //         }

    //         switch (operator) {
    //             case '==':
    //                 return (v1 == v2) ? options.fn(this) : options.inverse(this);
    //             case '===':
    //                 return (v1 === v2) ? options.fn(this) : options.inverse(this);
    //             case '!=':
    //                 return (v1 != v2) ? options.fn(this) : options.inverse(this);
    //             case '!==':
    //                 return (v1 !== v2) ? options.fn(this) : options.inverse(this);
    //             case '<':
    //                 return (v1 < v2) ? options.fn(this) : options.inverse(this);
    //             case '<=':
    //                 return (v1 <= v2) ? options.fn(this) : options.inverse(this);
    //             case '>':
    //                 return (v1 > v2) ? options.fn(this) : options.inverse(this);
    //             case '>=':
    //                 return (v1 >= v2) ? options.fn(this) : options.inverse(this);
    //             case '&&':
    //                 return (v1 && v2) ? options.fn(this) : options.inverse(this);
    //             case '||':
    //                 return (v1 || v2) ? options.fn(this) : options.inverse(this);
    //             default:
    //                 return options.inverse(this);
    //         }
    //     });

    // }

    // Handlebars.registerHelper('checkIf', function(v1, o1, v2, mainOperator, v3, o2, v4, options) {
    //     var operators = {
    //         '==': function(a, b) { return a == b },
    //         '===': function(a, b) { return a === b },
    //         '!=': function(a, b) { return a != b },
    //         '!==': function(a, b) { return a !== b },
    //         '<': function(a, b) { return a < b },
    //         '<=': function(a, b) { return a <= b },
    //         '>': function(a, b) { return a > b },
    //         '>=': function(a, b) { return a >= b },
    //         '&&': function(a, b) { return a && b },
    //         '||': function(a, b) { return a || b },
    //     }
    //     var a1 = operators[o1](v1, v2);
    //     var a2 = operators[o2](v3, v4);
    //     var isTrue = operators[mainOperator](a1, a2);
    //     return isTrue ? options.fn(this) : options.inverse(this);
    // });

    // Handlebars.registerHelper('formatPrize', function(value) {
    //     if (value.toString() === '1') {
    //         value = '1st';
    //     }
    //     if (value.toString() === '2') {
    //         value = '2nd';
    //     }
    //     if (value.toString() === '3') {
    //         value = '3rd';
    //     }
    //     if (value.toString() === '4') {
    //         value = 'Starter';
    //     }
    //     if (value.toString() === '5') {
    //         value = 'Consolation';
    //     }
    //     return value;
    // });

    // Handlebars.registerHelper('formatDate', function(value) {
    //     value = moment(value).format('ddd, D MMMM YYYY');
    //     return value;
    // });

    // function initCountDowntimer() {

    //     moment.locale('en');

    //     _countdownTimer = setInterval(function() {

    //         var now = moment().utcOffset(0);
    //         now = moment(now).utcOffset(_utcOffset);
    //         now.add('-1', 'minute');
    //         var countdownTime = moment(_countdowntime);
    //         var duration = moment.duration(countdownTime.diff(now));

    //         var days = duration._data.days;
    //         var hours = duration._data.hours;
    //         var minutes = duration._data.minutes;
    //         var seconds = duration._data.seconds;

    //         if (days > 0) {
    //             hours = days * 24 + hours - 1;
    //         }

    //         if (minutes < 0 || hours < 0 || seconds < 0) {
    //             hours = '00';
    //             minutes = '00';
    //             seconds = '00';

    //             clearInterval(_countdownTimer);

    //             lotteryIntegration();

    //         } else {

    //             if (minutes < 10) {
    //                 minutes = '0' + minutes;
    //             }

    //             if (hours < 10) {
    //                 hours = '0' + hours;
    //             }

    //             if (seconds < 10) {
    //                 seconds = '0' + seconds;
    //             }

    //         }

    //         $('.countdownbox .hours').text(hours);
    //         $('.countdownbox .minutes').text(minutes);
    //         $('.countdownbox .seconds').text(seconds);

    //     }, 1000);

    // }

    // function getFilterResult(gameCode, filter) {

    //     var counter = 0;

    //     $.ajax({
    //         url: lotteryAPILink,
    //         type: 'POST',
    //         data: JSON.stringify({
    //             'gameCode': gameCode,
    //             'filter': filter,
    //             'actionType': 'getTicketRedeemedInfo'
    //         }),
    //         dataType: 'json',
    //         contentType: 'application/json; charset=utf-8',
    //         success: function(data, textStatus, jQxhr) {

    //             var data = JSON.parse(data.result);

    //             if (data.length > 0) {
    //                 var filterData = [];
    //                 var tempArr = [];

    //                 // Filter data
    //                 var prevDate;
    //                 var currentDate;

    //                 for (var i = 0; i < data.length; i++) {
    //                     tempArr.push(data[i]);

    //                     counter++;
    //                     if ((counter % 23 === 0 || i === data.lenth - 1) && i !== 0) {
    //                         counter = 0;
    //                         filterData.push({
    //                             ['patch_' + i]: tempArr
    //                         });
    //                         tempArr = [];
    //                     }
    //                 }

    //                 console.log('History', filterData);

    //                 // Recent spin result
    //                 sourceHistory = sourceHistory || $('#source-history').html();
    //                 var template = Handlebars.compile(sourceHistory);
    //                 var context = filterData;
    //                 var htmlRaw = template(context);

    //                 $('.spin-result.all .spin-box').html(htmlRaw);
    //                 $('.msg-error').addClass('hide');

    //                 $('.box-inner.style-1').each(function() {
    //                     if ($(this).find('.content .field').length === 0) {
    //                         $(this).addClass('hide');
    //                     } else {
    //                         $(this).find('.content .number.same-line').each(function(index) {
    //                             index = index + 1;
    //                             if (index % 2 === 0) {
    //                                 $(this).prev().andSelf().wrapAll('<div class="field"></div>');

    //                             }
    //                         });
    //                     }

    //                 });
    //             } else {

    //                 // Recent spin result no data
    //                 sourceHistory = sourceHistory || $('#source-history').html();
    //                 var template = Handlebars.compile(sourceHistory);
    //                 var context = [];
    //                 var htmlRaw = template(context);
    //                 $('.spin-result.all .spin-box').html(htmlRaw);
    //                 $('.msg-error').removeClass('hide');
    //             }

    //         },
    //         error: function(jqXhr, textStatus, errorThrown) {
    //             console.log(errorThrown);
    //         }
    //     });
    // }

    function lotteryIntegration() {

        // Get Current Game Code Integration
        $.ajax({
            url: lotteryAPILink,
            type: 'POST',
            data: JSON.stringify({
                'actionType': 'getIntegrationGame'
            }),
            dataType: 'json',
            contentType: 'application/json; charset=utf-8',
            success: function(data, textStatus, jQxhr) {

                var data = JSON.parse(data.result);
                //console.log(data);

                _gameCode = data[0].game_code;
                _uid = data[0].uid;
                _countdowntime = data[0].countdowntime;

                initCountDowntimer();

                // Set up Live Draw link
                var gameLink = domain + 'lotteryv3/udata/' + _uid + '/' + _gameCode + '/client/';
                $('.live-draw a').attr('href', gameLink);

                var isHomePage = $('.homepage').length;
                var counter = 0;
                if (isHomePage) {
                    // Get Latest results spin
                    $.ajax({
                        url: lotteryAPILink,
                        type: 'POST',
                        data: JSON.stringify({
                            'gameCode': _gameCode,
                            'filter': 'ORDER BY created_date, prize LIMIT 92',
                            'actionType': 'getTicketRedeemedInfo'
                        }),
                        dataType: 'json',
                        contentType: 'application/json; charset=utf-8',
                        success: function(data, textStatus, jQxhr) {

                            var data = JSON.parse(data.result);
                            var filterData = [];
                            var tempArr = [];

                            // Filter data
                            var prevDate;
                            var currentDate;

                            for (var i = 0; i < data.length; i++) {
                                tempArr.push(data[i]);

                                counter++;
                                if ((counter % 23 === 0 || i === data.lenth - 1) && i !== 0) {
                                    counter = 0;
                                    filterData.push({
                                        ['patch_' + i]: tempArr
                                    });
                                    tempArr = [];
                                }
                            }

                            console.log('filterData', filterData);

                            if (data.length > 0) {
                                moment.locale('en');

                                var dateTime = moment(filterData[3].patch_91[0].created_date);
                                dateTime = dateTime.format('LLLL');

                                // Latest spin result
                                sourceLatest = sourceLatest || $('#source-latest').html();
                                var template = Handlebars.compile(sourceLatest);
                                var context = filterData;
                                var htmlRaw = template(context);

                                $('.spin-result.latest .list-number').html(htmlRaw);

                                $('.spin-result-latest-date').text(dateTime);

                                $('.spin-draw-no span').text(filterData[3].patch_91[0].draw_no);

                                // Recent spin result
                                sourceRecent = sourceRecent || $('#source-recent').html();
                                var template = Handlebars.compile(sourceRecent);
                                var context = filterData;
                                var htmlRaw = template(context);

                                $('.spin-result.recent .spin-box').html(htmlRaw);

                                $('.box-inner.style-1').each(function() {
                                    if ($(this).find('.content .field').length === 0) {
                                        $(this).addClass('hide');
                                    } else {
                                        $(this).find('.content .number.same-line').each(function(index) {
                                            index = index + 1;
                                            if (index % 2 === 0) {
                                                $(this).prev().andSelf().wrapAll('<div class="field"></div>');

                                            }
                                        });
                                    }
                                });
                            }

                        },
                        error: function(jqXhr, textStatus, errorThrown) {
                            console.log(errorThrown);
                        }
                    });

                }

                // Get All History Spin
                var isSpinHistoryPage = $('.history').length;
                if (isSpinHistoryPage) {
                    var filter = 'ORDER BY created_date, prize LIMIT 69';
                    getFilterResult(_gameCode, filter)

                }


                // Contact Form
                var isContactForm = $('.contact-area-wrapper').length;
                if (isContactForm) {

                    $('.contact-area-wrapper .submit-btn').on('click', function(e) {
                        e.preventDefault();

                        if ($(this).hasClass('disabled')) {
                            return false;
                        }

                        // Show overlay
                        $('.preloader-wrapper').addClass('bg-black').show();

                        var submitData = {
                            'customerName': $('#uname').val().replace('script', ''),
                            'customerEmail': $('#email').val().replace('script', ''),
                            'message': $('#message').val().replace('script', ''),
                            'actionType': 'sendEmail'
                        }
                        $.ajax({
                            url: wpAPILink,
                            type: 'POST',
                            data: JSON.stringify(submitData),
                            dataType: 'json',
                            contentType: 'application/json; charset=utf-8',
                            success: function(data, textStatus, jQxhr) {

                                // Hide overlay
                                $('.preloader-wrapper').removeClass('bg-black').hide();

                                var data = data.result;
                                //console.log(data);

                                $('.server-msg').text(data);

                            },
                            error: function(jqXhr, textStatus, errorThrown) {
                                console.log(errorThrown);

                                // Hide overlay
                                $('.preloader-wrapper').removeClass('bg-black').hide();

                            }
                        });
                    });
                }

            },
            error: function(jqXhr, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });

        $('.contact-area-wrapper #uname, .contact-area-wrapper #email, .contact-area-wrapper #message').on('keyup', function() {
            var name = $('.contact-area-wrapper #uname').val();
            var email = $('.contact-area-wrapper #email').val();
            var message = $('.contact-area-wrapper #message').val();

            if (name.length > 0 && email.length > 0 && message.length > 0) {
                $('.contact-area-wrapper .submit-btn').removeClass('disabled');
            } else {
                $('.contact-area-wrapper .submit-btn').addClass('disabled');
            }
        });
    }

    jQuery(document).ready(function($) {
        /*------------------------------
            counter section activation
        -------------------------------*/
        var counternumber = $('.count-num');
        counternumber.counterUp({
            delay: 20,
            time: 3000
        });
        /*--------------------
            wow js init
        --------------------*/
        new WOW().init();
        /*----------------------------
            portfolio menu active
        ----------------------------*/
        var portfolioMenu = '.portfolio-menu li';
        $(document).on('click', portfolioMenu, function() {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
        });

        /*----------------------------------
            magnific popup activation
        ----------------------------------*/
        $('.image-popup').magnificPopup({
            type: 'image'
        });
        $('.video-play-btn,.play-video-btn').magnificPopup({
            type: 'video'
        });
        /*-------------------------------
            back to top
        ------------------------------*/
        $(document).on('click', '.back-to-top', function() {
            $("html,body").animate({
                scrollTop: 0
            }, 2000);
        });

        $('.navbar-nav li a').on('click', function(event) {
            $('.navbar-collapse').removeClass('show');
        });
        /*------------------------------
            smoth achor effect
        ------------------------------*/
        $(document).on('click', '#appside_main_menu li a', function(e) {
            var anchor = $(this).attr('href');
            var link = anchor.slice(0, 1);
            if ('#' == link) {
                e.preventDefault();
                var top = $(anchor).offset().top;
                $('html, body').animate({
                    scrollTop: $(anchor).offset().top
                }, 1000);
                $(this).parent().addClass('active').siblings().removeClass('active');
            }

        });


        // Datepicker Events
        var materialPicker006 = new MaterialDatepicker('.query-history input', {
            outputFormat: 'DD/MM/YYYY',
            onNewDate: function(date) {
                var formatDateTo = moment(date).format('YYYY-MM-DD');
                var formatDateFrom = moment(date).add('-2', 'day').format('YYYY-MM-DD');
                console.log(formatDateFrom, formatDateTo);

                var filter = 'AND CONVERT(created_date, date)  BETWEEN "' + formatDateFrom + '" AND "' + formatDateTo + '" ORDER BY created_date, prize LIMIT 69';
                getFilterResult(_gameCode, filter);
            }
        });

        /*----------------------------------------
             screenshort carousel
         ----------------------------------------*/
        var $brandCarousel = $('.brand-carousel');
        if ($brandCarousel.length > 0) {
            $brandCarousel.owlCarousel({
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: false,
                nav: true,
                smartSpeed: 3000,
                navText: ['', ''],
                responsive: {
                    0: {
                        items: 1,
                        nav: false
                    },
                    360: {
                        items: 2,
                        nav: false
                    },
                    767: {
                        items: 2,
                        nav: false
                    },
                    768: {
                        items: 2,
                        nav: false
                    },
                    960: {
                        items: 3,
                        nav: false
                    },
                    1200: {
                        items: 4
                    },
                    1920: {
                        items: 5
                    }
                }
            });
        }
        /*----------------------------------------
            screenshort carousel
        ----------------------------------------*/
        var $screenshortCarouselTwo = $('.screenshort-carousel-02');
        if ($screenshortCarouselTwo.length > 0) {
            $screenshortCarouselTwo.owlCarousel({
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: false,
                nav: true,
                smartSpeed: 3000,
                navText: ['', ''],
                responsive: {
                    0: {
                        items: 1,
                        nav: false
                    },
                    414: {
                        items: 2,
                        nav: false
                    },
                    767: {
                        items: 2,
                        nav: false
                    },
                    768: {
                        items: 2,
                        nav: false
                    },
                    960: {
                        items: 3,
                        nav: false
                    },
                    1200: {
                        items: 4
                    },
                    1920: {
                        items: 3
                    }
                }
            });
        }
        /*----------------------------------------
            screenshort carousel
        ----------------------------------------*/
        var $screenshortCarousel = $('.screenshort-carousel');
        if ($screenshortCarousel.length > 0) {
            $screenshortCarousel.owlCarousel({
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: false,
                nav: true,
                smartSpeed: 3000,
                navText: ['', ''],
                responsive: {
                    0: {
                        items: 1,
                        nav: false
                    },
                    767: {
                        items: 2,
                        nav: false
                    },
                    768: {
                        items: 2,
                        nav: false
                    },
                    960: {
                        items: 3,
                        nav: false
                    },
                    1200: {
                        items: 4
                    },
                    1920: {
                        items: 4
                    }
                }
            });
        }
        /*----------------------------------------
            testimonial carousel
        ----------------------------------------*/
        var $testimonialCarousel = $('.testimonial-carousel');
        if ($testimonialCarousel.length > 0) {
            $testimonialCarousel.owlCarousel({
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: true,
                nav: true,
                smartSpeed: 3000,
                animateIn: 'fadeIn',
                animateOut: "fadeOut",
                navText: ['', ''],
                responsive: {
                    0: {
                        items: 1,
                        nav: false
                    },
                    767: {
                        items: 1,
                        nav: false
                    },
                    768: {
                        items: 1,
                        nav: false
                    },
                    960: {
                        items: 1,
                        nav: false
                    },
                    1200: {
                        items: 1
                    },
                    1920: {
                        items: 1
                    }
                }
            });
        }
        /*----------------------------------------
            testimonialtwo carousel
        ----------------------------------------*/
        var $testimonialCarouselTwo = $('.testimonial-carousel-02');
        if ($testimonialCarouselTwo.length > 0) {
            $testimonialCarouselTwo.owlCarousel({
                loop: true,
                autoplay: false, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 60,
                dots: true,
                nav: true,
                smartSpeed: 3000,
                animateIn: 'fadeIn',
                animateOut: "fadeOut",
                navText: ['', ''],
                center: true,
                stagePadding: 100,
                responsive: {
                    0: {
                        items: 1,
                        nav: false,
                        center: false,
                        stagePadding: 10
                    },
                    414: {
                        items: 1,
                        nav: false,
                        center: false,
                        stagePadding: 10
                    },
                    767: {
                        items: 1,
                        nav: false,
                        center: false,
                        stagePadding: 10
                    },
                    768: {
                        items: 1,
                        nav: false
                    },
                    960: {
                        items: 1,
                        nav: false,
                        center: false
                    },
                    1200: {
                        items: 2,
                        nav: false,
                        center: false,
                        stagePadding: 10
                    },
                    1920: {
                        items: 2
                    }
                }
            });
        }
        /*----------------------------------------
            testimonialtwo carousel
        ----------------------------------------*/
        var $testimonialCarouselThree = $('.testimonial-carousel-03');
        if ($testimonialCarouselThree.length > 0) {
            $testimonialCarouselThree.owlCarousel({
                loop: true,
                autoplay: false, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: true,
                nav: true,
                smartSpeed: 3000,
                animateIn: 'fadeIn',
                animateOut: "fadeOut",
                navText: ['', ''],
                responsive: {
                    0: {
                        items: 1,
                        nav: false
                    },
                    767: {
                        items: 1,
                        nav: false
                    },
                    768: {
                        items: 1,
                        nav: false
                    },
                    960: {
                        items: 2,
                        nav: false,
                    },
                    1200: {
                        items: 3
                    },
                    1920: {
                        items: 3
                    }
                }
            });
        }
        /*----------------------------------------
            Team carousel
        ----------------------------------------*/
        var $teamCarousel = $('.team-carousel');
        if ($teamCarousel.length > 0) {
            $teamCarousel.owlCarousel({
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: true,
                nav: true,
                smartSpeed: 3000,
                animateIn: 'fadeIn',
                animateOut: "fadeOut",
                navText: ['', ''],
                responsive: {
                    0: {
                        items: 1,
                        nav: false
                    },
                    414: {
                        items: 1,
                        nav: false
                    },
                    520: {
                        items: 2,
                        nav: false
                    },
                    767: {
                        items: 2,
                        nav: false
                    },
                    768: {
                        items: 2,
                        nav: false
                    },
                    960: {
                        items: 3,
                        nav: false
                    },
                    1200: {
                        items: 4
                    },
                    1920: {
                        items: 4
                    }
                }
            });
        }

        // Call API To Handle Data Lottery
        lotteryIntegration();
    });


    //define variable for store last scrolltop
    var lastScrollTop = '';
    $(window).on('scroll', function() {
        /*---------------------------
            back to top show / hide
        ---------------------------*/
        var ScrollTop = $('.back-to-top');
        if ($(window).scrollTop() > 1000) {
            ScrollTop.fadeIn(1000);
        } else {
            ScrollTop.fadeOut(1000);
        }
        /*--------------------------
         sticky menu activation
        ---------------------------*/
        var st = $(this).scrollTop();
        var mainMenuTop = $('.navbar-area');
        if ($(window).scrollTop() > 1000) {
            if (st > lastScrollTop) {
                // hide sticky menu on scrolldown 
                mainMenuTop.removeClass('nav-fixed');

            } else {
                // active sticky menu on scrollup 
                mainMenuTop.addClass('nav-fixed');
            }

        } else {
            mainMenuTop.removeClass('nav-fixed ');
        }
        lastScrollTop = st;

    });

    $(window).on('load', function() {
        /*-----------------------------
            preloader
        -----------------------------*/
        var preLoder = $("#preloader");
        preLoder.fadeOut(1000);
        /*-----------------------------
            back to top
        -----------------------------*/
        var backtoTop = $('.back-to-top')
        backtoTop.fadeOut(100);
    });

}(jQuery));