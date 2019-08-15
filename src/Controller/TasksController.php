<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Routing\Router;

/**
 * Tasks Controller
 *
 * @property \App\Model\Table\TasksTable $Tasks
 *
 * @method \App\Model\Entity\Task[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TasksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $query = $this->Tasks->fetchRows($this->getRequest()->getQuery());
        $tasks = $this->paginate($query, ['limit' => 10]);

        $this->set(compact('tasks'));
    }

    /**
     * View method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $task = $this->Tasks->get($id, [
            'contain' => ['Tags']
        ]);

        $this->set('task', $task);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $task = $this->Tasks->newEntity();
        if ($this->request->is('post')) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
            $task->set('uuid', \Cake\Utility\Text::uuid());
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been added.'));
                return $this->renderOrRedirect(['action' => 'edit', $task->id]);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }
        $tags = $this->Tasks->Tags->find('list', ['limit' => 200]);
        $schema = $this->Tasks->getFieldSchema();
        $this->set(compact('task', 'tags', 'schema'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $task = $this->Tasks->get($id, [
            'contain' => ['Tags']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));
            } else {
                $this->Flash->error(__('The task could not be saved. Please, try again.'));
            }
            if ($response = $this->renderOrRedirect()) {
                return $response;
            }
        }
        $tags = $this->Tasks->Tags->find('list', ['limit' => 200]);
        $schema = $this->Tasks->getFieldSchema();
        $this->set(compact('task', 'tags', 'schema'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $task = $this->Tasks->get($id);
        if ($this->Tasks->delete($task)) {
            $this->Flash->success(__('The task has been deleted.'));
        } else {
            $this->Flash->error(__('The task could not be deleted. Please, try again.'));
        }
        if ($response = $this->renderOrRedirect()) {
            return $response;
        }
    }
}
