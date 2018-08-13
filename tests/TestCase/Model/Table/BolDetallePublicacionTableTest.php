<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BolDetallePublicacionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BolDetallePublicacionTable Test Case
 */
class BolDetallePublicacionTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BolDetallePublicacionTable
     */
    public $BolDetallePublicacion;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.bol_detalle_publicacion'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('BolDetallePublicacion') ? [] : ['className' => BolDetallePublicacionTable::class];
        $this->BolDetallePublicacion = TableRegistry::getTableLocator()->get('BolDetallePublicacion', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BolDetallePublicacion);

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
