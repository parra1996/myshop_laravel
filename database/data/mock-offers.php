<?php

return [
   1=> [
        'id' => 1,
        'name' => 'Descuento Primavera Gamer',
        'slug' => 'descuento-primavera-gamer',
        'discount_percentage' => 20,
        'description' => '20% de descuento en juegos seleccionados de PS5 y Nintendo.',
        'start_date' => '2025-03-01',
        'end_date' => '2025-03-31',
        'active' => true,
        'product_ids' => [1, 5] // God of War Ragnarök, Zelda TOTK
    ],
    2=> [
        'id' => 2,
        'name' => 'Oferta Xbox Fans',
        'slug' => 'oferta-xbox-fans',
        'discount_percentage' => 15,
        'description' => 'Ahorra un 15% en juegos exclusivos de Xbox.',
        'start_date' => '2025-02-15',
        'end_date' => '2025-04-15',
        'active' => true,
        'product_ids' => [3] // Halo Infinite
    ],
    3=> [
        'id' => 3,
        'name' => 'Accesorios en Oferta',
        'slug' => 'accesorios-en-oferta',
        'discount_percentage' => 10,
        'description' => '10% de descuento en accesorios seleccionados para consolas.',
        'start_date' => '2025-01-10',
        'end_date' => '2025-02-28',
        'active' => false,
        'product_ids' => [7, 9] // Pulse 3D Headset, Joy-Cons
    ],
];