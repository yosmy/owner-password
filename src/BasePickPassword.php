<?php

namespace Yosmy;

/**
 * @di\service()
 */
class BasePickPassword implements PickPassword
{
    /**
     * @var ManagePasswordCollection
     */
    private $manageCollection;

    /**
     * @param ManagePasswordCollection $manageCollection
     */
    public function __construct(ManagePasswordCollection $manageCollection)
    {
        $this->manageCollection = $manageCollection;
    }

    /**
     * @param string $user
     *
     * @return Password
     *
     * @throws NonexistentPasswordException
     */
    public function pick(
        string $user
    ): Password {
        /** @var Password $password */
        $password = $this->manageCollection->findOne([
            '_id' => $user
        ]);

        if (!$password) {
            throw new BaseNonexistentPasswordException();
        }

        return $password;
    }
}
