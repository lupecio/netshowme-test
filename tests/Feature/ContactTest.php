<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ContactTest extends TestCase
{
    use WithFaker, DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShouldSendContact()
    {
        $response = $this->json('POST', '/api/contacts', [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => '62992264519',
            'message' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'file' => UploadedFile::fake()->create('123.pdf', 500)
        ]);

        $responseJson = json_decode($response->getContent());

        Storage::disk('local')->assertExists($responseJson->data->url);

        $response->assertStatus(201)
                ->assertJsonStructure([
                    'data' => [
                        'id',
                        'name',
                        'email',
                        'phone',
                        'message',
                        'url'
                    ]
                ]);
    }

    public function testShouldReturnEmptyValues()
    {
        $response = $this->json('POST', '/api/contacts', [
            'name' => $this->faker->name,
            'phone' => '62992264519',
            'message' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'file' => UploadedFile::fake()->create('123.pdf', 500)
        ]);

        $response->assertStatus(422)
                 ->assertJsonStructure([
                    'message'
                ]);
    }

    public function testShouldReturnPhoneFormatInvalid()
    {
        $response = $this->json('POST', '/api/contacts', [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => '6299226451',
            'message' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'file' => UploadedFile::fake()->create('123.pdf', 500)
        ]);

        $response->assertStatus(422)
                 ->assertJsonStructure([
                    'message'
                ]);
    }

    public function testShouldReturnEmailFormatInvalid()
    {
        $response = $this->json('POST', '/api/contacts', [
            'name' => $this->faker->name,
            'email' => 'lucas@',
            'phone' => '6299226451',
            'message' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'file' => UploadedFile::fake()->create('123.pdf', 500)
        ]);

        $response->assertStatus(422)
                 ->assertJsonStructure([
                    'message'
                ]);
    }
}
