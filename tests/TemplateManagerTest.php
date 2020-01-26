<?php

use App\Entity\Quote;
use App\Entity\Template;
use App\Repository\DestinationRepository;
use Faker\Factory;
use App\ApplicationContext;
use App\Manager\TemplateManager;

class TemplateManagerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var TemplateManager
     */
    private $templateManager;

    /**
     * Init the mocks
     */
    public function setUp(): void
    {
        $this->templateManager = new TemplateManager();
    }

    /**
     * Closes the mocks
     */
    public function tearDown(): void
    {
    }

    /**
     * @test
     */
    public function testGetTemplateComputedOnSuccess()
    {
        $faker = Factory::create();
        $expectedDestination = DestinationRepository::getInstance()->getById($faker->randomNumber());
        $expectedUser = ApplicationContext::getInstance()->getCurrentUser();

        $quote = new Quote($faker->randomNumber(), $faker->randomNumber(), $expectedDestination->id, $faker->date());

        $template = new Template(
            1,
            'Votre voyage avec une agence locale [quote:destination_name]',
            "
Bonjour [user:first_name],

Merci d'avoir contacté un agent local pour votre voyage [quote:destination_name].

Bien cordialement,

L'équipe Evaneos.com
www.evaneos.com
");

        $message = $this->templateManager->getTemplateComputed(
            $template,
            [
                'quote' => $quote
            ]
        );

        $this->assertEquals('Votre voyage avec une agence locale ' . $expectedDestination->countryName, $message->subject);
        $this->assertEquals("
Bonjour " . $expectedUser->firstname . ",

Merci d'avoir contacté un agent local pour votre voyage " . $expectedDestination->countryName . ".

Bien cordialement,

L'équipe Evaneos.com
www.evaneos.com
", $message->content);
    }

    public function testGetTemplateComputedOnRuntimeException()
    {
        $this->expectException('RuntimeException');

        $this->templateManager->getTemplateComputed(null, []);
    }
}
