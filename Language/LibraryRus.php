<?php

return [

    /*
        |--------------------------------------------------------------------------
        | Validation Language Lines
        |--------------------------------------------------------------------------
        |
        | Следующие языковые линии содержат сообщения об ошибках по умолчанию, используемые
        | класс валидатора.Некоторые из этих правил имеют несколько версий таких
        | как размер правил.Не стесняйтесь настроить каждую из этих сообщений здесь.
        |
        */

    'accepted' => ':attribute должен быть принят.',
    'active_url' => ':attribute не является действительным URL.',
    'after' => ':attribute должен быть датой после :date.',
    'after_or_equal' => ':attribute должен быть датой после или равен :date.',
    'alpha' => ':attribute может содержать только буквы.',
    'alpha_dash' => ':attribute может содержать буквы, номера, тире и подчеркивания.',
    'alpha_num' => ':attribute может содержать только буквы и цифры.',
    'array' => ':attribute должен быть массивом.', //-,_//
    'before' => ':attribute должен быть датой до :date.',
    'before_or_equal' => ':attribute должен быть датой до или равной :date.',
    // 'between' => [
    //     'numeric' => ':attribute должен быть между :min и :max.',
    //     'file' => ':attribute должен быть между :min а также :max килобайт.',
    //     'string' => ':attribute должен быть между :min и :max символов.',
    //     'array' => ':attribute должен иметь между :min и :max элементом.',
    // ],
    'between' => 'Количество элементов в массиве :attribute не должно быть меньше :min и больше :max.',
    'boolean' => 'Поле :attribute должно быть true или false.',
    'confirmed' => ':attribute не подтвержден.',
    'date' => ':attribute не является действительной датой.',
    'date_equals' => ':attribute должен быть датой, равной :date.',
    'date_format' => ':attribute не соответствует формату :format.',
    'different' => ':attribute и :other должен быть другим.',
    'digits' => ':attribute должно быть :digits цифры.',
    'digits_between' => ':attribute должен быть между :min и :max цифрой.',
    'dimensions' => ':attribute имеет недействительные размеры изображения.',
    'distinct' => ':attribute имеет дублирующее значение.',
    'email' => ':attribute адрес эл. почты должен быть действительным.',
    'phone' => 'Некорректный номер телефона.',
    'ends_with' => ':attribute должен закончиться одним из следующих действий: :values.',
    'exists' => 'Выбранный :attribute является недействительным.',
    'file' => ':attribute должен быть файл.',
    'filled' => ':attribute поле должно иметь значение.',
    'gt' => [
        'numeric' => ':attribute должен быть больше, чем :value.',
        'file' => ':attribute должен быть больше, чем :value килобайт.',
        'string' => ':attribute должен быть больше, чем :value символов.',
        'array' => ':attribute должен иметь больше, чем :value элементов.',
    ],
    'gte' => [
        'numeric' => ':attribute должен быть больше или равен :value.',
        'file' => ':attribute должен быть больше или равен :value килобайт.',
        'string' => ':attribute должен быть больше или равен :value символов.',
        'array' => ':attribute должен иметь :value значений или более.',
    ],
    'image' => ':attribute должен быть изображением.',
    'in' => 'Выбранный :attribute является неверным.',
    'in_array' => ':other не существует в :attribute.',
    'key_array' => ':other не является ключом в :attribute.',
    'in_object' => ':attribute не существует в объекте.',
    'integer' => ':attribute должен быть целым числом.', //-,_// 
    'ip' => ':attribute должен быть IP-адресом.',
    'ipv4' => ':attribute должен быть адресом IPv4.',
    'ipv6' => ':attribute должен быть адресом IPv6.',
    'json' => ':attribute должен быть строкой JSON.',
    'lt' => [
        'numeric' => ':attribute должно быть меньше, чем :value.',
        'file' => ':attribute должно быть меньше, чем :value килобайт.',
        'string' => ':attribute должно быть меньше, чем :value символа(ов).',
        'array' => ':attribute должно быть меньше, чем :value элемента(ов).',
    ],
    'lte' => [
        'numeric' => ':attribute должно быть меньше, чем или равный :value.',
        'file' => ':attribute должно быть меньше, чем или равный :value килобайт.',
        'string' => ':attribute должно быть меньше, чем или равный :value символов.',
        'array' => ':attribute не должно быть больше, чем :value элемента(ов).',
    ],
    'max' => [
        'numeric' => ':attribute не может быть больше, чем :max.',
        'file' => ':attribute не может быть больше, чем :max килобайт.',
        'string' => ':attribute не может быть больше, чем :max символов.',
        'array' => ':attribute не может быть больше, чем :max элементов.',
    ],
    'mimes' => ':attribute должен быть файл типа: :values.',
    'mimetypes' => ':attribute должен быть файл типа: :values.',
    'min' => [
        'numeric' => ':attribute должен быть не менее :min.',
        'file' => ':attribute должен быть не менее :min килобайт.',
        'string' => ':attribute должен быть не менее :min символов.',
        'array' => ':attribute должен быть не менее :min элементов.',
    ],
    'multiple_of' => ':attribute должен быть кратным :value.',
    'not_in' => 'Выбранный :attribute некорректный.',
    'not_regex' => ':attribute неверного формата.',
    'numeric' => ':attribute должны быть числом.',
    'password' => 'Некорректный пароль.',
    'present' => ':attribute отсутствует.',
    'regex' => 'Неверный формат :attribute.', //-,_//
    'required' => 'Поле :attribute обязательно для заполнения.', //-,_//
    'required_if' => ':attribute требуется, когда :other является :value.',
    'required_unless' => ':attribute требуется, если :other в :values.',
    'required_with' => ':attribute требуется, когда :values действительное.',
    'required_with_all' => ':attribute требуется, когда :values присутствуют.',
    'required_without' => ':attribute требуется, когда :values отсутствует.',
    'required_without_all' => ':attribute требуется, когда ни один из :values присутствуют.',
    'same' => ':attribute и :other должен совпадать.',
    'size' => [
        'numeric' => ':attribute должен быть :size.',
        'file' => ':attribute должнен быть :size килобайт.',
        'string' => ':attribute должнен быть :size символов.',
        'array' => ':attribute должен содержать :size элементов.',
    ],
    'starts_with' => ':attribute должен начать с одного из следующих: :values.',
    'string' => 'Это поле :attribute должно быть строкой.', //-,_//
    'timezone' => ':attribute должен быть действительной зоной.',
    'unique' => ':attribute уже использован.',
    'uploaded' => ':attribute не удалось загрузить.',
    'url' => 'Формат :attribute неверный.',
    'uuid' => ':attribute должен быть действительным UUID.',

    /*
        |--------------------------------------------------------------------------
        | Custom Validation Language Lines
        |--------------------------------------------------------------------------
        |
        | Здесь вы можете указать пользовательские сообщения проверки для атрибутов, используя
        | Конвенция «Атрибут. Руле» назвать строки.Это делает это быстро
        | Укажите определенную полосу пользовательской языковой линии для данного правила атрибута.
        |
        */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
        |--------------------------------------------------------------------------
        | Custom Validation Attributes
        |--------------------------------------------------------------------------
        |
        | Следующие языковые линии используются для замены нашего атрибута
        | с чем-то более удобным для чтения, такой как «адрес электронной почты» вместо
        | «электронного письма».Это просто помогает нам сделать наше сообщение более выразительным.
        |
        */

    'attributes' => [],

];
