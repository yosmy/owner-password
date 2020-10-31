<?php

namespace Yosmy;

use Yosmy;
use Traversable;

/**
 * @di\service()
 */
class AuditExtraPasswords
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
        return $this->managePasswordCollection->aggregate(
            [
                [
                    '$lookup' => [
                        'localField' => '_id',
                        'from' => $manageCollection->getName(),
                        'as' => 'parent',
                        'foreignField' => '_id',
                    ]
                ],
                [
                    '$match' => [
                        'parent._id' => [
                            '$exists' => false
                        ]
                    ],
                ]
            ]
        );
    }
}