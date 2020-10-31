<?php

namespace Yosmy\Password\User;

use Symsonte\Security;
use Yosmy\Password\ManageUserCollection;
use Yosmy\Password\User;

/**
 * @di\service()
 */
class AssertPassword
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
     * @var Security\ConstantTimeEqAsserter
     */
    private $eqAsserter;

    /**
     * @param ManageUserCollection            $manageCollection
     * @param Security\HashEncoder            $encoder
     * @param Security\ConstantTimeEqAsserter $eqAsserter
     */
    public function __construct(
        ManageUserCollection $manageCollection,
        Security\HashEncoder $encoder,
        Security\ConstantTimeEqAsserter $eqAsserter
    ) {
        $this->manageCollection = $manageCollection;
        $this->encoder = $encoder;
        $this->eqAsserter = $eqAsserter;
    }

    /**
     * @param string $id
     * @param string $plain
     *
     * @return bool
     */
    public function assert(
        string $id,
        string $plain
    ) {
        /** @var User $user */
        $user = $this->manageCollection->findOne([
            '_id' => $id
        ]);

        return $this->eqAsserter->assert(
            $this->encoder->encode($plain, $user->getSalt()),
            $user->getPassword()
        );
    }
}