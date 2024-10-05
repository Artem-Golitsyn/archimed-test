@extends('layout')

@section('content')
    @include('navbar')
    <div class="container my-5">
        <h1>Задание 1 - Приложение-задачник</h1>
        <div class="col-lg-8 py-3">
            <button type="button" class="btn btn-primary" id="create-form" data-bs-toggle="modal"
                    data-bs-target="#createModal">Создать новую задачу
            </button>
            <button type="button" class="btn btn-success" id="login-form" data-bs-toggle="modal"
                    data-bs-target="#loginModal">Администрирование
            </button>
            <button type="button" class="btn btn-danger" id="logout">Выход</button>
        </div>
        <div class="col-lg-8 py-3">
            <table class="table">
                <thead>
                <tr id="sort">
                    <th scope="col" class="selected asc" style="min-width: 60px;"><a class="sort" data-order="id"
                                                                                     href="#">id</a></th>
                    <th scope="col" style="min-width: 70px;"><a class="sort" data-order="admin_check"
                                                                href="#">Проверено</a></th>
                    <th scope="col" style="min-width: 120px;"><a class="sort" data-order="name" href="#">Имя</a></th>
                    <th scope="col" style="min-width: 150px;"><a class="sort" data-order="email" href="#">Email</a></th>
                    <th scope="col">Текст задачи</th>
                    <th scope="col" style="min-width: 40px;"></th>
                </tr>
                </thead>
                <tbody id="records">

                </tbody>
            </table>

            <nav aria-label="Page navigation example">
                <ul class="pagination" id="paginator">
                </ul>
            </nav>

        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModalLabel">Новая задача</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="col-form-label">Ваше имя:</label>
                            <input type="text" class="form-control need-validate" data-name="name"/>
                            <div class="invalid-feedback">
                                Поле должно быть заполнено
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Email:</label>
                            <input type="text" class="form-control need-validate" data-name="email"/>
                            <div class="invalid-feedback">
                                Поле должно быть заполнено
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Текст задачи:</label>
                            <textarea class="form-control need-validate" rows="8" data-name="description"></textarea>
                            <div class="invalid-feedback">
                                Поле должно быть заполнено
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="create-cancel" data-bs-dismiss="modal">Закрыть
                    </button>
                    <button type="button" class="btn btn-primary" id="create-send">Создать</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModalLabel">Редактирование задачи</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" class="need-validate" data-name="id"/>

                        <div class="mb-3">
                            <label class="col-form-label">Имя:</label>
                            <input type="text" class="form-control need-validate" data-name="name"/>
                            <div class="invalid-feedback">
                                Поле должно быть заполнено
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Email:</label>
                            <input type="text" class="form-control need-validate" data-name="email"/>
                            <div class="invalid-feedback">
                                Поле должно быть заполнено
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Текст задачи:</label>
                            <textarea class="form-control need-validate" rows="8" data-name="description"></textarea>
                            <div class="invalid-feedback">
                                Поле должно быть заполнено
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-check">
                                <input class="form-check-input" type="checkbox" data-name="admin_check"
                                       id="admin_check">
                                <label class="form-check-label" for="admin_check">Проверено</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="edit-cancel" data-bs-dismiss="modal">Закрыть
                    </button>
                    <button type="button" class="btn btn-primary" id="edit-send">Изменить</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="loginModalLabel">Вход</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div id="loginError" class="mb-3" style="display: none;">
                            <h4 style="color: darkred" class="red">Логин или пароль указаны неверно</h4>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Логин</label>
                            <input type="text" class="form-control need-validate" data-name="login"/>
                            <div class="invalid-feedback">
                                Поле должно быть заполнено
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Пароль:</label>
                            <input type="text" class="form-control need-validate" data-name="password"/>
                            <div class="invalid-feedback">
                                Поле должно быть заполнено
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="auth-cancel" data-bs-dismiss="modal">Закрыть
                    </button>
                    <button type="button" class="btn btn-primary" id="auth-send">Войти</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Текущая страница
        window.page = 1;

        // Ключ сортировки по умолчанию
        window.order = 'id';

        // Обратная сортировка
        window.desc = false;

        // Статус логина с бекенда
        window.admin = {{ session('admin') ? 'true' : 'false' }};

        // Данные по задачам для админских форм
        window.data = {};

        jQuery(document).ready(function ($) {

            // Если в режиме администрирования, то скрываем кнопку логина
            // и показываем кнопку логаута
            if (window.admin) {
                $('#login-form').hide();
                $('#logout').show();
            } else {
                $('#login-form').show();
                $('#logout').hide();
            }

            // загрузка
            function load() {

                // показываем лоадер
                $('.loader').show();
                $.ajax({
                    url: '/api/task/index/?page=' + window.page + '&order=' + window.order + '&desc=' + (window.desc ? 1 : 0),
                    dataType: "json",
                    success: function (data) {

                        // Сброс таблицы
                        $("#records").empty();

                        // Если администрирование - показываем дополненную таблицу с кнопками редактирования
                        if (window.admin) {

                            // Заполняем таблицу
                            $.each(data.data.items, function (i, item) {
                                window.data[item.id] = item;
                                $('<tr>').append(
                                    $('<td>').text(item.id),
                                    $('<td>').text(parseInt(item.admin_check) === 0 ? 'нет' : 'да'),
                                    $('<td>').text(item.name),
                                    $('<td>').text(item.email),
                                    $('<td>').text(item.description),
                                    $('<td>').html('<a class="edit-form" data-id="' + item.id + '" href="#">Редактировать</a>')
                                ).appendTo('#records');
                            });

                            // На кнопки редакрирования вешаем события показа диалога редактирования
                            $('.edit-form').on('click', function (e) {
                                e.preventDefault();
                                let id = $(this).attr('data-id');
                                $('#editModal .need-validate').each(function (index) {
                                    let name = $(this).attr('data-name');
                                    $(this).val(window.data[id][name]);
                                });

                                if (parseInt(window.data[id]['admin_check']) === 1) {
                                    $('#admin_check').prop('checked', true);
                                } else {
                                    $('#admin_check').prop('checked', false);
                                }

                                $('#editModal').modal('show');
                            });
                        } else {
                            // заполнение таблицы в пользовательском режиме
                            $.each(data.data.items, function (i, item) {
                                $('<tr>').append(
                                    $('<td>').text(item.id),
                                    $('<td>').text(parseInt(item.admin_check) === 0 ? 'нет' : 'да'),
                                    $('<td>').text(item.name),
                                    $('<td>').text(item.email),
                                    $('<td>').text(item.description)
                                ).appendTo('#records');
                            });
                        }

                        // Сброс пагинатора
                        $("#paginator").empty();

                        // Рисуем пагинатор заново
                        for (let i = 1; i <= data.data.last_page; i++) {
                            $('<li class="page-item">').append(
                                $('<a class="page-link pager" data-page="' + i + '" onclick="" href="#">').text(i)
                            ).appendTo('#paginator');
                        }

                        // На каждую кнопку постранички вешаем событие установки номера страницы и перезагрузки данных
                        $('.pager').on('click', function (e) {
                            e.preventDefault();
                            window.page = $(this).attr('data-page');
                            load();
                        });
                    },
                    complete: function () {
                        // скрываем лоадер
                        $('.loader').hide();
                    }
                });
            }

            // Сортировка
            // На каждый элемент сортировки (заголовки колонок) вешаем событие и изменем вид если данная сортирока выбрана
            $(".sort").each(function (index) {
                $(this).on('click', function (e) {
                    e.preventDefault();

                    // Убираем все классы сортировок
                    $(".sort").each(function (index) {
                        $(this).parent().removeClass('selected desc asc');
                    });

                    // Имя сортировки
                    let order = $(this).attr('data-order');

                    // Если кликнули по той же самой сортировки - изменяем порядок сортировки
                    if (order === window.order) {
                        window.desc = !window.desc;

                        if (window.desc) {
                            $(this).parent().removeClass('asc').addClass('desc');
                        } else {
                            $(this).parent().removeClass('desc').addClass('asc');
                        }
                    } else {
                        // Устанавливаем новый порядок сортровки
                        window.order = $(this).attr('data-order');
                        $(this).parent().removeClass('desc').addClass('asc');
                        window.desc = false;
                    }

                    $(this).parent().addClass('selected');

                    // перезагружаем
                    load();
                });
            });

            // Для события показа модального окна создания
            // Удаляем все ранее выбранные данные и валидацию
            $('#create-form').on('click', function (e) {
                e.preventDefault();
                $('#createModal .need-validate').each(function (index) {
                    $(this).removeClass('is-valid is-invalid');
                    $(this).val('');
                });
            })

            // Создание задачи
            $('#create-send').on('click', function (e) {
                e.preventDefault();

                var isValidated = true;
                var formData = {};

                // Валидация
                $('#createModal .need-validate').each(function (index) {
                    if (/^\s?$/.test($(this).val())) {
                        $(this).removeClass('is-valid').addClass('is-invalid');
                        isValidated = false;
                    } else {
                        $(this).removeClass('is-invalid').addClass('is-valid');
                    }

                    formData[$(this).attr('data-name')] = $(this).val();
                });

                // Валидация не прошла то не сохраняем
                if (!isValidated) {
                    return false;
                }

                // Запрос сохранения
                $('.loader').show();
                $.ajax({
                    url: '/api/task/store',
                    method: 'post',
                    dataType: 'json',
                    data: formData,
                    success: function (data) {
                        // тут интересно. По идее гасить модалку нужно методом modal()
                        // но по непонятной причине такой способ зачастую намного надежнее
                        // плюс если есть события на закрытия они вызываются
                        $('#create-cancel').click();

                        // перезагрузка
                        load();
                    },
                    complete: function () {
                        $('.loader').hide();
                    }
                });
            })

            // Сохранение задачи
            // На бекенде есть защита от вызываения сохранения без администрирования
            $('#edit-send').on('click', function (e) {
                e.preventDefault();

                var isValidated = true;
                var formData = {};

                // Валидация
                $('#editModal .need-validate').each(function (index) {
                    if (/^\s?$/.test($(this).val())) {
                        $(this).removeClass('is-valid').addClass('is-invalid');
                        isValidated = false;
                    } else {
                        $(this).removeClass('is-invalid').addClass('is-valid');
                    }

                    formData[$(this).attr('data-name')] = $(this).val();
                });

                // Валидация не прошла то не сохраняем
                if (!isValidated) {
                    return false;
                }

                // Запрос сохранения
                formData['admin_check'] = $('#admin_check').is(':checked') ? 1 : 0;
                $('.loader').show();
                $.ajax({
                    url: '/api/task/store',
                    method: 'post',
                    dataType: 'json',
                    data: formData,
                    success: function (data) {
                        // тут интересно. По идее гасить модалку нужно методом modal()
                        // но по непонятной причине такой способ зачастую намного надежнее
                        // плюс если есть события на закрытия они вызываются
                        $('#edit-cancel').click();

                        // перезагрузка
                        load();
                    },
                    complete: function () {
                        $('.loader').hide();
                    }
                });
            })

            // Авторизация
            $('#auth-send').on('click', function (e) {
                e.preventDefault();

                var isValidated = true;
                var formData = {};

                // проверка заполненности
                $('#loginModal .need-validate').each(function (index) {
                    if (/^\s?$/.test($(this).val())) {
                        $(this).removeClass('is-valid').addClass('is-invalid');
                        isValidated = false;
                    } else {
                        $(this).removeClass('is-invalid').addClass('is-valid');
                    }
                    formData[$(this).attr('data-name')] = $(this).val();
                });

                // Если что-то пусто - выкидываем
                if (!isValidated) {
                    return false;
                }

                $('.loader').show();
                $.ajax({
                    url: '/api/login',
                    method: 'post',
                    dataType: 'json',
                    data: formData,
                    success: function (data) {

                        // Установка админсткого режима
                        window.admin = true;

                        // Прячим окно, скрывааем кнопку авторизации, показываем логаут
                        $('#auth-cancel').click();
                        $('#login-form').hide();
                        $('#logout').show();

                        load();
                    },
                    error: function () {
                        // Показываем что логин/пароль указаны неверно
                        $('#loginError').show();
                    },
                    complete: function () {
                        $('.loader').hide();
                    }
                });
            })

            // Логаут
            $('#logout').on('click', function (e) {
                e.preventDefault();
                $('.loader').show();
                $.ajax({
                    url: '/api/logout',
                    method: 'post',
                    success: function (data) {

                        // переход в пользовательски режим
                        window.admin = false;
                        window.data = {};

                        // показываем кнопку авторизации, скрываем логаут
                        $('#login-form').show();
                        $('#logout').hide();

                        load();
                    },
                    complete: function () {
                        $('.loader').hide();
                    }
                });
            });

            // начальная загрузка
            load();
        });
    </script>
@endsection