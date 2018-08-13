<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BolDetallePublicacion Entity
 *
 * @property int $Codigo
 * @property int $Cod_Publicacion
 * @property string $Cod_Usuario
 * @property int $Cod_Categoria
 * @property string $Estado
 * @property \Cake\I18n\FrozenTime $Fecha_Publicacion
 * @property int $Destacada
 */
class BolDetallePublicacion extends Entity
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
        'Cod_Publicacion' => true,
        'Cod_Usuario' => true,
        'Cod_Categoria' => true,
        'Estado' => true,
        'Fecha_Publicacion' => true,
        'Destacada' => true
    ];
}
