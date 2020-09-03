<?php

namespace pschocke\FeedbackModal\Tests;

use pschocke\FeedbackModal\AnonymousFeedback;

class AnonymousFeedbackTest extends TestCase
{
    /** @test */
    public function the_database_was_created()
    {
        factory(AnonymousFeedback::class)->create();

        $this->assertCount(1, AnonymousFeedback::all());
    }
}
