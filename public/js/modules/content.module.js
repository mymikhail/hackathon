;(function($){

    var oContentTypeMap = {
        film: {
            fields: [
                {
                    name: 'title',
                    title: 'Название',
                    type: 'text',
                    required: true
                },
//                {
//                    name: 'genres',
//                    title: 'Жанры',
//                    type: 'list'
//                },
                {
                    name: 'image',
                    title: 'Постер',
                    type: 'file'
                },
                {
                    name: 'studio',
                    title: 'Студия',
                    type: 'text'
                },
                {
                    name: 'year',
                    title: 'Год',
                    type: 'text'
                },
                {
                    name: 'actors',
                    title: 'Актеры',
                    type: 'list'
                },
                {
                    name: 'directors',
                    title: 'Режиссеры',
                    type: 'list'
                },
                {
                    name: 'producers',
                    title: 'Продюсеры',
                    type: 'list'
                }
            ]
        }
    };

    ContentTypeModel = Backbone.Model.extend({
        initialize: function(data){
            this.set(data);
            this.set({fields: oContentTypeMap[data.type].fields});
        }
    });


})(jQuery)
