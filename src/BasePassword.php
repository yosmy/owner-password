<?php

namespace Yosmy;

use Yosmy\Mongo;

class BasePassword extends Mongo\Document implements Password
{
    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->offsetGet('_id');
    }

    /**
     * @return string
     */
    public function getSalt(): string
    {
        return $this->offsetGet('salt');
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->offsetGet('value');
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize(): object
    {
        $data = parent::jsonSerialize();

        $data->user = $data->_id;

        unset($data->_id);

        return $data;
    }
}
