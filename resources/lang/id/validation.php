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

    'accepted' => 'Kolom :attribute harus diterima.',
    'active_url' => 'Kolom :attribute bukan URL yang valid.',
    'after' => 'Kolom :attribute harus tanggal setelah :date.',
    'after_or_equal' => 'Kolom :attribute harus berupa tanggal atau sama dengan tanggal :date.',
    'alpha' => 'Kolom :attribute hanya boleh diisi huruf.',
    'alpha_dash' => 'Kolom :attribute hanya boleh berisi huruf, angka dan strip.',
    'alpha_num' => 'Kolom :attribute hanya boleh berisi huruf dan angka.',
    'array' => 'Kolom :attribute harus berupa array.',
    'before' => 'Kolom :attribute harus sebelum tanggal :date.',
    'before_or_equal' => 'Kolom :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'Kolom :attribute harus diantara :min dan :max.',
        'file' => 'Kolom :attribute harus diantara :min dan :max kilobytes.',
        'string' => 'Kolom :attribute harus diantara :min dan :max karakter.',
        'array' => 'Kolom :attribute harus diantara :min dan :max item.',
    ],
    'boolean' => 'Kolom :attribute harus berupa true atau false.',
    'confirmed' => 'Kolom :attribute konfirmasi tidak cocok.',
    'date' => 'Kolom :attribute harus berupa tanggal yang valid.',
    'date_equals' => 'Kolom :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'Kolom :attribute harus berjumlah :digits digit.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute Kolom has a duplicate value.',
    'email' => 'Kolom :attribute harus berupa email yang valid.',
    'exists' => 'Kolom :attribute yang dipilih tidak valid.',
    'file' => 'Kolom :attribute harus berupa sebuah berkas.',
    'filled' => 'Kolom :attribute harus memiliki Kolom.',
    'gt' => [
        'numeric' => 'Kolom :attribute harus lebih besar dari :value.',
        'file' => 'Kolom :attribute harus lebih besar dari :value kilobytes.',
        'string' => 'Kolom :attribute harus lebih besar dari :value karakter.',
        'array' => 'Kolom :attribute must have more than :value item.',
    ],
    'gte' => [
        'numeric' => 'Kolom :attribute harus lebih besar atau sama dengan :value.',
        'file' => 'Kolom :attribute harus lebih besar atau sama dengan :value kilobytes.',
        'string' => 'Kolom :attribute harus lebih besar atau sama dengan :value karakter.',
        'array' => 'Kolom :attribute harus memiliki :value item atau lebih.',
    ],
    'image' => 'Kolom :attribute harus berupa sebuah gambar.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'Kolom :attribute tidak sesuai dengan :other.',
    'integer' => 'Kolom :attribute harus bertipe integer.',
    'ip' => 'Kolom :attribute harus alamat IP yang valid.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'Kolom :attribute harus kurang dari :value.',
        'file' => 'Kolom :attribute harus kurang dari :value kilobytes.',
        'string' => 'Kolom :attribute harus kurang dari :value karakter.',
        'array' => 'Kolom :attribute must have less than :value item.',
    ],
    'lte' => [
        'numeric' => 'Kolom :attribute harus kurang dari atau sama dengan :value.',
        'file' => 'Kolom :attribute harus kurang dari atau sama dengan :value kilobytes.',
        'string' => 'Kolom :attribute harus kurang dari atau sama dengan :value karakter.',
        'array' => 'Kolom :attribute harus kurang dari :value item.',
    ],
    'max' => [
        'numeric' => 'Kolom :attribute tidak boleh lebih dari :max.',
        'file' => 'Kolom :attribute tidak boleh lebih dari :max kilobytes.',
        'string' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
        'array' => 'Kolom :attribute tidak boleh lebih dari :max items.',
    ],
    'mimes' => 'Kolom :attribute harus berkas bertipe : :values.',
    'mimetypes' => 'Kolom :attribute harus berkas bertipe : :values.',
    'min' => [
        'numeric' => 'Kolom :attribute harus minimal :min.',
        'file' => 'Kolom :attribute harus minimal :min kilobytes.',
        'string' => 'Kolom :attribute harus minimal :min karakter.',
        'array' => 'Kolom :attribute harus minimal :min item.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'Kolom :attribute harus berupa angka.',
    'present' => 'The :attribute Kolom must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'Kolom :attribute tidak boleh kosong.',
    'required_if' => 'The :attribute Kolom is required when :other is :value.',
    'required_unless' => 'The :attribute Kolom is required unless :other is in :values.',
    'required_with' => 'The :attribute Kolom is required when :values is present.',
    'required_with_all' => 'The :attribute Kolom is required when :values are present.',
    'required_without' => 'The :attribute Kolom is required when :values is not present.',
    'required_without_all' => 'The :attribute Kolom is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'Kolom :attribute harus berukuran :size.',
        'file' => 'Kolom :attribute harus berukuran :size kilobytes.',
        'string' => 'Kolom :attribute harus berukuran :size karakter.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => 'Kolom :attribute harus bertipe string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'Kolom :attribute sudah ada sebelumnya.',
    'uploaded' => 'Kolom :attribute gagal diupload.',
    'url' => 'Kolom :attribute tidak valid.',
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
        'kd_matkul' => [
            'required' => 'Kolom kode mata kuliah tidak boleh kosong',
            'min'      => [
                    'string' => 'Kolom kode mata kuliah harus minimal :min karakter.',
                    'array'  => 'Kolom kode mata kuliah harus minimal :min karakter.'
            ],
            'max'      => [
                    'string' => 'Kolom kode mata kuliah tidak boleh lebih dari :max karakter.',
                    'array'  => 'Kolom kode mata kuliah tidak boleh lebih dari :max karakter.'
            ],
            'unique' => 'Kolom kode mata kuliah harus unik.'
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
