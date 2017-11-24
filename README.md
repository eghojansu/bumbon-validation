# Bumbon/Validation

PHP Validation.

## Installation

```
composer require bumbon/validation
```

## Usage

```php
<?php

$validation = Validation::create(
    [
        'foo' => NotBlank(),
        'baz' => [
            new NotBlank(),
            new Length([
                'min' => 5,
            ])
        ],
    ],
    [
        'foo' => 'bar',
        'baz' => 'qux'
    ]
);
$violation = $validation->validate();

// or
// $validation->validate(['foo' => 'bar','baz' => 'qux']);

if ($violation->hasViolation()) {
    echo 'Invalid data';
} else {
    echo 'Data valid';
}

// or
if ($violation->noViolation()) {
    echo 'Data valid';
} else {
    echo 'Invalid data';
}

// get violation message
var_dump($violation->all());

// [
//   'foo' => ['Nilai ini tidak boleh kosong']
// ]

```

## Available Constraints

All option can be passed in each constraint via associative array.
All constraint has parent option. Default message is Bahasa Indonesia.

```php
<?php

// default parent option
$option = [
    // message
    'message' => 'Custom message',
    // group validate
    'groups' => ['Default'],
    // trim value
    'trim' => true,
    // callback for normalize data (before validate)
    'normalizer' => null,
];
```

- Between

  ```php
  <?php
  $option = [
    'min' => 5,
    'max' => 5,
  ];
  ```
- Blank
- Boolean
- Callback

  ```php
  <?php
  $option = [
    // callback (return bool)
    'callback' => null,
  ];
  ```
- Choice

  ```php
  <?php
  $option = [
    // array of valid choices
    'choices' => [],
  ];
  ```
- Email
- Equal

  ```php
  <?php
  $option = [
    // equal to this value
    'value' => null,
  ];
  ```
- GreaterThanEqual

  ```php
  <?php
  $option = [
    // greater than or equal to this value
    'value' => null,
  ];
  ```
- GreaterThan

  ```php
  <?php
  $option = [
    // greater than to this value
    'value' => null,
  ];
  ```
- Identical

  ```php
  <?php
  $option = [
    // identical to this value
    'value' => null,
  ];
  ```
- InTable

  ```php
  <?php
  $option = [
    // pdo connection
    'pdo' => null,
    // table to lookup
    'table' => null,
    // field to find
    'field' => 'ID',
  ];
  ```
- Ip
- IsFalse
- IsTrue
- Length

  ```php
  <?php
  $option = [
    'min' => 5,
    'max' => 5,
  ];
  ```
- LessThanEqual

  ```php
  <?php
  $option = [
    // lest than or equal to this value
    'value' => null,
  ];
  ```
- LessThan

  ```php
  <?php
  $option = [
    // less than to this value
    'value' => null,
  ];
  ```
- NotBlank
- NotEqual

  ```php
  <?php
  $option = [
    // not equal to this value
    'value' => null,
  ];
  ```
- NotIdentical

  ```php
  <?php
  $option = [
    // not identical to this value
    'value' => null,
  ];
  ```
- NotInTable

  ```php
  <?php
  $option = [
    // pdo connection
    'pdo' => null,
    // table to lookup
    'table' => null,
    // field to find
    'field' => 'ID',
    // primary key, can be array
    'id' => 'ID',
    // current primary key value, can be array
    'current_id' => null,
  ];
  ```
- Numeric
- PhoneNumber
- Regex

  ```php
  <?php
  $option = [
    // match to this pattern
    'pattern' => null,
  ];
  ```
- Url

## Custom Constraints

Implements Constraint Interface.
```php
<?php

namespace Bumbon\Validation\Constraint;

interface ConstraintInterface
{
    /**
     * Get violation message
     * @return array|string
     */
    public function getMessages();

    /**
     * Get groups
     * @return array
     */
    public function getGroups();

    /**
     * Set value to check
     * @param mixed $value
     * @return  $this
     */
    public function setValue($value);

    /**
     * Get value
     * @return  mixed
     */
    public function getValue();

    /**
     * Validate value
     * @return $this
     */
    public function validate();

    /**
     * Get constraint validity
     * @return boolean
     */
    public function isValid();
}

```

Or extends AbstractConstraint
```php
<?php

use Bumbon\Validation\Constraint;

class CustomConstraint extends AbstractContraint
{
    public function validate()
    {
        $this->valid = $this->value == 'true';

        return $this;
    }
}
```

## Inspiration

This library was inspired by Symfony/Validation. I created this for my own project.
