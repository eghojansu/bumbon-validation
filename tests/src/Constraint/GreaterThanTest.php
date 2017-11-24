<?php

namespace Bumbon\Validation\Test\Constraint;

use MyTestCase;
use Bumbon\Validation\Constraint\GreaterThan;

class GreaterThanTest extends MyTestCase
{
    public function testValidate()
    {
        $constraint = new GreaterThan([
            'value' => 3,
        ]);

        $this->assertTrue($constraint->validate()->isValid());
        $this->assertTrue($constraint->setValue(4)->validate()->isValid());
        $this->assertFalse($constraint->setValue(3)->validate()->isValid());
        $this->assertFalse($constraint->setValue(2)->validate()->isValid());
    }
}
