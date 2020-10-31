<?php

namespace Yosmy\Password;

use Symsonte\Security;
use Yosmy;

/**
 * @di\service()
 */
class AssertValue
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
     * @var Security\ConstantTimeEqAsserter
     */
    private $eqAsserter;

    /**
     * @param Yosmy\ManagePasswordCollection  $manageCollection
     * @param Security\HashEncoder            $encoder
     * @param Security\ConstantTimeEqAsserter $eqAsserter
     */
    public function __construct(
        Yosmy\ManagePasswordCollection $manageCollection,
        Security\HashEncoder $encoder,
        Security\ConstantTimeEqAsserter $eqAsserter
    ) {
        $this->manageCollection = $manageCollection;
        $this->encoder = $encoder;
        $this->eqAsserter = $eqAsserter;
    }

    /**
     * @param string $user
     * @param string $plain
     *
     * @return bool
     */
    public function assert(
        string $user,
        string $plain
    ): bool {
        /** @var Yosmy\Password $password */
        $password = $this->manageCollection->findOne([
            '_id' => $user
        ]);

        return $this->eqAsserter->assert(
            $this->encoder->encode($plain, $password->getSalt()),
            $password->getValue()
        );
    }
}