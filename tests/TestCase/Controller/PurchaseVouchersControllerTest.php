<?php
namespace App\Test\TestCase\Controller;

use App\Controller\PurchaseVouchersController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\PurchaseVouchersController Test Case
 */
class PurchaseVouchersControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.purchase_vouchers',
        'app.supplier_ledgers',
        'app.purchase_ledgers',
        'app.companies',
        'app.accounting_entries',
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
