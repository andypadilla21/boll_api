<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Auth\AuthRequest;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\MailerAwareTrait; 
use Cake\Auth\BaseAuthenticate;
use Cake\Http\ServerRequest;
use Cake\Http\Response;

class BolRegistroController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['add']);
    }
    
    public function index()
    {
        $bolRegistro = $this->paginate($this->BolRegistro);

        $this->set(compact('bolRegistro'));
        $this->set('_serialize', ['bolRegistro']);
    }

   //Función para agregar un nuevo regario
    use MailerAwareTrait;
    public function add($id = null)
    {
        //Extrae de la tabla bol_tipo_documento el id y el tipo de doc, para mostrarlo en la vista
        $tipo = TableRegistry::get('bol_tipo_documento');
        $tipodoc = $tipo->find('all');
        $this->set('tipodoc', $tipodoc);

        $pais = TableRegistry::get('country');
        $p = $pais->find()->select(['Name','Code'])
        ->order(['Name' => 'ASC']);
        $this->set('pais', $p);

        if ($this->request->getSession()->read('Auth.User.Cod_User')) {
            return $this->redirect(array('controller' => 'Home', 'action' => 'index'));
        }else
        if ($this->request->is('post')) {
            $fecha = $this->request->getData('Fecha_Nacimiento');
            $clave1 = $this->request->getData('Password');

            $user = TableRegistry::get('bol_registro');           
            $reg = $user->newEntity();
            $reg->Nombres          = $this->request->getData('Nombres');
            $reg->Apellidos        = $this->request->getData('Apellidos');
            $reg->Sexo             = $this->request->getData('Sexo');
            $reg->Fecha_Nacimiento = date("y-m-d",strtotime($fecha));
            $reg->Tipo_Id          = $this->request->getData('Tipo_Id');
            $reg->Cod_User         = $this->request->getData('Cod_User');
            $reg->Telefono         = $this->request->getData('Telefono');
            $reg->Email            = $this->request->getData('Email');
            $reg->Password         = $hasher = hash('sha512', $clave1 , false);
            $reg->Rol              = 'Suscriptor';
            $reg->Pais             = $this->request->getData('Pais');
            $reg->Ciudad           = $this->request->getData('Ciudad');
            if ($user->save($reg)) {
                $this->getMailer('BolRegistro')->send('bienvenido',[$reg]);
                $this->Flash->success('<div class="container card-panel green lighten-2">
                <span class="white-text">¡Felicidades! Tus datos han sido registrados exitosamente, 
                te hemos enviado un correo de confirmación e información adicional de tu registro.
                </span></div>', [
                        'key' => 'add',
                        'escape' => false,
                        'params' => ['name'  => $reg->Nombre,
                                    'email' => $reg->email]
                        
                    ]);
                return $this->redirect(array('Controller'=>'BolRegistro','action' => 'add'));
            }else{
               $this->Flash->error('error', ['key' => 'registro',]);
            }
        } 
    }
}
