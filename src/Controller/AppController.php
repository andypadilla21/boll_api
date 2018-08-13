<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use App\Controller\AppController;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Auth\AuthRequest;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\MailerAwareTrait; 
use Cake\Auth\BaseAuthenticate;
use Cake\Http\ServerRequest;
use Cake\Http\Response;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => 'Home',
                'action' => 'index',
            ],
            'authError' => 'Did you really think you are allowed to see that?',
            'authenticate' => [
                'Form' => [
                    'fields' => ['emailorphone' => 'Email', 'Password' => 'Password']
                ]
            ],
            'logoutRedirect' => [
                'controller' => 'Home',
                'action' => 'index',
                'home'
            ],
            'storage' => 'Session'
            ]);

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['login','roles']);
    }

    public function login(){
        if ($this->request->getSession()->read('Auth.User.emailorphone')) {
             return $this->redirect(array('controller' => 'Home', 'action' => 'index'));
        }else{
            if ($this->request->is('post')) {
            $user = TableRegistry::get('bol_registro');
            $hasher = hash('sha512', $this->request->getData('Password'),false);
            $query = $user->find()->where(['OR' => ['Email' => $this->request->getData('emailorphone'),'Telefono' => $this->request->getData('emailorphone')]])->andWhere(['Password' => $hasher])->andWhere(['Estado' => 1])->first();
            $query1 = $user->find()->where(['OR' => ['Email' => $this->request->getData('emailorphone'),'Telefono' => $this->request->getData('emailorphone')]])->andWhere(['Password' => $hasher])->andWhere(['Estado' => 0])->first();
            if($query){
                $this->Auth->setUser($query);
                return $this->redirect($this->Auth->redirectUrl());
            }else
            if ($query1) {
               $query1->Estado = 1;
               $user->save($query1);
               $this->Auth->setUser($query1);
               return $this->redirect($this->Auth->redirectUrl());
            }else
            $this->Flash->error('<div class="container card-panel  red lighten-3">
            <span class="white-text">Los datos de acceso son incorrectos, verifique e intente nuevamente
            </span></div>', 
                [
                   'key' => 'login',
                   'escape' => false
               ]);
            }
        }
    }

    public function roles(){
        if($this->Auth->user('Rol') == 'Administrador'){ 
            return $this->redirect(array( 'controller' => 'BolPublicacion', 'action' => 'Estadisticas')); 
        }
        if($this->Auth->user('Rol') == 'Coordinador'){
            return $this->redirect(array( 'controller' => 'Coordinador', 'action' => 'coordinador'));
        }
        if($this->Auth->user('Rol') == 'Suscriptor'){
            return $this->redirect(array( 'controller' => 'Suscriptor', 'action' => 'inbox'));
        }
        if($this->Auth->user('Rol') == 'Editorial'){
            return $this->redirect(array( 'controller' => 'Editor', 'action' => 'inbox'));
        }
    }

    public function logout(){
        return $this->redirect($this->Auth->logout());
    }

}
