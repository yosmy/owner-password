<?php

namespace Yosmy;

interface AddPassword
{
    /**
     * @param string $user
     * @param string $value
     */
    public function add(
        string $user,
        string $value
    );
}