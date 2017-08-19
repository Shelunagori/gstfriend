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
        $purchaseVouchers = $this->paginate($this->PurchaseVouchers->find()->order(['PurchaseVouchers.id'=>'DESC']));

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
		$company_id=$this->Auth->User('company_id');
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
		
		$companies = $this->PurchaseVouchers->Companies->find()->where(['id' => $company_id]);
		
		$this->set(compact('cgst_per','sgst_per','companies'));
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
			//pr($purchaseVoucher);exit;
            if ($this->PurchaseVouchers->save($purchaseVoucher)) {

				if($purchaseVoucher->total_amount_after_tax !=0)
				{		
					$Accounting_entries = $this->PurchaseVouchers->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $purchaseVoucher->supplier_ledger_id;
					$Accounting_entries->debit = 0;
					$Accounting_entries->credit = $purchaseVoucher->total_amount_after_tax;
					$Accounting_entries->transaction_date = $purchaseVoucher->transaction_date;
					$Accounting_entries->purchase_voucher_id = $purchaseVoucher->id;
					$Accounting_entries->company_id=$company_id;
					$this->PurchaseVouchers->AccountingEntries->save($Accounting_entries);				
				}
				
				if($purchaseVoucher->total_amount_before_tax !=0)
				{		
					$Accounting_entries = $this->PurchaseVouchers->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $purchaseVoucher->purchase_ledger_id;
					$Accounting_entries->debit = $purchaseVoucher->total_amount_before_tax;
					$Accounting_entries->credit = 0;
					$Accounting_entries->transaction_date = $purchaseVoucher->transaction_date;
					$Accounting_entries->purchase_voucher_id = $purchaseVoucher->id;
					$Accounting_entries->company_id=$company_id;
					$this->PurchaseVouchers->AccountingEntries->save($Accounting_entries);				
				}				
			
				
				foreach($purchaseVoucher->purchase_voucher_rows as $purchase_voucher_row)
				{
					$Accounting_entries = $this->PurchaseVouchers->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $purchase_voucher_row->cgst_ledger_id;
					$Accounting_entries->debit = $purchase_voucher_row->cgst_amount;
					$Accounting_entries->credit = 0;
					$Accounting_entries->transaction_date = $purchaseVoucher->transaction_date;
					$Accounting_entries->purchase_voucher_id = $purchaseVoucher->id;
					$Accounting_entries->company_id=$company_id;
					$this->PurchaseVouchers->AccountingEntries->save($Accounting_entries);

					$Accounting_entries = $this->PurchaseVouchers->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $purchase_voucher_row->sgst_ledger_id;
					$Accounting_entries->debit = $purchase_voucher_row->sgst_amount;
					$Accounting_entries->credit = 0;
					$Accounting_entries->transaction_date = $purchaseVoucher->transaction_date;
					$Accounting_entries->purchase_voucher_id = $purchaseVoucher->id;
					$Accounting_entries->company_id=$company_id;
					$this->PurchaseVouchers->AccountingEntries->save($Accounting_entries);
					
				}

				$this->Flash->success(__('The purchase voucher has been saved.'));
				return $this->redirect(['action' => 'view/'.$invoice->id]);
            }
            $this->Flash->error(__('The purchase voucher could not be saved. Please, try again.'));
        }
		$items_datas = $this->PurchaseVouchers->Items->find()->where(['freezed'=>0]);
		
		
		foreach($items_datas as $items_data)
		{
			$items[]=['value'=>$items_data->id,'text'=>$items_data->name,'rate'=>$items_data->price,'cgst_ledger_id'=>$items_data->input_cgst_ledger_id,'sgst_ledger_id'=>$items_data->input_sgst_ledger_id,'igst_ledger_id'=>$items_data->input_igst_ledger_id];
		}
		
		
		
		
		
		$SupplierLedger = $this->PurchaseVouchers->SupplierLedger->find('list')->where(['accounting_group_id'=>25,'freeze'=>0]);
        $PurchaseLedger = $this->PurchaseVouchers->PurchaseLedger->find('list')->where(['accounting_group_id'=>13,'freeze'=>0]);
		
		$CgstTax = $this->PurchaseVouchers->CgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'CGST']);

		$SgstTax = $this->PurchaseVouchers->SgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'SGST']);		

		$IgstTax = $this->PurchaseVouchers->IgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'IGST']);
		
		//pr($IgstTax->toArray()); exit;
		
		

		$this->set(compact('purchaseVoucher', 'SupplierLedger','PurchaseLedger','items','CgstTax','SgstTax','IgstTax'));
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
            'contain' => ['PurchaseVoucherRows'=>['Items']]
        ]);
		$company_id=$this->Auth->User('company_id');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseVoucher = $this->PurchaseVouchers->patchEntity($purchaseVoucher, $this->request->getData());
            if ($this->PurchaseVouchers->save($purchaseVoucher)) {

				$query = $this->PurchaseVouchers->AccountingEntries->query();
				$query->delete()->where(['purchase_voucher_id'=> $id])->execute();

				if($purchaseVoucher->total_amount_after_tax !=0)
				{		
					$Accounting_entries = $this->PurchaseVouchers->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $purchaseVoucher->supplier_ledger_id;
					$Accounting_entries->debit = 0;
					$Accounting_entries->credit = $purchaseVoucher->total_amount_after_tax;
					$Accounting_entries->transaction_date = $purchaseVoucher->transaction_date;
					$Accounting_entries->purchase_voucher_id = $purchaseVoucher->id;
					$Accounting_entries->company_id=$company_id;
					$this->PurchaseVouchers->AccountingEntries->save($Accounting_entries);				
				}

				if($purchaseVoucher->total_amount_before_tax !=0)
				{		
					$Accounting_entries = $this->PurchaseVouchers->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $purchaseVoucher->purchase_ledger_id;
					$Accounting_entries->debit = $purchaseVoucher->total_amount_before_tax;
					$Accounting_entries->credit = 0;
					$Accounting_entries->transaction_date = $purchaseVoucher->transaction_date;
					$Accounting_entries->purchase_voucher_id = $purchaseVoucher->id;
					$Accounting_entries->company_id=$company_id;
					$this->PurchaseVouchers->AccountingEntries->save($Accounting_entries);				
				}				
				
				
				foreach($purchaseVoucher->purchase_voucher_rows as $purchase_voucher_row)
				{
					$Accounting_entries = $this->PurchaseVouchers->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $purchase_voucher_row->cgst_ledger_id;
					$Accounting_entries->debit = $purchase_voucher_row->cgst_amount;
					$Accounting_entries->credit = 0;
					$Accounting_entries->transaction_date = $purchaseVoucher->transaction_date;
					$Accounting_entries->purchase_voucher_id = $purchaseVoucher->id;
					$Accounting_entries->company_id=$company_id;
					$this->PurchaseVouchers->AccountingEntries->save($Accounting_entries);

					$Accounting_entries = $this->PurchaseVouchers->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $purchase_voucher_row->sgst_ledger_id;
					$Accounting_entries->debit = $purchase_voucher_row->sgst_amount;
					$Accounting_entries->credit = 0;
					$Accounting_entries->transaction_date = $purchaseVoucher->transaction_date;
					$Accounting_entries->purchase_voucher_id = $purchaseVoucher->id;
					$Accounting_entries->company_id=$company_id;
					$this->PurchaseVouchers->AccountingEntries->save($Accounting_entries);
					
				}		
				
                $this->Flash->success(__('The purchase voucher has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase voucher could not be saved. Please, try again.'));
        }
		$items = $this->PurchaseVouchers->Items->find('list')->where(['freezed'=>0]);
		$SupplierLedger = $this->PurchaseVouchers->SupplierLedger->find('list')->where(['accounting_group_id'=>25,'freeze'=>0]);
        $PurchaseLedger = $this->PurchaseVouchers->PurchaseLedger->find('list')->where(['accounting_group_id'=>13,'freeze'=>0]);
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
