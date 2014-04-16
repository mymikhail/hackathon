;(function($){

    var oItemDefaults = {
        id: null,
        type: null,
        title: null,
        genres: null,
        image: null,
        studio: null,
        year: null,
        persons: null
    };

    PopupModel = Backbone.Model.extend({
        defaults: oItemDefaults,
        initialize: function(){
        },
        onListItemEdit: function(data){
            debugger;
        }
    });

    PopupView = Backbone.View.extend({
        initialize: function(){
            var self = this;

            this.$el.on('hide', function(){
                self.$el.find('.modal-body').html('Загрузка данных...');
            });
        },
        events: {
        },
        render: function(){
            var template = _.template($("#itemFormTemplate").html(), this.model.toJSON() );
            this.$el.find('.modal-body').html(template);
        }
    });
})(jQuery)