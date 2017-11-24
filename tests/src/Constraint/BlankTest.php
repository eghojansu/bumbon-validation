<?php

namespace Bumbon\Validation\Test\Constraint;

use MyTestCase;
use Bumbon\Validation\Constraint\Blank;

class BlankTest extends MyTestCase
{
    public function testValidate()
    {
        $constraint = new Blank();

        $this->assertTrue($constraint->validate()->isValid());
        $constraint->setValue('not blank');
        $this->assertFalse($constraint->validate()->isValid());
    }
}
