<?php
App::uses('AppShell', 'Console/Command');
App::uses('Controller', 'Controller');
App::uses('ComponentCollection', 'Controller');
App::uses('AclComponent', 'Controller/Component');
App::uses('DbAcl', 'Model');
App::uses('Hash', 'Utility');

class SetupShell extends AppShell {
	
	protected $Acl;
	public $uses = array('Group');
	
	public function main() {
		$this->out("Processing...\n");

		$collection = new ComponentCollection();
		$this->Acl = new AclComponent($collection);
		$controller = new Controller();
		$this->Acl->startup($controller);		
		
		$this->setupGroups();
		$this->setPermissions();
	}

	private function setupGroups()
	{
		$this->Group->truncate();
		$this->createGroup('Admin');
		$this->createGroup('Premium');
		$this->createGroup('Normal');
	}

	private function createGroup($name)
	{
		$this->Group->create();
		
		if($this->Group->save(array('Group' => array('name' => $name)))){
			$this->out('Group "'.$name.'" created;');
		}else{
			$this->out('ERROR! Group "'.$name.'" failed creation;');
		}
	}
	
	private function setPermissions()
	{
		$adminGroup = $this->loadGroup('Admin');
		$premiumGroup = $this->loadGroup('Premium');
		$normalGroup = $this->loadGroup('Normal');
		
		$group =& $this->Group;
		
		//Allow admins to everything
		$group->id = $adminGroup['Group']['id'];
		$this->Acl->deny($group, 'controllers');

		//Premiums are restricted for only actions in their boekhouding; they may create grootboekrekeningen.
		$group->id = $premiumGroup['Group']['id'];
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Bookyears');
		$this->Acl->allow($group, 'controllers/Calculations');
		
		//This users may not alter grootboekrekeningen or import CSV's.
		//$group->id = $normalGroup;
		//we add an exit to avoid an ugly "missing views" error message
		echo "all done";
	}
	
	private function loadGroup($name)
	{
		$group = $this->Group->find('first', array(
				'conditions' => array('Group.name' => $name)
		));	

		return $group;
	}
}