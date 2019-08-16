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

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Routing\Router;

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

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        if (Configure::read('useAuth')) {
            $this->loadComponent('Auth', [
                'authenticate' => [
                    'Form' => [
                        'userModel' => 'Users',
                        'fields' => ['username' => 'login'],
                    //'finder' => 'adminAuth'
                    ]
                ],
                'ajaxLogin' => '../Users/login'
            ]);
        }
        $this->filterInputData();

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }
    
    /**
     * Checks AJAX-using by actions and make redirect or JSON serialized
     * 
     * @param array|string $url
     * @return \Cake\Http\Response|null Redirects to action
     */
    protected function renderOrRedirect($url = null)
    {
        $json = true;
        if (!$url) {
            $json = false;
            $url = ['action' => 'index'];
        }
        $request = $this->getRequest();
        if ($json && $request->is('ajax')) {
            $this->set([
                'url' => Router::url($url),
                '_serialize' => ['url']
            ]);
            return $this->RequestHandler->renderAs($this, 'json');
        }
        if ($request->is('ajax')) {
            if ($request->getParam('action') == 'delete') {
                $this->setAction('index');
            }
        } else {
            return $this->redirect($url);
        }
    }
    
    private function filterInputData()
    {
        $request = $this->getRequest();
        $data = [];
        if ($request->is(['post', 'put'])) {
            foreach ($request->getData() as $key => $value) {
                $data[$key] = $value;
                if (is_numeric($value) or ! is_scalar($value)) {
                    continue;
                }
                $data[$key] = trim(preg_replace('~\s{2,}~', ' ', preg_replace('~<[a-z0-9/]+>~i', ' ', $value)));
            }
            $this->setRequest($request->withParsedBody($data));
        }
    }

}
