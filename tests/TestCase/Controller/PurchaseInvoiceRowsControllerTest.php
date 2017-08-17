<?php
namespace App\Test\TestCase\Controller;

use App\Controller\PurchaseInvoiceRowsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\PurchaseInvoiceRowsController Test Case
 */
class PurchaseInvoiceRowsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.purchase_invoice_rows',
        'app.cgst_ledgers',
        'app.sgst_ledgers',
        'app.purchase_invoices',
        'app.cgst_ledger',
        'app.accounting_groups',
        'app.nature_of_groups',
        'app.companies',
        'app.ledgers',
        'app.suppliers',
        'app.customers',
        'app.accounting_entries',
        'app.sgst_ledger'
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
