<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Submission;

class SubmissionTest extends TestCase
{
    /**
     * Test if the Submission model can be instantiated.
     */
    public function testCanInstantiateSubmissionModel()
    {
        $submission = new Submission();
        $this->assertInstanceOf(Submission::class, $submission);
    }

    /**
     * Test if the Submission model has the correct fillable attributes.
     */
    public function testSubmissionModelHasFillableAttributes()
    {
        $submission = new Submission();
        $fillable = ['name', 'email', 'message'];
        $this->assertEquals($fillable, $submission->getFillable());
    }
}
