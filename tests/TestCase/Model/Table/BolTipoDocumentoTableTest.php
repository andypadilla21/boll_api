<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BolTipoDocumentoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BolTipoDocumentoTable Test Case
 */
class BolTipoDocumentoTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BolTipoDocumentoTable
     */
    public $BolTipoDocumento;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.bol_tipo_documento'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('BolTipoDocumento') ? [] : ['className' => BolTipoDocumentoTable::class];
        $this->BolTipoDocumento = TableRegistry::getTableLocator()->get('BolTipoDocumento', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BolTipoDocumento);

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
