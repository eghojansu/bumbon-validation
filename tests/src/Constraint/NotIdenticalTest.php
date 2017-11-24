<?php

namespace Bumbon\Validation\Test\Constraint;

use MyTestCase;
use Bumbon\Validation\Constraint\NotIdentical;

class NotIdenticalTest extends MyTestCase
{
    public function testValidate()
    {
        $constraint = new NotIdentical([
            'value' => 'this',
        ]);

        $this->assertTrue($constraint->validate()->isValid());
        $this->assertFalse($constraint->setValue('this')->validate()->isValid());
        $this->assertTrue($constraint->setValue('that')->validate()->isValid());
    }
}
