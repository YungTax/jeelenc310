jQuery( function ( $ )
{
	 "use strict";
	/* Enable megamenu */
	$( 'body' ).on( 'change', '.edit-menu-item-megamenu-enable', function ( e ) {
	
		var itemid = $(this).data('itemid'),
		megamenu_block = $(this).closest('.pls-custom-fields');
		var selected_design='555';
		if(this.checked) {
			megamenu_block.find('.megamenu-field').removeClass('hidden-field');			
			selected_design = $('#edit-menu-item-design-'+itemid).val();	
			if(selected_design == 'custom-size'){
				$('#pls-custom-design-block-'+itemid).removeClass('hidden-field');
			}
		}else{
			megamenu_block.find('.megamenu-field').addClass('hidden-field');
			$('#pls-custom-design-block-'+itemid).addClass('hidden-field');
		}
	});
	
	/* Menu design block */
	$( 'body' ).on( 'change', '.pls-menu-design', function ( e ) {
		var itemid = $(this).data('itemid');
		var design = $(this).val();
		if(design == 'custom-size'){
			$('#pls-custom-design-block-'+itemid).show('slow');
		}else{
			$('#pls-custom-design-block-'+itemid).hide('slow');
		}
		
	});
	
	/* Menu block edit link */
	$('.pls-custom-block').change(function() {
		$('.edit-block-link').attr('href', $(this).find('option:selected').data('block-link')).show();
	});
	
	/*
	* Field Icon
	*/
	$( 'body' ).on( 'click', '.pick-icon', function ( e ) {
		e.preventDefault();
		$( this ).next( '.icons-block' ).css('display', 'block');
	} );
	$( 'body' ).on( 'click', '.pls-icon-close', function ( e ) {
		$('.icons-block').slideUp('slow');
	} );
	$( '.icon-selector' ).on( 'click', 'i', function(e) {
		e.preventDefault();
		var $el = $( this ),
			icon = $el.data( 'icon' );

		$el.closest( '.icons-block' ).next( 'input' ).val( icon ).siblings( '.pick-icon' ).children( 'i' ).attr( 'class', icon );
		$el.addClass( 'selected' ).siblings( '.selected' ).removeClass( 'selected' );
	} );

	$( '.search-icon' ).on( 'keyup', function() {
		var search = $( this ).val(),
			$icons = $( this ).siblings( '.icon-selector' ).children();

			if ( !search ) {
				$icons.show();
				return;
			}

			$icons.hide().filter( function() {
				return $( this ).data( 'icon' ).indexOf( search ) >= 0;
			} ).show();
	} );		
	$(document).on('click','.pls-menu-image-clear',function(e){   
		e.preventDefault();
		var $btn = this;
		var itemid = $(this).data('itemid');
		if (confirm(pls_admin_params.menu_delete_icon_msg)) {
			$($btn).closest('.pls-menu-icon-img').find('.img-wrp').html('');
			$('#edit-menu-item-thumbnail-url-'+itemid).val('');
			$('#pls-attachment-'+itemid).val('');
			$('#pls-media-upload-'+itemid).text(pls_admin_params.menu_icon_upload_text);
		}		
	});    
	$(document).on('click','.pls-menu-image-upload',function(e){
		e.preventDefault();
		var img_content = '';
		var $btn = this;
		var itemid = $(this).data('itemid');
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
			img_content = '<img src="'+image_url+'" width="32" height="32">';
			img_content += '<span data-itemid = "'+itemid+'" class="pls-menu-image-clear"></span>';
			$($btn).closest('.pls-menu-icon-img').find('.img-wrp').html(img_content);
			$($btn).text(pls_admin_params.menu_icon_change_text);
            $('#edit-menu-item-thumbnail-url-'+itemid).val(image_url);
            $('#pls-attachment-'+itemid).val(attachment_id);
		
        });
	});	
} );