<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemDiscountsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemDiscountsTable Test Case
 */
class ItemDiscountsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemDiscountsTable
     */
    public $ItemDiscounts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_discounts',
        'app.customer_ledgers',
        'app.items',
        'app.companies',
        'app.cgst_ledgers',
        'app.accounting_groups',
        'app.nature_of_groups',
        'app.ledgers',
        'app.suppliers',
        'app.customers',
        'app.accounting_entries',
        'app.sgst_ledgers',
        'app.purchase_vouchers',
        'app.supplier_ledger',
        'app.purchase_ledger',
        'app.cgst_ledger',
        'app.sgst_ledger',
        'app.purchase_voucher_rows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ItemDiscounts') ? [] : ['className' => ItemDiscountsTable::class];
        $this->ItemDiscounts = TableRegistry::get('ItemDiscounts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemDiscounts);

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
