<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BolDetallePublicacionFixture
 *
 */
class BolDetallePublicacionFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'bol_detalle_publicacion';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'Codigo' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'Cod_Publicacion' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Cod_Usuario' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => null, 'collate' => 'utf16_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Cod_Categoria' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Estado' => ['type' => 'string', 'length' => 25, 'null' => false, 'default' => null, 'collate' => 'utf16_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Fecha_Publicacion' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'Destacada' => ['type' => 'integer', 'length' => 1, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'cod_user_idx' => ['type' => 'index', 'columns' => ['Cod_Usuario'], 'length' => []],
            'cod_pub_idx' => ['type' => 'index', 'columns' => ['Cod_Publicacion'], 'length' => []],
            'cod_cat_idx' => ['type' => 'index', 'columns' => ['Cod_Categoria'], 'length' => []],
            'Cod_Usuario' => ['type' => 'index', 'columns' => ['Cod_Usuario'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['Codigo'], 'length' => []],
            'cod_cat' => ['type' => 'foreign', 'columns' => ['Cod_Categoria'], 'references' => ['bol_categoria', 'codigo'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'cod_pub' => ['type' => 'foreign', 'columns' => ['Cod_Publicacion'], 'references' => ['bol_publicacion', 'codigo_publicacion'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'cod_user' => ['type' => 'foreign', 'columns' => ['Cod_Usuario'], 'references' => ['bol_registro', 'Cod_User'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf16_swedish_ci'
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
                'Codigo' => 1,
                'Cod_Publicacion' => 1,
                'Cod_Usuario' => 'Lorem ipsum dolor ',
                'Cod_Categoria' => 1,
                'Estado' => 'Lorem ipsum dolor sit a',
                'Fecha_Publicacion' => 1533481047,
                'Destacada' => 1
            ],
        ];
        parent::init();
    }
}
