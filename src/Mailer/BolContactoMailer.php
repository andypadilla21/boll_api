<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;

/**
 * BolContacto mailer.
 */
class BolContactoMailer extends Mailer
{

    /**
     * Mailer's name.
     *
     * @var string
     */
    static public $name = 'BolContacto';
    public function respuesta($bolContacto){
    	$this->to($bolContacto->Correo)
        ->profile('bolusb')
        ->emailFormat('html')
        ->template('contacto')
        ->layout('bol_registro')
        ->viewVars(['Nombre'=>$bolRegistro->Nombres])
        ->subject(sprintf('Respuesta: Inquietudes y/o sugerencias.',$bolRegistro->Nombres));
    }
}
