<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BolPublicacion Entity
 *
 * @property int $codigo_publicacion
 * @property string $codigo_User
 * @property string $Titulo
 * @property \Cake\I18n\FrozenTime $Fecha
 * @property string $Desarrollo
 * @property string $Imagen
 * @property string $Enlace
 * @property string $Usuario
 * @property string $Estado
 * @property string $Correccion
 */
class BolPublicacion extends Entity
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
        'codigo_User' => true,
        'Titulo' => true,
        'Fecha' => true,
        'Desarrollo' => true,
        'Imagen' => true,
        'Enlace' => true,
        'Usuario' => true,
        'Estado' => true,
        'Correccion' => true
    ];
}
