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

            <section class="tab-pane active" id="quickSearch">
                <form class="form-search">
                    <div class="input-append">
                        <input name="query" type="text" class="input-xxlarge search-query" placeholder="умный поиск" title="Введите целиком или часть: название фильма, режиссера, актера и т.д.">
                        <button type="submit" class="btn">Найти</button>
                    </div>
                </form>


                <p>
                    Последние запросы:
                    <a href="#" class="pseudo-link quick-link">Тарантино</a>,
                    <a href="#" class="pseudo-link quick-link">Человек-паук</a>,
                    <a href="#" class="pseudo-link quick-link">Италия 1960-1970</a>,
                    &hellip;
                </p>

                <p>
                    Основые категории?..
                </p>
            </section>

            <section class="tab-pane" id="extendedSearch">

                <div class="span6">
                    <form class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label" for="inputTitle">Название</label>
                            <div class="controls">
                                <input type="text" id="inputTitle" name="title">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputProducer">Режиссёр</label>
                            <div class="controls">
                                <input type="text" id="inputProducer" name="producer">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputActor">Актёры</label>
                            <div class="controls">
                                <input type="text" id="inputActor" name="actor">
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn">Найти</button>
                                <button type="button" class="btn">Сохранить фильтр</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="span6">
                    Сохраненные фильтры: <a href="#" class="pseudo-link">Ранний Тарантино с Умой Турман</a>, <a href="#" class="pseudo-link">Партнерка Tviggle</a>
                </div>







            </section>


            <section class="tab-pane" id="addItem"></section>

        </div>

        <section id="itemsList">
            <table class="table table-condensed table-striped table-hover">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Постер</th>
                    <th>Студия</th>
                    <th>Год</th>
                    <th>Страна</th>
                    <th>Актёры</th>
                    <th>Продюссер</th>
                    <th>Режиссер</th>
                    <th class="td-list-action">&nbsp;</th>
                </tr>
                </thead>
                <tbody id="listContainer">
                <tr>
                    <td colspan="8">Загрузка данных...</td>
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
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Modal header</h3>
    </div>
    <form action="." method="post" enctype="multipart/form-data"  class="form-horizontal modal-body">
        Загрузка данных...
    </form>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button>
        <button class="btn btn-primary">Сохранить</button>
    </div>
</div>

<script type="text/template" id="listItemTemplate">
    <% _.each(items, function(item) { %>
    <tr data-id="<%= item.id %>">
        <td><a href="#myModal" data-toggle="modal" class="list-item-edit"><%= item.title %></a></td>
        <td><%= item.image %></td>
        <td><%= item.studio %></td>
        <td><%= item.year %></td>
        <td><%= item.country %></td>
        <td>
            <% _.each(item.persons, function(person, i) { %><% if ( i > 0) {%>, <% }; %><%= person.name %><% }); %>
        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td class="td-list-action">
            <a href="#" title="Удалить" class="list-item-remove"><i class="icon-remove"></i></a>
        </td>
    </tr>
    <% }); %>
</script>

<script type="text/template" id="itemFormTemplate">
    <div class="control-group">
        <label class="control-label" for="inputName">Название</label>
        <div class="controls">
            <input type="text" id="inputName" placeholder="<%= title %>">
        </div>
    </div>
</script>

</body>
</html>