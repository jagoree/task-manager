<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    
    /**
     * Called before every action. Check if Configure::read('useAuth') === false and thrown NotFoundException
     * 
     * @param \Cake\Event\Event $event
     * @throws \Cake\Http\Exception\NotFoundException
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        if (Configure::read('useAuth') === false) {
            throw new NotFoundException();
        }
    }
    
    /**
     * Log a user in
     * 
     * @return \Cake\Http\Response|null
     */
    public function login()
    {
        if ($this->Auth->user()) {
            return $this->redirect($this->Auth->redirectUrl());
        }
		if ($this->getRequest()->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->renderOrRedirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Wrong login or password'));
        }
    }
    
    /**
     * Log a user out
     * 
     * @return \Cake\Http\Response|null
     */
    public function logout()
    {
        if ($response = $this->renderOrRedirect($this->Auth->logout())) {
            return $response;
        }
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $query = $this->Users
                ->find()
                ->selectAllExcept($this->Users, ['password']);
        if ($this->Auth->user('id') != 1) {
            $query->where(['id <>' => 1]);
        }
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been added.'));
                return $this->renderOrRedirect(['action' => 'edit', $user->id]);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if ($this->Auth->user('id') != 1 && $id == 1) {
            return $this->redirect(['action' => 'index']);
        }
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
            if ($response = $this->renderOrRedirect()) {
                return $response;
            }
        }
        $user->unsetProperty('password');
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if ($this->Auth->user('id') != 1 && $id == 1) {
            return $this->redirect(['action' => 'index']);
        }
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        if ($response = $this->renderOrRedirect()) {
            return $response;
        }
    }
}
