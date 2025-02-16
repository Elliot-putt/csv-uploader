<?php

namespace Tests\Modules\Homeowner\Unit\Requests;

use App\Modules\Homeowner\Requests\HomeownerUploadRequest;
use Tests\TestCase;

class HomeownerUploadRequestTest extends TestCase {

    /** @test */
    public function it_should_validate_the_correct_validation_rules()
    {
        $this->assertExactValidationRules([
            'file' => ['required', 'file', 'mimes:csv']
        ], (new HomeownerUploadRequest())->rules());
    }
}
