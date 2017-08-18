<?php
namespace App\Test\TestCase\Controller;

use App\Controller\AccountingEntriesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\AccountingEntriesController Test Case
 */
class AccountingEntriesControllerTest extends IntegrationTestCase
{

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
