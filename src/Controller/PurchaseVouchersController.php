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
            'contain' => ['SupplierLedger'=>['Suppliers'],'PurchaseLedger'=>['Customers'],'Companies', 'AccountingEntries', 'PurchaseVoucherRows'=>['Items']]
        ]);
		//tax value show in view page start
 		$cgst_per=[];
		$sgst_per=[];
 		foreach($purchaseVoucher->purchase_voucher_rows as $purchase_voucher_row){
			if($purchase_voucher_row->cgst_ledger_id > 0){
				$cgst_per[$purchase_voucher_row->id]=$this->PurchaseVouchers->Ledgers->get(@$purchase_voucher_row->cgst_ledger_id);
			}
			if($purchase_voucher_row->sgst_ledger_id > 0){
				$sgst_per[$purchase_voucher_row->id]=$this->PurchaseVouchers->Ledgers->get(@$purchase_voucher_row->sgst_ledger_id);
			}
			
		}
		// Tax value show in view page end
		$this->set(compact('cgst_per','sgst_per'));
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
			//End Voucher Number
			$purchaseVoucher->company_id=$company_id;
			
			
            if ($this->PurchaseVouchers->save($purchaseVoucher)) {
				
				$this->Flash->success(__('The purchase voucher has been saved.'));
				return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The purchase voucher could not be saved. Please, try again.'));
        }
		$items = $this->PurchaseVouchers->Items->find('list');
		$itemmasters = $this->PurchaseVouchers->ItemMasters->find();
				    
	  	$item_fetchs = $this->PurchaseVouchers->Items->find()->contain(['ItemMasters']);
		$autofill=[];
        foreach($item_fetchs as $item_fetch){
			
            $item_name=$item_fetch->name;
				foreach($item_fetch->item_masters as $item_master){
            $price=$item_master->price;
            $cgst_ledger_id=$item_master->cgst_ledger_id;
            $sgst_ledger_id=$item_master->sgst_ledger_id;

            $autofill[]= ['value'=>$item_fetch->id,'item_id'=>$item_name,'rate' =>$price,'cgst_ledger_id'=>$cgst_ledger_id,'sgst_ledger_id'=>$sgst_ledger_id];
			
				}
        }
	  
	  
		$SupplierLedger = $this->PurchaseVouchers->SupplierLedger->find('list')->where(['accounting_group_id'=>25]);
        $PurchaseLedger = $this->PurchaseVouchers->PurchaseLedger->find('list')->where(['accounting_group_id'=>13]);
		
		$CgstTax = $this->PurchaseVouchers->CgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'CGST']);
		//pr($CgstTax->toArray()); exit;
		
		
		$SgstTax = $this->PurchaseVouchers->SgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'SGST']);
		$this->set(compact('purchaseVoucher', 'SupplierLedger','PurchaseLedger','items','CgstTax','SgstTax','itemmasters','item_fetchs'));
        $this->set('_serialize', ['purchaseVoucher']);
		$this->set('active_menu', 'PurchaseVouchers.Add');
    }
	
	public function getPurchaseVouchers($item_id=null){
	
    $data = $this->PurchaseVouchers->ItemMasters->find()->where(['item_id'=>$item_id]);
	pr( $data->toarray()); exit;
    if(count($data)>0){
        foreach($data as $key => $val) {
            echo "<option value=$key>$val</option>";
        }
		}else{
			echo "<option></option>"; // if the result is empty , show a select empty
		}
		
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
            'contain' => ['PurchaseVoucherRows'=>['Items']]
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseVoucher = $this->PurchaseVouchers->patchEntity($purchaseVoucher, $this->request->getData());
            if ($this->PurchaseVouchers->save($purchaseVoucher)) {
                $this->Flash->success(__('The purchase voucher has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase voucher could not be saved. Please, try again.'));
        }
		$items = $this->PurchaseVouchers->Items->find('list');
		$SupplierLedger = $this->PurchaseVouchers->SupplierLedger->find('list')->where(['accounting_group_id'=>25]);
        $PurchaseLedger = $this->PurchaseVouchers->PurchaseLedger->find('list')->where(['accounting_group_id'=>13]);
		$CgstTax = $this->PurchaseVouchers->CgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'CGST']);
		//pr($CgstTax->toArray()); exit;
		$SgstTax = $this->PurchaseVouchers->SgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'SGST']);
        $this->set(compact('purchaseVoucher', 'SupplierLedger' , 'PurchaseLedger','items','CgstTax','SgstTax'));
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
