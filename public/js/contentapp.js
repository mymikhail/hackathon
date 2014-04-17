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

    $( function(){

        /**
         * Global content model
         */
        appContent = new ContentTypeModel({
            type: 'film'
        });

        /**
         * Items list
         */
        var oListModel = new ListModel
          , oListView = new ListView({
                el: '#itemsList',
                model: oListModel
            })
        ;

        /**
         * Item edd/edit
         */
        var oPopupModel = new PopupModel
          , oPopupView = new PopupView({
                el: '#myModal',
                model: oPopupModel
            })
        ;

        /**
         * Search query controller
         */
        var oSearchModel = new SearchModel
          , oPaginationView = new PaginationView({
                el: '#pagination',
                model: oSearchModel
            })
          , oQuickSearchView = new QuickSearchView({
                el: '#quickSearch',
                model: oSearchModel
            })
          , oExtendedSearchView = new ExtendedSearchView({
                el: '#extendedSearch',
                model: oSearchModel
            })
        ;

        /**
         * Global event handler
         */
        appEventHandler = _.extend({}, Backbone.Events)
            .on('list:edit', function(data){
                oPopupModel.fetch(data);
            })
            .on('list:add', function(){
                oPopupModel.reset();
                oPopupView.$el.modal('show');
            })
            .on('list:update', function(data){
                oListModel.fetch(data);
            })
            .on('list:renderpages', function(data){
                oPaginationView.render(data);
            })
        ;

        /**
         * Tabs
         */
        TabView = Backbone.View.extend({
            events: {
                'click .tab-link': 'onTabLinkHandler',
                'click .list-item-add-link': 'onItemAddLinkHandler'
            },
            onTabLinkHandler: function(e){
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