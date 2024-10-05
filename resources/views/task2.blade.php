@extends('layout')

@section('content')
    @include('navbar')
    <div class="container my-5">
        <h1>Задание 2 - Выбор домов</h1>


        <div class="col-lg-8 py-3">
            <form>
                <div class="row md-8">
                    <div class="col-md-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control search-param" id="name" />
                    </div>
                    <div class="col-md-2">
                        <label for="price_from" class="form-label">Price from</label>
                        <input type="text" class="form-control search-param" data-type="int" id="price_from" />
                    </div>
                    <div class="col-md-2">
                        <label for="price_to" class="form-label">Price to</label>
                        <input type="text" class="form-control search-param" data-type="int" id="price_to" />
                    </div>
                </div>

                <div class="row md-8">
                    <div class="col-md-2">
                        <label for="bedrooms" class="form-label">Bedrooms</label>
                        <input type="text" class="form-control search-param" data-type="int" id="bedrooms" />
                    </div>

                    <div class="col-md-2">
                        <label for="bathrooms" class="form-label">Bathrooms</label>
                        <input type="text" class="form-control search-param" data-type="int" id="bathrooms" />
                    </div>

                    <div class="col-md-2">
                        <label for="storeys" class="form-label">Storeys</label>
                        <input type="text" class="form-control search-param" data-type="int" id="storeys" />
                    </div>

                    <div class="col-md-2">
                        <label for="garages" class="form-label">Garages</label>
                        <input type="text" class="form-control search-param" data-type="int" id="garages" />
                    </div>
                </div>
            </form>
        </div>


        <div class="col-lg-8 py-3">
            <table class="table">
                <thead>
                <tr id="sort">
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Bedrooms</th>
                    <th scope="col">Bathrooms</th>
                    <th scope="col">Storeys</th>
                    <th scope="col">Garages</th>
                </tr>
                </thead>
                <tbody id="records">

                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Таймер отсрочки загрузки после ввода данных
        // Что бы на каждый чих не кидать на load
        window.timer = null;

        jQuery(document).ready(function ($) {

            // На ввод каждого поискового параметра вводим интервал
            // после которого произойдет загрузка

            $('.search-param').on('keyup', function() {
                if (window.timer) {
                    clearTimeout(window.timer);
                }
                window.timer = setTimeout(function () {
                    load();
                }, 500)
            });

            // Загрузчик
            function load() {
                let props = {};
                let validated = true;

                // Валидация и установка параметров
                // Если параметр не введен - не учитываем его
                // Если вместо числа введено непонятно что - говорим что ввод неверен
                $('.search-param').each(function () {
                    if (!/^\s?$/.test($(this).val())) {
                        let id = $(this).prop('id');
                        let type = $(this).attr('data-type');

                        if (type === 'int' && !/^\d+$/.test($(this).val())) {
                            validated = false;
                        }

                        props[id] = $(this).val();
                    }
                });


                // Сброс таблицы
                $("#records").empty();

                // Если валидация не прошла - сообщаем и завершаем, не грузим данные
                if (!validated) {
                    $('<tr>').append(
                        $('<td colspan="6">').text('Указаны неверные числовые значения')
                    ).appendTo('#records');
                    return;
                }

                // Индикатор загрузки
                // Я бы мог повесить спиннер как в прошлой задаче, но если просили имнно так, то ок
                $('<tr>').append(
                    $('<td colspan="6">').text('Загрузка...')
                ).appendTo('#records');

                // Загрузка
                $.ajax({
                    url: '/api/house/index/',
                    method: 'get',
                    dataType: "json",
                    data: props,
                    success: function (data) {

                        // Сброс таблицы
                        $("#records").empty();

                        // Заполнение таблицы либо сообщение, что данных нет
                        if (data.data.length > 0) {
                            $.each(data.data, function (i, item) {
                                $('<tr>').append(
                                    $('<td>').text(item.name),
                                    $('<td>').text(item.price),
                                    $('<td>').text(item.bedrooms),
                                    $('<td>').text(item.bathrooms),
                                    $('<td>').text(item.storeys),
                                    $('<td>').text(item.garages)
                                ).appendTo('#records');
                            });
                        }
                        else {
                            $('<tr>').append(
                                $('<td colspan="6">').text('По указанным вами параметрам ничего не найдено')
                            ).appendTo('#records');
                        }
                    }
                });
            }
            load();
        });
    </script>
@endsection