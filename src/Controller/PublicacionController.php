<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\MailerAwareTrait; 

class PublicacionController extends AppController
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
        $this->set('publicacion', $this->->find('all'));
    }

    public function view($id)
    {
        $article = $this->Articles->get($id);
        $this->set(compact('article'));
    }

    public function add()
    {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.'));
        }
        $this->set('article', $article);
    }
}