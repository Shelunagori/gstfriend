<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AccountingEntriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AccountingEntriesTable Test Case
 */
class AccountingEntriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AccountingEntriesTable
     */
    public $AccountingEntries;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.accounting_entries',
        'app.ledgers',
        'app.accounting_groups',
        'app.nature_of_groups',
        'app.companies',
        'app.suppliers',
        'app.customers',
        'app.purchase_vouchers',
        'app.supplier_ledger',
        'app.purchase_ledger',
        'app.cgst_ledger',
        'app.sgst_ledger',
        'app.purchase_voucher_rows',
        'app.items',
        'app.cgst_ledgers',
        'app.sgst_ledgers',
        'app.item_discounts',
        'app.customer_ledgers',
        'app.invoices',
        'app.sales_ledgers',
        'app.invoice_rows',
        'app.tax_s_g_s_t',
        'app.tax_c_g_s_t'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AccountingEntries') ? [] : ['className' => AccountingEntriesTable::class];
        $this->AccountingEntries = TableRegistry::get('AccountingEntries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AccountingEntries);

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
