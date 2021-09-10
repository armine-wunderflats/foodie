<?php

return [
    'sign_up' => [
        'validation_rules' => [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50',
        ],
    ],

    'login' => [
        'validation_rules' => [
            'email' => 'required|email',
            'password' => 'required|string',
        ],
    ],

    'create_meal' => [
        'validation_rules' => [
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'string',
        ],
    ],

    'update_meal' => [
        'validation_rules' => [
            'name' => 'string',
            'price' => 'numeric',
            'description' => 'string',
        ],
    ],

    'create_restaurant' => [
        'validation_rules' => [
            'name' => 'required|string',
            'food_type' => 'required|string',
            'description' => 'string',
        ],
    ],

    'update_restaurant' => [
        'validation_rules' => [
            'name' => 'string',
            'food_type' => 'string',
            'description' => 'string',
        ],
    ],

    'create_order' => [
        'validation_rules' => [
            'mealIds' => 'array',
        ],
    ],

    'update_user' => [
        'validation_rules' => [
            'name' => 'string',
            'email' => 'email|unique:users',
            'password' => 'string|min:6|max:50',
        ],
    ],
];
