<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\MailerAwareTrait; 

class CoordinadorController extends AppController
{
    var $paginate = [
        'limit' => 15,
        'order' => ['BolPublicacion.Fecha' => 'desc'],
        'group by' => ['BolPublicacion.Estado']
    ];
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Auth', [
            'authError' => 'Did you really think you are allowed to see that?',
            'storage' => 'Session'
            ]);
            $this->Auth->allow([]);
        /**
        * Si hay una sesión iniciada, no permite acceder desde la barra de dirección a otros roles.
        */
        if ($this->Auth->user('Rol') != 'Coordinador') {
            return $this->redirect(array('controller' => 'BolRegistro', 'action' => 'login'));
        }
        $this->loadComponent('RequestHandler');
        /**Contar el número de mensajes nuevos no leídos*/
        $contacto = TableRegistry::get('bol_contacto');
        $publicacion = TableRegistry::get('bol_publicacion');
        $contact = $contacto->find('all')
        ->select(['contador' => 'COUNT(*)'])
        ->where(['Estado' => 1]);
        foreach ($contact as $key) {
            $totalcont = $key['contador'];
            $this->set('num',$totalcont);
        }
        $cont = $publicacion->find('all')//Contar el número de solicitudes no atendidas
        ->select(['cant' => 'count(*)'])
        ->where(['Estado' => 'Recibido']);
        foreach ($cont as $key) {
            $totalpub = $key['cant'];
           $this->set('nump',$totalpub);
        }   
    }

    public function desactivar(){
        $userTable = TableRegistry::get('bol_registro');
          $user = $userTable->get($this->request->session()->read('Auth.User.Cod_User'));
          $user->Estado = 0;
          $userTable->save($user);
          $this->Auth->logout();
          $this->Flash->error('<div class="alert alert-danger alert-dismissable">Tu cuenta ha sido desactivada, ingresa para activar nuevamente</div>', [
                        'key' => 'desactivar','escape' => false]);  
        
        return $this->redirect(array('controller'=>'BolRegistro','action' => 'login'));  
    }

    public function contacto(){
      $contacto = TableRegistry::get('bol_contacto');
        $c = $contacto->find('all')
        ->order(['Fecha' => 'DESC']);
        $this->set('c',$c);
    }

    use MailerAwareTrait;
    public function mensaje($Id = null){
      $contacto = TableRegistry::get('bol_contacto');
        $p = $contacto->find('all')
        ->where(['Id' => $Id])->first();
        $p->Estado = 0;
        $contacto->save($p);
        $this->set('p',$p);

        if ($this->request->is('post')) {
            $tcont = TableRegistry::get('bol_contacto');
            $p = $tcont->get($Id);
            $p->Fecha_Resp = strtotime("now");
            $p->Respuesta = $this->request->getData('resp');
                if ($tcont->save($p)) {
                    $this->getMailer('bolRegistro')->send('respuesta',[$p]);
                  return $this->redirect(array('Controller'=>'Coordinador','action' => 'mensaje'));
                }
        }
        
    }

    public function enviadas(){
        $userTable = TableRegistry::get('bol_publicacion');
        $publicacion = $userTable->find()
        ->select(['cat'=>'b.Categoria','cod'=>'c.Cod_Publicacion','Titulo', 'Desarrollo','Imagen','Fecha','codigo_publicacion','Usuario','Enlace','Estado'])
        ->hydrate(false)
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
        ->where(['c.Cod_Usuario' => $this->request->session()->read('Auth.User.Cod_User')])
        ->distinct(['c.Cod_Publicacion'])
        ->order(['Fecha' => 'DESC']);
        $this->set('pub',$this->paginate($publicacion));
    }

    public function multimedia(){
        $publicacion = TableRegistry::get('bol_multimedia');
           $pub = $publicacion->find()
            ->order(['Fecha' => 'DESC'])
            ->where(['Cod_User' => $this->request->session()->read('Auth.User.Cod_User')]);
            $this->set('bol',$this->paginate($pub));

        if ($this->request->is('post')) {
            $multimedia = TableRegistry::get('bol_multimedia');
            $archivo = $multimedia->newEntity();
            $archivo->Url_Link = $this->request->getData('Url_Link');
            $archivo->Cod_User = $this->request->session()->read('Auth.User.Cod_User');
            $archivo->Estado = 'Recibido';
                if ($multimedia->save($archivo)) {
                  return $this->redirect(array('Controller'=>'Coordinador','action' => 'multimedia'));
                }
        }
    }

    public function borrarvideo(){
        if ($this->request->is('post') ){
            $cod = $this->request->getData('cod');
            $mult = TableRegistry::get('bol_multimedia');
            $query = $mult->query();
            $query->delete()
            ->where(['Codigo' => $cod])
            ->execute();
            return $this->redirect(['action' => 'Coordinador','action'=>'multimedia']);
        }
    }

    public function actualizarclave(){
      if ($this->request->is('post')) {
        $clave = $this->request->getData('password');
        $clave1 = $this->request->getData('password1');
        $userTable = TableRegistry::get('bol_registro');
        $user = $userTable->get($this->request->session()->read('Auth.User.Cod_User'));
          if(!empty($clave)){
            $c = hash('sha512', $clave, false);
            if($user->Password != $c){
             $this->Flash->error('<div class="alert alert-warning alert-dismissable">Tu clave es incorrecta, verifica e intenta nuevamente.</div>', ['key' => 'error','escape' => false]);
            return $this->redirect(array('Controller'=>'Coordinador','action' => 'editar'));
            }else{
              $user->Password = hash('sha512', $clave1, false);
              $user->confirmPassword = hash('sha512', $clave1, false);
              $userTable->save($user);
                $this->Flash->error('<div class="alert alert-success alert-dismissable">Tus datos se han actualizado.<button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button></div>', ['key' => 'perfil','escape' => false]);
            return $this->redirect(array('Controller'=>'Coordinador','action' => 'editar'));
            $this->Auth->setUser($user);  
            }
          }  
      }
    }

    public function editar(){
      if ($this->request->is('post')) {
        $foto = $this->request->getData('fotoperfil');
           if($foto['type']=='image/jpeg' || $foto['type']=='image/gif' || $foto['type']=='image/png'){
                if( $foto['error'] == 0 &&  $foto['size'] > 0){
                    $name = $this->request->session()->read('Auth.User.Cod_User').'.jpeg';
                    $destino = WWW_ROOT.'img'.DS.'perfiles'.DS.$name;
                    $destinothumb = WWW_ROOT.'img'.DS.'perfiles'.DS.$name;
                    
                    if(move_uploaded_file($foto['tmp_name'], $destino)){   
                        list($ancho, $alto) = getimagesize($destino);
                        $nuevoAncho=250;
                        $nuevoAlto=250;
                        $info = getimagesize($destino);
                        switch ($info["mime"]){
                            case "image/jpeg":
                                $imagen = imagecreatefromjpeg($destino);
                                break;
                            case "image/gif":
                                $imagen = imagecreatefromgif($destino);
                                break;
                            case "image/png":
                                $imagen = imagecreatefrompng($destino);
                                break;
                            default :
                                echo "Error: No es un tipo de imagen permitido.";
                        }
                        $tipo= $info["mime"];
                        /******/
                        $thumbnail = imagecreatetruecolor($nuevoAncho, $nuevoAlto);  
                        imagecopyresampled($thumbnail , $imagen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        /****guardar imagen *******/
                        switch ($tipo){
                            case "image/jpeg":
                                imagejpeg($thumbnail, $destinothumb, 95); // El 100 es la calidade de la imagen (entre 1 y 100. Con 100 sin compresion ni perdida de calidad.).
                                break;
                            case "image/jpg":
                                imagejpg($thumbnail, $destinothumb, 95); // El 100 es la calidade de la imagen (entre 1 y 100. Con 100 sin compresion ni perdida de calidad.).
                                break;
                            case "image/gif":
                                imagegif($thumbnail, $destinothumb);
                                break;
                            case "image/png":
                                imagepng($thumbnail, $destinothumb, 9); // El 9 es grado de compresion de la imagen (entre 0 y 9. Con 9 maxima compresion pero igual calidad.).
                                break;
                        }
                        /*****************/
                        $userTable = TableRegistry::get('bol_registro');
                        $user = $userTable->get($this->request->session()->read('Auth.User.Cod_User'));
                        $user->ImgPerfil = $name;
                        $userTable->save($user);
                        $this->Auth->setUser($user);
                        $this->Flash->error('<div class="alert alert-success alert-dismissable">
                          Tus datos se han actualizado.
                          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">                                     × </button>
                        </div>', [
                                'key' => 'perfil','escape' => false]);
                    }
                    
                }
           }
            
        } 
    }

    public function usuarios(){
        $reg = TableRegistry::get('bol_registro');
        $usu = $reg->find('all')
        ->where(['Estado' => 1]);
        $this->set('reg',$this->paginate($usu));
    }

    public function coordinador(){
        $publicacion = TableRegistry::get('bol_publicacion');
        $pub = $publicacion->find('all')
        ->hydrate(false)
        ->order(['Fecha' => 'DESC']);        
        $this->set('bol',$this->paginate($pub));
    }

    public function add(){
        $bol = TableRegistry::get('bol_categoria');
        $pub2 = $bol->find()->select(['Codigo', 'Categoria']);
        $this->set('bol', $pub2);

        $Table = TableRegistry::get('bol_publicacion');
        $publicacion = $Table->find()->select(['cod'=>'MAX(codigo_publicacion) + 1']);
        $this->set('p', $publicacion);
        if ($this->request->is('post')) {
            $categoria = $this->request->getData('Cod_Categoria');
            $cod = $this->request->getData('cod');
             /*****************/
            $pub = TableRegistry::get('bol_publicacion');
            $p = $pub->newEntity();
            $p->codigo_User = $this->request->session()->read('Auth.User.Cod_User');
            $p->Titulo = $this->request->getData('Titulo');
            $p->Fecha = strtotime("now");
            $p->Desarrollo = $this->request->getData('Desarrollo');
            $p->Enlace = $this->request->getData('Fuente');
            $p->Usuario = $this->request->getData('Usuario');
            $p->Estado = 'En Edición';
                if ($pub->save($p)) {
                    $detallePub = TableRegistry::get('bol_detalle_publicacion');
                        foreach ($categoria as $cate) {
                            $detalle = $detallePub->newEntity();
                            $detalle->Cod_Usuario = $this->request->session()->read('Auth.User.Cod_User');
                            $detalle->Cod_Publicacion = $cod;
                            $detalle->Cod_Categoria = $cate;
                            $detalle->Estado = 'En Edición';
                            $detalle->Fecha_Publicacion = strtotime("now");
                            $detallePub->save($detalle);
                        }
                $this->Flash->error('<div class="alert alert-success alert-dismissable">Se han guardado los cambios exitosamente, puedes seguir el estado de tu colaboración.</div>', ['key' => 'ex','escape' => false]);
                return $this->redirect(array('Controller'=>'Coordinador','action' => 'coordinador'));
                }
        }
                    
    }
            
    public function ver($codigo_publicacion = null){
        $bol = TableRegistry::get('bol_categoria');
        $pub2 = $bol->find()->select(['Codigo', 'Categoria']);
        $this->set('bol', $pub2);

        $userTable = TableRegistry::get('bol_publicacion');
        $publicacion = $userTable->find()
        ->select(['codigo_User','Titulo', 'Desarrollo','Imagen','Fecha','Estado','codigo_publicacion','Usuario','Enlace'])
        ->where(['codigo_publicacion' => $codigo_publicacion])->first();
        if(empty($publicacion)){
           return $this->redirect(array('controller' => 'Coordinador', 'action' => 'coordinador'));
        }
        $this->set('p', $publicacion);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $codusuario = $this->request->getData('codigo_User');
            $estado = $this->request->getData('Estado');
            $categoria = $this->request->getData('Cod_Categoria');
            $cod = $this->request->getData('codigo_publicacion');
            $correccion = $this->request->getData('Correccion');

            $pub = TableRegistry::get('bol_publicacion');
            $p = $pub->get($codigo_publicacion);
            $p->codigo_User = $codusuario;
            $p->Fecha = strtotime("now");
            $p->Estado = $estado;
            $p->Correccion = $correccion;
            if ($estado != 'Corrección' && $pub->save($p)) {
                $detallePub = TableRegistry::get('bol_detalle_publicacion');
                    foreach ($categoria as $cate) {
                        $detalle = $detallePub->newEntity();
                        $detalle->Cod_Usuario = $codusuario;
                        $detalle->Cod_Publicacion = $cod;
                        $detalle->Cod_Categoria = $cate;
                        $detalle->Estado = 'En Edicion';
                        $detalle->Fecha_Publicacion = strtotime("now");
                        $detallePub->save($detalle);
                    }
                return $this->redirect(['action' => 'Coordinador','action'=>'coordinador']);
            }else{
                $pub->save($p);
                return $this->redirect(['action' => 'Coordinador','action'=>'coordinador']);
                }
        }
    }//FIn editar   
}