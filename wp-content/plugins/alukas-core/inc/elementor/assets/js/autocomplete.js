jQuery(window).on('elementor:init', function() {
    var $ = jQuery,
	PLSAutocomplete = elementor.modules.controls.BaseData.extend({
        isSearch: false,

        resultsRender: function () {
            var _this = this;
            var ids = this.getControlValue();

            if (!ids || ids.length == 0) {
                return;
            }

            if (!_.isArray(ids)) {
                ids = [ids];
            }

            _this.addControlSpinner();

            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: _this.model.get('render'),
                    post_type: _this.model.get('post_type'),
                    taxonomy: _this.model.get('taxonomy'),
                    id: ids,
                },

                success: function (results) {
                    _this.isSearch = true;
                    _this.model.set('options', results);
                    _this.render();
                },
            });
        },

        addControlSpinner: function () {
            this.ui.select.prop('disabled', true);
            this.$el.find('.elementor-control-title').after('<span class="elementor-control-spinner">&nbsp;<i class="fa fa-spinner fa-spin"></i>&nbsp;</span>');
        },

        onReady: function () {
            var _this = this;

            this.ui.select.select2({
				 allowClear: true,
                placeholder: 'Search',               
                minimumInputLength: 3,
                ajax: {
                    url: ajaxurl,
                    dataType: 'json',
                    method: 'post',
                    delay: 200,
                    data: function ( params ) {
                        return {
                            q: params.term,
                            action: _this.model.get('search'),
                            post_type: _this.model.get('post_type'),
                            taxonomy: _this.model.get('taxonomy'),
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data,
                        };
                    },
                    cache: true,
                },
            });

            if (!this.isSearch) {
                this.resultsRender();
            }
        },

        onBeforeDestroy: function () {
            if (this.ui.select.data('select2')) {
                this.ui.select.select2('destroy');
            }
            this.$el.remove();
        },
    });
    elementor.addControlView('pls_autocomplete', PLSAutocomplete);
});
