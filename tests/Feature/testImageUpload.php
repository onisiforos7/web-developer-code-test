<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class testImageUpload extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testImageUpload()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->json('POST', '/store', [
            'attachment' => $file,
        ]);

        $filename = time().$file->getClientOriginalName();

        // Assert the file was stored...
        Storage::disk('public')->assertExists('attachments/'.$filename);


    }
}
