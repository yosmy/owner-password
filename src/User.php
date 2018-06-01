<?php

namespace Yosmy\Password;

use MongoDB\Model\BSONDocument;

/**
 * @author Yosmany Garcia <yosmanyga@gmail.com>
 */
class User extends BSONDocument
{
    /**
     * @return string
     */
    public function getId()
    {
        return $this->offsetGet('id');
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->offsetGet('salt');
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->offsetGet('password');
    }

    /**
     * {@inheritdoc}
     */
    public function bsonUnserialize(array $data)
    {
        $data['id'] = $data['_id'];
        unset($data['_id']);

        parent::bsonUnserialize($data);
    }
}
