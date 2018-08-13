<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BolPublicacionFixture
 *
 */
class BolPublicacionFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'bol_publicacion';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'codigo_publicacion' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'codigo_User' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => null, 'collate' => 'utf16_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Titulo' => ['type' => 'string', 'length' => 190, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Fecha' => ['type' => 'timestamp', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'Desarrollo' => ['type' => 'string', 'length' => 60000, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Imagen' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'Enlace' => ['type' => 'string', 'length' => 150, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Usuario' => ['type' => 'string', 'length' => 35, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Estado' => ['type' => 'string', 'length' => 25, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Correccion' => ['type' => 'string', 'length' => 1200, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'codigo_User' => ['type' => 'index', 'columns' => ['codigo_User'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['codigo_publicacion'], 'length' => []],
            'bol_publicacion_ibfk_1' => ['type' => 'foreign', 'columns' => ['codigo_User'], 'references' => ['bol_registro', 'Cod_User'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'codigo_publicacion' => 1,
                'codigo_User' => 'Lorem ipsum dolor ',
                'Titulo' => 'Lorem ipsum dolor sit amet',
                'Fecha' => 1533480955,
                'Desarrollo' => 'Lorem ipsum dolor sit amet',
                'Imagen' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'Enlace' => 'Lorem ipsum dolor sit amet',
                'Usuario' => 'Lorem ipsum dolor sit amet',
                'Estado' => 'Lorem ipsum dolor sit a',
                'Correccion' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
