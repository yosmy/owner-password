<?php

namespace Yosmy\Password;

use Symsonte\Security;

/**
 * @di\service()
 */
class AddUser
{
    /**
     * @var ManageUserCollection
     */
    private $manageCollection;

    /**
     * @var Security\HashEncoder
     */
    private $encoder;

    /**
     * @param ManageUserCollection $manageCollection
     * @param Security\HashEncoder $encoder
     */
    public function __construct(
        ManageUserCollection $manageCollection,
        Security\HashEncoder $encoder
    ) {
        $this->manageCollection = $manageCollection;
        $this->encoder = $encoder;
    }

    /**
     * @param string $id
     * @param string $password
     */
    public function add(
        string $id,
        string $password
    ) {
        $salt = uniqid('salt-', true);

        $password = $this->encoder->encode($password, $salt);

        $this->manageCollection->insertOne([
            '_id' => $id,
            'salt' => $salt,
            'password' => $password
        ]);
    }
}