// namespace Database\Factories;

// use Illuminate\Database\Eloquent\Factories\Factory;
// use Illuminate\Process\FakeProcessResult;


// database/factories/CommentFactory.php
/**
* @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
    */
    // class CommentFactory extends Factory
    // {
    // /**
    // * Define the model's default state.
    // *
    // * @return array<string, mixed>
        // */
        // public function definition(): array
        // {
        // return [
        // 'content' => fake()->text
        // ];
        // }
        // }
        <?php

        namespace Database\Factories;

        use Illuminate\Database\Eloquent\Factories\Factory;
        use App\Models\Comment;

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
             * @return array<string, mixed>
             */
            public function definition(): array
            {
                return [
                    'content' => $this->faker->text
                ];
            }
        }
