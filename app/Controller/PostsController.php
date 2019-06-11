<?php
// app/Controller/PostsController.php
class PostsController extends AppController {
    //ビューで$helpersプロパティを使うためにヘルパーの名前をコントローラの$helpers配列に追加
    //HtmlとFormはデフォルト
    public $helpers = array('Html', 'Form', 'Flash');
    //Flashコンポーネントを追加する
    public $components = array('Flash');

    //特定のコントロールアクションでだけヘルパーを使うように設定
    public function index() {
        //setメソッドでコントローラーからビューにデータを渡す
        //set(変数名, 実際の値)
        $this->set('posts', $this->Post->find('all'));

        //ログインユーザーの情報を取得
        $user = $this->Auth->user();
        //ビューに渡す
        $this->set('user', $user);
    }

    public function view($id) {
       if (!$id) {
           throw new NotFoundException(__('Invalid post'));
       }

        //Postモデルのメソッドを呼ぶ
       $post = $this->Post->findById($id);
       if (!$post) {
           throw new NotFoundException(__('Invalid post'));
       }
       $this->set('post', $post);
    }

    public function add() {
        if ($this->request->is('post')) {
            //Added this line
            $this->request->data['Post']['user_id'] = $this->Auth->user('id');
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Your post has been saved.'));
                //redirectの処理ではexitが実行されるのでそれ以降が実行されない
                //indexにリダイレクト
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Post->delete($id)) {
            $this->Flash->success(
                __('The post with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Flash->error(
                __('The post with id: %s could not be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'index'));

    }

    public function isAuthorized($user) {
        //登録ユーザーは投稿できる
        if ($this->action === 'add') {
            return true;
        }

        //投稿のオーナーは編集や削除ができる
        if (in_array($this->action, array('edit', 'delete'))) {
            $postId = (int) $this->request->params['pass'][0];
            if ($this->Post->isOwnedBy($postId, $user['id'])) {
                return true;
            } else {
                $this->Flash->error(__('You don\'t have permission.'));
                return $this->redirect(array('action' => 'index'));
            }
        }

        return parent::isAuthorized($user);
    }

}
?>
