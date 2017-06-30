/**
 * Nutralife Products
 * http://manik.me
 *
 * Copyright (c) 2017 MD Sultan N.
 * Licensed under the GPLv2+ license.
 */

/*jslint browser: true */
/*global jQuery:false */

window.Nutralife_Products = (function(window, document, $, undefined){
	'use strict';

	var app = {};

	app.init = function() {

	};

	var winWidth = $(window).width();
	if(winWidth>760){
	    var rightPanel = $('.double-cols-parent').find('.three-fourth').height();
	    // console.log(rightPanel);
        // var height = $('.taxonomy-list-wrapper').closest('.column').outerHeight();
        $('.taxonomy-list-wrapper').css('height', (rightPanel-20)+'px');
        console.log(rightPanel);
        console.log('worked');
    }



	$(document).ready( app.init );

	return app;

})(window, document, jQuery);

