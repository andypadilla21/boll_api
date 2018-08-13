<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;

/**
 * BolRegistro mailer.
 */
class BolRegistroMailer extends Mailer
{

    /**
     * Mailer's name.
     *
     * @var string
     */
    static public $name = 'BolRegistro';

    public function bienvenido($bolRegistro){
    	$this->to($bolRegistro->Email)
        ->profile('bolusb')
        ->emailFormat('html')
        ->template('boletin')
        ->layout('bol_registro')
        ->viewVars(['Nombre'=>$bolRegistro->Nombres])
        ->subject(sprintf('Bienvenido',$bolRegistro->Nombres));
    }
}
