<?php

namespace Bumbon\Validation\Test\Constraint;

use MyTestCase;
use Bumbon\Validation\Constraint\Regex;

class RegexTest extends MyTestCase
{
    public function testValidate()
    {
        $constraint = new Regex(['pattern'=>'/^beginofthis/']);

        $this->assertTrue($constraint->validate()->isValid());
        $this->assertTrue($constraint->setValue('beginofthis oke')->validate()->isValid());
        $this->assertFalse($constraint->setValue('http:/example.com')->validate()->isValid());
    }
}
