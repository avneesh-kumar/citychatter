<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Roilift\Admin\Interfaces\CategoryRepositoryInterface;
use Roilift\Admin\Models\Category;
use Roilift\Admin\Models\Post;

class FeedController extends Controller
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository
    )
    {
        
    }

    public function index($slug = null)
    {
        $categories = $this->categoryRepository->all();
        // $feeds= [
        //     [
        //         'id' => 7,
        //         'image' => 'https://i.pinimg.com/236x/f9/07/32/f90732b39cc961518e2165b9e83f0411.jpg',
        //         'title' => 'Nike Air Max',
        //         'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
        //         'location' => 'New York',
        //         'created_at' => '2021-06-01 12:00:00'
        //     ],
        //     [
        //         'id' => 1,
        //         'image' => 'https://www.quickanddirtytips.com/wp-content/uploads/2022/05/ezgif.com-gif-maker-3.jpg',
        //         'title' => 'Nike Air Max',
        //         'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
        //         'location' => 'New York',
        //         'created_at' => '2021-06-01 12:00:00'
        //     ],
        //     [
        //         'id' => 2,
        //         'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQ2RPWHdT7Y-WW2EJMGg3NoJZRjwWol4ACNBHaBd0_biMz5J7QFku9RPy0XxPyFp8CQvk&usqp=CAU',
        //         'title' => 'Nike Air Max',
        //         'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
        //         'location' => 'New York',
        //         'created_at' => '2021-06-01 12:00:00'
        //     ],
        //     [
        //         'id' => 3,
        //         'image' => 'https://freesociety.in/cdn/shop/files/1245160_01_jpg_1024x1024.webp?v=1699701942',
        //         'title' => 'Nike Air Max',
        //         'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
        //         'location' => 'New York',
        //         'created_at' => '2021-06-01 12:00:00'
        //     ],
        //     [
        //         'id' => 4,
        //         'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZzebeG2Na4e9e6J7OvgJubOvAliPZHdu3kA4Y1UrZyP9WCJMDJsLp_GBMcTLa91uYY-A&usqp=CAU',
        //         'title' => 'Nike Air Max',
        //         'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
        //         'location' => 'New York',
        //         'created_at' => '2021-06-01 12:00:00'
        //     ],
        //     [
        //         'id' => 8,
        //         'image' => 'https://i.pinimg.com/236x/f9/07/32/f90732b39cc961518e2165b9e83f0411.jpg',
        //         'title' => 'Nike Air Max',
        //         'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
        //         'location' => 'New York',
        //         'created_at' => '2021-06-01 12:00:00'
        //     ],
        //     [
        //         'id' => 5,
        //         'image' => 'https://freesociety.in/cdn/shop/files/1245160_01_jpg_1024x1024.webp?v=1699701942',
        //         'title' => 'Nike Air Max',
        //         'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
        //         'location' => 'New York',
        //         'created_at' => '2021-06-01 12:00:00'
        //     ],
        //     [
        //         'id' => 6,
        //         'image' => 'https://freesociety.in/cdn/shop/files/1245160_01_jpg_1024x1024.webp?v=1699701942',
        //         'title' => 'Nike Air Max',
        //         'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
        //         'location' => 'New York',
        //         'created_at' => '2021-06-01 12:00:00'
        //     ],
        //     [
        //         'id' => 7,
        //         'image' => 'https://i.pinimg.com/236x/f9/07/32/f90732b39cc961518e2165b9e83f0411.jpg',
        //         'title' => 'Nike Air Max',
        //         'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
        //         'location' => 'New York',
        //         'created_at' => '2021-06-01 12:00:00'
        //     ],
        //     [
        //         'id' => 6,
        //         'image' => 'https://freesociety.in/cdn/shop/files/1245160_01_jpg_1024x1024.webp?v=1699701942',
        //         'title' => 'Nike Air Max',
        //         'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
        //         'location' => 'New York',
        //         'created_at' => '2021-06-01 12:00:00'
        //     ],
        // ];

        if($slug) {
            $category = Category::where('slug', $slug)->first();
            $feeds = Post::where('category_id', $category->id)->paginate(20);
        } else {
            $feeds = Post::paginate(20);
        }

        return view('feed.index2', compact('categories', 'feeds'));
    }
}
