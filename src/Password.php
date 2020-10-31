<?php

namespace Yosmy;

interface Password
{
    /**
     * @return string
     */
    public function getUser(): string;

    /**
     * @return string
     */
    public function getSalt(): string;

    /**
     * @return string
     */
    public function getValue(): string;
}
