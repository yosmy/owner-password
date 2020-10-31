<?php

namespace Yosmy;

use Yosmy;
use Traversable;

/**
 * @di\service()
 */
class AuditMissingPasswords
{
    /**
     * @var ManagePasswordCollection
     */
    private $managePasswordCollection;

    /**
     * @param ManagePasswordCollection $managePasswordCollection
     */
    public function __construct(
        ManagePasswordCollection $managePasswordCollection
    ) {
        $this->managePasswordCollection = $managePasswordCollection;
    }

    /**
     * @param Yosmy\Mongo\ManageCollection $manageCollection
     *
     * @return Traversable
     */
    public function audit(
        Yosmy\Mongo\ManageCollection $manageCollection
    ): Traversable
    {
        return $manageCollection->aggregate(
            [
                [
                    '$lookup' => [
                        'localField' => '_id',
                        'from' => $this->managePasswordCollection->getName(),
                        'as' => 'passwords',
                        'foreignField' => '_id',
                    ]
                ],
                [
                    '$match' => [
                        'passwords._id' => [
                            '$exists' => false
                        ]
                    ],
                ]
            ]
        );
    }
}