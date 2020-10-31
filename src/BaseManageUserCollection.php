<?php

namespace Yosmy\Password;

use Yosmy\Mongo;

/**
 * @di\service({
 *     private: true
 * })
 */
class BaseManageUserCollection extends Mongo\BaseManageCollection
{
    /**
     * @di\arguments({
     *     uri: "%mongo_uri%",
     *     db:  "%mongo_db%"
     * })
     *
     * @param string $uri
     * @param string $db
     * @param string $root
     */
    public function __construct(
        string $uri,
        string $db,
        string $root
    ) {
        parent::__construct(
            $uri,
            $db,
            'yosmy_password_users',
            [
                'typeMap' => array(
                    'root' => $root,
                ),
            ]
        );
    }
}
