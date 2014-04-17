;(function($){
    ListModel = Backbone.Model.extend({
        url: '/list/index/',
        initialize: function(){
            this.fetch();
        },
        fetch: function(data){
            var data = data || {};
            var self = this;
            $.ajax({
                type: 'get',
                url: self.url,
                data: data,
                dataType: 'json',
                contentType: 'application/json; charset=utf-8',
                success: function(json){
                    self.set(json);
                }
            })
        }
    });

    ListView = Backbone.View.extend({
        initialize: function(){
//            this.render();
        },
        events: {
            'click .list-item-edit': 'onListItemEdit',
            'click .list-item-remove': 'onListItemRemove'
        },
        render: function(model){
            var template = _.template($("#listItemTemplate").html(), {rows: model.get('rows')} );
            this.$el.html(template);
        },
        onListItemEdit: function(e){
            e.preventDefault();
            var data = $(e.currentTarget).closest('tr').data();
            appEventHandler.trigger('list:edit', data);
        },
        onListItemRemove: function(e){
            e.preventDefault();
            if(confirm('Точно удалить?')){
                $(e.currentTarget).closest('tr').remove();
            }
        }
    });
})(jQuery)