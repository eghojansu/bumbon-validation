<?php

namespace Bumbon\Validation\Test\Constraint;

use MyTestCase;
use Bumbon\Validation\Constraint\IsFalse;

class IsFalseTest extends MyTestCase
{
    public function testValidate()
    {
        $constraint = new IsFalse();

        $this->assertTrue($constraint->validate()->isValid());
        $this->assertFalse($constraint->setValue('1')->validate()->isValid());
        $this->assertFalse($constraint->setValue('on')->validate()->isValid());
        $this->assertFalse($constraint->setValue('true')->validate()->isValid());
        $this->assertFalse($constraint->setValue(true)->validate()->isValid());
        $this->assertTrue($constraint->setValue('0')->validate()->isValid());
        $this->assertTrue($constraint->setValue(false)->validate()->isValid());
    }
}
