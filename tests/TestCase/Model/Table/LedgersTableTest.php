<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LedgersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LedgersTable Test Case
 */
class LedgersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LedgersTable
     */
    public $Ledgers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ledgers',
        'app.accounting_groups',
        'app.nature_of_groups'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Ledgers') ? [] : ['className' => LedgersTable::class];
        $this->Ledgers = TableRegistry::get('Ledgers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ledgers);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
