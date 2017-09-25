<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
	
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow([ 'logout','add','edit' ,'sendotpmobile','varifymobile','changepass']);
    }

	public function logout()
	{
		return $this->redirect($this->Auth->logout());
	}
	
    public function login()
    {
		$this->viewBuilder()->layout('login');
        if ($this->request->is('post')) 
		{
            $user = $this->Auth->identify();
			
            if ($user) 
			{
                $this->Auth->setUser($user);
				return $this->redirect(['controller'=>'Users','action' => 'Dashboard']);
            }
			//pr($user); exit;
            $this->Flash->error(__('Invalid Username or Password'));
        }
		$user = $this->Users->newEntity();
        $this->set(compact('user'));
    }
	
	
	
	
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id');
        $users = $this->paginate($this->Users->find()->where(['company_id'=>$company_id,'status' => 0]));
		
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

	
	
	function sendotpmobile($smssend)
    {
		$this->viewBuilder()->layout('');
		$datas = $this->Users->find()
		->where(['mobile_no'=>$smssend]);
		
		if(!empty($datas->toArray()))
		{  
			$chars = "0123456789";//ABCDEFGHIJKLMNOPQRSTUVWXYZ
			$string = '';
			for ($i = 0; $i < 6; $i++) {
			 $string .= $chars[rand(0, strlen($chars) - 1)];
			}
			$query = $this->Users->query();
			$query->update()
					->set(['otp'=>$string])
					->where(['mobile_no' => $smssend])
					->execute();
			//$sms=str_replace('', '+', 'Your One Time Password Set successfully.');
			
			//$working_key='A7a76ea72525fc05bbe9963267b48dd96';
			//$sms_sender='JAINTE';
			//$sms=str_replace(' ' , '+', $sms);
			//file_get_contents('http://alerts.sinfini.com/api/web2sms.php?workingkey='.$working_key.'&sender='.$sms_sender.'&to='.$smssend.'&message='.$sms.''.$string);		
			
			echo '1';
			
		}else
		{
				echo '0';
		}	
	}
	
	
	
	function varifymobile($mobilematch,$otpvarify)
    {		
		$this->viewBuilder()->layout('');
		$datas = $this->Users->find()
		->where(['mobile_no'=>$mobilematch,'otp'=>$otpvarify]);
		
		if(!empty($datas->toArray()))
		{  
			echo '1';
		}else
		{
				echo '0';
		}	
	}
	
	
	
	
	function changepass($password,$mobilein)
    {		
		$this->viewBuilder()->layout('');
		
		if($mobilein!='')
		{
				
			$query = $this->Users->query();
			$query->update()
				->set(['password'=>$password])
				->where(['mobile_no' =>$mobilein])
				->execute();
			echo '1';
		}else
		{
				echo '0';
		}	
		exit;
	}
	
	
    /**
	
	
	
	
	
	
	
	
	
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
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
        $user = $this->Users->newEntity();
		
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
			
			if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
		if($company_id==5){
			$companies=$this->Users->Companies->find()->where (['freezed'=>0]);
		}else{
			$companies=$this->Users->Companies->find()->where (['Companies.id'=>$company_id,'freezed'=>0]);
		}	
		$company=[];
		foreach($companies as $companie)
			{
				$company[]=['value'=>$companie->id,'text'=>$companie->name];
			}
        $this->set(compact('user','company'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id');
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->getData());
			
			$user->company_id=$company_id;
			
			
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                 return $this->redirect(['action' => 'dashboard']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
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
        $company_id=$this->Auth->User('company_id');
		if ($this->request->is(['patch', 'post', 'put']))
		{
			$user = $this->Users->get($id);
			$query = $this->Users->query();
				$query->update()
					->set(['status' => 1])
					->where(['id' => $id,'company_id'=>$company_id])
					->execute();
			if ($this->Users->save($user)) {
				
				$this->Flash->success(__('The user has been deleted.'));
			} else {
				$this->Flash->error(__('The user could not be deleted. Please, try again.'));
			}
		}
        return $this->redirect(['action' => 'index']);
		
		
		
		
		
		
		
		
    }
	
	public function dashboard()
    {
        $this->viewBuilder()->layout('index_layout');
		
		$company_id=$this->Auth->User('company_id');
		
		
		$last_invoice=$this->Users->Invoices->find()->select(['invoice_no'])->order(['invoice_no' => 'DESC'])->first();
		$last_voucher=$this->Users->PurchaseInvoices->find()->select(['id'])->order(['id' => 'DESC'])->first();
		 
		$this->set(compact('user','last_invoice','last_voucher'));
		$this->set('active_menu', 'Users.Dashboard');
    }
	
	
}
