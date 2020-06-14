<?php

final class Domain
{

    /**
     * @var string
     */
    public string $domain;

    /**
     * @var array|string[]
     */
    public array $registered_domains;

    /**
     * Domain constructor.
     * @param $domain
     */
    public function __construct($domain)
    {
        $this->domain = $domain;
        $this->registered_domains = array(
            'kinghost.com.br',
            'kinghost.com',
            'gmail.com',
            'google.com.br',
            'bah.poa.br',
            'hotmail.com',
            'facebook.com'
        );
    }

    /**
     * Registered Domains getter.
     * @return array|string[]
     */
    public function getRegisteredDomains()
    {
        return $this->registered_domains;
    }

    /**
     *  Validates that the domain string is empty.
     * @return bool
     */
    public function isDomainEmpty()
    {
        return empty($this->domain);
    }

    /**
     * Remove blank spaces from the string.
     * @return string|string[]
     */
    public function removeBlankSpace()
    {
        return str_replace(' ', '', $this->domain);
    }

    /**
     * Validates a minimum of 2 characters.
     * @return bool
     */
    public function hasMinimumLength()
    {
        if (strlen($this->domain) < 2) {
            return false;
        }

        return true;
    }

    /**
     * Validates a maximum of 26 characters.
     * @return bool
     */
    public function hasLessThanMaximumLength()
    {
        if (strlen($this->domain) > 26) {
            return false;
        }

        return true;
    }

    /**
     * Validates if the domain contains only numbers.
     * @return bool
     */
    public function hasOnlyNumbers()
    {
        return is_numeric($this->domain);
    }

    /**
     * Validates that the domain is not already registered.
     * @return bool
     */
    public function isNotRegisteredDomain()
    {
        if (in_array($this->domain, $this->registered_domains)) {
            return false;
        }

        return true;
    }
}