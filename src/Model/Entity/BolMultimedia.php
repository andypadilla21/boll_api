<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BolMultimedia Entity
 *
 * @property int $Codigo
 * @property string $Cod_User
 * @property string $Url_Link
 * @property string $Estado
 * @property \Cake\I18n\FrozenTime $Fecha
 */
class BolMultimedia extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'Cod_User' => true,
        'Url_Link' => true,
        'Estado' => true,
        'Fecha' => true
    ];
}
