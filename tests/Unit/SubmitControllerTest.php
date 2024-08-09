<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Jobs\ProcessSubmission;
use Illuminate\Support\Facades\Queue;

class SubmitControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test] public function it_submits_data_successfully()
    {
        Queue::fake();

        $response = $this->postJson('/api/submit', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.'
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Data submitted successfully'
            ]);

        Queue::assertPushed(ProcessSubmission::class, function ($job) {
            $job->handle();
            return true;
        });

        $this->assertDatabaseHas('submissions', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.'
        ]);
    }

    #[Test] public function it_returns_validation_errors_for_missing_fields()
    {
        $response = $this->postJson('/api/submit');

        $response->assertStatus(400)
            ->assertJsonValidationErrors(['name', 'email', 'message']);
    }
}
