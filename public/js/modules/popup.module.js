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
            var self = this
              , id = this.get('id') || null
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
                    var data = {
                        id: json.id,
                        value: $.extend({}, self.attributes )
                    };
                    appEventHandler.trigger('list:add/edit', data);

                    if (!id){
                        self.reset();
                    }
                }
            });
        },
        reset: function(){
            this.clear().set(oItemDefaults);
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
            'submit form': 'onFormSubmitHandler',
            'click .list-value-remove': 'onListValueRemoveHandler'
        },
        onFormSubmitHandler: function(e){
            e.preventDefault();
            var data = $(e.currentTarget).serializeObject();

            /* TODO удалять динамически по типу поля */
            delete data.genres;
            delete data.actors;
            delete data.directors;
            delete data.producer;

            this.model.set(data, {silent: true}).save();

            if ( this.model.get('id') ){
                this.$el.modal('hide');
            }
        },
        onListValueRemoveHandler: function(e){
            e.preventDefault();
            var data = $(e.currentTarget).data()
              , a = []
            ;
            $(e.currentTarget).parent().remove();
            _.each(this.model.get(data.attribute), function(attribute){
                if (attribute.id!=data.id){
                    a.push(attribute);
                }
            });
            this.model.set(data.attribute, a, {silent: true});
        },
        render: function(model){
            var self = this
              , fields = $.extend({}, appContent.get('fields'));
            _.each(fields, function(field){
                field.value = model.get(field.name);
            });

            var template = _.template($("#formRowTemplate").html(), {fields: appContent.get('fields'), prefix: 'popupForm'} );
            this.$el.find('.modal-body').html(template);

            _.map( ['actors', 'directors', 'producers'], function(attribute){
                $('#popupFormInput' + attribute).autocomplete({
                    serviceUrl: '/autocomplite/person/',
                    lookupLimit: 10,
                    minChars: 3,
                    transformResult: function(response) {
                        var json = JSON.parse(response);
                        return {
                            suggestions: $.map(json, function(item) {
                                return { value: item.name, data: item.id };
                            })
                        };
                    },
                    onSelect: function(suggestion){
                        $(this)
                            .val('')
                            .next('.list-value-container')
                            .prepend('<span class="label">' + suggestion.value + ' <i class="icon-remove list-value-remove" title="Удалить" data-id="' + suggestion.data + '" data-attribute="' + attribute + '"></i></span>')
                        ;

                        var a = self.model.get(attribute) || [];
                        a.push({
                            name: suggestion.value,
                            id: suggestion.data
                        });
                        self.model.set(attribute, a, {silent: true});

                    }
                });
            } );

        }
    });
})(jQuery)