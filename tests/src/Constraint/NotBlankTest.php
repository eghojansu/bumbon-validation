<?php

namespace Bumbon\Validation\Test\Constraint;

use MyTestCase;
use Bumbon\Validation\Constraint\NotBlank;

class NotBlankTest extends MyTestCase
{
    public function testValidate()
    {
        $constraint = new NotBlank();

        $this->assertFalse($constraint->validate()->isValid());
        $this->assertTrue($constraint->setValue('not blank')->validate()->isValid());
    }
}
