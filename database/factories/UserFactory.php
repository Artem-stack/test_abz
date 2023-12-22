<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        $phonePrefixes = ['050', '063', '066', '095', '096'];
        $phoneNumber = '+38' . $phonePrefixes[array_rand($phonePrefixes)] . $this->faker->unique()->numerify('#######');

        $imageUrl = "https://i.pravatar.cc/300?u=" . Str::random(10);
        $imageContent = file_get_contents($imageUrl);

        $imagePath = 'images/users/' . Str::random(10) . '.jpg';
        Storage::disk('public')->put($imagePath, $imageContent);

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $phoneNumber,
            'position_id' => $this->faker->numberBetween(1, 7),
            'token' => Str::random(32),
            'photo' => $imagePath,
        ];
    }
}