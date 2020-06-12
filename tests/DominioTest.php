<?php declare(strict_types = 1);
use PHPUnit\Framework\TestCase;

final class DominioTest extends TestCase
{

    protected $faker;


    /**
     * @before
     */
    protected function setFaker(): void
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * @test
     */
    public function testEmptyDomain(): void
    {

        $domain = new Dominio('');

        $this->assertTrue($domain->validaDominioVazio());

    }

    /**
     * @test
     */
    public function testNotEmpty(): void
    {

        $domain = new Dominio($this->faker->valid()->domainName);

        $this->assertFalse($domain->validaDominioVazio());

    }

    /**
     * @test
     */
    public function testSpaceRemoving(): void
    {

        $domain = new Dominio($this->faker->sentence($nbWords = 6, $variableNbWords = true));
        $space_regex = '^\s^';

        $this->assertDoesNotMatchRegularExpression( $space_regex, $domain->retiraEspacos());

    }

    /**
     * @test
     */
    public function testCharactersBoundariesValidators(): void
    {

        $twenty_six_char = '';
        $twenty_seven_char = '';

        for ($i=0; $i < 26; $i++) {
            $twenty_six_char .= $this->faker->randomLetter;
        }

        for ($i=0; $i < 27; $i++) {
            $twenty_seven_char .= $this->faker->randomLetter;
        }

        $one_char_domain = new Dominio($this->faker->randomLetter);
        $two_chars_domain = new Dominio($this->faker->randomLetter . $this->faker->randomLetter );
        $twenty_seven_chars_domain = new Dominio($twenty_seven_char);
        $twenty_six_chars_domain = new Dominio($twenty_six_char);

        $this->assertFalse($one_char_domain->minimoCaracteres());
        $this->assertTrue($two_chars_domain->minimoCaracteres());
        $this->assertFalse($twenty_seven_chars_domain->maximoCaracteres());
        $this->assertTrue($twenty_six_chars_domain->maximoCaracteres());

    }

    /**
     * @test
     */
    public function testCantHaveOnlyNumber(): void
    {

        $alphanumeric_domain = new Dominio($this->faker->randomNumber() . $this->faker->randomLetter);
        $numeric_domain = new Dominio($this->faker->randomNumber());

        $this->assertFalse($alphanumeric_domain->somenteNumeros());
        $this->assertTrue($numeric_domain->somenteNumeros());

    }


    /**
     * @test
     */
    public function testDomainInsertion(): void
    {

        foreach ($this->getRegisteredDomains() as $domain){

            $registered_domain = new Dominio($domain);
            $this->assertFalse($registered_domain->verificarDominioRegistrado());

        }

        $unregistered_domain = new Dominio($this->faker->domainName());
        $this->assertTrue($unregistered_domain->verificarDominioRegistrado());

    }

    protected function getRegisteredDomains(): array
    {

        return array (
            'kinghost.com.br',
            'kinghost.com',
            'gmail.com',
            'google.com.br',
            'bah.poa.br',
            'hotmail.com',
            'facebook.com'
        );

    }

}