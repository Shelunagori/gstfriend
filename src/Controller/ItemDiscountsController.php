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
        $company_id=$this->Auth->User('company_id');
        $itemDiscount = $this->ItemDiscounts->Items->find()->where(['company_id'=>$company_id]);
		
		$itemDiscounts = $this->paginate($itemDiscount);
		
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
		$company_id=$this->Auth->User('company_id');
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
		$company_id=$this->Auth->User('company_id');
        $itemDiscount = $this->ItemDiscounts->newEntity();
		
        if ($this->request->is('post')) {
			
			$data=$this->request->data['item_discounts'];
			
			
			$item_ids=$this->request->data['item_ids'];
			
			//pr($data); exit;	
			$itemDiscount = $this->ItemDiscounts->newEntities($data);
			
			
			
			//Replace Data In Table Start
			$query = $this->ItemDiscounts->query();
			$query->delete()->where(['item_id'=> $item_ids])->execute();
			
			
			//Replace Data In Table End
            if ($this->ItemDiscounts->saveMany($itemDiscount)) 
			{
				
                $this->Flash->success(__('The item discount has been saved.'));

                return $this->redirect(['action' => 'Add']);
            }
            $this->Flash->error(__('The item discount could not be saved. Please, try again.'));
        }

        $items_datas = $this->ItemDiscounts->Items->find()->where(['freezed'=>0,'company_id'=>$company_id]);
			foreach($items_datas as $items_data)
			{
				$items[]=['value'=>$items_data->id,'text'=>$items_data->name,'rate'=>$items_data->price];
			}

		
        $this->set(compact('itemDiscount', 'customerLedgers', 'items','company_id'));
        $this->set('_serialize', ['itemDiscount']);
		$this->set('active_menu', 'ItemDiscounts.Add');
    }
	
	function getItemDiscount($item_id){
		$company_id=$this->Auth->User('company_id');
		$customerLedgers = $this->ItemDiscounts->CustomerLedgers->find()->where(['accounting_group_id'=>22,'freeze'=>0,'company_id'=>$company_id]);
		$itemDiscounts = $this->ItemDiscounts->find()->where(['item_id'=>$item_id,'company_id'=>$company_id]);
		$discount=[];
		foreach($itemDiscounts as $itemDiscount){
			$discount[$itemDiscount->customer_ledger_id]=$itemDiscount->discount;
		}
		
		$this->set(compact('customerLedgers','discount','company_id'));
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
		$company_id=$this->Auth->User('company_id');
        $itemDiscount = $this->ItemDiscounts->find()
		->contain(['CustomerLedgers','Items'])
		->where(['item_id'=>$id,'ItemDiscounts.company_id'=>$company_id]);

		//pr($itemDiscount->toArray());exit;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemDiscount = $this->ItemDiscounts->patchEntity($itemDiscount, $this->request->getData());
            if ($this->ItemDiscounts->saveMany($itemDiscount)) {
                $this->Flash->success(__('The item discount has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item discount could not be saved. Please, try again.'));
        }
        $customerLedgers = $this->ItemDiscounts->CustomerLedgers->find()->where(['accounting_group_id'=>22,'freezed'=>0,'company_id'=>$company_id]);
		
        $items = $this->ItemDiscounts->Items->find('list')->where(['freezed'=>0,'company_id'=>$company_id]);
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
		$company_id=$this->Auth->User('company_id');
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
