<?php

namespace pschocke\FeedbackModal\Tests;

use Livewire\Livewire;
use pschocke\FeedbackModal\AnonymousFeedback;
use pschocke\FeedbackModal\FeedbackModalComponent;

class FeedbackComponentTest extends TestCase
{
    /** @test */
    public function a_user_can_submit_feedback()
    {
        Livewire::test(FeedbackModalComponent::class)
            ->set('type', 'like')
            ->set('feedback', 'Test')
            ->set('email', 'test@example.com')
            ->set('data_protection', 'true')
            ->call('send')
            ->assertEmitted('change-send')
            ->assertHasNoErrors();

        $this->assertCount(1, AnonymousFeedback::all());
        $this->assertDatabaseHas('anonymous_feedback', ['feedback' => 'Test']);
    }

    /** @test */
    public function a_user_needs_to_specify_a_type()
    {
        Livewire::test(FeedbackModalComponent::class)
            ->set('feedback', 'Test')
            ->set('email', 'test@example.com')
            ->set('data_protection', 'true')
            ->call('send')
            ->assertHasErrors('type');
    }

    /** @test */
    public function a_user_needs_to_accept_the_data_protection()
    {
        Livewire::test(FeedbackModalComponent::class)
            ->set('type', 'like')
            ->set('feedback', 'Test')
            ->set('email', 'test@example.com')
            ->call('send')
            ->assertHasErrors('data_protection');
    }

    /** @test */
    public function a_user_needs_to_type_feedback()
    {
        Livewire::test(FeedbackModalComponent::class)
            ->set('type', 'like')
            ->set('email', 'test@example.com')
            ->set('data_protection', 'true')
            ->call('send')
            ->assertHasErrors('feedback');
    }
}
