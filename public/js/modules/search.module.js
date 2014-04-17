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
        },
        events: {
            'submit form': 'onFormSubmitHandler'
        },
        render: function(){
            var template = _.template($("#formRowTemplate").html(), {fields: appContent.get('fields'), prefix: 'extendedSearchForm'} );
            this.$el.find('.extended-search-fields-container').html(template);
        },
        onFormSubmitHandler: function(e){
            e.preventDefault();
            var data = $(e.currentTarget).serializeObject();
            this.model.clear({silent: true}).set(data);
        }
    });
})(jQuery)
