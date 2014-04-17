;(function($){

    var oContentTypeMap = {
        film: {
            fields: [
                {
                    name: 'title',
                    title: 'Название'
                },
                {
                    name: 'genres',
                    title: 'Жанры'
                },
                {
                    name: 'image',
                    title: 'Постер'
                },
                {
                    name: 'studio',
                    title: 'Студия'
                },
                {
                    name: 'year',
                    title: 'Год'
                },
                {
                    name: 'persons',
                    title: 'Персоны'
                }
            ]
        }
    };

    ContentTypeModel = Backbone.Model.extend({
        initialize: function(data){
            this.set(data);
            this.set({fields: oContentTypeMap[data.type]});
        }
    });


})(jQuery)
