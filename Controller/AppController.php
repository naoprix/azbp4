<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	var $components = array(
		'DebugKit.Toolbar',//DebugKitをアクティブにした。2015－06－09
        'Session',
		////
		//CAKEPHP ブログチュートリアルより追加した。
        'Auth' => array(
            //'loginRedirect' => array(
            //    'controller' => 'posts',
            //    'action' => 'index'
            //),
            //'logoutRedirect' => array(
            //    'controller' => 'pages',
            //    'action' => 'display',
            //    'home'
            //),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                )
            ),
            //'authorize' => array('Controller') 
        )
    );

    public function beforeFilter() {
    	// どのページもindexとviewは閲覧できるらしい。
        $this->Auth->allow('index', 'view');
    }

    /*
    public function isAuthorized($user) {
    if (isset($user['role']) && $user['role'] === 'admin') {
        return true;
    }
    // デフォルトは拒否。Admin ユーザー以外は全員アクセスできない。
    return false;
    }*/

}

