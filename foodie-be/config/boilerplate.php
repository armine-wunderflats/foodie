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
            'description' => 'nullable|string',
        ],
    ],

    'update_meal' => [
        'validation_rules' => [
            'name' => 'string',
            'price' => 'numeric',
            'description' => 'nullable|string',
        ],
    ],

    'create_restaurant' => [
        'validation_rules' => [
            'name' => 'required|string',
            'food_type' => 'required|string',
            'description' => 'nullable|string',
        ],
    ],

    'update_restaurant' => [
        'validation_rules' => [
            'name' => 'string',
            'food_type' => 'string',
            'description' => 'nullable|string',
        ],
    ],

    'create_order' => [
        'validation_rules' => [
            'mealIds' => 'required|array|min:1',
            'address' => 'required|string',
            'instructions' => 'nullable|string',
        ],
    ],

    'update_user' => [
        'validation_rules' => [
            'name' => 'string',
            'email' => 'email|unique:users',
            'password' => 'string|min:6|max:50',
        ],
    ],

    'block_user' => [
        'validation_rules' => [
            'user' => 'required',
        ],
    ],
];
