<?php

namespace Bumbon\Validation\Test\Constraint;

use MyTestCase;
use Bumbon\Validation\Constraint\LessThanEqual;

class LessThanEqualTest extends MyTestCase
{
    public function testValidate()
    {
        $constraint = new LessThanEqual([
            'value' => 3,
        ]);

        $this->assertTrue($constraint->validate()->isValid());
        $this->assertTrue($constraint->setValue(2)->validate()->isValid());
        $this->assertTrue($constraint->setValue(3)->validate()->isValid());
        $this->assertFalse($constraint->setValue(4)->validate()->isValid());
    }
}
