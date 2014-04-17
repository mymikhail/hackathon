;(function($){

    var oItemDefaults = {
        id: null
    };

    PopupModel = Backbone.Model.extend({
        url: '/element/index/',
        initialize: function(){
            _.each(appContent.get('fields'), function(field, index, list){
                oItemDefaults[field.name] = null;
            });
        },
        fetch: function(data){
            var self = this
              , id = data.id
              , url = self.url + id
            ;
            $.ajax({
                type: 'get',
                url: url,
                dataType: 'json',
//                contentType: 'application/json; charset=utf-8',
                success: function(json){
                    json.id = id;
                    self.set(json);
                }
            });
        },
        save: function(){
            var id = this.get('id') || null
              , url = id ? this.url + id : this.url
              , type = id? 'put' : 'post'
            ;

            $.ajax({
                type: type,
                url: url,
                data: this.toJSON(),
                dataType: 'json',
//                contentType: 'application/json; charset=utf-8',
                success: function(json){
                }
            });
        },
        reset: function(){
            this.set(oItemDefaults);
        }
    });

    PopupView = Backbone.View.extend({
        initialize: function(){
            var self = this;

            this.$el.on('hide', function(){
                self.$el.find('.modal-body').html('Загрузка данных...');
            });

            this.listenTo(this.model, 'change', this.render);
        },
        events: {
            'submit form': 'onFormSubmitHandler'
        },
        onFormSubmitHandler: function(e){
            e.preventDefault();
            var data = $(e.currentTarget).serializeObject();

            /**
             * TODO fix this )
             */
            delete data.genres;
            delete data.actors;
            delete data.directors;
            delete data.producer;

            this.model.set(data, {silent: true}).save();
        },
        render: function(model){
            var fields = $.extend({}, appContent.get('fields'));
            _.each(fields, function(field){
                field.value = model.get(field.name);
            });

            var template = _.template($("#formRowTemplate").html(), {fields: appContent.get('fields'), prefix: 'popupForm'} );
            this.$el.find('.modal-body').html(template);
        }
    });
})(jQuery)