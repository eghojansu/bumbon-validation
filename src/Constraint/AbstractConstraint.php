<?php

namespace Bumbon\Validation\Constraint;

abstract class AbstractConstraint implements ConstraintInterface
{
    const MESSAGE_DEFAULT = 'Nilai ini tidak valid';

    /** @var boolean */
    protected $valid = true;

    /** @var mixed */
    protected $value;

    /** @var array */
    protected $option;


    /**
     * Class constructor
     * @param array $option
     */
    public function __construct(array $option = null)
    {
        $this->option = ((array) $option) + [
            // message
            'message' => static::MESSAGE_DEFAULT,
            // group validate
            'groups' => ['Default'],
            // trim value
            'trim' => true,
            // callback for normalize data (before validate)
            'normalizer' => null,
        ];
    }

    /**
     * {@inheritdoc}
    */
    public function getMessages()
    {
        return $this->option['message'];
    }

    /**
     * {@inheritdoc}
    */
    public function getGroups()
    {
        return $this->option['groups'];
    }

    /**
     * {@inheritdoc}
    */
    public function setValue($value)
    {
        if ($this->option['trim'] && is_string($value)) {
            $value = trim($value);
        }
        if ($this->option['normalizer']) {
            $value = call_user_func_array($this->option['normalizer'], [$value]);
        }
        $this->value = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
    */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
    */
    public function isValid()
    {
        return $this->valid;
    }

    /**
     * {@inheritdoc}
    */
    abstract public function validate();
}
