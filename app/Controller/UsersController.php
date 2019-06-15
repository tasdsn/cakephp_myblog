<?php
//app/Controller/UsersController.php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        //ユーザー自身による登録とログアウトと編集を許可する
        $this->Auth->allow('add', 'logout', 'edit');
    }

    public function login() {
        //post送信があればtrue
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Flash->error(__('Invalid email or password, try again'));
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        //Userモデルのメソッドを呼ぶ 
        //ログインユーザーの情報を取得
        $login_user = $this->Auth->user();
        //ビューに渡す
        $user = $this->User->findById($id);
        if (!$user) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('user', $user);
        $this->set('login_user', $login_user);
    }

    public function add() {
        //post送信があるかどうか判定
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('controller' => 'posts', 'action' => 'index',));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        //ユーザーを取得
        $user = $this->User->findById($id);
        if (!$user) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('user', $user);

        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $login_user = $this->Auth->user();
        debug($login_user['id']);
        debug($user['User']['id']);
        if ($user['User']['id'] !== $login_user['id']) {
            $this->Flash->error(__('You don\'t have permission.'));
            return $this->redirect(array('controller' => 'users', 'action' => 'view', $id));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            
           
            //アップロードしたファイルの名前を取得します
            $img = $this->request->data['Document']['image']['name'];
            //アップロードしたファイルの拡張子を取得
            $extension = substr($img, strrpos($img, '.'));
            
            //拡張子でアップロードするか判断
            $check_array = array('.jpg', '.png', '.jpeg');
            if (!in_array($extension, $check_array)) {
                $this->Flash->error(__('No image'));
            }
            //ランダムな値を取得
            $name = (uniqid(mt_rand(), true)) . $extension;
            //保存先のパスを保存、WWW_ROOTはwebrootを示します。
            $path = WWW_ROOT . 'img/';
            $uploadfile = $path . $name;
            //tmpフォルダ
            $tmp = $this->request->data['Document']['image']['tmp_name'];
            if (!move_uploaded_file($tmp, $uploadfile)) {
                $this->Flash->error(__('Failed to save image file.'));
            }
            //フォームデータを保存したら画像の名前を保存
            if ($this->User->save($this->request->data)) {
                $this->User->set('image_name', $name);
                $this->User->save();
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('controller' => 'users', 'action' => 'view', $id));
            }
            
        } else {
            $this->request->data = $this->User->findById($id);
            //$this->request->data['keyword']で取得できる
            unset($this->request->data['User']['password']);
        }
    }
    
}

?>
