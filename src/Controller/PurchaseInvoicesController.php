<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PurchaseInvoices Controller
 *
 * @property \App\Model\Table\PurchaseInvoicesTable $PurchaseInvoices
 *
 * @method \App\Model\Entity\PurchaseInvoice[] paginate($object = null, array $settings = [])
 */
class PurchaseInvoicesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
        $purchaseInvoices = $this->paginate($this->PurchaseInvoices->find()->where(['status' => 0]));

        $this->set(compact('purchaseInvoices'));
        $this->set('_serialize', ['purchaseInvoices']);
		$this->set('active_menu', 'PurchaseInvoices.Index');
    }
	
	//Report Generate Function Start
	function datewisereport($datefrom,$dateto)
	{
		$StartDate = date('Y-m-d',strtotime($datefrom));
		$EndDate = date('Y-m-d', strtotime($dateto));

		$reportdatas = $this->PurchaseInvoices->find()
		->where(['PurchaseInvoices.transaction_date BETWEEN :start AND :end' ])
		->bind(':start', $StartDate, 'date')
		->bind(':end',   $EndDate, 'date')
		->order(['PurchaseInvoices.id'=>'DESC']);
		
		$this->set(compact('reportdatas'));
	}
	
	//Report Generate Function End

    /**
     * View method
     *
     * @param string|null $id Purchase Invoice id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id');
        $purchaseInvoice = $this->PurchaseInvoices->get($id, [
            'contain' => ['SupplierLedger'=>['Suppliers'],'PurchaseLedger'=>['Customers'],'Companies',  'PurchaseInvoiceRows']
        ]);
		$cgst_per=[];
		$sgst_per=[];
		$igst_per=[];
 		foreach($purchaseInvoice->purchase_invoice_rows as $purchase_invoice_row){
			if($purchase_invoice_row->cgst_ledger_id > 0){
				$cgst_per[$purchase_invoice_row->id]=$this->PurchaseInvoices->Ledgers->get(@$purchase_invoice_row->cgst_ledger_id);
			}
			else{ 
					$cgst_per[$purchase_invoice_row->id] = 0;
				}
			if($purchase_invoice_row->sgst_ledger_id > 0){
				$sgst_per[$purchase_invoice_row->id]=$this->PurchaseInvoices->Ledgers->get(@$purchase_invoice_row->sgst_ledger_id);
			}
			else{ 
					$sgst_per[$purchase_invoice_row->id] = 0; 
				}
			if($purchase_invoice_row->igst_ledger_id > 0){
				$igst_per[$purchase_invoice_row->id]=$this->PurchaseInvoices->Ledgers->get(@$purchase_invoice_row->igst_ledger_id);
			}
			else{
					$igst_per[$purchase_invoice_row->id] = 0;
				}
			
		}
		// Tax value show in view page end
		
		$companies = $this->PurchaseInvoices->Companies->find()->where(['id' => $company_id]);
		
		$this->set(compact('cgst_per','sgst_per','igst_per','companies'));
        $this->set('purchaseInvoice', $purchaseInvoice);
        $this->set('_serialize', ['purchaseInvoice']);
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
		$purchaseInvoice = $this->PurchaseInvoices->newEntity();
        if ($this->request->is('post')) {
            $purchaseInvoice = $this->PurchaseInvoices->patchEntity($purchaseInvoice, $this->request->getData());
			$purchaseInvoice->transaction_date = date('Y-m-d',strtotime($purchaseInvoice->transaction_date));
			$purchaseInvoice->company_id = $company_id;
			//pr($purchaseInvoice->purchase_invoice_others);  exit;
			
			foreach($purchaseInvoice->purchase_invoice_others as $purchase_invoice_row)
			{
				
				$taxtypes[] = $this->PurchaseInvoices->TaxTypes->TaxTypeRows->find()
				->where(['tax_type_id'=>$purchase_invoice_row['tax_type_id']])->toArray();

				
				foreach($taxtypes as $taxtype)
				{   
					foreach($taxtype as $key => &$taxtyp)
					{	if($purchase_invoice_row['tax_type_id'] == $taxtyp->tax_type_id)
						{
							$taxtyp['tax_amount'] = $purchase_invoice_row['tax_amount'];
						}
						
					}
				}	
			}
			
			//pr($taxtypes);exit;
			
			foreach($taxtypes as $taxtype)
			{
				foreach($taxtype as $taxtyp)
				{
				
				 $input_gst_ids[] = $this->PurchaseInvoices->Ledgers->find()
				->where(['name'=>$taxtyp->tax_type_name,'accounting_group_id'=>29])->toArray(); 

					foreach($input_gst_ids as $input_gst_id_data)
					{
						foreach($input_gst_id_data as $key => &$input_gst_id)
						{
							 if($taxtyp->tax_type_name == $input_gst_id->name)
							{
								$input_gst_id['tax_amount'] = $taxtyp->tax_amount;
							} 
						}						
					}							

				}
			}
			
			//pr($input_gst_ids); exit;
			unset($purchaseInvoice->purchase_invoice_others);
			$purchaseInvoice->purchase_invoice_others = array();
			if(!empty($input_gst_ids))
			{
				foreach($input_gst_ids as $input_gst_id_data)
				{
					foreach($input_gst_id_data as $input_gst_id)
					{
						if($input_gst_id->gst_type == 'CGST')
						{
							$cgst_amount = $input_gst_id->tax_amount/2;
							$purchaseInvoice['purchase_invoice_others'][]['CGST'] = ['cgst_ledger_id' =>$input_gst_id->id,'cgst_amount'=>$cgst_amount];
						}

						if($input_gst_id->gst_type == 'SGST')
						{
							$sgst_amount = $input_gst_id->tax_amount/2;
							$purchaseInvoice['purchase_invoice_others'][]['SGST'] = ['sgst_ledger_id' =>$input_gst_id->id,'sgst_amount'=>$sgst_amount];
						}
						
						if($input_gst_id->gst_type == 'IGST')
						{
							$igst_amount = $input_gst_id->tax_amount;
							$purchaseInvoice['purchase_invoice_others'][]['IGST'] = ['igst_ledger_id' =>$input_gst_id->id,'igst_amount'=>$igst_amount];
						}						
					}
				}
			}
				
		//pr($purchaseInvoice->purchase_invoice_others); exit;
            if ($this->PurchaseInvoices->save($purchaseInvoice)) {
			
			foreach($purchaseInvoice->purchase_invoice_others as $purchase_invoice_other_data)
			{ 
			foreach($purchase_invoice_other_data as $key => $purchase_invoice_other)	
			{	
				if($key == 'CGST')
				{
					$query_insert = $this->PurchaseInvoices->PurchaseInvoiceRows->query();
					$query_insert->insert(['cgst_ledger_id','cgst_amount','purchase_invoice_id'])
					->values([
						'cgst_ledger_id' => $purchase_invoice_other['cgst_ledger_id'],
						'cgst_amount' => $purchase_invoice_other['cgst_amount'],
						'purchase_invoice_id' => $purchaseInvoice->id
					]);
					$query_insert->execute();
					
					
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_voucher_id','company_id'])
					->values([
						'ledger_id'=>$purchase_invoice_other['cgst_ledger_id'],
						'debit'=>$purchase_invoice_other['cgst_amount'],
						'credit'=>0,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_voucher_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();					
				}

				if($key == 'SGST')
				{
					$query_insert = $this->PurchaseInvoices->PurchaseInvoiceRows->query();
					$query_insert->insert(['sgst_ledger_id','sgst_amount','purchase_invoice_id'])
					->values([
						'sgst_ledger_id' => $purchase_invoice_other['sgst_ledger_id'],
						'sgst_amount' => $purchase_invoice_other['sgst_amount'],
						'purchase_invoice_id' => $purchaseInvoice->id
					]);
					$query_insert->execute();
					
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_voucher_id','company_id'])
					->values([
						'ledger_id'=>$purchase_invoice_other['sgst_ledger_id'],
						'debit'=>$purchase_invoice_other['sgst_amount'],
						'credit'=>0,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_voucher_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();		
					
				}
				if($key == 'IGST')
				{
					$query_insert = $this->PurchaseInvoices->PurchaseInvoiceRows->query();
					$query_insert->insert(['igst_ledger_id','igst_amount','purchase_invoice_id'])
					->values([
						'igst_ledger_id' => $purchase_invoice_other['igst_ledger_id'],
						'igst_amount' => $purchase_invoice_other['igst_amount'],
						'purchase_invoice_id' => $purchaseInvoice->id
					]);
					$query_insert->execute();
					
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_voucher_id','company_id'])
					->values([
						'ledger_id'=>$purchase_invoice_other['igst_ledger_id'],
						'debit'=>$purchase_invoice_other['igst_amount'],
						'credit'=>0,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_voucher_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();		
				}			
			}	
			} 
			
				if($purchaseInvoice->total !=0)
				{		
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_voucher_id','company_id'])
					->values([
						'ledger_id'=>$purchaseInvoice->supplier_ledger_id,
						'debit'=>0,
						'credit'=>$purchaseInvoice->total,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_voucher_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();							
					
					
				}
				
				if($purchaseInvoice->base_amount !=0)
				{		
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_voucher_id','company_id'])
					->values([
						'ledger_id'=>$purchaseInvoice->purchase_ledger_id,
						'debit'=>$purchaseInvoice->base_amount,
						'credit'=>0,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_voucher_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();	
				}				
				
                $this->Flash->success(__('The purchase invoice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase invoice could not be saved. Please, try again.'));
        }
		$SupplierLedger = $this->PurchaseInvoices->SupplierLedger->find('list')->where(['accounting_group_id'=>25,'freeze'=>0]);
        $PurchaseLedger = $this->PurchaseInvoices->PurchaseLedger->find('list')->where(['accounting_group_id'=>13,'freeze'=>0]);
		
		$CgstTax = $this->PurchaseInvoices->CgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'CGST']);
		
		$SgstTax = $this->PurchaseInvoices->SgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'SGST']);
		
		$taxtypes = $this->PurchaseInvoices->TaxTypes->find('list');
		
        $this->set(compact('purchaseInvoice','SupplierLedger','PurchaseLedger','CgstTax','SgstTax','taxtypes'));
        $this->set('_serialize', ['purchaseInvoice']);
		$this->set('active_menu', 'PurchaseInvoices.Add');
    }


    /**
     * Edit method
     *
     * @param string|null $id Purchase Invoice id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id');
        $purchaseInvoice = $this->PurchaseInvoices->get($id, [
            'contain' => ['PurchaseInvoiceRows']
        ]);
		//pr($purchaseInvoice);exit;
		//fetch data from database start	
			foreach($purchaseInvoice->purchase_invoice_rows as $purchaseInvoic)
			{
				
				$cgsttaxtypes[] = $this->PurchaseInvoices->Ledgers->find()
				->where(['id'=>$purchaseInvoic['cgst_ledger_id'],'accounting_group_id'=>29])->toArray();
				$sgsttaxtypes[] = $this->PurchaseInvoices->Ledgers->find()
				->where(['id'=>$purchaseInvoic['sgst_ledger_id'],'accounting_group_id'=>29])->toArray();
				$igsttaxtypes[] = $this->PurchaseInvoices->Ledgers->find()
				->where(['id'=>$purchaseInvoic['igst_ledger_id'],'accounting_group_id'=>29])->toArray();
				
				
				foreach($cgsttaxtypes as $cgsttaxtype)
				{   
					foreach($cgsttaxtype as $key => &$cgsttaxtyp)
					{	if($purchaseInvoic['cgst_ledger_id'] == $cgsttaxtyp->id)
						{
							$cgsttaxtyp['cgsttax_amount'] = $purchaseInvoic['cgst_amount'];
						}
						
					}
				}	
				foreach($sgsttaxtypes as $sgsttaxtype)
				{   
					foreach($sgsttaxtype as $key => &$sgsttaxtyp)
					{	if($purchaseInvoic['sgst_ledger_id'] == $sgsttaxtyp->id)
						{
							$sgsttaxtyp['sgsttax_amount'] = $purchaseInvoic['sgst_amount'];
						}
						
					}
				}
				foreach($igsttaxtypes as $igsttaxtype)
				{   
					foreach($igsttaxtype as $key => &$igsttaxtyp)
					{	if($purchaseInvoic['igst_ledger_id'] == $igsttaxtyp->id)
						{
							$igsttaxtyp['igsttax_amount'] = $purchaseInvoic['igst_amount'];
						}
						
					}
				}
				
						
			}
			//pr($igsttaxtypes); exit;
		
			$cgstinput_gst_ids=[];
			foreach($cgsttaxtypes as $cgsttaxtype)
			{
				foreach($cgsttaxtype as $cgsttaxtyp)
				{
				
				 $cgstinput_gst_ids[] = $this->PurchaseInvoices->TaxTypes->TaxTypeRows->find()
				->where(['tax_type_name'=>$cgsttaxtyp->name])->toArray(); 

					foreach($cgstinput_gst_ids as $cgstinput_gst_ids_data)
					{
						foreach($cgstinput_gst_ids_data as $key => &$cgstinput_gst_id)
						{
							 if($cgsttaxtyp->name == $cgstinput_gst_id->tax_type_name)
							{
								$cgstinput_gst_id['cgsttax_amount'] = $cgsttaxtyp->cgsttax_amount;
							} 
						}						
					}							

				}
			}
			$sgstinput_gst_ids=[];
			foreach($sgsttaxtypes as $sgsttaxtype)
			{
				foreach($sgsttaxtype as $sgsttaxtyp)
				{
				
				 $sgstinput_gst_ids[] = $this->PurchaseInvoices->TaxTypes->TaxTypeRows->find()
				->where(['tax_type_name'=>$sgsttaxtyp->name])->toArray(); 

					foreach($sgstinput_gst_ids as $sgstinput_gst_ids_data)
					{
						foreach($sgstinput_gst_ids_data as $key => &$sgstinput_gst_id)
						{
							 if($sgsttaxtyp->name == $sgstinput_gst_id->tax_type_name)
							{
								$sgstinput_gst_id['sgsttax_amount'] = $sgsttaxtyp->sgsttax_amount;
							} 
						}						
					}							

				}
			}
			$igstinput_gst_ids=[];
			foreach($igsttaxtypes as $igsttaxtype)
			{
				foreach($igsttaxtype as $igsttaxtyp)
				{
				
				 $igstinput_gst_ids[] = $this->PurchaseInvoices->TaxTypes->TaxTypeRows->find()
				->where(['tax_type_name'=>$igsttaxtyp->name])->toArray(); 

					foreach($igstinput_gst_ids as $igstinput_gst_ids_data)
					{
						foreach($igstinput_gst_ids_data as $key => &$igstinput_gst_id)
						{
							 if($igsttaxtyp->name == $igstinput_gst_id->tax_type_name)
							{
								$igstinput_gst_id['igsttax_amount'] = $igsttaxtyp->igsttax_amount;
							} 
						}						
					}							

				}
			}
		$purchaseInvoicetotal[]=array_merge($igstinput_gst_ids,$cgstinput_gst_ids);
		
			
			
		//pr($purchaseInvoicetotal);    exit;
		
		
			
			foreach($purchaseInvoicetotal as $purchaseInvoictotal)
			{
				foreach($purchaseInvoictotal as $purchaseInvoictotals)
				{
				//pr($purchaseInvoicetotal);  exit;
					foreach($purchaseInvoictotals as $purchaseInvoictota)
					{
					//pr($purchaseInvoictota);  exit;
					 $totaltaxtypes[] = $this->PurchaseInvoices->TaxTypes->find()
					->where(['id'=>$purchaseInvoictota->tax_type_id])->toArray();
					
						foreach($totaltaxtypes as $totaltaxtypes_data)
						{
							foreach($totaltaxtypes_data as $totaltaxtypes_datas)
							{	
								 if($purchaseInvoictota->tax_type_id == $totaltaxtypes_datas->id)
								{
									if(!empty($purchaseInvoictota->cgsttax_amount)){
										$totalvalue[$totaltaxtypes_datas->id] = $purchaseInvoictota->cgsttax_amount *2;  
									}
									
									if(!empty( $purchaseInvoictota->igsttax_amount)){
										$totalvalue[$totaltaxtypes_datas->id] = $purchaseInvoictota->igsttax_amount ;  
									}
									//pr($totalvalue);   exit;
									
								} 
							}			
						}	
												

					}
				}
			}		
		 
		//fetch data from database end
		
		
		
		
		
		
		
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseInvoice = $this->PurchaseInvoices->patchEntity($purchaseInvoice, $this->request->getData());
			
			$purchaseInvoice->transaction_date = date('Y-m-d',strtotime($purchaseInvoice->transaction_date));
			$purchaseInvoice->company_id = $company_id;
			//pr($purchaseInvoice->purchase_invoice_rows);  exit;
			
			foreach($purchaseInvoice->purchase_invoice_rows as $purchase_invoice_row)
			//pr($purchase_invoice_row);    exit;
			{
			
				$taxtypes[] = $this->PurchaseInvoices->TaxTypes->TaxTypeRows->find()
				->where(['tax_type_id'=>$purchase_invoice_row['tax_type_id']])->toArray();

				
				foreach($taxtypes as $taxtype)
				{   
					foreach($taxtype as $key => &$taxtyp)
					{	if($purchase_invoice_row['tax_type_id'] == $taxtyp->tax_type_id)
						{
							$taxtyp['tax_amount'] = $purchase_invoice_row['tax_amount'];
						}
						
					}
				}	
			}
			
			//pr($taxtypes);    exit;
			
			foreach($taxtypes as $taxtype)
			{
				foreach($taxtype as $taxtyp)
				{
				
				 $input_gst_ids[] = $this->PurchaseInvoices->Ledgers->find()
				->where(['name'=>$taxtyp->tax_type_name,'accounting_group_id'=>29])->toArray(); 

					foreach($input_gst_ids as $input_gst_id_data)
					{
						foreach($input_gst_id_data as $key => &$input_gst_id)
						{
							 if($taxtyp->tax_type_name == $input_gst_id->name)
							{
								$input_gst_id['tax_amount'] = $taxtyp->tax_amount;
							} 
						}						
					}							

				}
			}
			
			//pr($input_gst_ids); exit;
			unset($purchaseInvoice->purchase_invoice_others);
			$purchaseInvoice->purchase_invoice_others = array();
			if(!empty($input_gst_ids))
			{
				foreach($input_gst_ids as $input_gst_id_data)
				{
					foreach($input_gst_id_data as $input_gst_id)
					{
						if($input_gst_id->gst_type == 'CGST')
						{
							$cgst_amount = $input_gst_id->tax_amount/2;
							$purchaseInvoice['purchase_invoice_others'][]['CGST'] = ['cgst_ledger_id' =>$input_gst_id->id,'cgst_amount'=>$cgst_amount];
						}

						if($input_gst_id->gst_type == 'SGST')
						{
							$sgst_amount = $input_gst_id->tax_amount/2;
							$purchaseInvoice['purchase_invoice_others'][]['SGST'] = ['sgst_ledger_id' =>$input_gst_id->id,'sgst_amount'=>$sgst_amount];
						}
						
						if($input_gst_id->gst_type == 'IGST')
						{
							$igst_amount = $input_gst_id->tax_amount;
							$purchaseInvoice['purchase_invoice_others'][]['IGST'] = ['igst_ledger_id' =>$input_gst_id->id,'igst_amount'=>$igst_amount];
						}						
					}
				}
			}
				
		//pr($purchaseInvoice->purchase_invoice_others); exit;
            if ($this->PurchaseInvoices->save($purchaseInvoice)) {
			
			foreach($purchaseInvoice->purchase_invoice_others as $purchase_invoice_other_data)
			{ 
			foreach($purchase_invoice_other_data as $key => $purchase_invoice_other)	
			{	
				if($key == 'CGST')
				{
					$query_insert = $this->PurchaseInvoices->PurchaseInvoiceRows->query();
					$query_insert->insert(['cgst_ledger_id','cgst_amount','purchase_invoice_id'])
					->values([
						'cgst_ledger_id' => $purchase_invoice_other['cgst_ledger_id'],
						'cgst_amount' => $purchase_invoice_other['cgst_amount'],
						'purchase_invoice_id' => $purchaseInvoice->id
					]);
					$query_insert->execute();
					
					
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_voucher_id','company_id'])
					->values([
						'ledger_id'=>$purchase_invoice_other['cgst_ledger_id'],
						'debit'=>$purchase_invoice_other['cgst_amount'],
						'credit'=>0,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_voucher_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();					
				}

				if($key == 'SGST')
				{
					$query_insert = $this->PurchaseInvoices->PurchaseInvoiceRows->query();
					$query_insert->insert(['sgst_ledger_id','sgst_amount','purchase_invoice_id'])
					->values([
						'sgst_ledger_id' => $purchase_invoice_other['sgst_ledger_id'],
						'sgst_amount' => $purchase_invoice_other['sgst_amount'],
						'purchase_invoice_id' => $purchaseInvoice->id
					]);
					$query_insert->execute();
					
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_voucher_id','company_id'])
					->values([
						'ledger_id'=>$purchase_invoice_other['sgst_ledger_id'],
						'debit'=>$purchase_invoice_other['sgst_amount'],
						'credit'=>0,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_voucher_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();		
					
				}
				if($key == 'IGST')
				{
					$query_insert = $this->PurchaseInvoices->PurchaseInvoiceRows->query();
					$query_insert->insert(['igst_ledger_id','igst_amount','purchase_invoice_id'])
					->values([
						'igst_ledger_id' => $purchase_invoice_other['igst_ledger_id'],
						'igst_amount' => $purchase_invoice_other['igst_amount'],
						'purchase_invoice_id' => $purchaseInvoice->id
					]);
					$query_insert->execute();
					
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_voucher_id','company_id'])
					->values([
						'ledger_id'=>$purchase_invoice_other['igst_ledger_id'],
						'debit'=>$purchase_invoice_other['igst_amount'],
						'credit'=>0,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_voucher_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();		
				}			
			}	
			} 
			
				if($purchaseInvoice->total !=0)
				{		
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_voucher_id','company_id'])
					->values([
						'ledger_id'=>$purchaseInvoice->supplier_ledger_id,
						'debit'=>0,
						'credit'=>$purchaseInvoice->total,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_voucher_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();							
					
					
				}
				
				if($purchaseInvoice->base_amount !=0)
				{		
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_voucher_id','company_id'])
					->values([
						'ledger_id'=>$purchaseInvoice->purchase_ledger_id,
						'debit'=>$purchaseInvoice->base_amount,
						'credit'=>0,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_voucher_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();	
				}				
				
                $this->Flash->success(__('The purchase invoice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase invoice could not be saved. Please, try again.'));
        }
	
		$SupplierLedger = $this->PurchaseInvoices->SupplierLedger->find('list')->where(['accounting_group_id'=>25,'freeze'=>0]);
        $PurchaseLedger = $this->PurchaseInvoices->PurchaseLedger->find('list')->where(['accounting_group_id'=>13,'freeze'=>0]);
		
		$CgstTax = $this->PurchaseInvoices->CgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'CGST']);
		
		$SgstTax = $this->PurchaseInvoices->SgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'SGST']);

		$taxtypes = $this->PurchaseInvoices->TaxTypes->find('list');
		
        $this->set(compact('purchaseInvoice','SupplierLedger','PurchaseLedger','CgstTax','SgstTax','taxtypes','totaltaxtypes','totalvalue'));
        $this->set('_serialize', ['purchaseInvoice']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Invoice id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		if ($this->request->is(['patch', 'post', 'put']))
		{
			$purchaseInvoice = $this->PurchaseInvoices->get($id);
			$query = $this->PurchaseInvoices->query();
				$query->update()
					->set(['status' => 1])
					->where(['id' => $id])
					->execute();
			if ($this->PurchaseInvoices->save($purchaseInvoice)) {
				
				$this->Flash->success(__('The purchaseInvoice has been deleted.'));
			} else {
				$this->Flash->error(__('The purchaseInvoice could not be deleted. Please, try again.'));
			}
		}
        return $this->redirect(['action' => 'index']);
    }
}
