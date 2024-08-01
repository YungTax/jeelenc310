/* pls theme activation*/
jQuery( function ( $ ) {
	"use strict";
	var pls_activation = pls_activation || {};
	pls_activation.init = function() {
		var self = this;
		pls_activation.$doc          	= $(document)
		pls_activation.$html    		= $('html'),
		pls_activation.$body 			= $(document.body),
		pls_activation.$window 		= $(window),
		pls_activation.$windowWidth 	= $(window).width(),
		pls_activation.$windowHeight 	= $(window).height();
		self.activate_theme();
		self.deactivate_theme();
	};
	
	pls_activation.activate_theme = function() {
		// Activate theme
		$('body').on('click', '.pls-activate-btn', function() {
			var purchase_code = $(".purchase-code").val();
			var activate_btn = $(this);
			activate_btn.addClass('loading');
			if( $.trim(purchase_code) != ''){
				$(this).attr('disabled', 'true');
				var data = {
					action      	: 'activate_theme',
					purchase_code   : purchase_code,
					nonce   		: pls_admin_params.nonce,
				};
				$.post(ajaxurl,data,function(response) {
					
					var data = $.parseJSON(response);
					
					if(data.success == '1'){
						alert(data.message);
						setTimeout(function(){location.reload();}, 5000);
					}else{
						alert(data.message);
						activate_btn.removeClass('loading');
						activate_btn.removeAttr('disabled');
					}			
				});
			} else {
				alert('Please Enter Purchase Code');
			}
			
			return false;
		});
	};
	
	
	pls_activation.deactivate_theme = function() {
		// deactivate theme
		$('body').on('click', '.pls-deactivate-btn', function() {
			var purchase_code = $(".purchase-code").val();
			var activate_btn = $(this);
			activate_btn.addClass('loading');
			if( $.trim(purchase_code) != ''){
				$(this).attr('disabled', 'true');
				var data = {
					action      	: 'deactivate_theme',
					purchase_code   : purchase_code,
					nonce   		: pls_admin_params.nonce,
				};
				$.post(ajaxurl,data,function(response) {
					
					var data = $.parseJSON(response);
					
					if(data.success == '1'){
						alert(data.message);
						
						setTimeout(function(){location.reload();}, 5000);
					}else{
						alert(data.message);
						activate_btn.removeClass('loading');
						activate_btn.removeAttr('disabled');
					}
				});
			} else {
				alert('Purchase code is empty.');
			}
			//$(this).attr('disabled', 'true');
			return false;
		});
	};
	
	/**
	 * Document ready
	 */ 
	$(document).ready(function(){ 
		pls_activation.init();
    });
	
});
