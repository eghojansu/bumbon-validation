<?php

namespace Bumbon\Validation\Test\Constraint;

use DB;
use MyTestCase;
use Bumbon\Validation\Constraint\NotInTable;

class NotInTableTest extends MyTestCase
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
        $constraint = new NotInTable([
            'pdo' => DB::pdo(),
            'table' => 'test',
            'field' => 'col_1',
            'id' => 'col_1',
        ]);

        $this->assertTrue($constraint->validate()->isValid());
        $this->assertFalse($constraint->setValue(1)->validate()->isValid());
        $this->assertFalse($constraint->setValue(2)->validate()->isValid());
        $this->assertFalse($constraint->setValue(3)->validate()->isValid());
        $this->assertFalse($constraint->setValue(4)->validate()->isValid());
        $this->assertFalse($constraint->setValue(5)->validate()->isValid());
        $this->assertTrue($constraint->setValue(6)->validate()->isValid());
    }

    public function testValidate2()
    {
        $constraint = new NotInTable([
            'pdo' => DB::pdo(),
            'table' => 'test',
            'field' => 'col_1',
            'id' => 'col_1',
            'current_id' => 1,
        ]);

        $this->assertTrue($constraint->validate()->isValid());
        $this->assertTrue($constraint->setValue(1)->validate()->isValid());
        $this->assertFalse($constraint->setValue(2)->validate()->isValid());
        $this->assertFalse($constraint->setValue(3)->validate()->isValid());
        $this->assertFalse($constraint->setValue(4)->validate()->isValid());
    }

    public function testValidate3()
    {
        $constraint = new NotInTable([
            'pdo' => DB::pdo(),
            'table' => 'test',
            'field' => 'col_3',
            'id' => 'col_1',
            'current_id' => 1,
        ]);

        $this->assertTrue($constraint->validate()->isValid());
        $this->assertTrue($constraint->setValue('row 1 col 3')->validate()->isValid());
        $this->assertFalse($constraint->setValue('row 2 col 3')->validate()->isValid());
    }

    public function testValidate4()
    {
        $constraint = new NotInTable([
            'pdo' => DB::pdo(),
            'table' => 'test',
            'field' => 'col_3',
            'id' => ['col_1','col_2'],
            'current_id' => [1, 'row 1 col 2'],
        ]);

        $this->assertTrue($constraint->validate()->isValid());
        $this->assertTrue($constraint->setValue('row 1 col 3')->validate()->isValid());
        $this->assertFalse($constraint->setValue('row 2 col 3')->validate()->isValid());
    }
}
