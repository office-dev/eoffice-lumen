<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    /**
     * Define custom actions here
     */
    /**
     * @Then /^saya harus melihat tulisan "([^"]*)"$/
     */
    public function iShouldSeeHelloworld($text)
    {
        $this->see($text);
    }

    /**
     * @Given /^saya berada di halaman homepage$/
     */
    public function iAmOnTheHomepage()
    {
        $this->amOnPage("/");
    }
}
