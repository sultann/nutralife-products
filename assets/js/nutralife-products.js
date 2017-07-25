/**
 * Nutralife Products - v0.1.0 - 2017-07-25
 * http://manik.me
 *
 * Copyright (c) 2017;
 * Licensed GPLv2+
 */
/*jslint browser: true */
/*global jQuery:false */

window.Nutralife_Products = (function(window, document, $, undefined){
	'use strict';

	var app = {};
	app.init = function() {
        adjust_tax_height();
	    function adjust_tax_height() {
            var winWidth = $(window).width();
            if(winWidth>760){
                var rightPanel = $('.double-cols-parent').find('.three-fourth').height();
                // console.log(rightPanel);
                // var height = $('.taxonomy-list-wrapper').closest('.column').outerHeight();
                $('.taxonomy-list-wrapper').css('height', (rightPanel-20)+'px');
            }
        }
        $(window).on('resize', function () {
            adjust_tax_height();
        });

	    var tax_menu =$('.taxonomy-list-wrapper').clone(true);
        tax_menu.appendTo('.breadcrumbs-mobile-tax-wrapper');
        $('.tax-responsive-menu-toggle ').on('click', function () {
           $('.breadcrumbs-mobile-tax-wrapper').toggleClass('menu-active');
            $('.breadcrumbs-mobile-tax-wrapper li').find('a').on('click', function () {
                $('.breadcrumbs-mobile-tax-wrapper').toggleClass('menu-active');
            });
           return false;
        });
	};





	$(document).ready( app.init );

	return app;

})(window, document, jQuery);

