<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BolTipoDocumento Entity
 *
 * @property int $Codigo
 * @property string $Tipo
 */
class BolTipoDocumento extends Entity
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
        'Tipo' => true
    ];
}
