<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ItemDiscountsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ItemDiscountsController Test Case
 */
class ItemDiscountsControllerTest extends IntegrationTestCase
{

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
