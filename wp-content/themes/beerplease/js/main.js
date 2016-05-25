(function($) {
    'use strict';

    $.Common = function() {
        // Élements commun
        this.elements = {
            body: $('body')
        };

        // Variables par défaut
        this.pageFunction = {
            pageHome: 'home'
        };

        this.windowWidth = screen.width;
        this.device = {
            desktop: (this.windowWidth >= 1024) ? true : false,
            tablet: (this.windowWidth >= 768 && this.windowWidth < 1024) ? true : false,
            smartphone: (this.windowWidth < 768) ? true : false
        };

        // Init
        this.init();
    };

    $.Common.prototype = {
        init: function() {
            var self = this;

            // Pour toutes les pages
            self.pageAll();

            // Pour chaque page
            $.each(self.pageFunction, function(funcName, className) {
                if (self.elements.body.hasClass(className) && typeof self[funcName] == 'function') {
                    self[funcName]();
                }
            });
        },
        pageAll: function() {
            $.extend(this.elements, {
                biggerLink: $('.is-link'),
                cookieLegal: $('.notice-cookie')
            });

            // Agrandissement de la zone de clic s'il y a "lire la suite"
            this.biggerLink();

            //Cookie légal en bas de page
            this.noticeCookie();
        },
        biggerLink: function() {
            this.elements.biggerLink.click(function(event) {
                event.preventDefault();
                location.href = $(this).find('a:first').attr('href');
            });
        },
        noticeCookie: function() {
            var self = this;

            if (this.elements.cookieLegal.length) {

                self.elements.cookieLegal.find( "button" ).click( function() {
                    var expDate = new Date();
                    var valueCookie = expDate.getTime();
                    expDate.setFullYear( expDate.getFullYear() + 1 );
                    $(this).setCookie( "BEERPLEASE-COOKIE-ACCEPT", valueCookie, expDate, cookiePathApp, cookieDomainApp);
                    self.elements.cookieLegal.fadeOut();
                } );
            }
        },

        /**
         * Page d'accueil
         */
        pageHome: function() {
            $.extend(this.elements, {
                headerImage: $('.header-image')
            });

            var self = this;
            
            //Parallaxe sur les visuels du slider
            if (!this.device.smartphone) {
                self.headerParallax();

                $(window).scroll(function() {  
                    self.headerParallax();
                });
            }

        },
        headerParallax: function() {
            var self = this,
                top = $(window).scrollTop();

            self.elements.headerImage.css({'background-position' : 'center ' + (top/2)+"px"}); 
        },
    };

    /**
     * Méthode getcookie
     * @param name
     * @returns {undefined}
     */
    $.fn.getCookie = function(name) {
        var cookies = document.cookie.split( "; "),
            returnValue = undefined;

        $( cookies ).each( function( key, value ) {
            if( value.indexOf( name ) != -1 ) {
                returnValue = value.split( "=" )[ 1 ];
            }
        });

        return returnValue;
    };

    /**
     * Méthode setcookie
     * @param name, value, expire, path, domain, security
     * @returns {undefined}
     */
    $.fn.setCookie = function(name, value, expire, path, domain, security) {
        document.cookie = name + " = " + value + "  " +
            ( ( expire === undefined ) ? "" : ( "; expires = " + expire.toGMTString() ) ) +
            ( ( path === undefined ) ? "" : ( "; path = " + path ) ) +
            ( ( domain === undefined ) ? "" : ( "; domain = " + domain ) ) +
            ( ( security === true ) ? "; secure" : ""
            );
    };
    
    /**
     * onReady
     */
    $(document).ready(function() {
        new $.Common();
    });
})(jQuery);