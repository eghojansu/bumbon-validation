<?php

namespace Bumbon\Validation\Constraint;

use InvalidArgumentException;
use PDO;

class NotInTable extends AbstractConstraint
{
    const MESSAGE_DEFAULT = 'Nilai ini sudah digunakan.';

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
            // primary key, can be array
            'id' => 'ID',
            // current primary key value, can be array
            'current_id' => null,
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
            throw new InvalidArgumentException('Constraint should have instance of PDO');
        }
        if (empty($this->option['table']) || empty($this->option['field'])) {
            throw new InvalidArgumentException('Table and field should not blank');
        }
        if (null !== $this->value) {
            $pks = (array) $this->option['id'];
            $pks_value = (array) $this->option['current_id'];

            $columns = implode(',', array_merge($pks, [$this->option['field']]));
            $sql = "SELECT $columns FROM {$this->option['table']}".
                   " WHERE {$this->option['field']} = ? LIMIT 1";
            $query = $this->option['pdo']->prepare($sql);
            $query->execute([$this->value]);
            $result = $query->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                if ($pks_value) {
                    $this->valid = count(array_intersect($pks_value, $result)) === count($pks_value);
                } else {
                    $this->valid = false;
                }
            } else {
                $this->valid = true;
            }
        }

        return $this;
    }
}
