<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BolMultimediaTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BolMultimediaTable Test Case
 */
class BolMultimediaTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BolMultimediaTable
     */
    public $BolMultimedia;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.bol_multimedia'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('BolMultimedia') ? [] : ['className' => BolMultimediaTable::class];
        $this->BolMultimedia = TableRegistry::getTableLocator()->get('BolMultimedia', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BolMultimedia);

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
