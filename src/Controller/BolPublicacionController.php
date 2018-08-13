<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\MailerAwareTrait; 

class BolPublicacionController extends AppController
{
    public $components = ['Flash'];
    var $paginate = [
        'limit' => 15,
        'order' => ['BolPublicacion.Fecha' => 'desc'],
        'group by' => ['BolPublicacion.Estado']
    ];
    var $imp = 0;
    public function initialize()
    {
        parent::initialize();
        
    }

    public function index()
    {
        $this->set('publicacion', $this->BolPublicacion->find('all'));
    }

    public function view($id)
    {
        $publicacion = $this->Publicacion->get($id);
        $this->set(compact('publicacion'));
    }

    public function add()
    {
        $publicacion = $this->Publicacion->newEntity();
        if ($this->request->is('post')) {
            $publicacion = $this->BolPublicacion->patchEntity($publicacion, $this->request->getData());
            if ($this->BolPublicacion->save($publicacion)) {
                $this->Flash->success(__('Your publicacion has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your publicacion.'));
        }
        $this->set('publicacion', $publicacion);
    }

    public function edit($id = null)
    {
    $publicacion = $this->BolPublicacion->get($id);
    if ($this->request->is(['post', 'put'])) {
        $this->BolPublicacion->patchEntity($publicacion, $this->request->getData());
        if ($this->BolPublicacion->save($publicacion)) {
            $this->Flash->success(__('Tu Publicación ha sido actualizada.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Tu artículo no se ha podido actualizar.'));
    }

    $this->set('publicacion', $publicacion);
   }

   public function delete($id)
   {
    $this->request->allowMethod(['post', 'delete']);

    $publicacion = $this->BolPublicacion->get($id);
    if ($this->BolPublicacion->delete($publicacion)) {
        $this->Flash->success(__('El Post con id: {0} ha sido eliminado.', h($id)));
        return $this->redirect(['action' => 'index']);
    }
   }
}