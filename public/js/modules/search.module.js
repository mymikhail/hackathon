;(function($){

    $.fn.serializeObject = function(){
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };

    var oSearchDefaults = {
        page: 1,
        query: ''
    };

    SearchModel = Backbone.Model.extend({
        defaults: oSearchDefaults,
        initialize: function(){
            this.on('change', function(model){
                console.log(model.attributes);
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
        events: {
            'submit form': 'onFormSubmitHandler',
            'click .quick-link': 'onQuickLinkClickHandler'
        },
        onFormSubmitHandler: function(e){
            e.preventDefault();
            var data = $(e.currentTarget).serializeObject();
            this.model.clear({silent: true}).set(data);
        },
        onQuickLinkClickHandler: function(e){
            e.preventDefault();
            var text = $(e.currentTarget).text();
            this.$el.find('.search-query').val(text);
            this.$el.find('.form-search').trigger('submit');
        }
    });

    ExtendedSearchView =  Backbone.View.extend({
        events: {
            'submit form': 'onFormSubmitHandler'
        },
        onFormSubmitHandler: function(e){
            e.preventDefault();
            var data = $(e.currentTarget).serializeObject();
            this.model.clear({silent: true}).set(data);
        }
    });
})(jQuery)
