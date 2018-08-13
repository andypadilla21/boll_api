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

class SuscriptorController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Auth', [
        'loginAction' => [  
            'controller' => 'Suscriptor',
            'action' => 'inbox',
            ],
        ]);
        $this->Auth->allow([]);
        $this->loadComponent('RequestHandler');
        //Contar en caso de que una publicación haya sido rechazada o necesite una correción
        $publicacion = TableRegistry::get('bol_publicacion');
        $cont = $publicacion->find('all')//Contar el número de solicitudes no atendidas
        ->select(['cant' => 'count(*)'])
        ->where(['Estado' => 'Corrección','codigo_User'=>$this->request->session()->read('Auth.User.Cod_User')]);
        foreach ($cont as $key) {
            $totalpub = $key['cant'];
           $this->set('c',$totalpub);
        }
    }

    public function index()
    {
        $suscriptor = $this->paginate($this->Suscriptor);
        $this->set(compact('suscriptor'));
        $this->set('_serialize', ['suscriptor']);
    }

    public function inbox(){

        $publicacion = TableRegistry::get('bol_publicacion');
        $pub = $publicacion->find()
        ->select(['Titulo', 'Desarrollo','Imagen','Fecha','Estado','codigo_publicacion','Usuario'])
        ->where(['codigo_User'=>$this->request->getSession()->read('Auth.User.Cod_User')])
        ->order(['Fecha' => 'DESC']);
        $this->set('bol',$this->paginate($pub));
    }

    public function publicacion($codigo_publicacion = null){
        $bol = TableRegistry::get('bol_categoria');
        $pub2 = $bol->find()->select(['Codigo', 'Categoria']);
        $this->set('bol', $pub2);

        $userTable = TableRegistry::get('bol_publicacion');
        $publicacion = $userTable->find()
        ->select(['codigo_User','Titulo', 'Desarrollo','Imagen','Fecha','Estado','codigo_publicacion','Usuario','Enlace'])
        ->where(['codigo_publicacion' => $codigo_publicacion])->first();
        if(empty($publicacion)){
           return $this->redirect(array('controller' => 'Editor', 'action' => 'inbox'));
        }
        $this->set('p', $publicacion);
    }

    public function contacto(){}

    public function editar(){
      if ($this->request->is('post')) {
        $foto = $this->request->getData['fotoperfil'];
           if($foto['type']=='image/jpeg' || $foto['type']=='image/gif' || $foto['type']=='image/png'){
                if( $foto['error'] == 0 &&  $foto['size'] > 0){
                    $name = $this->request->getSession()->read('Auth.User.Cod_User').'-'.$foto['name'];
                    $destino = WWW_ROOT.'img'.DS.'perfiles'.DS.$name;
                    $destinothumb = WWW_ROOT.'img'.DS.'perfiles'.DS.$name;
                    
                    if(move_uploaded_file($foto['tmp_name'], $destino)){   
                        list($ancho, $alto) = getimagesize($destino);
                        $nuevoAncho=250;
                        $nuevoAlto=250;
                        /**** abrir imagen******/
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
                        $thumbnail = imagecreatetruecolor($nuevoAncho, $nuevoAlto);  
                        imagecopyresampled($thumbnail , $imagen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        switch ($tipo){
                            case "image/jpeg":
                                imagejpeg($thumbnail, $destinothumb, 95); 
                                break;
                            case "image/jpg":
                                imagejpg($thumbnail, $destinothumb, 95); 
                                break;
                            case "image/gif":
                                imagegif($thumbnail, $destinothumb);
                                break;
                            case "image/png":
                                imagepng($thumbnail, $destinothumb, 9); 
                                break;
                        }
                        /*****************/
                        $userTable = TableRegistry::get('bol_registro');
                        $user = $userTable->get($this->request->getSession()->read('Auth.User.Cod_User'));
                        $user->ImgPerfil = $name;
                        $userTable->save($user);
                        $this->Auth->setUser($user);
                        $this->Flash->error('<div class="alert alert-success alert-dismissable">
                          Tus datos se han actualizado.
                          <button aria-hidden="true" getData-dismiss="alert" class="close" type="button"> × </button>
                        </div>', [
                                'key' => 'perfil','escape' => false]);
                    }
                    
                }
           }
            
        } 
    }

    public function multimedia(){
        $publicacion = TableRegistry::get('bol_multimedia');
           $pub = $publicacion->find()
            ->order(['Fecha' => 'DESC'])
            ->where(['Cod_User' => $this->request->getSession()->read('Auth.User.Cod_User')]);
            $this->set('bol',$this->paginate($pub));

        if ($this->request->is('post')) {
            $multimedia        = TableRegistry::get('bol_multimedia');
            $archivo           = $multimedia->newEntity();
            $archivo->Url_Link = $this->request->getData('Url_Link');
            $archivo->Cod_User = $this->request->getSession()->read('Auth.User.Cod_User');
            $archivo->Estado   = 'Recibido';
                if ($multimedia->save($archivo)) {
                  return $this->redirect(array('Controller'=>'Suscriptor','action' => 'multimedia'));
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
            return $this->redirect(['action' => 'Suscriptor','action'=>'multimedia']);
        }
    }

    public function editarpublicacion($codigo_publicacion = null){
        $bol = TableRegistry::get('bol_categoria');
        $pub2 = $bol->find()->select(['Codigo', 'Categoria']);
        $this->set('bol', $pub2);

        $userTable = TableRegistry::get('bol_publicacion');
        $publicacion = $userTable->find()
        ->select(['codigo_User','Titulo', 'Desarrollo','Imagen','Fecha','Estado','codigo_publicacion','Usuario','Enlace','Correccion'])
        ->hydrate(false)
        ->where(['codigo_publicacion' => $codigo_publicacion])->first();
        if(empty($publicacion)){
           return $this->redirect(array('controller' => 'Suscriptor', 'action' => 'inbox'));
        }
        $this->set('p',$publicacion);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $codusuario = $this->request->getData('codigo_User');
            $cod = $this->request->getData('codigo_publicacion');

            $pub = TableRegistry::get('bol_publicacion');
            $p = $pub->get($codigo_publicacion);
            $p->codigo_User = $codusuario;
            $p->Titulo     = $this->request->getData('Titulo');
            $p->Fecha      = strtotime("now");
            $p->Desarrollo =  $this->request->getData['Desarrollo'];
            $p->Imagen     = $this->request->getData('Imagen');
            $p->Enlace     = $this->request->getData('Enlace');
            $p->Usuario    = $this->request->getData('Usuario');
            $p->Estado     = 'Recibido';
            if ($pub->save($p)) {
                $detallePub   = TableRegistry::get('bol_detalle_publicacion');
                $query        = $detallePub->query();
                $query->update()
                ->set(['Estado' => Recibido])
                ->where(['Cod_Publicacion' => $cod])
                ->execute();
                return $this->redirect(['action' => 'Suscriptor','action'=>'inbox']);
            }
            $this->Flash->error(__('The bol publicacion could not be saved. Please, try again.'));
        }
    }//FIn editar

    public function crear()
    {
        $bol = TableRegistry::get('bol_categoria');
        $pub2 = $bol->find()->select(['Codigo', 'Categoria']);
        $this->set('bol', $pub2);

        if ($this->request->is('post')) {
            $desarrollo = $this->request->getData['Desarrollo'];
            $foto = $this->request->getData('Imagen');
           if($foto['type']=='image/jpeg' || $foto['type']=='image/gif' || $foto['type']=='image/png'){
                if( $foto['error'] == 0 &&  $foto['size'] > 0){
                    $name = $this->request->getSession()->read('Auth.User.Cod_User').'-'.$foto['name'];
                    $destino = WWW_ROOT.'img'.DS.$name;
                    $destinothumb = WWW_ROOT.'img'.DS.$name;
                    if(move_uploaded_file($foto['tmp_name'], $destino)){  
                        list($ancho, $alto) = getimagesize($destino);
                        $nuevoAncho=1280;
                        $nuevoAlto=682; 
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
                        switch ($tipo){
                            case "image/jpeg":
                                imagejpeg($thumbnail, $destinothumb, 95); 
                                break;
                            case "image/gif":
                                imagegif($thumbnail, $destinothumb);
                                break;
                            case "image/png":
                                imagepng($thumbnail, $destinothumb, 9); 
                                break;
                        }
                        /*****************/
                        $pub = TableRegistry::get('bol_publicacion');
                        $p = $pub->newEntity();
                        $p->codigo_User = $this->request->session()->read('Auth.User.Cod_User');
                        $p->Titulo     = $this->request->getData('Titulo');
                        $p->Desarrollo = $this->request->getData('Desarrollo');
                        $p->Imagen     = $name;
                        $p->Enlace     = $this->request->getData('Fuente');
                        $p->Usuario    = $this->request->getData('Usuario');
                        $p->Estado     = "Recibido";
                        if ($pub->save($p)) {
                            return $this->redirect(array('Controller'=>'BolPublicacion','action' => 'inbox'));
                        }
                    }
                    
                }
            }
            
        }
    }
}
