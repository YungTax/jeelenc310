/*
* @package pls
*/
jQuery(document).ready(function($){
    "use strict";
	
	var pls_import_percent 			= 0,
        pls_import_percent_increase 	= 0,
        pls_import_index_request 		= 0,
        pls_import_request_data 		= [],
        pls_import_demo_name 			= '';
	
	/* Size Guide Chart Table*/
	var sizechart_table = $('#pls-chart-table');
	if(sizechart_table.length > 0 ) {
        sizechart_table.editTable();
    }
	
	/* Color Picker */
    if( $('.pls-color-box').length > 0 ) {
        $('.pls-color-box').wpColorPicker();
    }
	
	/**
     * Load models
     */
    $(document).on('change', '.pls-select-make', function () {
		
		var _this = $(this);
		var make_id = $(_this).val();
		var target_field = $('.pls-select-model');
		var data = {
			action	: 'pls_get_models',
			make_id	: make_id
		};
		
		$.post(ajaxurl,data,function(response) {
			if(response.success){
				$(target_field).html(response.content);
			}
			
		});	
	});
	
	if( $('.pls-image-clear').length > 0 ) {
		
		var attachments = $('.pls-image-clear');		
		attachments.each(function(index){
			var current_attachment = $(this),
			attachmentWrap		= current_attachment.closest('td'),
			attachement_id = attachmentWrap.find('.pls-attachment-id').val();
			if(attachement_id == ''){
				attachmentWrap.find('.pls-image-clear').hide();
			}
			
		});
		
		$(document).on('click','.pls-image-clear',function(e){			
			var image_url = $(this).attr('data-src');			
			$(this).parent().find('.pls-attr-img').attr('src',image_url);
            $(this).parent().find('.pls-attachment-id').val('');
			$(this).parent().find('.pls-image-clear').hide('slow');
			
		});
    }
	
	/* Upload media image */
	$(document).on('click','.pls-image-upload',function(e){
		e.preventDefault();
		var img_wrap,img_clear,attachment_id_wrap;

		img_wrap 				=  $(this).parent().find('.pls-attr-img');
		attachment_id_wrap	=  $(this).parent().find('.pls-attachment-id');
		img_clear			= $(this).parent().find('.pls-image-clear');
		var image = wp.media({ 
            title: 'Upload Image',
            multiple: false
        }).open()
        .on('select', function(e){
            var uploaded_image = image.state().get('selection').first();
            var image_url,attachment;
			attachment = uploaded_image.toJSON();
			var attachment_id = attachment.id ? attachment.id : '';
            if(typeof uploaded_image.toJSON().sizes.thumbnail === 'undefined') {
                image_url=attachment.url;
                image_url=attachment.url;
            }else{
                image_url = attachment.sizes.thumbnail.url;
            }
            img_wrap.attr('src',image_url);
            attachment_id_wrap.val(attachment_id);
			img_clear.show('slow');
		
        });
	});
	
	/* Import Demo*/
	$(document).on('click', '.pls-import-data .theme .import-button', function(e) {
		var content_wrp = $(this).closest('.theme');
		var template_part = $('#pls-popup-content');
		content_wrp.find('.theme-screenshot').addClass('loading');
		var template	= wp.template('pls-popup-data');
		var demo_name,demo_deails,modalcontainer;
		demo_name = $(this).attr('data-name');
		pls_import_demo_name = $(this).attr('data-name');
		modalcontainer = $(this).closest('.pls-import-demo-popup');
		
		var data = {
						action	: 'get_demo_data',
						demo   	: demo_name
					};
					
		$.post(ajaxurl,data,function(response) {
			
			var data = $.parseJSON(response);
			
			if( !data.status){
				alert(data.message);
				content_wrp.find('.theme-screenshot').removeClass('loading');
				return;
			}
			
			template_part.append( template({
				title : data.title,
				demo_key : data.slug,
				preview_image : data.preview_image,
				preview_demo_link : data.preview_demo_link,
			}));
			
			$.magnificPopup.open({
				items			: {
					src	: '.pls-import-demo-popup'
				},
				type			: 'inline',
				mainClass		: 'mfp-with-zoom',
				closeOnBgClick	: false,
				enableEscapeKey	: false,
				zoom			: {
					enabled	: true,
					duration: 300
				},
				callbacks		: {
					open	: function () {
						content_wrp.find('.theme-screenshot').removeClass('loading');
					},	
					close	:function(){
						template_part.html('');
					}
				},
			});
		});	
	});
	
	/* Process to import*/
	$(document).on('click', '.install-demo', function(e) {
		var import_btn = $(this);
		if (import_btn.hasClass('processing')) {
			return false;
		}
		if (import_btn.hasClass('disabled')) {
			return false;
		}
		if (import_btn.hasClass('import-completed')) {
			return false;
		}
		
		var c = confirm('Are you sure you want to import this demo?');
		if (!c) {
			return false;
		}
		
		import_btn.addClass('processing');
		import_btn.addClass('loading');
		$('.install-demo.processing').text('Importing...');
		$('.progress-percent').html('1%');
		$('.progress-bar').css('width','1%');
		$('.import-process').show();
		pls_import_request_data = [],
		pls_import_demo_name = $(this).attr('data-demo');
		
		var import_full_content = false,
		import_content 			= false,
		import_menu 			= false,
		import_widget 			= false,
		import_revslider 		= false,
		import_theme_options 	= false,
		import_attachments 		= false;
		var demo_name 			= pls_import_demo_name;
		
        if ($('#import_content_' + demo_name).is(':checked')) {
            import_content = true;
        } else {
            import_content = false;
        }
		if ($('#import_widget_' + demo_name).is(':checked')) {
            import_widget = true;
        } else {
            import_widget = false;
        }
        if ($('#import_revslider_' + demo_name).is(':checked')) {
            import_revslider = true;
        } else {
            import_revslider = false;
        }
        if ($('#import_attachments_' + demo_name).is(':checked')) {
            import_attachments = true;
        } else {
            import_attachments = false;
        }
        if ($('#import_menu_' + demo_name).is(':checked')) {
            import_menu = true;
        } else {
            import_menu = false;
        }
        if ($('#import_theme_options_' + demo_name).is(':checked')) {
            import_theme_options = true;
        } else {
            import_theme_options = false;
        }
        if ($('#import_full_content_' + demo_name).is(':checked')) {
            import_full_content 	= true;
            import_widget 			= true;
            import_revslider 		= true;
            import_menu 			= true;
            import_content 			= true;
            import_attachments 		= true;
            import_theme_options 	= true;
        }
		
        /* Import content */
        if ( import_content ) {			
			var condent_no;
			for (condent_no = 1; condent_no <= 1; condent_no++) {
				var data = {
					'action'		: 'import_content',
					'count'			: condent_no,
					'attachments'	: import_attachments,
				}
				
				pls_import_request_data.push(data);
			}		
        }
		
		/* Import Menu */
		if ( import_menu ) {
            pls_import_request_data.push({
                'action'	: 'import_menu',
                'demo_name'	: demo_name,
            });
        }
		
		/* Import Theme Options */
        if ( import_theme_options ) {
            pls_import_request_data.push({
                'action'	: 'import_theme_options',
                'demo_name'	: demo_name,
            });
        }
		
		/* Import Widget */
        if ( import_widget ) {
            pls_import_request_data.push({'action': 'import_widget', 'demo_name': demo_name});
        }
		
		/* Import Slider */
        if ( import_revslider ) {
            pls_import_request_data.push({'action': 'import_revslider', 'demo_name': demo_name});
        }
        
		/* Import Configuration */
        pls_import_request_data.push({
            'action': 'import_config',
            'demo_name': demo_name,
        });
        
        var total_ajaxs = pls_import_request_data.length;
        
        if (total_ajaxs == 0) {
            import_btn.removeClass('processing');
            import_btn.removeClass('loading');
			import_btn.addClass('import-completed');
            return;
        }
        
        pls_import_percent_increase = (100 / total_ajaxs);
       
        pls_import_ajax_call();
        
        e.preventDefault();
		
	});
	
	function pls_import_ajax_call() {
        if (pls_import_index_request == pls_import_request_data.length) {
			alert('Import proceess done');
			location.reload();
            return;
        }
       $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: pls_import_request_data[pls_import_index_request],
            complete: function (jqXHR, textStatus) {
                pls_import_percent += pls_import_percent_increase;
                pls_import_progress_bar();
                pls_import_index_request++;
                setTimeout(function () {
                    pls_import_ajax_call();
                }, 200);
            }
        });
    }
	function pls_import_progress_bar(){
		if (pls_import_percent > 100) {
            pls_import_percent = 100;
        }
        
        if (pls_import_percent == 100) {
            $('.install-demo.processing').text('Import Completed');
			$('.pls-complete-action').show();
            $('.install-demo.processing').removeClass('loading');
            $('.install-demo.processing').removeClass('processing');
            
        }
        
        var progress_bar_wrap = $('[data-demo="' + pls_import_demo_name + '"]').closest('.pls-import-demo-popup').find('.import-process');
        progress_bar_wrap.find('.progress-percent').html(parseInt(pls_import_percent)+'%');  
        progress_bar_wrap.find('.progress-bar').css('width',parseInt(pls_import_percent)+'%');
	}
	
	function full_content_change() {
        $('.import_full_content').each(function () {
            var _this = $(this);
            if (_this.is(':checked')) {
                _this.closest('.import-options').find('input[type="checkbox"]').not(_this).attr('checked', false);
                _this.closest('.import-options').find('label').not(_this.parent()).css({
                    'pointer-events': 'none',
                    'opacity': '0.4'
                });
            } else {
                _this.closest('.import-options').find('label').not(_this.parent()).css({
                    'pointer-events': 'initial',
                    'opacity': '1'
                });
            }
        })
		if ($(".import-options input:checkbox:checked").length > 0)
		{
			$('.import-options').closest('.pls-box-body').find('.install-demo').removeClass('disabled');
		}
		else
		{
		   $('.import-options').closest('.pls-box-body').find('.install-demo').addClass('disabled');
		}
    }
    
    full_content_change();
    
    $(document).on('change', function () {
        full_content_change()
    });
	
});

/*
* Select service icon
*/
jQuery(function($){
		
	$('.fa-service-icons > span').on('click', function(e){
		var me = $(this);
		$(this).parent().find('span').removeClass('selected');
		me.addClass('selected');
		var icon = me.find('i').attr('id');
		
		me.parents('.fa-select-icon').find('.hidden_icon').val(icon);
	
	});
})
