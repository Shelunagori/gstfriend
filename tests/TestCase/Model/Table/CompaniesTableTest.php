<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CompaniesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CompaniesTable Test Case
 */
class CompaniesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CompaniesTable
     */
    public $Companies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.companies',
        'app.accounting_entries',
        'app.ledgers',
        'app.accounting_groups',
        'app.nature_of_groups',
        'app.suppliers',
        'app.customers',
        'app.purchase_vouchers',
        'app.supplier_ledger',
        'app.purchase_ledger',
        'app.cgst_ledger',
        'app.sgst_ledger',
        'app.igst_ledger',
        'app.purchase_voucher_rows',
        'app.items',
        'app.cgst_ledgers',
        'app.sgst_ledgers',
        'app.igst_ledgers',
        'app.item_discounts',
        'app.customer_ledgers',
        'app.tax_types',
        'app.tax_type_rows',
        'app.purchase_invoices',
        'app.purchase_invoice_rows',
        'app.invoices',
        'app.sales_ledgers',
        'app.invoice_rows',
        'app.tax_s_g_s_t',
        'app.tax_c_g_s_t',
        'app.tax_i_g_s_t',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Companies') ? [] : ['className' => CompaniesTable::class];
        $this->Companies = TableRegistry::get('Companies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Companies);

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
