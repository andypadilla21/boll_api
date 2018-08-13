<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BolRegistro Entity
 *
 * @property string $Cod_User
 * @property int $Tipo_Id
 * @property string $Nombres
 * @property string $Apellidos
 * @property string $ImgPerfil
 * @property string $Sexo
 * @property \Cake\I18n\FrozenDate $Fecha_Nacimiento
 * @property string $Telefono
 * @property string $Email
 * @property string $Password
 * @property string $Tipo_Usuario
 * @property string $Rol
 * @property string $Pais
 * @property string $Ciudad
 * @property \Cake\I18n\FrozenTime $Fecha_Registro
 * @property int $Estado
 */
class BolRegistro extends Entity
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

     // Make all fields mass assignable for now.
    protected $_accessible = ['*' => true];

    // ...

    protected function _setPassword($password)
    {
        if (strlen($Password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
}
