<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Invoices Controller
 *
 * @property \App\Model\Table\InvoicesTable $Invoices
 *
 * @method \App\Model\Entity\Invoice[] paginate($object = null, array $settings = [])
 */
class InvoicesController extends AppController
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
		
        $invoices = $this->paginate($this->Invoices->find()->where(['Invoices.company_id'=>$company_id,'status' => 0])->order(['Invoices.id'=>'DESC'])->contain(['CustomerLedgers']));
		$customerLedgers = $this->Invoices->CustomerLedgers->find('list')->where(['accounting_group_id'=>22,'freeze'=>0,'company_id'=>$company_id]);
		
        $this->set(compact('invoices','customerLedgers'));
        $this->set('_serialize', ['invoices']);
		$this->set('active_menu','Invoices.Index');
    }
	
	function datewiseinvoicereport($datefrom,$dateto)
	{
		$company_id=$this->Auth->User('company_id');
		$StartDate = date('Y-m-d',strtotime($datefrom));
		$EndDate = date('Y-m-d', strtotime($dateto));

		$reportdatas = $this->Invoices->find()
		->where(['Invoices.transaction_date BETWEEN :start AND :end','company_id'=>$company_id,'status' => 0])
		->bind(':start', $StartDate, 'date')
		->bind(':end',   $EndDate, 'date')
		->order(['Invoices.id'=>'DESC']);
	
		$this->set(compact('reportdatas'));
	}
	
	
	
	
	function filterreportcustomer($startdatefrom,$startdateto,$customername,$radioValue)
	{    
		$company_id=$this->Auth->User('company_id');
		$StartfilterDate = date('Y-m-d',strtotime($startdatefrom));
		$EndfilterDate = date('Y-m-d', strtotime($startdateto));
		
			$filterdatas = $this->Invoices->find()
			->where(['Invoices.transaction_date BETWEEN :start AND :end','customer_name'=>$customername,'company_id'=>$company_id,'invoicetype'=>$radioValue,'status' => 0])
			->bind(':start', $StartfilterDate, 'date')
			->bind(':end',   $EndfilterDate, 'date')
			->order(['Invoices.id'=>'DESC']);
		
		$this->set(compact('filterdatas'));
		
	}
	
	
	
	function filterreportcreditcustomer($startdatefrom,$startdateto,$radioValue,$cstmrUser)
	{  
		$company_id=$this->Auth->User('company_id');
	
		$StartfilterDate = date('Y-m-d',strtotime($startdatefrom));
		$EndfilterDate = date('Y-m-d', strtotime($startdateto));
		
			$filterdatas = $this->Invoices->find()
			->where(['Invoices.customer_ledger_id'=>$cstmrUser,'Invoices.company_id'=>$company_id,'Invoices.invoicetype'=>$radioValue])
			->where(['Invoices.transaction_date BETWEEN :start AND :end','Invoices.status' => 0])
			->bind(':start', $StartfilterDate, 'date')
			->bind(':end',   $EndfilterDate, 'date')
			->contain(['CustomerLedgers'=>['Customers']])
			->order(['Invoices.id'=>'DESC']);
		$customerLedgers = $this->Invoices->CustomerLedgers->find('list')->where(['accounting_group_id'=>22,'freeze'=>0,'company_id'=>$company_id]);
		
		$this->set(compact('filterdatas','customerLedgers'));
		
	}
	
    /**
     * View method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {	
		$company_id=$this->Auth->User('company_id');
		$this->viewBuilder()->layout('index_layout');
		
        $invoice = $this->Invoices->get($id, [
            'contain' => ['CustomerLedgers'=>['Customers'], 'SalesLedgers', 'InvoiceRows'=>['Items','TaxCGST','TaxSGST','TaxIGST']]
        ]);
		
		
		
		
		
		$companies = $this->Invoices->Companies->find()->where(['id' => $company_id]);
		//pr($invoice->toArray());exit;
        
		$this->set(compact('invoice','companies'));
		$this->set('invoice', $invoice);

        $this->set('_serialize', ['invoice']);
		
		
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
        $invoice = $this->Invoices->newEntity();
		$company_id=$this->Auth->User('company_id');
        if ($this->request->is('post')) {
            $invoice = $this->Invoices->patchEntity($invoice, $this->request->getData());
			
			//Invoice Number Increment
			$last_invoice=$this->Invoices->find()->select(['invoice_no'])->where(['company_id'=>$company_id])->order(['invoice_no' => 'DESC'])->first();
			if($last_invoice){
				$invoice->invoice_no=$last_invoice->invoice_no+1;
			}else{
				$invoice->invoice_no=1;
			} 
			$invoice->transaction_date = date('Y-m-d',strtotime($invoice->transaction_date));
			$invoice->delievery_date = date('Y-m-d',strtotime($invoice->delievery_date));
			$invoice->company_id=$company_id;
			if ($this->Invoices->save($invoice)) {
				
				if($invoice->invoicetype == 'Cash')
				{
					if($invoice->total_amount_after_tax !=0)
					{		
						$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
						$Accounting_entries->ledger_id = 29;
						$Accounting_entries->debit = $invoice->total_amount_after_tax;
						$Accounting_entries->credit = 0;
						$Accounting_entries->transaction_date = $invoice->transaction_date;
						$Accounting_entries->company_id=$company_id;
						$Accounting_entries->invoice_id = $invoice->id;
						$this->Invoices->AccountingEntries->save($Accounting_entries);				
					}					
				}
				else
				{
					if($invoice->total_amount_after_tax !=0)
					{		
						$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
						$Accounting_entries->ledger_id = $invoice->customer_ledger_id;
						$Accounting_entries->debit = $invoice->total_amount_after_tax;
						$Accounting_entries->credit = 0;
						$Accounting_entries->transaction_date = $invoice->transaction_date;
						$Accounting_entries->company_id=$company_id;
						$Accounting_entries->invoice_id = $invoice->id;
						$this->Invoices->AccountingEntries->save($Accounting_entries);				
					}					
				}
				
				if($invoice->total_amount_before_tax !=0)
				{		
					$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $invoice->sales_ledger_id;
					$Accounting_entries->debit = 0;
					$Accounting_entries->credit = $invoice->total_amount_before_tax;
					$Accounting_entries->transaction_date = $invoice->transaction_date;
					$Accounting_entries->company_id=$company_id;
					$Accounting_entries->invoice_id = $invoice->id;
					$this->Invoices->AccountingEntries->save($Accounting_entries);				
				}				
				
				
				foreach($invoice->invoice_rows as $invoice_row)
				{
					$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $invoice_row->cgst_rate;
					$Accounting_entries->debit = 0;
					$Accounting_entries->credit = $invoice_row->cgst_amount;
					$Accounting_entries->transaction_date = $invoice->transaction_date;
					$Accounting_entries->company_id=$company_id;
					$Accounting_entries->invoice_id = $invoice->id;
					$this->Invoices->AccountingEntries->save($Accounting_entries);

					$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $invoice_row->sgst_rate;
					$Accounting_entries->debit = 0;
					$Accounting_entries->credit = $invoice_row->sgst_amount;
					$Accounting_entries->transaction_date = $invoice->transaction_date;
					$Accounting_entries->company_id=$company_id;
					$Accounting_entries->invoice_id = $invoice->id;
					$this->Invoices->AccountingEntries->save($Accounting_entries);
					
					$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $invoice_row->igst_ledger_id;
					$Accounting_entries->debit = 0;
					$Accounting_entries->credit = $invoice_row->igst_amount;
					$Accounting_entries->transaction_date = $invoice->transaction_date;
					$Accounting_entries->company_id=$company_id;
					$Accounting_entries->invoice_id = $invoice->id;
					$this->Invoices->AccountingEntries->save($Accounting_entries);
					
				}
				
				
                //$this->Flash->success(__('The invoice has been saved.'));

                return $this->redirect(['action' => 'view/'.$invoice->id]);
            }
            $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
        }
        $customerLedgers = $this->Invoices->CustomerLedgers->find('list')->where(['accounting_group_id'=>22,'freeze'=>0,'company_id'=>$company_id]);
	
        $salesLedgers = $this->Invoices->SalesLedgers->find('list')->where(['accounting_group_id'=>14,'freeze'=>0,'company_id'=>$company_id]);
        $items_datas = $this->Invoices->InvoiceRows->Items->find()->where(['freezed'=>0,'company_id'=>$company_id]);
        $customer_discounts = $this->Invoices->InvoiceRows->Items->find()->where(['company_id'=>$company_id]);
	
		$tax_CGSTS = $this->Invoices->SalesLedgers->find()->where(['accounting_group_id'=>30,'gst_type'=>'CGST','company_id'=>$company_id]);
		
		foreach($tax_CGSTS as $tax_CGST)
		{
			$taxs_CGST[]=['value'=>$tax_CGST->id,'text'=>$tax_CGST->name,'tax_rate'=>$tax_CGST->tax_percentage];
		}		
		
		$tax_SGSTS = $this->Invoices->SalesLedgers->find()->where(['accounting_group_id'=>30,'gst_type'=>'SGST','company_id'=>$company_id]);
		
		foreach($tax_SGSTS as $tax_SGST)
		{
			$taxs_SGST[]=['value'=>$tax_SGST->id,'text'=>$tax_SGST->name,'tax_rate'=>$tax_SGST->tax_percentage];
		}		
		
		foreach($items_datas as $items_data)
		{
			$items[]=['value'=>$items_data->id,'hsncode'=>$items_data->hsn_code,'text'=>$items_data->name,'rate'=>$items_data->price,'cgst_ledger_id'=>$items_data->cgst_ledger_id,'sgst_ledger_id'=>$items_data->sgst_ledger_id,'igst_ledger_id'=>$items_data->igst_ledger_id];
		}

		
		$last_invoice=$this->Invoices->find()->where(['company_id'=>$company_id])->select(['invoice_no'])->order(['invoice_no' => 'DESC'])->first();
		if($last_invoice){
				$invoice_no=$last_invoice->invoice_no+1;
		}else{
				$invoice_no=1;
		} 

		$tax_IGSTS = $this->Invoices->SalesLedgers->find()->where(['accounting_group_id'=>30,'gst_type'=>'IGST','company_id'=>$company_id]);
		
		foreach($tax_IGSTS as $tax_IGST)
		{
			$taxs_IGST[]=['value'=>$tax_IGST->id,'text'=>$tax_IGST->name,'tax_rate'=>$tax_IGST->tax_percentage];
		}		
		
        $this->set(compact('invoice', 'customerLedgers', 'salesLedgers', 'items','taxs_CGST','taxs_SGST','invoice_no','taxs_IGST'));
        $this->set('_serialize', ['invoice']);
		$this->set('active_menu', 'Invoices.Add');
    }
	
	
	
	// addcash invoice start
	public function addcashinvoice()
    {
		$this->viewBuilder()->layout('index_layout');
        $invoice = $this->Invoices->newEntity();
		$company_id=$this->Auth->User('company_id');
        if ($this->request->is('post')) {
            $invoice = $this->Invoices->patchEntity($invoice, $this->request->getData());
			
			//Invoice Number Increment
			$last_invoice=$this->Invoices->find()->select(['invoice_no'])->where(['company_id'=>$company_id])->order(['invoice_no' => 'DESC'])->first();
			if($last_invoice){
				$invoice->invoice_no=$last_invoice->invoice_no+1;
			}else{
				$invoice->invoice_no=1;
			} 
			$invoice->transaction_date = date('Y-m-d',strtotime($invoice->transaction_date));
			$invoice->delievery_date = date('Y-m-d',strtotime($invoice->delievery_date));
			$invoice->company_id=$company_id;
			if ($this->Invoices->save($invoice)) {
				
				if($invoice->invoicetype == 'Cash')
				{
					if($invoice->total_amount_after_tax !=0)
					{		
						$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
						$Accounting_entries->ledger_id = 29;
						$Accounting_entries->debit = $invoice->total_amount_after_tax;
						$Accounting_entries->credit = 0;
						$Accounting_entries->transaction_date = $invoice->transaction_date;
						$Accounting_entries->company_id=$company_id;
						$Accounting_entries->invoice_id = $invoice->id;
						$this->Invoices->AccountingEntries->save($Accounting_entries);				
					}					
				}
				else
				{
					if($invoice->total_amount_after_tax !=0)
					{		
						$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
						$Accounting_entries->ledger_id = $invoice->customer_ledger_id;
						$Accounting_entries->debit = $invoice->total_amount_after_tax;
						$Accounting_entries->credit = 0;
						$Accounting_entries->transaction_date = $invoice->transaction_date;
						$Accounting_entries->company_id=$company_id;
						$Accounting_entries->invoice_id = $invoice->id;
						$this->Invoices->AccountingEntries->save($Accounting_entries);				
					}					
				}
				
				if($invoice->total_amount_before_tax !=0)
				{		
					$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $invoice->sales_ledger_id;
					$Accounting_entries->debit = 0;
					$Accounting_entries->credit = $invoice->total_amount_before_tax;
					$Accounting_entries->transaction_date = $invoice->transaction_date;
					$Accounting_entries->company_id=$company_id;
					$Accounting_entries->invoice_id = $invoice->id;
					$this->Invoices->AccountingEntries->save($Accounting_entries);				
				}				
				
				
				foreach($invoice->invoice_rows as $invoice_row)
				{
					$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $invoice_row->cgst_rate;
					$Accounting_entries->debit = 0;
					$Accounting_entries->credit = $invoice_row->cgst_amount;
					$Accounting_entries->transaction_date = $invoice->transaction_date;
					$Accounting_entries->company_id=$company_id;
					$Accounting_entries->invoice_id = $invoice->id;
					$this->Invoices->AccountingEntries->save($Accounting_entries);

					$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $invoice_row->sgst_rate;
					$Accounting_entries->debit = 0;
					$Accounting_entries->credit = $invoice_row->sgst_amount;
					$Accounting_entries->transaction_date = $invoice->transaction_date;
					$Accounting_entries->company_id=$company_id;
					$Accounting_entries->invoice_id = $invoice->id;
					$this->Invoices->AccountingEntries->save($Accounting_entries);
					
					$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $invoice_row->igst_ledger_id;
					$Accounting_entries->debit = 0;
					$Accounting_entries->credit = $invoice_row->igst_amount;
					$Accounting_entries->transaction_date = $invoice->transaction_date;
					$Accounting_entries->company_id=$company_id;
					$Accounting_entries->invoice_id = $invoice->id;
					$this->Invoices->AccountingEntries->save($Accounting_entries);
					
				}
				
				
                $this->Flash->success(__('The invoice has been saved.'));

                return $this->redirect(['action' => 'view/'.$invoice->id]);
            }
            $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
        }
        $customerLedgers = $this->Invoices->CustomerLedgers->find('list')->where(['accounting_group_id'=>22,'freeze'=>0,'company_id'=>$company_id]);
        $salesLedgers = $this->Invoices->SalesLedgers->find('list')->where(['accounting_group_id'=>14,'freeze'=>0,'company_id'=>$company_id]);
        $items_datas = $this->Invoices->InvoiceRows->Items->find()->where(['freezed'=>0,'company_id'=>$company_id,'status'=>0]);
        $customer_discounts = $this->Invoices->InvoiceRows->Items->find()->where(['company_id'=>$company_id]);
	
		$tax_CGSTS = $this->Invoices->SalesLedgers->find()->where(['accounting_group_id'=>30,'gst_type'=>'CGST','company_id'=>$company_id]);
		
		foreach($tax_CGSTS as $tax_CGST)
		{
			$taxs_CGST[]=['value'=>$tax_CGST->id,'text'=>$tax_CGST->name,'tax_rate'=>$tax_CGST->tax_percentage];
		}		
		
		$tax_SGSTS = $this->Invoices->SalesLedgers->find()->where(['accounting_group_id'=>30,'gst_type'=>'SGST','company_id'=>$company_id]);
		
		foreach($tax_SGSTS as $tax_SGST)
		{
			$taxs_SGST[]=['value'=>$tax_SGST->id,'text'=>$tax_SGST->name,'tax_rate'=>$tax_SGST->tax_percentage];
		}		
		
		foreach($items_datas as $items_data)
		{
			$items[]=['value'=>$items_data->id,'hsncode'=>$items_data->hsn_code,'text'=>$items_data->name,'rate'=>$items_data->price,'cgst_ledger_id'=>$items_data->cgst_ledger_id,'sgst_ledger_id'=>$items_data->sgst_ledger_id,'igst_ledger_id'=>$items_data->igst_ledger_id];
		}

		
		$last_invoice=$this->Invoices->find()->where(['company_id'=>$company_id])->select(['invoice_no'])->order(['invoice_no' => 'DESC'])->first();
		if($last_invoice){
				$invoice_no=$last_invoice->invoice_no+1;
		}else{
				$invoice_no=1;
		} 

		$tax_IGSTS = $this->Invoices->SalesLedgers->find()->where(['accounting_group_id'=>30,'gst_type'=>'IGST','company_id'=>$company_id]);
		
		foreach($tax_IGSTS as $tax_IGST)
		{
			$taxs_IGST[]=['value'=>$tax_IGST->id,'text'=>$tax_IGST->name,'tax_rate'=>$tax_IGST->tax_percentage];
		}		
		
        $this->set(compact('invoice', 'customerLedgers', 'salesLedgers', 'items','taxs_CGST','taxs_SGST','invoice_no','taxs_IGST'));
        $this->set('_serialize', ['invoice']);
		$this->set('active_menu', 'Invoices.CashAddInvoice');
    }
	// addcash invoice end
	
	
	
	
	function CustomerDiscount($customer_id,$item_id){
		$company_id=$this->Auth->User('company_id');
		$CustomerDiscounts = $this->Invoices->InvoiceRows->Items->ItemDiscounts->find()->where(['ItemDiscounts.customer_ledger_id'=>$customer_id,'ItemDiscounts.item_id'=>$item_id,'company_id'=>$company_id]);
		$CustomerDiscount = 0;
		if(!empty($CustomerDiscounts))
		{	
			foreach($CustomerDiscounts as $CustomerDis)
			{
				$CustomerDiscount = $CustomerDis->discount;
			}
		}
		else
		{
			$CustomerDiscount = 0;
		}
		 echo $CustomerDiscount; exit;
		
	}
	

    /**
     * Edit method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id');
        $invoice = $this->Invoices->get($id, [
            'contain' => ['InvoiceRows']
        ]);
		
		
		
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $invoice = $this->Invoices->patchEntity($invoice, $this->request->getData());
          
			$last_invoice=$this->Invoices->find()->where(['company_id'=>$company_id])->select(['invoice_no'])->order(['invoice_no' => 'DESC'])->first();
				if($last_invoice){
					$invoice->invoice_no=$last_invoice->invoice_no+1;
				}else{
					$invoice->invoice_no=1;
				} 
				$invoice->transaction_date = date('Y-m-d',strtotime($invoice->transaction_date));
				$invoice->delievery_date = date('Y-m-d',strtotime($invoice->delievery_date));
				
			if ($this->Invoices->save($invoice)) {
				
				if($invoice->invoicetype == 'Cash')
				{
					if($invoice->total_amount_after_tax !=0)
					{		
						$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
						$Accounting_entries->ledger_id = 29;
						$Accounting_entries->debit = $invoice->total_amount_after_tax;
						$Accounting_entries->credit = 0;
						$Accounting_entries->transaction_date = $invoice->transaction_date;
						$Accounting_entries->company_id=$company_id;
						$Accounting_entries->invoice_id = $invoice->id;
						$this->Invoices->AccountingEntries->save($Accounting_entries);				
					}					
				}
				else
				{
					if($invoice->total_amount_after_tax !=0)
					{		
						$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
						$Accounting_entries->ledger_id = $invoice->customer_ledger_id;
						$Accounting_entries->debit = $invoice->total_amount_after_tax;
						$Accounting_entries->credit = 0;
						$Accounting_entries->transaction_date = $invoice->transaction_date;
						$Accounting_entries->company_id=$company_id;
						$Accounting_entries->invoice_id = $invoice->id;
						$this->Invoices->AccountingEntries->save($Accounting_entries);				
					}					
				}
				
				if($invoice->total_amount_before_tax !=0)
				{		
					$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $invoice->sales_ledger_id;
					$Accounting_entries->debit = 0;
					$Accounting_entries->credit = $invoice->total_amount_before_tax;
					$Accounting_entries->transaction_date = $invoice->transaction_date;
					$Accounting_entries->company_id=$company_id;
					$Accounting_entries->invoice_id = $invoice->id;
					$this->Invoices->AccountingEntries->save($Accounting_entries);				
				}				
				
				
				foreach($invoice->invoice_rows as $invoice_row)
				{
					$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $invoice_row->cgst_rate;
					$Accounting_entries->debit = 0;
					$Accounting_entries->credit = $invoice_row->cgst_amount;
					$Accounting_entries->transaction_date = $invoice->transaction_date;
					$Accounting_entries->company_id=$company_id;
					$Accounting_entries->invoice_id = $invoice->id;
					$this->Invoices->AccountingEntries->save($Accounting_entries);

					$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $invoice_row->sgst_rate;
					$Accounting_entries->debit = 0;
					$Accounting_entries->credit = $invoice_row->sgst_amount;
					$Accounting_entries->transaction_date = $invoice->transaction_date;
					$Accounting_entries->company_id=$company_id;
					$Accounting_entries->invoice_id = $invoice->id;
					$this->Invoices->AccountingEntries->save($Accounting_entries);
					
				}
				
				
                $this->Flash->success(__('The invoice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
        }

        $customerLedgers = $this->Invoices->CustomerLedgers->find('list')->where(['accounting_group_id'=>22,'freeze'=>0,'company_id'=>$company_id]);
        $salesLedgers = $this->Invoices->SalesLedgers->find('list')->where(['accounting_group_id'=>14,'freeze'=>0,'company_id'=>$company_id]);
        $items_datas = $this->Invoices->InvoiceRows->Items->find()->where(['freezed'=>0,'company_id'=>$company_id]);
		
		foreach($items_datas as $items_data)
		{
			$items[]=['value'=>$items_data->id,'text'=>$items_data->name,'rate'=>$items_data->price,'cgst_ledger_id'=>$items_data->cgst_ledger_id,'sgst_ledger_id'=>$items_data->sgst_ledger_id,'igst_ledger_id'=>$items_data->igst_ledger_id];
		}
			
        $customer_discounts = $this->Invoices->InvoiceRows->Items->find()->where(['company_id'=>$company_id]);
	
		$tax_CGSTS = $this->Invoices->SalesLedgers->find()->where(['accounting_group_id'=>30,'gst_type'=>'CGST','company_id'=>$company_id]);
		
		foreach($tax_CGSTS as $tax_CGST)
		{
			$taxs_CGST[]=['value'=>$tax_CGST->id,'text'=>$tax_CGST->name,'tax_rate'=>$tax_CGST->tax_percentage];
		}		
		
		$tax_SGSTS = $this->Invoices->SalesLedgers->find()->where(['accounting_group_id'=>30,'gst_type'=>'SGST','company_id'=>$company_id]);
		
		foreach($tax_SGSTS as $tax_SGST)
		{
			$taxs_SGST[]=['value'=>$tax_SGST->id,'text'=>$tax_SGST->name,'tax_rate'=>$tax_SGST->tax_percentage];
		}		
		
		


		$last_invoice=$this->Invoices->find()->where(['company_id'=>$company_id])->select(['invoice_no'])->order(['invoice_no' => 'DESC'])->first();
		if($last_invoice){
				$invoice_no=$last_invoice->invoice_no+1;
		}else{
				$invoice_no=1;
		} 

		$tax_IGSTS = $this->Invoices->SalesLedgers->find()->where(['accounting_group_id'=>30,'gst_type'=>'IGST','company_id'=>$company_id]);
		
		foreach($tax_IGSTS as $tax_IGST)
		{
			$taxs_IGST[]=['value'=>$tax_IGST->id,'text'=>$tax_IGST->name,'tax_rate'=>$tax_IGST->tax_percentage];
		}		
		
		//pr($taxs_IGST); exit;
        $this->set(compact('invoice', 'customerLedgers', 'salesLedgers', 'items','taxs_CGST','taxs_SGST','invoice_no','taxs_IGST'));
        $this->set('_serialize', ['invoice']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$company_id=$this->Auth->User('company_id');
		if ($this->request->is(['patch', 'post', 'put']))
		{
			$invoice = $this->Invoices->get($id);
			$query = $this->Invoices->query();
				$query->update()
					->set(['status' => 1])
					->where(['id' => $id,'company_id'=>$company_id])
					->execute();
			if ($this->Invoices->save($invoice)) {
				
				$this->Flash->success(__('The invoice has been deleted.'));
			} else {
				$this->Flash->error(__('The invoice could not be deleted. Please, try again.'));
			}
		}
        return $this->redirect(['action' => 'index']);
    }
}
