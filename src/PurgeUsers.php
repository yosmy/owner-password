<?php

namespace Yosmy\Password;

/**
 * @di\service()
 */
class PurgeUsers
{
    /**
     * @var ManageUserCollection
     */
    private $selectCollection;

    /**
     * @param ManageUserCollection $selectCollection
     */
    public function __construct(
        ManageUserCollection $selectCollection
    )
    {
        $this->selectCollection = $selectCollection;
    }

    public function purge()
    {
        $this->selectCollection->drop([
            'typeMap' => [
                'root' => 'array'
            ]
        ]);
    }
}
