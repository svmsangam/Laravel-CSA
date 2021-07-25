<?php

namespace Database\Factories;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Posts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'title'=>$this->faker->sentence(rand(3,7)),
            'body'=>$this->faker->paragraphs(rand(3,7),true),
            'images'=>$this->faker->image('public/images',640,480,null,false),
            'views'=>rand(0,10),  
            'reply_count'=>rand(0,10),
            'user_id'=>User::all()->random()->id
        ];
    }
}
