<?php
class CalculationsController extends AppController
{
    public $name = 'Calculations';
    public $helpers = array('Form', 'Html', 'Number',  'Balans');

    public $uses = array('Calculation', 'Balans', 'Bookyear', 'Grootboek', 'Bankaccount');

    public $components = array('Import', 'Csv', 'Session', 'PrepareJournalEntry', 'UploadImportFile');

    public function beforeFilter()
    {

    }

    public function index()
    {
        $this->Calculation->recursive = 0;
        $this->set('calculations', $this->paginate());
    }

    public function search()
    {
        $this->Calculation->recursive = 0;

            $conditions = array();

            foreach ($this->request->query as $key=>$value) {
                $key = str_replace('_', '.', $key);
                $conditions[$key.' LIKE']='%'.$value.'%';
            }

            $conditions['Calculation.bookyear_id']=$this->Session->read('Bookyear.id');

            $this->paginate = array(
                    'conditions' => $conditions
            );

            $calculations = $this->paginate('Calculation');
            $this->set(compact('calculations'));

    }

    public function view($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid calculation'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Calculation->recursive = 1;
        $this->set('calculation', $this->Calculation->read(null, $id));
    }

    public function add()
    {
        if (!empty($this->request->data)) {
            $this->Calculation->create();
            if ($this->Calculation->save($this->request->data)) {
                $this->Session->setFlash(__('The calculation has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The calculation could not be saved. Please, try again.'));
            }
        }
        $grootboeks = $this->Calculation->Grootboek->find('list');
        $bookyears = $this->Calculation->Bookyear->find('list');
        $this->set(compact('grootboeks', 'bookyears'));
    }

    public function crossbooking($grootboek=null)
    {
        $bookyear['Bookyear'] = $this->checkSessionHasBookyear();
        if (!empty($this->request->data)) {
            $preparedData =$this->PrepareJournalEntry->prepareSingleTransaction($this->request->data["Calculation"]);

            if ($this->Calculation->saveAll($preparedData)) {
                $this->Session->setFlash(__('Mutatie is verwerkt'), 'success');
                $this->redirect('/balans/'.$bookyear['Bookyear']['omschrijving']);
            } else {
                $this->Session->setFlash(__('De mutatie kon niet worden verwerkt. Controlleer of alle velden zijn ingevuld'), 'danger');
            }
        }

        if (isset($grootboek) && $bookyear['Bookyear'] !== false) {
            $grootboeks = $this->Calculation->Grootboek->find('list');
            $grootboek = $this->Calculation->Grootboek->get($grootboek);

            $info['Grootboek'] = $grootboek['Grootboek'];
            $info['Bookyear'] = $bookyear['Bookyear'];

            $this->set(compact('grootboeks', 'info', 'grootboek', 'bookyear'));
        } else {
            $this->redirect(array('controller' => 'bookyears', 'action' => 'selectBookyear'));
        }
    }

    public function edit($id = null)
    {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid calculation'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Calculation->save($this->request->data)) {
                $this->Session->setFlash(__('The calculation has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The calculation could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Calculation->read(null, $id);
        }
        $grootboeks = $this->Calculation->Grootboek->find('list');
        $bookyears = $this->Calculation->Bookyear->find('list');
        $this->set(compact('grootboeks', 'bookyears'));
    }

    public function delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for calculation'));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Calculation->delete($id)) {
            $this->Session->setFlash(__('Calculation deleted'));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Calculation was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function deletebyhash($hash = null)
    {
        if (!$hash) {
            $this->Session->setFlash(__('Onbekende boeking'), 'danger');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Calculation->deleteAll(array('Calculation.hash' => $hash))) {
            $this->Session->setFlash(__('Boekingen verwijdert'), 'success');
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Boekingen zijn niet verwijdert'), 'danger');
        $this->redirect(array('action' => 'index'));
    }

    public function listbyboekingstuk($boekingstuk)
    {
        $calculations = $this->Calculation->getByBoekingsstuk($boekingstuk);
        $this->set(compact('calculations','boekingstuk'));
    }

    public function import()
    {
        $bookyear = array();
        $bookyear['Bookyear'] = $this->checkSessionHasBookyear();

        if (isset($this->request->params['source'])) {
            $source = $this->request->params['source'];
        }

        if (isset($this->request->params['type'])) {
            $type = $this->request->params['type'];
        }

        if (!empty($this->request->data ) && !empty($source) && !empty($type) && isset($this->request->data['File'])) {
            $result = $this->UploadImportFile->execute($this->request->data['File'][0]);

            if ($result === false) {
                $this->Session->setFlash(__('henk'));
                $this->redirect(array('controller' => 'pages', 'action' => 'home'));
            } else {
                $filename = $this->UploadImportFile->getLastUploadedFilename();
                $this->Importer = $this->Components->load('Import'.ucwords($source).ucwords($type));
                $parseddata = $this->Importer->execute($filename, $source , $type );

                if (count($parseddata['accountNumbers']) > 1) {
                    $this->Session->setFlash(__('In het CSV bestand zijn 2 of meer bankrekeningen gevonden. Het is daarom niet mogelijk om dit bestand te koppelen aan een bekende bankrekening in ons systeem. Gevonden rekeningen: '.implode(', ', $parseddata['accountNumbers'])), 'danger');
                    $this->redirect('/balans/'.$bookyear['Bookyear']['omschrijving'].'/import/'.$source.'/'.$type);
                }

                $data = $parseddata['data'];
                $sourceinfo = $parseddata['sourceinfo'];
                $grootboeks = $this->Calculation->Grootboek->find('list');
                $bankpost = $this->Bankaccount->findByIban($sourceinfo['rekening']);

                if (!array_key_exists( 'Grootboek', $bankpost) || count($bankpost)==0) {
                    $this->Session->setFlash(__('Er is geen bankrekening bekend die voldoet aan uw CSV bestand. Controleer de rekeninggegevens en voeg deze zonodig toe in het systeem. Gevonden rekeningen: '.implode(', ', $parseddata['accountNumbers'])), 'danger');
                    $this->redirect('/balans/'.$bookyear['Bookyear']['omschrijving'].'/import/'.$source.'/'.$type);
                }

                $possibleDuplicates = 0;
                foreach ($data as $d) {

                    $condition = array('conditions' =>array(
                            "Calculation.bookyear_id" => $bookyear['Bookyear']['id'],
                        'AND' => array(
                            "Calculation.omschrijving LIKE " => $d['omschrijving'],
                            "Calculation.debet" => $d['debet'],
                            "Calculation.credit" => $d['credit'],

                            "Calculation.boekdatum" => $d['boekdatum']
                        )
                    ));

                    $calculation = $this->Calculation->find('first', $condition);
                    if (count($calculation) > 0 ) { //if there is something in the array! since CakePHP dont work with objects.
                        $possibleDuplicates++;
                    }

                }
                $this->set(compact('data', 'grootboeks', 'sourceinfo', 'bankpost', 'possibleDuplicates'));
            }
        } elseif (isset($this->request->data['Calculation'])) {
            $calculations = $this->request->data['Calculation'];
            $ledger = $this->Grootboek->findById( $this->request->data['Grootboek']['id']);

            $preparedData = $this->PrepareJournalEntry->prepareBatchTransaction($calculations, $bookyear, $ledger);

            if ($this->Calculation->saveAll($preparedData)) {
                $this->Session->setFlash(__('Mutatie is verwerkt'));
                //$this->redirect(array('controller' => 'grootboeks', 'action' => 'open', $incommingData['Calculation'][0]['bookyear_id'], $incommingData['Calculation'][0]['grootboek_id']));
            } else {
                $this->Session->setFlash(__('De mutatie kon niet worden verwerkt. Controlleer of alle velden zijn ingevuld'));
            }

        }

        $this->set(compact('bookyear'));
    }

    public function viewbyhash($hash)
    {
        $this->Calculation->recursive = 1;
        $conditions['Calculation.hash']=$hash;
        $calculations = $this->Calculation->findAllByHash($hash);
        if (count($calculations) < 1) {
            $this->Session->setFlash(__('Onbekende boeking'));
            $this->redirect(array('action'=>'index'));
        }
        $this->set(compact( 'calculations', 'hash'));
    }
}
