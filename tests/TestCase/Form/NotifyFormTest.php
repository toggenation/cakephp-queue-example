<?php
declare(strict_types=1);

namespace App\Test\TestCase\Form;

use App\Form\NotifyForm;
use Cake\TestSuite\TestCase;

/**
 * App\Form\NotifyForm Test Case
 */
class NotifyFormTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Form\NotifyForm
     */
    protected $Notify;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->Notify = new NotifyForm();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Notify);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Form\NotifyForm::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
