<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BolRegistroTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BolRegistroTable Test Case
 */
class BolRegistroTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BolRegistroTable
     */
    public $BolRegistro;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.bol_registro'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('BolRegistro') ? [] : ['className' => BolRegistroTable::class];
        $this->BolRegistro = TableRegistry::getTableLocator()->get('BolRegistro', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BolRegistro);

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
     * Test beforeSave method
     *
     * @return void
     */
    public function testBeforeSave()
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
