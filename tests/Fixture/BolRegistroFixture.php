<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BolRegistroFixture
 *
 */
class BolRegistroFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'bol_registro';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'Cod_User' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => null, 'collate' => 'utf16_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Tipo_Id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Nombres' => ['type' => 'string', 'length' => 90, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Apellidos' => ['type' => 'string', 'length' => 90, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ImgPerfil' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => 'avatar.jpeg', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Sexo' => ['type' => 'string', 'length' => 15, 'null' => false, 'default' => null, 'collate' => 'utf16_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Fecha_Nacimiento' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'Telefono' => ['type' => 'string', 'length' => 15, 'null' => true, 'default' => null, 'collate' => 'utf16_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Email' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'utf16_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Password' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf16_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Tipo_Usuario' => ['type' => 'string', 'length' => 18, 'null' => true, 'default' => null, 'collate' => 'utf16_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Rol' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'collate' => 'utf16_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Pais' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => null, 'collate' => 'utf16_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Ciudad' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'utf16_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Fecha_Registro' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'Estado' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => true, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'Tipo_Id' => ['type' => 'index', 'columns' => ['Tipo_Id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['Cod_User'], 'length' => []],
            'Email' => ['type' => 'unique', 'columns' => ['Email'], 'length' => []],
            'bol_registro_ibfk_1' => ['type' => 'foreign', 'columns' => ['Tipo_Id'], 'references' => ['bol_tipo_documento', 'Codigo'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'Cod_User' => '2c192a7f-426f-4478-8938-3de9e8ecd935',
                'Tipo_Id' => 1,
                'Nombres' => 'Lorem ipsum dolor sit amet',
                'Apellidos' => 'Lorem ipsum dolor sit amet',
                'ImgPerfil' => 'Lorem ipsum dolor sit amet',
                'Sexo' => 'Lorem ipsum d',
                'Fecha_Nacimiento' => '2018-08-05',
                'Telefono' => 'Lorem ipsum d',
                'Email' => 'Lorem ipsum dolor sit amet',
                'Password' => 'Lorem ipsum dolor sit amet',
                'Tipo_Usuario' => 'Lorem ipsum dolo',
                'Rol' => 'Lorem ipsum dolor sit amet',
                'Pais' => 'Lorem ipsum dolor ',
                'Ciudad' => 'Lorem ipsum dolor sit amet',
                'Fecha_Registro' => 1533494245,
                'Estado' => 1
            ],
        ];
        parent::init();
    }
}
