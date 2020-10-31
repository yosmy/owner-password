<?php

namespace Yosmy\Password;

use Symsonte\Security;
use Yosmy;

/**
 * @di\service()
 */
class UpdateValue
{
    /**
     * @var Yosmy\ManagePasswordCollection
     */
    private $manageCollection;

    /**
     * @var Security\HashEncoder
     */
    private $encoder;

    /**
     * @param Yosmy\ManagePasswordCollection $manageCollection
     * @param Security\HashEncoder           $encoder
     */
    public function __construct(
        Yosmy\ManagePasswordCollection $manageCollection,
        Security\HashEncoder $encoder
    ) {
        $this->manageCollection = $manageCollection;
        $this->encoder = $encoder;
    }

    /**
     * @param string $user
     * @param string $plain
     */
    public function update(
        string $user,
        string $plain
    ) {
        /** @var Yosmy\Password $password */
        $password = $this->manageCollection->findOne([
            '_id' => $user,
        ]);

        $value = $this->encoder->encode(
            $plain,
            $password->getSalt()
        );

        $this->manageCollection->updateOne(
            [
                '_id' => $user
            ],
            [
                '$set' => [
                    'value' => $value
                ]
            ]
        );
    }
}
