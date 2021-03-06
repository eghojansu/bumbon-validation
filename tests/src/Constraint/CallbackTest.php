<?php

namespace Bumbon\Validation\Test\Constraint;

use MyTestCase;
use Bumbon\Validation\Constraint\Callback;

class CallbackTest extends MyTestCase
{
    public function testValidate()
    {
        $constraint = new Callback([
            'callback' => function($value) {
                return $value === 'value';
            }
        ]);

        $this->assertTrue($constraint->validate()->isValid());
        $this->assertTrue($constraint->setValue('value')->validate()->isValid());
        $this->assertFalse($constraint->setValue('on')->validate()->isValid());
    }
}
