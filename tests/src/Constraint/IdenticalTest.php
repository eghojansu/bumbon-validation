<?php

namespace Bumbon\Validation\Test\Constraint;

use MyTestCase;
use Bumbon\Validation\Constraint\Identical;

class IdenticalTest extends MyTestCase
{
    public function testValidate()
    {
        $constraint = new Identical([
            'value' => 'this',
        ]);

        $this->assertTrue($constraint->validate()->isValid());
        $this->assertTrue($constraint->setValue('this')->validate()->isValid());
        $this->assertFalse($constraint->setValue('that')->validate()->isValid());
    }
}
