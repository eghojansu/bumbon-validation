<?php

namespace Bumbon\Validation\Test\Constraint;

use MyTestCase;
use Bumbon\Validation\Constraint\Email;

class EmailTest extends MyTestCase
{
    public function testValidate()
    {
        $constraint = new Email();

        $this->assertTrue($constraint->validate()->isValid());
        $this->assertTrue($constraint->setValue('email@email.com')->validate()->isValid());
        $this->assertTrue($constraint->setValue('valid@email.com')->validate()->isValid());
        $this->assertFalse($constraint->setValue('notemaild')->validate()->isValid());
        $this->assertFalse($constraint->setValue('email.com')->validate()->isValid());
    }
}
