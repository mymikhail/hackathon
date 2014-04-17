;(function($){

    var oSearchDefaults = {
        page: 1,
        query: ''
    };

    SearchModel = Backbone.Model.extend({
        defaults: oSearchDefaults,
        initialize: function(){
            this.on('change', function(model){
                appEventHandler.trigger('list:update', model.toJSON());
            });
        }
    });

    PaginationView = Backbone.View.extend({
        events: {
            'click .page': 'onPageClickHandler'
        },
        onPageClickHandler: function(e){
            e.preventDefault();
            var data = $(e.currentTarget).data();
            this.model.set(data);
        }
    });

    QuickSearchView =  Backbone.View.extend({
        initialize: function(){
            this.aQuickLink = []
        },
        events: {
            'submit form': 'onFormSubmitHandler',
            'click .quick-link': 'onQuickLinkClickHandler'
        },
        onFormSubmitHandler: function(e){
            e.preventDefault();
            var data = $(e.currentTarget).serializeObject();
            if (!data.query.length){
                return;
            }
            this.model.clear({silent: true}).set(data);

            if (-1==$.inArray(data.query, this.aQuickLink)){
                this.aQuickLink.unshift(data.query);
                this.renderQuickLink();
            }
        },
        onQuickLinkClickHandler: function(e){
            e.preventDefault();
            var text = $(e.currentTarget).text();
            this.$el.find('.search-query').val(text);
            this.$el.find('.form-search').trigger('submit');
        },
        renderQuickLink: function(){
            var template = '';
            if (this.aQuickLink.length){
                if (this.aQuickLink.length>5){
                    this.aQuickLink.length = 5;
                }

                template = _.template($("#quickLinkTemplate").html(), {items: this.aQuickLink} );
            }

            this.$el.find('.quick-link-container').html(template);
        }
    });

    ExtendedSearchView =  Backbone.View.extend({
        initialize: function(){
            this.render();
            this.renderSavedFilters();
        },
        events: {
            'submit form': 'onFormSubmitHandler',
            'click .save-filter-request': 'onSaveFilterRequestHandler',
            'click .save-filter-cancel': 'onSaveFilterCancelHandler',
            'click .save-filter-action': 'onSaveFilterActionHandler',
            'click .saved-filter-apply': 'onSavedFilterApplyHandler'
        },
        render: function(){
            var template = _.template($("#formRowTemplate").html(), {fields: appContent.get('fields'), prefix: 'extendedSearchForm'} );
            this.$el.find('.extended-search-fields-container').html(template);
        },
        renderSavedFilters: function(){
            var a = JSON.parse(localStorage.getItem('savedFilters')) || []
                , template = ''
            ;
            if (a.length){
                template = _.template($("#savedFiltersTemplate").html(), {filters: a} );
            }
            this.$el.find('.saved-filters-container').html(template);
        },
        onFormSubmitHandler: function(e){
            e.preventDefault();
            var data = $(e.currentTarget).serializeObject();
            this.model.clear({silent: true}).set(data);
        },
        onSaveFilterRequestHandler: function(e){
            e.preventDefault();
            $(e.currentTarget).closest('.filter-save-container').addClass('is-active')
        },
        onSaveFilterCancelHandler: function(e){
            e.preventDefault();
            $(e.currentTarget).closest('.filter-save-container').removeClass('is-active');
            this.$el.find('.save-filter-name').val('');
        },
        onSaveFilterActionHandler: function(e){
            e.preventDefault();
            var title = $.trim( this.$el.find('.save-filter-name').val() )
              , data = this.$el.find('form').serializeObject()
              , a = JSON.parse( localStorage.getItem('savedFilters') ) || []
            ;

            a.push({title: title, data: data});
            localStorage.setItem('savedFilters', JSON.stringify(a));
            this.renderSavedFilters();

            $(e.currentTarget).closest('.filter-save-container').removeClass('is-active');
            this.$el.find('.save-filter-name').val('');
        },
        onSavedFilterApplyHandler: function(e){
            var title = $.trim( $(e.currentTarget).text() )
              , filters = JSON.parse(localStorage.getItem('savedFilters')) || []
              , data = {}
            ;

            _.each(filters, function(filter){
                if (filter.title==title){
                    data=filter.data;
                }
            });

            _.each(data, function(value, field){
               $('#extendedSearchFormInput' + field).val(value);
            });
        }
    });
})(jQuery)
