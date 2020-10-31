<?php

namespace Yosmy\Password;

interface User
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getSalt();

    /**
     * @return string
     */
    public function getPassword();
}
