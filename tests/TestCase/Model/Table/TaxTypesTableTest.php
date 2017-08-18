<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TaxTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TaxTypesTable Test Case
 */
class TaxTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TaxTypesTable
     */
    public $TaxTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tax_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TaxTypes') ? [] : ['className' => TaxTypesTable::class];
        $this->TaxTypes = TableRegistry::get('TaxTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TaxTypes);

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
