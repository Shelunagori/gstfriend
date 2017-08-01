<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TaxsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TaxsTable Test Case
 */
class TaxsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TaxsTable
     */
    public $Taxs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.taxs',
        'app.items',
        'app.companies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Taxs') ? [] : ['className' => TaxsTable::class];
        $this->Taxs = TableRegistry::get('Taxs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Taxs);

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
}
