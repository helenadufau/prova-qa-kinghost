<?php

final class DomainFactory
{

    /**
     * Domain factory.
     * @param $domain
     * @return Domain
     */
    public static function create($domain)
    {
        return new Domain($domain);
    }
}