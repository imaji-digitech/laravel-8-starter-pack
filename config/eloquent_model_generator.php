<?php

use Illuminate\Database\Eloquent\Model;

return [
    'model_defaults' => [
        'namespace' => 'App\Models',
        'base_class_name' => Model::class,
        'output_path' => 'Models',
        'no_timestamps' => null,
        'date_format' => null,
        'connection' => null,
        'backup' => null,
    ]
];
