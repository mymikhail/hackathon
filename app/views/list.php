<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ContentApp</title>

    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/style.css" />

    <script src="http://yandex.st/jquery/1.7.2/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
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
                <a href="#quickSearch">Быстрый поиск</a>
            </li>
            <li>
                <a href="#extendedSearch">Расширенный поиск</a>
            </li>
            <li>
                <a href="#myModal" data-toggle="modal">Добавить элемент</a>
            </li>
        </ul>

        <div class="tab-content">

            <section class="tab-pane active" id="quickSearch">
                <form class="form-search">
                    <div class="input-append">
                        <input type="text" class="input-xxlarge search-query" placeholder="умный поиск" title="Введите целиком или часть: название фильма, режиссера, актера и т.д.">
                        <button type="submit" class="btn">Найти</button>
                    </div>
                </form>


                <p>
                    Последние запросы: <a href="#" class="pseudo-link">Тарантино</a>, <a href="#" class="pseudo-link">Человек-паук</a>, <a href="#" class="pseudo-link">Италия 1960-1970</a>, &hellip;
                </p>

                <p>
                    Основые категории?..
                </p>
            </section>

            <section class="tab-pane" id="extendedSearch">

                <div class="span6">
                    <form class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label" for="inputName">Название</label>
                            <div class="controls">
                                <input type="text" id="inputName" placeholder="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputProducer">Режиссёр</label>
                            <div class="controls">
                                <input type="text" id="inputProducer" placeholder="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputActor">Актёры</label>
                            <div class="controls">
                                <input type="text" id="inputActor" placeholder="">
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
                <tbody>
                    <tr>
                        <td><a href="#myModal" data-toggle="modal">Человек-паук</a></td>
                        <td></td>
                        <td>Marvell</td>
                        <td>2014</td>
                        <td>США</td>
                        <td>Вася, Саша, Таня</td>
                        <td>Тарантино</td>
                        <td>Тарантино</td>
                        <td class="td-list-action">
                            <a href="#" title="Удалить"><i class="icon-remove"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#myModal" data-toggle="modal">Человек-паук 2</a></td>
                        <td></td>
                        <td>Marvell</td>
                        <td>2014</td>
                        <td>США</td>
                        <td>Вася, Саша, Таня</td>
                        <td>Тарантино</td>
                        <td>Тарантино</td>
                        <td class="td-list-action">
                            <a href="#" title="Удалить"><i class="icon-remove"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#myModal" data-toggle="modal">Человек-паук 3</a></td>
                        <td></td>
                        <td>Marvell</td>
                        <td>2014</td>
                        <td>США</td>
                        <td>Вася, Саша, Таня</td>
                        <td>Тарантино</td>
                        <td>Тарантино</td>
                        <td class="td-list-action">
                            <a href="#" title="Удалить"><i class="icon-remove"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="pagination">
                <ul>
                    <li><a href="#">Prev</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
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
    <div class="modal-body">
        <p>Форма добавления или редактирования тут</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button>
        <button class="btn btn-primary">Сохранить</button>
    </div>
</div>

</body>
</html>