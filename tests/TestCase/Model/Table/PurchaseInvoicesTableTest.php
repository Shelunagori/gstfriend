<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PurchaseInvoicesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PurchaseInvoicesTable Test Case
 */
class PurchaseInvoicesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PurchaseInvoicesTable
     */
    public $PurchaseInvoices;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.purchase_invoices'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PurchaseInvoices') ? [] : ['className' => PurchaseInvoicesTable::class];
        $this->PurchaseInvoices = TableRegistry::get('PurchaseInvoices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PurchaseInvoices);

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
