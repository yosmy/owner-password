<?php

namespace Yosmy;

/**
 * @di\service()
 */
class BaseCollectPasswords implements CollectPasswords
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
     * @return Passwords
     */
    public function collect(): Passwords
    {
        $collection = $this->manageCollection->find();

        return new Passwords($collection);
    }
}
