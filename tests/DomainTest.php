<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class DomainTest extends TestCase
{

    protected $faker;

    /**
     * @test
     */
    public function testEmptyDomain(): void
    {
        $domain = DomainFactory::create('');

        $this->assertTrue($domain->isDomainEmpty());
    }

    /**
     * @test
     */
    public function testDomainNotEmpty(): void
    {
        $domain = DomainFactory::create($this->faker->valid()->domainName);

        $this->assertFalse($domain->isDomainEmpty());
    }

    /**
     * @test
     */
    public function testSpaceRemover(): void
    {
        $domain = DomainFactory::create($this->faker->sentence($nbWords = 6, $variableNbWords = true));
        $space_regex = '^\s^';

        $this->assertDoesNotMatchRegularExpression($space_regex, $domain->removeBlankSpace());
    }

    /**
     * @test
     */
    public function testDomainLengthBoundaries(): void
    {
        $this->superiorBoundary();
        $this->inferiorBoundary();
    }

    /**
     * Validates upper character boundary for a domain.
     */
    private function superiorBoundary(): void
    {
        $twenty_six_char = '';
        $twenty_seven_char = '';

        for ($i = 0; $i < 26; $i++) {
            $twenty_six_char .= $this->faker->randomLetter;
        }

        for ($i = 0; $i < 27; $i++) {
            $twenty_seven_char .= $this->faker->randomLetter;
        }

        $twenty_seven_chars_domain = DomainFactory::create($twenty_seven_char);
        $twenty_six_chars_domain = DomainFactory::create($twenty_six_char);

        $this->assertFalse($twenty_seven_chars_domain->hasLessThanMaximumLength());
        $this->assertTrue($twenty_six_chars_domain->hasLessThanMaximumLength());
    }

    /**
     * Validates lower character boundary for a domain.
     */
    private function inferiorBoundary(): void
    {
        $one_char_domain = DomainFactory::create($this->faker->randomLetter);
        $two_chars_domain = DomainFactory::create($this->faker->randomLetter . $this->faker->randomLetter);

        $this->assertFalse($one_char_domain->hasMinimumLength());
        $this->assertTrue($two_chars_domain->hasMinimumLength());
    }

    /**
     * @test
     */
    public function testCantHaveOnlyNumbers(): void
    {
        $alphanumeric_domain = DomainFactory::create($this->faker->randomNumber() . $this->faker->randomLetter);
        $numeric_domain = DomainFactory::create($this->faker->randomNumber());

        $this->assertFalse($alphanumeric_domain->hasOnlyNumbers());
        $this->assertTrue($numeric_domain->hasOnlyNumbers());
    }

    /**
     * @test
     */
    public function testDomainIsNotAlreadyRegistered(): void
    {
        foreach (DomainFactory::create('')->getRegisteredDomains() as $domain) {
            $registered_domain = DomainFactory::create($domain);
            $this->assertFalse($registered_domain->isNotRegisteredDomain());
        }

        $unregistered_domain = DomainFactory::create($this->faker->domainName());
        $this->assertTrue($unregistered_domain->isNotRegisteredDomain());
    }

    /**
     * @before
     */
    protected function setFaker(): void
    {
        $this->faker = Faker\Factory::create();
    }
}