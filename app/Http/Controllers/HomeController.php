<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $feeds= [
            [
                'id' => 1,
                'image' => 'https://freesociety.in/cdn/shop/files/1245160_01_jpg_1024x1024.webp?v=1699701942',
                'title' => 'Nike Air Max',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
                'location' => 'New York',
                'created_at' => '2021-06-01 12:00:00'
            ],
            [
                'id' => 2,
                'image' => 'https://freesociety.in/cdn/shop/files/1245160_01_jpg_1024x1024.webp?v=1699701942',
                'title' => 'Nike Air Max',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
                'location' => 'New York',
                'created_at' => '2021-06-01 12:00:00'
            ],
            [
                'id' => 3,
                'image' => 'https://freesociety.in/cdn/shop/files/1245160_01_jpg_1024x1024.webp?v=1699701942',
                'title' => 'Nike Air Max',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
                'location' => 'New York',
                'created_at' => '2021-06-01 12:00:00'
            ],
            [
                'id' => 4,
                'image' => 'https://freesociety.in/cdn/shop/files/1245160_01_jpg_1024x1024.webp?v=1699701942',
                'title' => 'Nike Air Max',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
                'location' => 'New York',
                'created_at' => '2021-06-01 12:00:00'
            ],
            [
                'id' => 5,
                'image' => 'https://freesociety.in/cdn/shop/files/1245160_01_jpg_1024x1024.webp?v=1699701942',
                'title' => 'Nike Air Max',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
                'location' => 'New York',
                'created_at' => '2021-06-01 12:00:00'
            ],
            [
                'id' => 6,
                'image' => 'https://freesociety.in/cdn/shop/files/1245160_01_jpg_1024x1024.webp?v=1699701942',
                'title' => 'Nike Air Max',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
                'location' => 'New York',
                'created_at' => '2021-06-01 12:00:00'
            ],
            [
                'id' => 7,
                'image' => 'https://freesociety.in/cdn/shop/files/1245160_01_jpg_1024x1024.webp?v=1699701942',
                'title' => 'Nike Air Max',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
                'location' => 'New York',
                'created_at' => '2021-06-01 12:00:00'
            ],
        ];
        return view('home', compact('feeds'));
    }

    public function plain()
    {
        return view('plain');
    }
}
