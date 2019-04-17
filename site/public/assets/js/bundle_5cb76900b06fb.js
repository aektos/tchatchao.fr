(function ($) {

    "use strict";

    window.cookieDisclaimer = function(el,dropCookie, cookieDuration, cookieName, cookieValue) {
        this.init(el,dropCookie, cookieDuration, cookieName, cookieValue);
    };

    cookieDisclaimer.prototype = {
        init: function(el,dropCookie, cookieDuration, cookieName, cookieValue) {
            this.$el = $(el);

            this.dropCookie = dropCookie; // true;                      // false disables the Cookie, allowing you to style the banner
            this.cookieDuration = cookieDuration; // 14;                    // Number of days before the cookie expires, and the banner reappears
            this.cookieName = cookieName; // 'nicolastorre_cookieDisclaimer';        // Name of our cookie
            this.cookieValue = cookieValue; // 'on';                     // Value of cookie
        },

        event: function() {
            var that = this;

            this.$el.ready(function(){
                if(that.checkCookie(that.cookieName) != that.cookieValue){
                    that.createDiv();
                }
            });

            this.$el.on('click', '#cookie-law', function(e) {
                e.preventDefault();
                that.removeDisclaimer();
            });

            this.$el.on('click', '.close-cookie-banner', function(e) {
                e.preventDefault();
                that.removeDisclaimer();
            });
        },

        createDiv: function(){

            this.$el.append("<div id=\"cookie-law\"><div class=\"container\"><div class=\"row text-center\"><p>En poursuivant votre navigation sur ce site, vous acceptez les conditions générales d'utilisation du site et l’utilisation de cookies afin de réaliser des statistiques de visites. <a class=\"close-cookie-banner\" href=\"#\" rel=\"nofollow\"><span class=\"glyphicon glyphicon-remove\"></span></a></p></div></div></div>");

        },

        createCookie: function(name,value,days) {
            if (days) {
                var date = new Date();
                date.setTime(date.getTime()+(days*24*60*60*1000));
                var expires = "; expires="+date.toGMTString();
            } else {
                var expires = "";
            }
            if(this.dropCookie) {
                document.cookie = name+"="+value+expires+"; path=/";
            }
        },

        checkCookie: function(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for(var i=0;i < ca.length;i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;
        },

        eraseCookie: function(name) {
            this.createCookie(name,"",-1);
        },

        removeDisclaimer: function(){
            this.createCookie(this.cookieName,this.cookieValue, this.cookieDuration); // Create the cookie

            $('#cookie-law').remove();
        }

    }

})(jQuery);

;( function( $, window, document, undefined ) {

    "use strict";

    var tchatchao = function() {

        this.$doc = $(document);
        this.$header = $('.navbar-default');
        this.changeHeaderOn = 300;

        this.init();
    };

    tchatchao.prototype = {

        /**
         * Init
         */
        init: function() {
            // Init events
            this.event();

            // Set section height
            this.setSectionHeight();

            // Highlight the top nav as scrolling occurs
            this.highlightTopNav();

            this.event();

            var observer = lozad(); // lazy loads elements with default selector as '.lozad'
            observer.observe();

            var firstImages = document.querySelectorAll('.lozad-first');
            firstImages.forEach(function(firstImage) {
                observer.triggerLoad(firstImage);
            });
        },

        /**
         * Events
         */
        event: function() {
            var that = this;

            // Page anchor scrolling
            $('a.page-scroll').bind('click', function (e) {
                e.defaultPrevented;

                var $anchor = $(e.target).closest('a');

                $('html, body').stop().animate({
                    scrollTop: $($anchor.attr('href')).offset().top
                }, 300);
            });

            $(window).on('scroll', function(e) {

                if( !that.didScroll ) {
                    that.didScroll = true;
                    setTimeout( $.proxy(that.scrollPage, that), 250 );
                }
            });

            // Closes the Responsive Menu on Menu Item Click
            $('.navbar-collapse ul li a').on('click', function () {
                $('.navbar-collapse').collapse('hide');
            });
        },

        /**
         * Trigger when scrolling the page
         */
        scrollPage: function() {

            var scrollY = window.pageYOffset || this.$doc.scrollTop;

            if ( scrollY >= this.changeHeaderOn ) {
                this.$header.addClass('navbar-shrink');
            }
            else {
                this.$header.removeClass('navbar-shrink');
            }
            this.didScroll = false;

        },

        /**
         * Highlight the top nav as scrolling occurs
         */
        highlightTopNav: function() {
            $('body').scrollspy({
                target: '.navbar-fixed-top'
            });
        },

        /**
         * Set section height
         */
        setSectionHeight: function() {
            var windowHeight = $(window).height();
            var contactWindowHeight = $(window).height() - $('nav').height() - $('footer').height();

            $('section').css('min-height', windowHeight + 'px');
            $('#contact').css('min-height', contactWindowHeight + 'px');

            $('header').height($(window).height());
        }

    };

    $(document).ready(function() {
        window.tcha = new tchatchao();
    });

} )( jQuery, window, document );