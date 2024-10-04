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
        window.page = 1;
        window.order = 'id';
        window.desc = false;
        window.admin = {{ session('admin') ? 'true' : 'false' }};
        window.data = {};

        jQuery(document).ready(function ($) {

            if (window.admin) {
                $('#login-form').hide();
                $('#logout').show();
            } else {
                $('#login-form').show();
                $('#logout').hide();
            }

            function load() {
                if (page < 1) {
                    return;
                }

                $('.loader').show();
                $.ajax({
                    url: '/api/task/index/?page=' + window.page + '&order=' + window.order + '&desc=' + (window.desc ? 1 : 0),
                    dataType: "json",
                    success: function (data) {

                        $("#records").empty();
                        if (window.admin) {
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

                        $("#paginator").empty();
                        for (let i = 1; i <= data.data.last_page; i++) {
                            $('<li class="page-item">').append(
                                $('<a class="page-link pager" data-page="' + i + '" onclick="" href="#">').text(i)
                            ).appendTo('#paginator');
                        }

                        $('.pager').on('click', function (e) {
                            e.preventDefault();
                            window.page = $(this).attr('data-page');
                            load();
                        });

                        $('.loader').hide();
                    },
                    complete: function () {
                        $('.loader').hide();
                    }
                });
            }

            $(".sort").each(function (index) {
                $(this).on('click', function (e) {
                    $(".sort").each(function (index) {
                        $(this).parent().removeClass('selected desc asc');
                    });

                    e.preventDefault();
                    let order = $(this).attr('data-order');
                    if (order === window.order) {
                        window.desc = !window.desc;

                        if (window.desc) {
                            $(this).parent().removeClass('asc').addClass('desc');
                        } else {
                            $(this).parent().removeClass('desc').addClass('asc');
                        }
                    } else {
                        window.order = $(this).attr('data-order');
                        $(this).parent().removeClass('desc').addClass('asc');
                        window.desc = false;
                    }

                    $(this).parent().addClass('selected');

                    load();
                });
            });

            $('#create-form').on('click', function (e) {
                e.preventDefault();
                $('#createModal .need-validate').each(function (index) {
                    $(this).removeClass('is-valid is-invalid');
                    $(this).val('');
                });
            })

            $('#create-send').on('click', function (e) {
                e.preventDefault();

                var isValidated = true;
                var formData = {};

                $('#createModal .need-validate').each(function (index) {
                    if (/^\s?$/.test($(this).val())) {
                        $(this).removeClass('is-valid').addClass('is-invalid');
                        isValidated = false;
                    } else {
                        $(this).removeClass('is-invalid').addClass('is-valid');
                    }

                    formData[$(this).attr('data-name')] = $(this).val();
                });

                if (!isValidated) {
                    return false;
                }

                $('.loader').show();
                $.ajax({
                    url: '/api/task/store',
                    method: 'post',
                    dataType: 'json',
                    data: formData,
                    success: function (data) {
                        $('#create-cancel').click();

                        load();
                    },
                    complete: function () {
                        $('.loader').hide();
                    }
                });
            })

            $('#edit-send').on('click', function (e) {
                e.preventDefault();

                var isValidated = true;
                var formData = {};

                $('#editModal .need-validate').each(function (index) {
                    if (/^\s?$/.test($(this).val())) {
                        $(this).removeClass('is-valid').addClass('is-invalid');
                        isValidated = false;
                    } else {
                        $(this).removeClass('is-invalid').addClass('is-valid');
                    }

                    formData[$(this).attr('data-name')] = $(this).val();
                });

                if (!isValidated) {
                    return false;
                }

                formData['admin_check'] = $('#admin_check').is(':checked') ? 1 : 0;

                $('.loader').show();
                $.ajax({
                    url: '/api/task/store',
                    method: 'post',
                    dataType: 'json',
                    data: formData,
                    success: function (data) {
                        $('#edit-cancel').click();

                        load();
                    },
                    complete: function () {
                        $('.loader').hide();
                    }
                });
            })

            $('#auth-send').on('click', function (e) {
                e.preventDefault();

                var isValidated = true;
                var formData = {};

                $('#loginModal .need-validate').each(function (index) {
                    if (/^\s?$/.test($(this).val())) {
                        $(this).removeClass('is-valid').addClass('is-invalid');
                        isValidated = false;
                    } else {
                        $(this).removeClass('is-invalid').addClass('is-valid');
                    }
                    formData[$(this).attr('data-name')] = $(this).val();
                });

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
                        window.admin = true;

                        // да, я вкурсе что тут можно $('#loginModal').modal('hide');
                        // Но так срабатывает надежнее
                        $('#auth-cancel').click();

                        $('#login-form').hide();
                        $('#logout').show();

                        load();
                    },
                    error: function () {
                        $('#loginError').show();
                    },
                    complete: function () {
                        $('.loader').hide();
                    }
                });
            })

            $('#logout').on('click', function (e) {
                e.preventDefault();
                $('.loader').show();
                $.ajax({
                    url: '/api/logout',
                    method: 'post',
                    success: function (data) {
                        window.admin = false;
                        window.data = {};
                        $('#login-form').show();
                        $('#logout').hide();

                        load();
                    },
                    complete: function () {
                        $('.loader').hide();
                    }
                });
            });

            load();
        });
    </script>
@endsection