<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemMastersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemMastersTable Test Case
 */
class ItemMastersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemMastersTable
     */
    public $ItemMasters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_masters',
        'app.items',
        'app.companies',
        'app.cgst_ledgers',
        'app.sgst_ledgers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ItemMasters') ? [] : ['className' => ItemMastersTable::class];
        $this->ItemMasters = TableRegistry::get('ItemMasters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemMasters);

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
