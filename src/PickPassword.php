<?php

namespace Yosmy;

interface PickPassword
{
    /**
     * @param string $user
     *
     * @return Password
     *
     * @throws NonexistentPasswordException
     */
    public function pick(
        string $user
    ): Password;
}