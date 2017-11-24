<?php

namespace Bumbon\Validation\Test\Constraint;

use MyTestCase;
use Bumbon\Validation\Constraint\Numeric;

class NumericTest extends MyTestCase
{
    public function testValidate()
    {
        $constraint = new Numeric([
            'max' => 10,
            'min' => 3
        ]);

        $this->assertTrue($constraint->setValue(3)->validate()->isValid());
        $this->assertTrue($constraint->setValue(4)->validate()->isValid());
        $this->assertTrue($constraint->setValue(10)->validate()->isValid());
        $this->assertFalse($constraint->setValue(11)->validate()->isValid());
        $this->assertFalse($constraint->setValue(2)->validate()->isValid());
    }
}
