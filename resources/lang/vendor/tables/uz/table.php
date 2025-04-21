<?php

return [

    'columns' => [
        'tags' => [
            'more' => 'va yana :count ta',
        ],
        'messages' => [
            'copied' => 'Nusxa olindi',
        ],
    ],

    'fields' => [
        'search_query' => [
            'label' => 'Qidirish',
            'placeholder' => 'Qidirish',
        ],
    ],

    'pagination' => [
        'label' => 'Sahifalash',

        'overview' => ':first dan :last gacha (jami :total)',

        'fields' => [
            'records_per_page' => [
                'label' => 'har sahifada',
                'options' => [
                    'all' => 'Hammasi',
                ],
            ],
        ],

        'buttons' => [
            'go_to_page' => [
                'label' => ':page - sahifaga o\'tish',
            ],
            'next' => [
                'label' => 'Keyingi',
            ],
            'previous' => [
                'label' => 'Oldingi',
            ],
        ],
    ],

    'buttons' => [
        'disable_reordering' => [
            'label' => 'Tartibni saqlash',
        ],
        'enable_reordering' => [
            'label' => 'Tartibni o\'zgartirish',
        ],
        'filter' => [
            'label' => 'Filtr',
        ],
        'open_actions' => [
            'label' => 'Harakatlarni ochish',
        ],
        'toggle_columns' => [
            'label' => 'Ustunlarni almashtirish',
        ],
    ],

    'empty' => [
        'heading' => 'Yozuvlar topilmadi',
    ],

    'filters' => [
        'buttons' => [
            'remove' => [
                'label' => 'Filterni olib tashlash',
            ],
            'remove_all' => [
                'label' => 'Filtrlarni tozalash',
                'tooltip' => 'Filtrlarni tozalash',
            ],
            'reset' => [
                'label' => 'Filtrlarni tiklash',
            ],
        ],

        'indicator' => 'Faol filtrlar',

        'multi_select' => [
            'placeholder' => 'Hammasi',
        ],

        'select' => [
            'placeholder' => 'Hammasi',
        ],

        'trashed' => [
            'label' => 'O\'chirilgan yozuvlar',
            'only_trashed' => 'Faqat o\'chirilgan yozuvlar',
            'with_trashed' => 'O\'chirilgan yozuvlar bilan',
            'without_trashed' => 'O\'chirilgan yozuvlarsiz',
        ],
    ],

    'reorder_indicator' => 'Yozuvlarni tartiblash uchun sudrab tashlang.',

    'selection_indicator' => [
        'selected_count' => '1 ta yozuv tanlandi.|:count ta yozuv tanlandi.',

        'buttons' => [
            'select_all' => [
                'label' => 'Barcha :count ta yozuvni tanlash',
            ],
            'deselect_all' => [
                'label' => 'Barcha tanlovlarni bekor qilish',
            ],
        ],
    ],

    'sorting' => [
        'fields' => [
            'column' => [
                'label' => 'Saralash turi',
            ],
            'direction' => [
                'label' => 'Yo\'nalish',
                'options' => [
                    'asc' => 'O\'sish bo\'yicha',
                    'desc' => 'Kamayish bo\'yicha',
                ],
            ],
        ],
    ],

];
