;(function($){
    $( function(){

        var oListModel = new ListModel
          , oListView = new ListView({
                el: '#listContainer',
                model: oListModel
            })
        ;
//        oListView.listenTo(oListModel, 'change', oListView.render);


        var oPopupModel = new PopupModel
          , oPopupView = new PopupView({
                el: '#myModal',
                model: oPopupModel
            })
        ;

        appEventHandler = _.extend({}, Backbone.Events)
            .on('list:edit', function(data){
                oPopupModel.onListItemEdit(data);
            })
            .on('list:add', function(){
                oPopupView.render();
            })
        ;

        /**
         * Tabs
         */
        TabView = Backbone.View.extend({
            events: {
                'click .tab-link': 'onTablinkHandler',
                'click .list-item-add-link': 'onItemAddLinkHandler'
            },
            onTablinkHandler: function(e){
                e.preventDefault();
                $(e.currentTarget).tab('show');
            },
            onItemAddLinkHandler: function(){
                appEventHandler.trigger('list:add');
            }
        });

        var oTabView = new TabView({
            el: '#myTab'
        });

    } );
})(jQuery)