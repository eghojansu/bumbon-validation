<?php

namespace Bumbon\Validation\Test\Constraint;

use MyTestCase;
use Bumbon\Validation\Constraint\InTable;
use DB;

class InTableTest extends MyTestCase
{
    protected function setUp()
    {
        DB::deleteData();
        DB::insertData();
    }

    protected function tearDown()
    {
        DB::deleteData();
    }

    public function testValidate()
    {
        $constraint = new InTable([
            'pdo' => DB::pdo(),
            'table' => 'test',
            'field' => 'col_1'
        ]);

        $this->assertTrue($constraint->validate()->isValid());
        $this->assertTrue($constraint->setValue(1)->validate()->isValid());
        $this->assertTrue($constraint->setValue(2)->validate()->isValid());
        $this->assertTrue($constraint->setValue(3)->validate()->isValid());
        $this->assertTrue($constraint->setValue(4)->validate()->isValid());
        $this->assertTrue($constraint->setValue(5)->validate()->isValid());
        $this->assertFalse($constraint->setValue(6)->validate()->isValid());

        $constraint = new InTable([
            'pdo' => DB::pdo(),
            'table' => 'test',
            'field' => 'col_2'
        ]);

        $this->assertTrue($constraint->validate()->isValid());
        $this->assertTrue($constraint->setValue('row 1 col 2')->validate()->isValid());
        $this->assertTrue($constraint->setValue('row 2 col 2')->validate()->isValid());
        $this->assertTrue($constraint->setValue('row 3 col 2')->validate()->isValid());
        $this->assertTrue($constraint->setValue('row 4 col 2')->validate()->isValid());
        $this->assertTrue($constraint->setValue('row 5 col 2')->validate()->isValid());
        $this->assertFalse($constraint->setValue('row 6 col 2')->validate()->isValid());
    }
}
