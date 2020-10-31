<?php

namespace Yosmy;

use Symsonte\Security;

/**
 * @di\service()
 */
class BaseAddPassword implements AddPassword
{
    /**
     * @var ManagePasswordCollection
     */
    private $manageCollection;

    /**
     * @var Security\HashEncoder
     */
    private $encoder;

    /**
     * @param ManagePasswordCollection $manageCollection
     * @param Security\HashEncoder     $encoder
     */
    public function __construct(
        ManagePasswordCollection $manageCollection,
        Security\HashEncoder $encoder
    ) {
        $this->manageCollection = $manageCollection;
        $this->encoder = $encoder;
    }

    /**
     * @param string $user
     * @param string $value
     */
    public function add(
        string $user,
        string $value
    ) {
        $salt = uniqid('salt-', true);

        $value = $this->encoder->encode(
            $value,
            $salt
        );

        $this->manageCollection->insertOne([
            '_id' => $user,
            'salt' => $salt,
            'value' => $value
        ]);
    }
}