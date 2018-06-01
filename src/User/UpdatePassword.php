<?php

namespace Yosmy\Password\User;

use Symsonte\Security;
use Yosmy\Password\ManageUserCollection;
use Yosmy\Password\User;

/**
 * @di\service()
 */
class UpdatePassword
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
     * @param string $plain
     */
    public function update(
        string $id,
        string $plain
    ) {
        /** @var User $user */
        $user = $this->manageCollection->findOne([
            '_id' => $id,
        ]);

        $password = $this->encoder->encode($plain, $user->getSalt());

        $this->manageCollection->updateOne(
            [
                '_id' => $id
            ],
            [
                '$set' => [
                    'password' => $password
                ]
            ]
        );
    }
}
