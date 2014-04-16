;(function($){
    ListModel = Backbone.Model.extend({
        defaults: {
            items: [
                {
                    "id": 1,
                    "type": "film",
                    "title": "Запрещено к показу",
                    "genres": [
                        "Драмы",
                        "Артхаус",
                        "Эротика"
                    ],
                    "image": "2310642",
                    "studio": "test",
                    "year": "2006",
                    "persons": [
                        {
                            "type": "films_actor",
                            "name": "Аугуст",
                            "image_id": null,
                            "id": ""
                        },
                        {
                            "type": "films_actor",
                            "name": "Кацуми",
                            "image_id": null,
                            "id": ""
                        },
                        {
                            "type": "films_actor",
                            "name": "Жасмин Бирн",
                            "image_id": null,
                            "id": ""
                        },
                        {
                            "type": "films_actor",
                            "name": "Нэнси Ви",
                            "image_id": null,
                            "id": ""
                        },
                        {
                            "type": "films_actor",
                            "name": "Джон Джон",
                            "image_id": null,
                            "id": ""
                        },
                        {
                            "type": "films_actor",
                            "name": "Диллан Лорен",
                            "image_id": null,
                            "id": ""
                        }
                    ]
                },
                {
                    "id": 2,
                    "title": "Человек-паук",
                    "image": "2310642",
                    "year": "2012"
                },
            ]
        },
        initialize: function(){
        }
    });

    ListView = Backbone.View.extend({
        initialize: function(){
            this.render();
        },
        events: {
            'click .list-item-edit': 'onListItemEdit',
            'click .list-item-remove': 'onListItemRemove'
        },
        render: function(){
            var template = _.template($("#listItemTemplate").html(), {items: this.model.get('items')} );
            this.$el.html(template);
        },
        onListItemEdit: function(e){
            var data = $(e.currentTarget).closest('tr').data();
            appEventHandler.trigger('list:edit', data);
        },
        onListItemRemove: function(e){
            $(e.currentTarget).closest('tr').remove();
        }
    });
})(jQuery)