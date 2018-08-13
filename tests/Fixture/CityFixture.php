<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CityFixture
 *
 */
class CityFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'city';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'Name' => ['type' => 'string', 'length' => 35, 'null' => false, 'default' => '', 'collate' => 'latin1_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Country' => ['type' => 'string', 'length' => 4, 'null' => false, 'default' => '', 'collate' => 'latin1_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Province' => ['type' => 'string', 'length' => 32, 'null' => false, 'default' => '', 'collate' => 'latin1_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_options' => [
            'engine' => 'MyISAM',
            'collation' => 'latin1_general_ci'
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
                'Name' => 'Lorem ipsum dolor sit amet',
                'Country' => 'Lo',
                'Province' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
