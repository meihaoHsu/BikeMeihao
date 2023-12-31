/*globals jQuery, troubleshooting_data */

/** @namespace troubleshooting_data.nonce.icl_restore_notifications */
/** @namespace troubleshooting_data.nonce.icl_remove_notifications */

jQuery(function () {

    var remove_notifications_button = jQuery('#icl_remove_notifications');
    var restore_notifications_button = jQuery('#icl_restore_notifications');
    var restore_notifications_all_users = jQuery('#icl_restore_notifications_all_users');
    var sync_posts_taxonomies_button = jQuery('#wpml_sync_posts_taxonomies');
    var ls_templates_update_domain_button = jQuery('#wpml_ls_templates_update_domain');
    remove_notifications_button.off('click');
    remove_notifications_button.on('click', remove_all_notifications);
    restore_notifications_button.off('click');
    restore_notifications_button.on('click', restore_notifications);

	function remove_all_notifications() {
		if (typeof(event.preventDefault) !== 'undefined') {
			event.preventDefault();
		} else {
			event.returnValue = false;
		}

		jQuery(this).prop( 'disabled', true );
		jQuery(this).after(icl_ajxloaderimg);

		var ajax_data = {
			'action': 'icl_remove_notifications',
			'nonce': troubleshooting_strings.removeNotificationsNonce,
		};

		jQuery.ajax({
			type:     "POST",
			url:      ajaxurl,
			data:     ajax_data,
			dataType: 'json',
			success:  function (response) {
				if(response.reload == 1) {
					location.reload();
				}
			},
			error:    function (jqXHR, status, error) {
				var parsed_response = jqXHR.statusText || status || error;
				alert(parsed_response);
			},
			complete: function (response) {
				remove_notifications_button.prop('disabled', false);
				remove_notifications_button.next().fadeOut();
			},
		});

		return false;
	}

	function restore_notifications() {
		if (typeof(event.preventDefault) !== 'undefined') {
			event.preventDefault();
		} else {
			event.returnValue = false;
		}

		jQuery(this).prop( 'disabled', true );
		jQuery(this).after(icl_ajxloaderimg);

		var all_users = restore_notifications_all_users.is(':checked') ? 1 : 0;

		var ajax_data = {
			'action': 'icl_restore_notifications',
			'nonce': troubleshooting_strings.restoreNotificationsNonce,
			'all_users':  all_users
		};

		jQuery.ajax({
			type:     "POST",
			url:      ajaxurl,
			data:     ajax_data,
			dataType: 'json',
			success:  function (response) {
				if(response.reload == 1) {
					location.reload();
				}
			},
			error:    function (jqXHR, status, error) {
				var parsed_response = jqXHR.statusText || status || error;
				alert(parsed_response);
			},
			complete: function() {
				restore_notifications_button.prop('disabled', false);
				restore_notifications_button.next().fadeOut();
			},
		});

		return false;
	}

	var fix_post_types_and_source_langs_button = jQuery("#icl_fix_post_types");
	var updateTermNamesButton = jQuery("#icl-update-term-names");

	updateTermNamesButton.click(iclUpdateTermNames);

	fix_post_types_and_source_langs_button.click(
		function () {
			jQuery(this).prop( 'disabled', true );
			icl_repair_broken_translations();
			jQuery(this).after(icl_ajxloaderimg);

		}
	);

	function icl_repair_broken_translations () {
		jQuery.ajax(
			{
				url: ajaxurl,
				data: {
					action: 'icl_repair_broken_type_and_language_assignments',
					icl_nonce: troubleshooting_strings.brokenTypeNonce,
				},
				success: function (response) {
					var rows_fixed = response.data;
					fix_post_types_and_source_langs_button.prop('disabled', false);
					fix_post_types_and_source_langs_button.next().fadeOut();
					var text = '';
					if (rows_fixed > 0) {
						text = troubleshooting_strings.success_1 + rows_fixed + troubleshooting_strings.success_2;
					} else {
						text = troubleshooting_strings.no_problems;
					}
					var type_term_popup_html = '<div id="icl_fix_languages_and_post_types"><p>' + text + '</p></div>';
					jQuery(type_term_popup_html).dialog(
						{
							dialogClass: 'wpml-dialog otgs-ui-dialog',
							width      : 'auto',
							modal      : true,
							buttons    : {
								Ok: function () {
									jQuery(this).dialog("close");
								}
							}
						}
					);
				}
			});
	}


	function iclUpdateTermNames() {

		var updatedTermNamesTable = jQuery('#icl-updated-term-names-table');

		/* First of all we get all selected rows and the displayed Term names. */

		var selectedTermRows = updatedTermNamesTable.find('input[type="checkbox"]');

		var selectedIDs = {};

		jQuery.each(selectedTermRows, function (index, selectedRow) {
			selectedRow = jQuery(selectedRow);
			if(selectedRow.is(':checked') && selectedRow.val() && selectedRow.attr('name') && selectedRow.attr('name').trim() !== ''){
				selectedIDs[selectedRow.val().toString()] = selectedRow.attr('name');
			}
		});

		var selectedIDsJSON = JSON.stringify(selectedIDs);

		jQuery.ajax(
			{
				url: ajaxurl,
				method: "POST",
				data: {
					action: 'wpml_update_term_names_troubleshoot',
					_icl_nonce: troubleshooting_strings.termNamesNonce,
					terms: selectedIDsJSON
				},
				success: function (response) {

					jQuery.each(response.data, function (index, id) {
						updatedTermNamesTable.find('input[type="checkbox"][value="'+ id +'"]').closest('tr').remove();
					});

					var remainingRows = jQuery('.icl-term-with-suffix-row');

					if (remainingRows.length === 0 ){
						updatedTermNamesTable.hide();
						jQuery('#icl-update-term-names').hide();
						jQuery('#icl-update-term-names-done').show();
					}

					var termSuffixUpdatedHTML = '<div id="icl_fix_term_suffixes"><p>' + troubleshooting_strings.suffixesRemoved + '</p></div>';
					jQuery(termSuffixUpdatedHTML).dialog(
						{
							dialogClass: 'wpml-dialog otgs-ui-dialog',
							width      : 'auto',
							modal      : true,
							buttons    : {
								Ok: function () {
									jQuery(this).dialog("close");
								}
							}

						}
					);
				}
			});
	}

	jQuery('#icl_cache_clear').click(function () {
		var self = jQuery(this);
		self.prop( 'disabled', true );
		self.after(icl_ajxloaderimg);
		jQuery.post(location.href + '&debug_action=cache_clear&nonce=' + troubleshooting_strings.cacheClearNonce, function () {
			self.prop('disabled', false);
			alert( troubleshooting_strings.done );
			self.next().fadeOut();
		});
	});

	sync_posts_taxonomies_button.click(function(){
		var requestData = {};

		sync_posts_taxonomies_button.siblings('.wpml-notice').empty();
		sync_posts_taxonomies_button.prop('disabled', true);
		sync_posts_taxonomies_button.after(icl_ajxloaderimg);
		requestData.batch_number = 0;
		requestData.post_type    = sync_posts_taxonomies_button.siblings('select[name="wpml_post_type"]').val();
		sync_posts_taxonomies_send_ajax(requestData);
	});

	var sync_posts_taxonomies_send_ajax = function(requestData) {
		requestData.debug_action = 'synchronize_posts_taxonomies';
		requestData.nonce        = troubleshooting_strings.syncPostsTaxNonce;
		jQuery.ajax({
			type    : "POST",
			url     : location.href,
			data    : requestData,
			success: sync_posts_taxonomies_receive_ajax
		});
	};

	var sync_posts_taxonomies_receive_ajax = function(response) {
		sync_posts_taxonomies_button.siblings('.wpml-notice').html(response.data.message);

		if ( response.success && ! response.data.completed ) {
			var requestData = response.data || {};
			requestData.debug_action = 'synchronize_posts_taxonomies';
			requestData.nonce        = troubleshooting_strings.syncPostsTaxNonce;
			sync_posts_taxonomies_send_ajax(requestData);
		} else {
			sync_posts_taxonomies_button.next().fadeOut();
			sync_posts_taxonomies_button.prop('disabled', false);
		}
	};
});
