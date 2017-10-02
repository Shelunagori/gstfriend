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
		$url=$this->request->here();
		$url=parse_url($url,PHP_URL_QUERY);
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id');
		$purchaseVoucher = $this->PurchaseVouchers->find()
		->contain(['Companies','SupplierLedger'=>['Suppliers'],'PurchaseLedger'=>['Customers'],'PurchaseVoucherRows'=>['CgstLedger','SgstLedger','IgstLedger','Items']])
		->where(['PurchaseVouchers.status' => 0,'PurchaseVouchers.company_id'=>$company_id,'PurchaseVouchers.status' => 0])->order(['PurchaseVouchers.id'=>'DESC']);
		$items = $this->PurchaseVouchers->Items->find('list')->where(['freezed'=>0,'company_id'=>$company_id,'status'=>0]);
        $purchaseVouchers = $this->paginate($purchaseVoucher);
		$SupplierLedger = $this->PurchaseVouchers->SupplierLedger->find('list')->where(['accounting_group_id'=>25,'freeze'=>0,'company_id'=>$company_id]);
		$this->set(compact('purchaseVouchers','SupplierLedger','items','url'));
        $this->set('_serialize', ['purchaseVouchers']);
		$this->set('active_menu', 'PurchaseVouchers.Index');
    }

	
	
	
	
	//generate index excel start
	 public function exportExcel()
    {
		$this->viewBuilder()->layout('');
		$company_id=$this->Auth->User('company_id');
		$purchaseVoucher = $this->PurchaseVouchers->find()
		->contain(['Companies','SupplierLedger'=>['Suppliers'],'PurchaseLedger'=>['Customers'],'PurchaseVoucherRows'=>['CgstLedger','SgstLedger','IgstLedger','Items']])
		->where(['PurchaseVouchers.status' => 0,'PurchaseVouchers.company_id'=>$company_id,'PurchaseVouchers.status' => 0])->order(['PurchaseVouchers.id'=>'DESC']);
		$items = $this->PurchaseVouchers->Items->find('list')->where(['freezed'=>0,'company_id'=>$company_id,'status'=>0]);
        $purchaseVouchers = $this->paginate($purchaseVoucher);
		$SupplierLedger = $this->PurchaseVouchers->SupplierLedger->find('list')->where(['accounting_group_id'=>25,'freeze'=>0,'company_id'=>$company_id]);
		$this->set(compact('purchaseVouchers','SupplierLedger','items'));
        $this->set('_serialize', ['purchaseVouchers']);
		$this->set('active_menu', 'PurchaseVouchers.Index');
	}
	//generate index excel end
	
	
	
	
	//item wise filter start
	function itemfilter($itemwise,$startdatefrom,$startdateto)
	{  
			$company_id=$this->Auth->User('company_id');
			$StartfilterDate = date('Y-m-d',strtotime($startdatefrom));
			$EndfilterDate = date('Y-m-d', strtotime($startdateto));
			$filterdatasitem = $this->PurchaseVouchers->find()
			->contain(['SupplierLedger'=>['Suppliers'],'PurchaseVoucherRows'=>function($q) use($itemwise){   
				return $q->where(['PurchaseVoucherRows.item_id'=>$itemwise])->contain(['CgstLedger','SgstLedger','IgstLedger','Items']);
				}])
					->where(['PurchaseVouchers.company_id'=>$company_id,'PurchaseVouchers.status' => 0,'PurchaseVouchers.transaction_date BETWEEN :start AND :end'])
					->bind(':start', $StartfilterDate, 'date')
					->bind(':end',   $EndfilterDate, 'date')
					->order(['PurchaseVouchers.id'=>'DESC'])
					->toArray();
			
		//pr($filterdatasitem);   exit;	
		$this->set(compact('filterdatasitem','itemwise','startdatefrom','startdateto'));
		
	}
	
	//item wise filter end
	
	//generate excel item wise start
	 public function itemWiseExcel($itemwise,$startdatefrom,$startdateto)
    {   
		
		$company_id=$this->Auth->User('company_id');
		$StartfilterDate = date('Y-m-d',strtotime($startdatefrom));
		$EndfilterDate = date('Y-m-d', strtotime($startdateto));
		$filterdatasitem = $this->PurchaseVouchers->find()
			->contain(['SupplierLedger'=>['Suppliers'],'PurchaseVoucherRows'=>function($q) use($itemwise){   
				return $q->where(['PurchaseVoucherRows.item_id'=>$itemwise])->contain(['CgstLedger','SgstLedger','IgstLedger','Items']);
				}])
					->where(['PurchaseVouchers.company_id'=>$company_id,'PurchaseVouchers.status' => 0,'PurchaseVouchers.transaction_date BETWEEN :start AND :end'])
					->bind(':start', $StartfilterDate, 'date')
					->bind(':end',   $EndfilterDate, 'date')
					->order(['PurchaseVouchers.id'=>'DESC'])
					->toArray();
			
		//pr($filterdatasitem);   exit;	
		$this->set(compact('filterdatasitem'));
		
	}
	
	//generate excel item wise  end
	
	
	
	
	
	
	
	
	
	
	function datewisereport($datefrom,$dateto)
	{
		$company_id=$this->Auth->User('company_id');
		$StartDate = date('Y-m-d',strtotime($datefrom));
		$EndDate = date('Y-m-d', strtotime($dateto));

		$reportdatas = $this->PurchaseVouchers->find()
		->where(['PurchaseVouchers.transaction_date BETWEEN :start AND :end','company_id'=>$company_id,'status'=>0])
		->bind(':start', $StartDate, 'date')
		->bind(':end',   $EndDate, 'date')
		->order(['PurchaseVouchers.id'=>'DESC']);
		
		$this->set(compact('reportdatas','datefrom','dateto'));
	}
	
	//generate excel date wise start
	 public function datewiseexcel($datefrom,$dateto)
    {   
		
		$company_id=$this->Auth->User('company_id');
		$StartDate = date('Y-m-d',strtotime($datefrom));
		$EndDate = date('Y-m-d', strtotime($dateto));

		$reportdatas = $this->PurchaseVouchers->find()
		->where(['PurchaseVouchers.transaction_date BETWEEN :start AND :end','company_id'=>$company_id,'status' => 0])
		->bind(':start', $StartDate, 'date')
		->bind(':end',   $EndDate, 'date')
		->order(['PurchaseVouchers.id'=>'DESC']);
		
		$this->set(compact('reportdatas'));
		
	}
	
	//generate excel date wise  end
	
	
	
	
	
	
	
	
	
	
	
	function filterreportsupplier($startdatefrom,$startdateto,$supplierfilter)
	{   
		$company_id=$this->Auth->User('company_id');
		$StartfilterDate = date('Y-m-d',strtotime($startdatefrom));
		$EndfilterDate = date('Y-m-d', strtotime($startdateto));
		
			$filterdatas = $this->PurchaseVouchers->find()
			->where(['PurchaseVouchers.transaction_date BETWEEN :start AND :end','supplier_ledger_id'=>$supplierfilter,'PurchaseVouchers.company_id'=>$company_id,'PurchaseVouchers.status' => 0])
			->bind(':start', $StartfilterDate, 'date')
			->bind(':end',   $EndfilterDate, 'date')
			->contain(['SupplierLedger'=>['Suppliers'],'PurchaseVoucherRows'=>['CgstLedger','SgstLedger','IgstLedger','Items']])
			->order(['PurchaseVouchers.id'=>'DESC']);
		
		$SupplierLedger = $this->PurchaseVouchers->SupplierLedger->find()->where(['accounting_group_id'=>25,'freeze'=>0,'company_id'=>$company_id]);
		
		$this->set(compact('filterdatas','SupplierLedger','startdatefrom','startdateto','supplierfilter'));
		
	}
	
	
	//Download excel customer wise start
	 public function supplierDateWise($startdatefrom,$startdateto,$supplierfilter)
    { 
		$this->viewBuilder()->layout('');
		$company_id=$this->Auth->User('company_id');
		$StartfilterDate = date('Y-m-d',strtotime($startdatefrom));
		$EndfilterDate = date('Y-m-d', strtotime($startdateto));
		
			$filterdatas = $this->PurchaseVouchers->find()
			->where(['PurchaseVouchers.transaction_date BETWEEN :start AND :end','supplier_ledger_id'=>$supplierfilter,'PurchaseVouchers.company_id'=>$company_id,'PurchaseVouchers.status' => 0])
			->bind(':start', $StartfilterDate, 'date')
			->bind(':end',   $EndfilterDate, 'date')
			->contain(['SupplierLedger'=>['Suppliers'],'PurchaseVoucherRows'=>['CgstLedger','SgstLedger','IgstLedger','Items']])
			->order(['PurchaseVouchers.id'=>'DESC']);
		
		$SupplierLedger = $this->PurchaseVouchers->SupplierLedger->find()->where(['accounting_group_id'=>25,'freeze'=>0,'company_id'=>$company_id]);
		
		$this->set(compact('filterdatas','SupplierLedger'));
	}
	//Download excel customer wise end
	
	
	
	
	
	
	
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
		$igst_per=[];
 		foreach($purchaseVoucher->purchase_voucher_rows as $purchase_voucher_row){
			if($purchase_voucher_row->cgst_ledger_id > 0){
				$cgst_per[$purchase_voucher_row->id]=$this->PurchaseVouchers->Ledgers->get(@$purchase_voucher_row->cgst_ledger_id);
			}
			else{ 
					$cgst_per[$purchase_voucher_row->id] = 0;
				}
			if($purchase_voucher_row->sgst_ledger_id > 0){
				$sgst_per[$purchase_voucher_row->id]=$this->PurchaseVouchers->Ledgers->get(@$purchase_voucher_row->sgst_ledger_id);
			}
			else{ 
					$sgst_per[$purchase_voucher_row->id] = 0; 
				}
			if($purchase_voucher_row->igst_ledger_id > 0){
				$igst_per[$purchase_voucher_row->id]=$this->PurchaseVouchers->Ledgers->get(@$purchase_voucher_row->igst_ledger_id);
			}
			else{
					$igst_per[$purchase_voucher_row->id] = 0;
				}
			
		}
		// Tax value show in view page end
		
		$companies = $this->PurchaseVouchers->Companies->find()->where(['id' => $company_id]);
		
		$this->set(compact('cgst_per','sgst_per','igst_per','companies'));
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
			$last_voucher=$this->PurchaseVouchers->find()->select(['voucher_no'])->where(['company_id'=>$company_id])->order(['voucher_no' => 'DESC'])->first();
			if($last_voucher){
				$purchaseVoucher->voucher_no=$last_voucher->voucher_no+1;
			}else{
				$purchaseVoucher->voucher_no=1;
			}
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
					
					$Accounting_entries = $this->PurchaseVouchers->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $purchase_voucher_row->igst_ledger_id;
					$Accounting_entries->debit = $purchase_voucher_row->igst_amount;
					$Accounting_entries->credit = 0;
					$Accounting_entries->transaction_date = $purchaseVoucher->transaction_date;
					$Accounting_entries->purchase_voucher_id = $purchaseVoucher->id;
					$Accounting_entries->company_id=$company_id;
					$this->PurchaseVouchers->AccountingEntries->save($Accounting_entries);
				}

				$this->Flash->success(__('The purchase voucher has been saved.'));
				return $this->redirect(['action' => 'view/'.$purchaseVoucher->id]);
            }
            $this->Flash->error(__('The purchase voucher could not be saved. Please, try again.'));
        }
		$items_datas = $this->PurchaseVouchers->Items->find()->where(['freezed'=>0,'company_id'=>$company_id]);
		
		
		foreach($items_datas as $items_data)
		{
			$items[]=['value'=>$items_data->id,'text'=>$items_data->name,'rate'=>$items_data->purchase_price,'cgst_ledger_id'=>$items_data->input_cgst_ledger_id,'sgst_ledger_id'=>$items_data->input_sgst_ledger_id,'igst_ledger_id'=>$items_data->input_igst_ledger_id];
		}
		
		
		$SupplierLedger = $this->PurchaseVouchers->SupplierLedger->find('list')->where(['accounting_group_id'=>25,'freeze'=>0,'company_id'=>$company_id]);
        $PurchaseLedger = $this->PurchaseVouchers->PurchaseLedger->find('list')->where(['accounting_group_id'=>13,'freeze'=>0,'company_id'=>$company_id]);
		
		$CgstTax = $this->PurchaseVouchers->CgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'CGST','company_id'=>$company_id]);

		$SgstTax = $this->PurchaseVouchers->SgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'SGST','company_id'=>$company_id]);		

		$IgstTax = $this->PurchaseVouchers->IgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'IGST','company_id'=>$company_id]);
		
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
			
			//pr($purchaseVoucher); exit;
			
            if ($this->PurchaseVouchers->save($purchaseVoucher)) {

				$query = $this->PurchaseVouchers->AccountingEntries->query();
				$query->delete()->where(['purchase_voucher_id'=> $id,'company_id'=>$company_id])->execute();

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

					$Accounting_entries = $this->PurchaseVouchers->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $purchase_voucher_row->igst_ledger_id;
					$Accounting_entries->debit = $purchase_voucher_row->igst_amount;
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
		
		$items_datas = $this->PurchaseVouchers->Items->find()->where(['freezed'=>0,'company_id'=>$company_id]);
		
		
		foreach($items_datas as $items_data)
		{
			$items[]=['value'=>$items_data->id,'text'=>$items_data->name,'rate'=>$items_data->purchase_price,'cgst_ledger_id'=>$items_data->input_cgst_ledger_id,'sgst_ledger_id'=>$items_data->input_sgst_ledger_id,'igst_ledger_id'=>$items_data->input_igst_ledger_id];
		}
		$SupplierLedger = $this->PurchaseVouchers->SupplierLedger->find('list')->where(['accounting_group_id'=>25,'freeze'=>0,'company_id'=>$company_id]);
        $PurchaseLedger = $this->PurchaseVouchers->PurchaseLedger->find('list')->where(['accounting_group_id'=>13,'freeze'=>0,'company_id'=>$company_id]);
		$CgstTax = $this->PurchaseVouchers->CgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'CGST','company_id'=>$company_id]);
		
		$SgstTax = $this->PurchaseVouchers->SgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'SGST','company_id'=>$company_id]);
		
		$IgstTax = $this->PurchaseVouchers->IgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'IGST','company_id'=>$company_id]);
		//pr($IgstTax->toArray()); exit;
        $this->set(compact('purchaseVoucher', 'SupplierLedger' , 'PurchaseLedger','items','CgstTax','SgstTax','IgstTax'));
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
		$company_id=$this->Auth->User('company_id');
		if ($this->request->is(['patch', 'post', 'put']))
		{
			$purchaseVoucher = $this->PurchaseVouchers->get($id);
			$query = $this->PurchaseVouchers->query();
				$query->update()
					->set(['status' => 1])
					->where(['id' => $id,'company_id'=>$company_id])
					->execute();
			
			if ($this->PurchaseVouchers->save($purchaseVoucher)) {
				
				$this->Flash->success(__('The purchase voucher has been deleted.'));
			} else {
				$this->Flash->error(__('The purchase voucher could not be deleted. Please, try again.'));
			}
		}
        return $this->redirect(['action' => 'index']);
    }
	
}
