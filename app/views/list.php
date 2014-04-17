<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ContentApp</title>

    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/style.css" />

    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    <script src="/js/underscore.min.js"></script>
    <script src="/js/backbone.min.js"></script>

    <script src="/js/modules/content.module.js"></script>
    <script src="/js/modules/list.module.js"></script>
    <script src="/js/modules/popup.module.js"></script>
    <script src="/js/modules/search.module.js"></script>
    <script src="/js/contentapp.js"></script>
</head>
<body>

<div class="container-fluid">
    <div class="row-fluid">

        <div class="navbar">
            <div class="navbar-inner">
                <a class="brand" href="#">ContentApp</a>
                <ul class="nav">
                    <li class="active"><a href="#">Фильмы</a></li>
                    <li><a href="#">Музыка</a></li>
                    <li><a href="#">Книги</a></li>
                    <li><a href="#">Игры</a></li>
                </ul>
            </div>
        </div>

        <ul class="nav nav-tabs" id="myTab">
            <li class="active">
                <a href="#quickSearch" class="tab-link" data-toggle="tab">Быстрый поиск</a>
            </li>
            <li>
                <a href="#extendedSearch" class="tab-link" data-toggle="tab">Расширенный поиск</a>
            </li>
            <li>
                <a href="#addItem" data-toggle="tab" class="tab-link list-item-add-link">Добавить элемент</a>
            </li>
        </ul>

        <div class="tab-content">

            <!-- quick search -->
            <section class="tab-pane active" id="quickSearch">
                <form class="form-search">
                    <div class="input-append">
                        <input name="query" type="text" class="input-xxlarge search-query" placeholder="умный поиск" title="Введите целиком или часть: название фильма, режиссера, актера и т.д.">
                        <button type="submit" class="btn">Найти</button>
                    </div>
                </form>


                <div class="quick-link-container"></div>
            </section>
            <!-- /quick search -->

            <!-- extended search -->
            <section class="tab-pane" id="extendedSearch">
                <div class="span6">
                    <form class="form-horizontal">
                        <fieldset class="extended-search-fields-container"></fieldset>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn">Найти</button>

                                <span class="filter-save-container">
                                    <span class="input-append">
                                        <input type="text" class="input-large save-filter-name" placeholder="Название" />
                                        <button type="button" class="btn save-filter-action">Сохранить</button>
                                        <button type="button" class="btn save-filter-cancel">Отмена</button>
                                    </span>
                                    <button type="button" class="btn save-filter-request">Сохранить фильтр</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="span6 saved-filters-container"></div>
            </section>
            <!-- /extended search -->

            <section class="tab-pane" id="addItem"></section>

        </div>

        <section id="itemsList">
            <table class="table table-condensed table-striped table-hover">
                <thead id="listHeadContainer"></thead>
                <tbody id="listContainer">
                <tr>
                    <td>Загрузка данных...</td>
                </tr>
                </tbody>
            </table>

            <div class="pagination" id="pagination">
                <ul>
                    <li><a href="#">Prev</a></li>
                    <li><a href="#" data-page="1" class="page">1</a></li>
                    <li><a href="#" data-page="2" class="page">2</a></li>
                    <li><a href="#" data-page="3" class="page">3</a></li>
                    <li><a href="#" data-page="4" class="page">4</a></li>
                    <li><a href="#" data-page="5" class="page">5</a></li>
                    <li><a href="#">Next</a></li>
                </ul>
            </div>
        </section>

    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<!--    <div class="modal-header">-->
<!--        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
<!--        <h3 id="myModalLabel">Modal header</h3>-->
<!--    </div>-->
    <form action="." method="post" enctype="multipart/form-data"  class="form-horizontal">
        <fieldset class="extended-search-fields-container modal-body">Загрузка данных...</fieldset>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true" type="button">Закрыть</button>
            <button class="btn btn-primary" type="submit">Сохранить</button>
        </div>
    </form>
</div>

<script type="text/template" id="listHeadTemplate">
    <tr>
        <% _.each(fields, function(field) { %>
        <th><%= field.title %></th>
        <% }); %>
        <th class="td-list-action">&nbsp;</th>
    </tr>
</script>

<script type="text/template" id="listItemTemplate">
    <% _.each(rows, function(row) { %>
    <tr data-id="<%= row.id %>">
        <td><a href="#myModal" data-toggle="modal" class="list-item-edit"><%= row.value.title %></a></td>
        <td><%= row.value.image %></td>
        <td><%= row.value.studio %></td>
        <td><%= row.value.year %></td>
        <td><%= row.value.country %></td>
        <td>
            <% _.each(row.value.actors, function(actor, i) { %><% if ( i > 0) {%>, <% }; %><%= actor.name %><% }); %>
        </td>
        <td>
            <% _.each(row.value.producers, function(producer, i) { %><% if ( i > 0) {%>, <% }; %><%= producer.name %><% }); %>
        </td>
        <td>
            <% _.each(row.value.directors, function(director, i) { %><% if ( i > 0) {%>, <% }; %><%= director.name %><% }); %>
        </td>
        <td class="td-list-action">
            <a href="#" title="Удалить" class="list-item-remove"><i class="icon-remove"></i></a>
        </td>
    </tr>
    <% }); %>
</script>

<script type="text/template" id="quickLinkTemplate">
    Последние запросы:
    <% _.each(items, function(item, i) { %><% if ( i > 0) {%>, <% }; %><a href="#" class="pseudo-link quick-link"><%= item %></a><% }); %>
</script>

<script type="text/template" id="formRowTemplate">
    <% _.each(fields, function(field) { %>
    <div class="control-group">
        <label class="control-label" for="<%= prefix %>Input<%= field.name %>"><%= field.title %></label>
        <div class="controls">
            <input type="text" id="<%= prefix %>Input<%= field.name %>" name="<%= field.name %>" value="<% if('text'==field.type){%><%= field.value %><% }; %>">
            <% if('list'==field.type){%>
                <div>
                    <% _.each(field.value, function(value) { %>
                        <span class="label" data-id="<%= value.id %>"><%= value.name %> <i class="icon-remove" title="Удалить"></i></span>
                    <% }); %>
                </div>
            <% }; %>
        </div>
    </div>
    <% }); %>
</script>

<script type="text/template" id="savedFiltersTemplate">
    Сохраненные фильтры:
        <% _.each(filters, function(filter) { %>
            <span class="label saved-filter-apply"><%= filter.title %> <i class="icon-remove" title="Удалить"></i></span>
        <% }); %>
</script>

</body>
</html>