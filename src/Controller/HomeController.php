<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;
use Cake\Auth\DefaultPasswordHasher; 

class HomeController extends AppController
{
  var $paginate = [
    // Other keys here.
    'maxLimit' => 10
  ];
    public function initialize(){
		parent::initialize();
    }
    
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow([]);
    }
    
    public function index(){
    $publicacion = TableRegistry::get('bol_publicacion');
		$pub = $publicacion->find()
    ->select(['cat'=>'b.Categoria','Titulo', 'Desarrollo','Imagen','Fecha','codigo_publicacion'])
    ->enableHydration(false)
    ->join([
        'c' => [
            'table' => 'bol_detalle_publicacion',
            'conditions' => [
                'c.Cod_Publicacion = bol_publicacion.codigo_publicacion'
            ]
        ]
    ])
    ->join([
        'b' => [
            'table' => 'bol_categoria',
            'conditions' => [
                'c.Cod_Categoria = b.codigo'
            ]
        ]
    ])
    ->where(['c.Estado ='=>'Publicada','c.Cod_Categoria' => 10])
    ->order(['Fecha' => 'DESC LIMIT 6']);
    $this->set('index', $pub);

    $pub = $publicacion->find()
    ->select(['cat'=>'b.Categoria','Titulo', 'Desarrollo','Imagen','Fecha','codigo_publicacion'])
    ->enableHydration(false)
    ->join([
        'c' => [
            'table' => 'bol_detalle_publicacion',
            'conditions' => [
                'c.Cod_Publicacion = bol_publicacion.codigo_publicacion'
            ]
        ]
    ])
    ->join([
        'b' => [
            'table' => 'bol_categoria',
            'conditions' => [
                'c.Cod_Categoria = b.codigo'
            ]
        ]
    ])
    ->where(['c.Estado ='=>'Publicada','c.Cod_Categoria' => 11])
    ->order(['Fecha' => 'DESC LIMIT 6']);
    $this->set('doc', $pub);

    $pub = $publicacion->find()
    ->select(['cat'=>'b.Categoria','Titulo', 'Desarrollo','Imagen','Fecha','codigo_publicacion'])
    ->enableHydration(false)
    ->join([
        'c' => [
            'table' => 'bol_detalle_publicacion',
            'conditions' => [
                'c.Cod_Publicacion = bol_publicacion.codigo_publicacion'
            ]
        ]
    ])
    ->join([
        'b' => [
            'table' => 'bol_categoria',
            'conditions' => [
                'c.Cod_Categoria = b.codigo'
            ]
        ]
    ])
    ->where(['c.Estado ='=>'Publicada','c.Cod_Categoria' => 12])
    ->order(['Fecha' => 'DESC LIMIT 6']);
    $this->set('int', $pub);
    
    $userTable = TableRegistry::get('bol_registro');
		$user = $userTable->find();
		$this->set('user', $user);

    $publicacion = TableRegistry::get('bol_publicacion');
        $pub = $publicacion->find()
        ->select(['Titulo','Imagen','Fecha','codigo_publicacion','Usuario'])
        ->enableHydration(true)
        ->join([
            'c' => [
                'table' => 'bol_detalle_publicacion',
                'type' => 'LEFT',
                'conditions' => [
                    'c.Cod_Publicacion = bol_publicacion.codigo_publicacion'
                ]
            ]
        ])
        ->join([
            'b' => [
                'table' => 'bol_categoria',
                'type' => 'LEFT',
                'conditions' => [
                    'c.Cod_Categoria = b.codigo'
                ]
            ]
        ])
        ->where(['c.Estado'=>'Publicada','c.Destacada'=>1])
        ->order(['Fecha' => 'DESC']);
        $this->set('bol',$pub);

    }
    public function convocatorias(){
        $convocatoria = TableRegistry::get('bol_publicacion');
        $c = $convocatoria->find()
        ->select(['cat'=>'b.Categoria','Titulo', 'Desarrollo','Imagen','Fecha','codigo_publicacion'])
        ->enableHydration(false)
        ->join([
            'c' => [
                'table' => 'bol_detalle_publicacion',
                'conditions' => [
                    'c.Cod_Publicacion = bol_publicacion.codigo_publicacion'
                ]
            ]
        ])
        ->join([
            'b' => [
                'table' => 'bol_categoria',
                'conditions' => [
                    'c.Cod_Categoria = b.codigo','c.Cod_Categoria = 13'
                ]
            ]
        ])
        ->where(['c.Estado ='=>'publicada'])
        ->order(['Fecha' => 'DESC']);
        $this->set('c', $this->paginate($c));
    }
    public function eventos(){
        $convocatoria = TableRegistry::get('bol_publicacion');
        $c =$convocatoria->find()
        ->select(['cat'=>'b.Categoria','Titulo', 'Desarrollo','Imagen','Fecha','codigo_publicacion'])
        ->enableHydration(false)
        ->join([
            'c' => [
                'table' => 'bol_detalle_publicacion',
                'conditions' => [
                    'c.Cod_Publicacion = bol_publicacion.codigo_publicacion'
                ]
            ]
        ])
        ->join([
            'b' => [
                'table' => 'bol_categoria',
                'conditions' => [
                    'c.Cod_Categoria = b.codigo','c.Cod_Categoria = 14'
                ]
            ]
        ])
        ->where(['c.Estado ='=>'publicada'])
        ->order(['Fecha' => 'DESC']);
        $this->set('e', $this->paginate($c));
    }
    
    public function intereses(){
        $investigacion = TableRegistry::get('bol_publicacion');
        $inv = $investigacion->find()
        ->select(['cat'=>'b.Categoria','Titulo', 'Desarrollo','Imagen','Fecha','codigo_publicacion'])
        ->enableHydration(false)
        ->join([
            'c' => [
                'table' => 'bol_detalle_publicacion',
                'conditions' => [
                    'c.Cod_Publicacion = bol_publicacion.codigo_publicacion'
                ]
            ]
        ])
        ->join([
            'b' => [
                'table' => 'bol_categoria',
                'conditions' => [
                    'c.Cod_Categoria = b.codigo','c.Cod_Categoria = 15'
                ]
            ]
        ])
        ->where(['c.Estado ='=>'publicada'])
        ->order(['Fecha' => 'DESC']);
        $this->set('int', $this->paginate($inv));

        $intereses = TableRegistry::get('bol_multimedia');
        $mult = $intereses->find()
        ->select(['Url_Link','Estado','Codigo'])
        ->where(['Estado ='=>'Publicado'])
        ->order(['Fecha' => 'DESC']);
        $this->set('multi', $this->paginate($mult));
    }
    public function investigacion(){
        $investigacion = TableRegistry::get('bol_publicacion');
		    $inv = $investigacion->find()
        ->select(['cat'=>'b.Categoria','Titulo', 'Desarrollo','Imagen','Fecha','codigo_publicacion'])

        ->enableHydration(false)
        ->join([
            'c' => [
                'table' => 'bol_detalle_publicacion',
                'conditions' => [
                    'c.Cod_Publicacion = bol_publicacion.codigo_publicacion'
                ]
            ]
        ])
        ->join([
            'b' => [
                'table' => 'bol_categoria',
                'conditions' => [
                    'c.Cod_Categoria = b.codigo','c.Cod_Categoria = 10'
                ]
            ]
        ])
        ->where(['c.Estado ='=>'publicada'])
        ->order(['Fecha' => 'DESC']);
        $this->set('inv', $this->paginate($inv));

        $res = $investigacion->find();
        $res->select(['cat'=>'b.Categoria','Titulo', 'Desarrollo','Imagen','Fecha','codigo_publicacion'])
        ->distinct(['Titulo'])
        ->enableHydration(false)
        ->join([
            'c' => [
                'table' => 'bol_detalle_publicacion',
                'conditions' => [
                    'c.Cod_Publicacion = bol_publicacion.codigo_publicacion'
                ]
            ]
        ])
        ->join([
            'b' => [
                'table' => 'bol_categoria',
                'conditions' => [
                    'c.Cod_Categoria = b.codigo','c.Cod_Categoria != 10'
                ]
            ]
        ])
        ->where(['c.Estado ='=>'publicada'])
        ->order(['Fecha' => 'DESC'])
        ->limit(6);
        $this->set('bol', $this->paginate($res));
    } 

    public function docencia(){
        $investigacion = TableRegistry::get('bol_publicacion');
        $inv = $investigacion->find()
        ->select(['cat'=>'b.Categoria','Titulo', 'Desarrollo','Imagen','Fecha','codigo_publicacion'])
        ->enableHydration(false)
        ->join([
            'c' => [
                'table' => 'bol_detalle_publicacion',
                'conditions' => [
                    'c.Cod_Publicacion = bol_publicacion.codigo_publicacion'
                ]
            ]
        ])
        ->join([
            'b' => [
                'table' => 'bol_categoria',
                'conditions' => [
                    'c.Cod_Categoria = b.codigo','c.Cod_Categoria = 11'
                ]
            ]
        ])
        ->where(['c.Estado ='=>'publicada'])
        ->order(['Fecha' => 'DESC']);
        $this->set('doc', $this->paginate($inv));

        $res = $investigacion->find();
        $res->select(['cat'=>'b.Categoria','Titulo', 'Desarrollo','Imagen','Fecha','codigo_publicacion'])
        ->distinct(['Titulo'])
        ->enableHydration(false)
        ->join([
            'c' => [
                'table' => 'bol_detalle_publicacion',
                'conditions' => [
                    'c.Cod_Publicacion = bol_publicacion.codigo_publicacion'
                ]
            ]
        ])
        ->join([
            'b' => [
                'table' => 'bol_categoria',
                'conditions' => [
                    'c.Cod_Categoria = b.codigo'
                ]
            ]
        ])
        ->where(['c.Estado ='=>'publicada'])
        ->order(['Fecha' => 'DESC'])
        ->limit(6);
        $this->set('bol', $this->paginate($res));
    
    } 

    public function publicacion($codigo_publicacion = null){
      $userTable = TableRegistry::get('bol_publicacion');
      $publicacion = $userTable->find()->select(['codigo_publicacion','Titulo', 'Enlace','Imagen','Desarrollo','Fecha','Usuario','codigo_User','img'=>'ImgPerfil'])
        ->enableHydration(false)
        ->join([
            'r' => [
                'table' => 'bol_registro',
                'conditions' => [
                    'r.Cod_User = bol_publicacion.codigo_User'
                ]
            ]
        ])
      ->where(['codigo_publicacion' => $codigo_publicacion])->first();
      if(empty($publicacion)){
        return $this->redirect(array('controller' => 'Home', 'action' => 'index'));
      }
      $this->set('p', $publicacion);

    $res = $userTable->find();
        $res->select(['Titulo','codigo_publicacion'])
        ->distinct(['Titulo'])
        ->enableHydration(false)
        ->join([
            'c' => [
                'table' => 'bol_detalle_publicacion',
                'conditions' => [
                    'c.Cod_Publicacion = bol_publicacion.codigo_publicacion'
                ]
            ]
        ])
        ->where(['c.Estado ='=>'publicada'])
        ->order(['Fecha' => 'DESC'])
        ->limit(6);
        $this->set('bol', $this->paginate($res));

    } 

    public function contacto(){
        if ($this->request->is('post')) {
            $contacto = TableRegistry::get('bol_contacto');          
            $c = $contacto->newEntity();
            $c->Nombres  = $this->request->getData('nombres');
            $c->Ciudad   = $this->request->getData('ciudad');
            $c->Telefono = $this->request->getData('telefono');
            $c->Correo   = $this->request->getData('correo');
            $c->Mensaje  = $this->request->getData('mensaje');
            $c->Estado   = 1;
            if ($contacto->save($c)) {
                //$this->getMailer('bolRegistro')->send('bienvenido',[$usu]);
                $this->Flash->error('<div class="alert alert-success alert-dismissable">
                  ¡Muchas gracias! hemos recibido tu mensaje.
                </div>', [
                        'key' => 'contacto','escape' => false]);
                return $this->redirect(array('Controller'=>'Home','action' => 'contacto'));
            }else{
               $this->Flash->error('error', ['key' => 'registro',]);
            }
        }

    }

    public function internacionalizacion(){
       $publicacion = TableRegistry::get('bol_publicacion');
        $int = $publicacion->find()
        ->select(['cat'=>'b.Categoria','Titulo', 'Desarrollo','Imagen','Fecha','codigo_publicacion'])
        ->enableHydration(false)
        ->join([
            'c' => [
                'table' => 'bol_detalle_publicacion',
                'conditions' => [
                    'c.Cod_Publicacion = bol_publicacion.codigo_publicacion'
                ]
            ]
        ])
        ->join([
            'b' => [
                'table' => 'bol_categoria',
                'conditions' => [
                    'c.Cod_Categoria = b.codigo','c.Cod_Categoria = 12'
                ]
            ]
        ])
        ->where(['c.Estado ='=>'publicada'])
        ->order(['Fecha' => 'DESC']);
        
    $this->set('int', $this->paginate($int));

    $res = $publicacion->find();
        $res->select(['cat'=>'b.Categoria','Titulo', 'Desarrollo','Imagen','Fecha','codigo_publicacion'])
        ->distinct(['Titulo'])
        ->enableHydration(false)
        ->join([
            'c' => [
                'table' => 'bol_detalle_publicacion',
                'conditions' => [
                    'c.Cod_Publicacion = bol_publicacion.codigo_publicacion'
                ]
            ]
        ])
        ->join([
            'b' => [
                'table' => 'bol_categoria',
                'conditions' => [
                    'c.Cod_Categoria = b.codigo'
                ]
            ]
        ])
        ->where(['c.Estado ='=>'publicada'])
        ->order(['Fecha' => 'DESC'])
        ->limit(6);
        $this->set('bol', $this->paginate($res));

    }
}
