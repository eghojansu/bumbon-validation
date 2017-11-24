<?php

namespace Bumbon\Validation\Constraint;

use InvalidArgumentException;
use PDO;

class InTable extends AbstractConstraint
{
    const MESSAGE_DEFAULT = 'Nilai ini tidak ada.';

    public function __construct(array $option = [])
    {
        parent::__construct($option);

        $this->option += [
            // pdo connection
            'pdo' => null,
            // table to lookup
            'table' => null,
            // field to find
            'field' => 'ID',
        ];
    }

    /**
     * {@inheritdoc}
    */
    public function validate()
    {
        if (null === $this->option['pdo']
            || !is_a($this->option['pdo'], PDO::class)
        ) {
            throw new InvalidArgumentException('Constraint should has instance of PDO');
        }
        if (empty($this->option['table']) || empty($this->option['field'])) {
            throw new InvalidArgumentException('Table and field should not blank');
        }
        if (null !== $this->value) {
            $sql = "SELECT {$this->option['field']} FROM {$this->option['table']}".
                   " WHERE {$this->option['field']} = ? LIMIT 1";
            $query = $this->option['pdo']->prepare($sql);
            $query->execute([$this->value]);
            $result = $query->fetch(PDO::FETCH_ASSOC);

            $this->valid = $result ? true : false;
        }

        return $this;
    }
}
