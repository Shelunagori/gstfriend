<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ItemDiscounts Controller
 *
 * @property \App\Model\Table\ItemDiscountsTable $ItemDiscounts
 *
 * @method \App\Model\Entity\ItemDiscount[] paginate($object = null, array $settings = [])
 */
class ItemDiscountsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
        $this->paginate = [
            'contain' => ['CustomerLedgers', 'Items']
        ];
        $itemDiscounts = $this->paginate($this->ItemDiscounts);

        $this->set(compact('itemDiscounts'));
        $this->set('_serialize', ['itemDiscounts']);
		$this->set('active_menu', 'ItemDiscounts.Index');
    }

    /**
     * View method
     *
     * @param string|null $id Item Discount id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $itemDiscount = $this->ItemDiscounts->get($id, [
            'contain' => ['CustomerLedgers', 'Items']
        ]);

        $this->set('itemDiscount', $itemDiscount);
        $this->set('_serialize', ['itemDiscount']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
        $itemDiscount = $this->ItemDiscounts->newEntity();
        if ($this->request->is('post')) {
            $itemDiscount = $this->ItemDiscounts->patchEntity($itemDiscount, $this->request->getData());
            if ($this->ItemDiscounts->save($itemDiscount)) {
                $this->Flash->success(__('The item discount has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item discount could not be saved. Please, try again.'));
        }
        $customerLedgers = $this->ItemDiscounts->CustomerLedgers->find()->where(['accounting_group_id'=>22]);
        $items = $this->ItemDiscounts->Items->find('list');
        $this->set(compact('itemDiscount', 'customerLedgers', 'items'));
        $this->set('_serialize', ['itemDiscount']);
		$this->set('active_menu', 'ItemDiscounts.Add');
    }
	


    /**
     * Edit method
     *
     * @param string|null $id Item Discount id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $itemDiscount = $this->ItemDiscounts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemDiscount = $this->ItemDiscounts->patchEntity($itemDiscount, $this->request->getData());
            if ($this->ItemDiscounts->save($itemDiscount)) {
                $this->Flash->success(__('The item discount has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item discount could not be saved. Please, try again.'));
        }
        $customerLedgers = $this->ItemDiscounts->CustomerLedgers->find('list')->where(['accounting_group_id'=>22]);
        $items = $this->ItemDiscounts->Items->find('list');
        $this->set(compact('itemDiscount', 'customerLedgers', 'items'));
        $this->set('_serialize', ['itemDiscount']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Item Discount id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemDiscount = $this->ItemDiscounts->get($id);
        if ($this->ItemDiscounts->delete($itemDiscount)) {
            $this->Flash->success(__('The item discount has been deleted.'));
        } else {
            $this->Flash->error(__('The item discount could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
