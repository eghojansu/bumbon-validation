<?php

namespace Bumbon\Validation\Test;

use MyTestCase;
use Bumbon\Validation\Constraint\NotBlank;
use Bumbon\Validation\Validation;
use Bumbon\Validation\ViolationList;

class ValidationTest extends MyTestCase
{
    public function testCreate()
    {
        $validator = Validation::create([
            'username' => new NotBlank(),
        ]);

        $this->assertCount(1, $validator->getConstraints());
        $this->assertFalse($validator->validate(['username'=>'not blank'])->hasViolation());
        $this->assertTrue($validator->validate(['username'=>''])->hasViolation());
    }

    public function testAdd()
    {
        $validator = new Validation();

        $this->assertCount(0, $validator->getConstraints());

        $validator->add('username', new NotBlank());

        $this->assertCount(1, $validator->getConstraints());
    }

    public function testValidate()
    {
        $validator = new Validation([
            'username' => new NotBlank(),
        ], [
            'username' => 'not blank'
        ]);
        $violations = $validator->validate();

        $this->assertInstanceOf(ViolationList::class, $violations);
        $this->assertFalse($violations->hasViolation());

        $violations = $validator->validate([
            'username' => 'not blank  '
        ]);

        $this->assertInstanceOf(ViolationList::class, $violations);
        $this->assertFalse($violations->hasViolation());
        $this->assertEquals(['username'=>'not blank'], $validator->getData());


        $validator = new Validation([
            'username' => new NotBlank([
                'normalizer' => function($data) { return $data.'-transformed'; }
            ]),
        ], [
            'username' => 'not blank'
        ]);
        $violations = $validator->validate();

        $this->assertInstanceOf(ViolationList::class, $violations);
        $this->assertFalse($violations->hasViolation());
        $this->assertEquals(['username'=>'not blank-transformed'], $validator->getData());
    }

    public function testValidate2()
    {
        $validator = new Validation([
            'username' => new NotBlank(),
            'other' => new NotBlank(),
        ], [
            'username' => '',
            'other' => 'oo',
        ]);
        $violations = $validator->validate();

        $this->assertTrue($violations->hasViolation());
        $this->assertEquals([
            'username' => ['Nilai ini tidak boleh kosong.']
        ], $violations->all());


        $violations = $validator->validate([]);

        $this->assertTrue($violations->hasViolation());
        $this->assertEquals([
            'username' => ['Nilai ini tidak boleh kosong.'],
            'other' => ['Nilai ini tidak boleh kosong.']
        ], $violations->all());
    }

    public function testAfter()
    {
        $validator = new Validation([
            'username' => new NotBlank(),
        ], [
            'username' => 'not blank'
        ]);
        $validator->after(function($data, $violations) {
            $data['username'] = 'username';

            return $data;
        });
        $violations = $validator->validate();

        $this->assertInstanceOf(ViolationList::class, $violations);
        $this->assertEquals(['username'=>'username'], $validator->getData());
    }

    public function testGetConstraints()
    {
        $validator = new Validation([], []);

        $this->assertCount(0, $validator->getConstraints());

        $validator->add('username', new NotBlank());

        $this->assertCount(1, $validator->getConstraints());
    }

    public function testGetData()
    {
        $validator = new Validation([
            'username' => new NotBlank(),
        ], [
            'username' => 'not blank'
        ]);
        $violations = $validator->validate();

        $this->assertInstanceOf(ViolationList::class, $violations);
        $this->assertEquals(['username'=>'not blank'], $validator->getData());
    }
}
