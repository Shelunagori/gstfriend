<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CompaniesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\CompaniesController Test Case
 */
class CompaniesControllerTest extends IntegrationTestCase
{

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
