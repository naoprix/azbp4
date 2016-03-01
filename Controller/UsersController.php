<?php

////
// app/Controller/UsersController.php

class UsersController extends AppController {

    // public $helpers = array('Html', 'Form', 'Session');
    // public $components = array('Auth', 'Paginator', 'Session');
    // public $uses = array('User');

    public function beforeFilter() {
        parent::beforeFilter();
        // ユーザ自信による登録とログアウトを許可
        $this->Auth->allow('add', 'login', 'logout');
    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id) {

        if ($this->request->is('post')){
            if ($this->User->delete($id)) {
                $this->Session->setFlash(__('ユーザーを削除しました'));
                $this->redirect(array('action' => 'index'));
            }            
        }
        $this->Session->setFlash(__('ユーザーを削除できませんでした'));
        $this->redirect(array('action' => 'index'));
    }

	public function login() {
	    if ($this->request->is('post')) {
    	    if ($this->Auth->login()) {
                $this->redirect(array('controller'=>'Tops', 'action' =>'index'));
    	    } else {
    	        $this->Session->setFlash(__('Invalid username or password, try again'));
    	    }
    	}
	}

	public function logout() {
    	$this->redirect($this->Auth->logout());
	}

}