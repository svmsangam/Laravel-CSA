<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Posts;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'body'=>$this->faker->sentence(rand(3,7)),
            'user_id'=>User::all()->random()->id,
            'posts_id'=>'31'
        ];
    }
}
