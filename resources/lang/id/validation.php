<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Field :attribute harus diterima.',
    'active_url' => 'Field :attribute bukan URL yang valid.',
    'after' => 'Field :attribute harus tanggal setelah :date.',
    'after_or_equal' => 'Field :attribute harus berupa tanggal atau sama dengan tanggal :date.',
    'alpha' => 'Field :attribute hanya boleh diisi huruf.',
    'alpha_dash' => 'Field :attribute hanya boleh berisi huruf, angka dan strip.',
    'alpha_num' => 'Field :attribute hanya boleh berisi huruf dan angka.',
    'array' => 'Field :attribute harus berupa array.',
    'before' => 'Field :attribute harus sebelum tanggal :date.',
    'before_or_equal' => 'Field :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'Field :attribute harus diantara :min dan :max.',
        'file' => 'Field :attribute harus diantara :min dan :max kilobytes.',
        'string' => 'Field :attribute harus diantara :min dan :max karakter.',
        'array' => 'Field :attribute harus diantara :min dan :max item.',
    ],
    'boolean' => 'Field :attribute harus berupa true atau false.',
    'confirmed' => 'Field :attribute konfirmasi tidak cocok.',
    'date' => 'Field :attribute harus berupa tanggal yang valid.',
    'date_equals' => 'Field :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'Field :attribute harus berjumlah :digits digit.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'Field :attribute harus berupa email yang valid.',
    'exists' => 'Field :attribute yang dipilih tidak valid.',
    'file' => 'Field :attribute harus berupa sebuah berkas.',
    'filled' => 'Field :attribute harus memiliki Field.',
    'gt' => [
        'numeric' => 'Field :attribute harus lebih besar dari :value.',
        'file' => 'Field :attribute harus lebih besar dari :value kilobytes.',
        'string' => 'Field :attribute harus lebih besar dari :value karakter.',
        'array' => 'Field :attribute must have more than :value item.',
    ],
    'gte' => [
        'numeric' => 'Field :attribute harus lebih besar atau sama dengan :value.',
        'file' => 'Field :attribute harus lebih besar atau sama dengan :value kilobytes.',
        'string' => 'Field :attribute harus lebih besar atau sama dengan :value karakter.',
        'array' => 'Field :attribute harus memiliki :value item atau lebih.',
    ],
    'image' => 'Field :attribute harus berupa sebuah gambar.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'Field :attribute tidak sesuai dengan :other.',
    'integer' => 'Field :attribute harus bertipe integer.',
    'ip' => 'Field :attribute harus alamat IP yang valid.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'Field :attribute harus kurang dari :value.',
        'file' => 'Field :attribute harus kurang dari :value kilobytes.',
        'string' => 'Field :attribute harus kurang dari :value karakter.',
        'array' => 'Field :attribute must have less than :value item.',
    ],
    'lte' => [
        'numeric' => 'Field :attribute harus kurang dari atau sama dengan :value.',
        'file' => 'Field :attribute harus kurang dari atau sama dengan :value kilobytes.',
        'string' => 'Field :attribute harus kurang dari atau sama dengan :value karakter.',
        'array' => 'Field :attribute harus kurang dari :value item.',
    ],
    'max' => [
        'numeric' => 'Field :attribute tidak boleh lebih dari :max.',
        'file' => 'Field :attribute tidak boleh lebih dari :max kilobytes.',
        'string' => 'Field :attribute tidak boleh lebih dari :max karakter.',
        'array' => 'Field :attribute tidak boleh lebih dari :max items.',
    ],
    'mimes' => 'Field :attribute harus berkas bertipe : :values.',
    'mimetypes' => 'Field :attribute harus berkas bertipe : :values.',
    'min' => [
        'numeric' => 'Field :attribute harus minimal :min.',
        'file' => 'Field :attribute harus minimal :min kilobytes.',
        'string' => 'Field :attribute harus minimal :min karakter.',
        'array' => 'Field :attribute harus minimal :min item.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'Field :attribute harus berupa angka.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'Field :attribute tidak boleh kosong.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'Field :attribute harus berukuran :size.',
        'file' => 'Field :attribute harus berukuran :size kilobytes.',
        'string' => 'Field :attribute harus berukuran :size karakter.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => 'Field :attribute harus bertipe string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'Field :attribute sudah ada sebelumnya.',
    'uploaded' => 'Field :attribute gagal diupload.',
    'url' => 'Field :attribute tidak valid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
