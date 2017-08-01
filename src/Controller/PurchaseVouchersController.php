<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PurchaseVouchers Controller
 *
 * @property \App\Model\Table\PurchaseVouchersTable $PurchaseVouchers
 *
 * @method \App\Model\Entity\PurchaseVoucher[] paginate($object = null, array $settings = [])
 */
class PurchaseVouchersController extends AppController
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
            'contain' => [ 'Companies','SupplierLedger'=>['Suppliers'],'PurchaseLedger'=>['Customers']]
        ];
        $purchaseVouchers = $this->paginate($this->PurchaseVouchers);

        $this->set(compact('purchaseVouchers'));
        $this->set('_serialize', ['purchaseVouchers']);
		$this->set('active_menu', 'PurchaseVouchers.Index');
    }

    /**
     * View method
     *
     * @param string|null $id Purchase Voucher id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $purchaseVoucher = $this->PurchaseVouchers->get($id, [
            'contain' => ['SupplierLedger'=>['Suppliers'],'PurchaseLedger'=>['Customers'],'Companies', 'AccountingEntries', 'PurchaseVoucherRows']
        ]);

        $this->set('purchaseVoucher', $purchaseVoucher);
        $this->set('_serialize', ['purchaseVoucher']);
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
        $purchaseVoucher = $this->PurchaseVouchers->newEntity();
        if ($this->request->is('post')) {
						
            $purchaseVoucher = $this->PurchaseVouchers->patchEntity($purchaseVoucher, $this->request->getData());
			
			//Voucher Number Increment
			$last_voucher=$this->PurchaseVouchers->find()->select(['voucher_no'])->order(['voucher_no' => 'DESC'])->first();
			if($last_voucher){
				$purchaseVoucher->voucher_no=$last_voucher->voucher_no+1;
			}else{
				$purchaseVoucher->voucher_no=1;
			}
			
			$purchaseVoucher->company_id=$company_id;
			
            if ($this->PurchaseVouchers->save($purchaseVoucher)) {
				
				$this->Flash->success(__('The purchase voucher has been saved.'));
				return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The purchase voucher could not be saved. Please, try again.'));
        }
		$items = $this->PurchaseVouchers->Items->find('list');
       
        $SupplierLedger = $this->PurchaseVouchers->SupplierLedger->find('list')->where(['accounting_group_id'=>25]);
        $PurchaseLedger = $this->PurchaseVouchers->PurchaseLedger->find('list')->where(['accounting_group_id'=>13]);
		$this->set(compact('purchaseVoucher', 'SupplierLedger','PurchaseLedger','items'));
        $this->set('_serialize', ['purchaseVoucher']);
		$this->set('active_menu', 'PurchaseVouchers.Add');
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Voucher id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $purchaseVoucher = $this->PurchaseVouchers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseVoucher = $this->PurchaseVouchers->patchEntity($purchaseVoucher, $this->request->getData());
            if ($this->PurchaseVouchers->save($purchaseVoucher)) {
                $this->Flash->success(__('The purchase voucher has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase voucher could not be saved. Please, try again.'));
        }
        $ledgers = $this->PurchaseVouchers->Ledgers->find('list');
		$SupplierLedger = $this->PurchaseVouchers->SupplierLedger->find('list')->where(['accounting_group_id'=>25]);
        $PurchaseLedger = $this->PurchaseVouchers->PurchaseLedger->find('list')->where(['accounting_group_id'=>13]);
       
        $this->set(compact('purchaseVoucher', 'ledgers', 'SupplierLedger' , 'PurchaseLedger'));
        $this->set('_serialize', ['purchaseVoucher']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Voucher id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseVoucher = $this->PurchaseVouchers->get($id);
        if ($this->PurchaseVouchers->delete($purchaseVoucher)) {
            $this->Flash->success(__('The purchase voucher has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase voucher could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
