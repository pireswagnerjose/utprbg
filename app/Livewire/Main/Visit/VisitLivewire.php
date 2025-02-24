<?php

namespace App\Livewire\Main\Visit;

use App\Models\Admin\Ward;
use App\Models\Main\IdentificationCard;
use App\Models\Main\Prisoner;
use App\Models\Main\UnitAddress;
use App\Models\Main\Visit\VisitControl;
use App\Models\Main\Visit\VisitScheduling;
use App\Models\Main\Visit\VisitSchedulingDate;
use App\Models\Main\Visitant;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

use Livewire\Component;

#[Layout("layouts.guest")]
class VisitLivewire extends Component
{
  public $code;
  public $cpf;
  public $date;
  public $date_visit;
  public $type;
  public $identification_card_id;
  public $prisoner_id;
  public $visitant_id;
  public $user_create; 
  public $prison_unit_id;
  public $visit_scheduling_start_date = null;
  public $visit_scheduling_end_date = null;
  public $identification_card = [];
  public $visit_scheduling_date;
  public $visit_controls;
  public $visit_types = ['SOCIAL','ÍNTIMA'];
  public $visibleForm = true;

  public function mount()
  {
    $this->date = date("Y-m-d");
    $this->visit_scheduling_start_date = VisitSchedulingDate::where('start_date', '>=', $this->date)
        ->orderBy('start_date', 'asc')->first();
    $this->visit_scheduling_end_date = VisitSchedulingDate::where('start_date', '>=', $this->date)
        ->orderBy('start_date', 'desc')->first();
  }

  // reset fields
  public function clearFields()
  {
      $this->reset(
          'code', 'cpf', 'type', 'identification_card_id', 'date_visit', 'prisoner_id', 'visitant_id', 'user_create',
          'prison_unit_id', 'identification_card', 'visit_scheduling_date', 'visit_controls'
      );
  }

  public function visit()
  {
    // type - code - cpf
    // verifica se o código e cpf do visitante foram digitados corretamente
    $this->validate(
      [
        'type'=>'required',
        'code' => 'required',
        'cpf' => 'required|max:14|min:14'],
      [
        'type.required' => 'O campo tipo de visita é obrigatório',
        'code.required' => 'O campo código do visitante é obrigatório',
        'cpf.required' => 'O campo CPF é obrigatório',
        'cpf.min' => 'O campo CPF deve ter 14 caracteres',
        ]
    );

    // busca os dados da carteirinha conforme os dados digitados
    $this->identification_card = IdentificationCard::with('visitant', 'prisoner')
        ->where('id', $this->code)->get()->first();
    
    // verifica se existe carteirinha conforme o código digitado
    if (!$this->identification_card) {
      return redirect()->back()->with('error', 'Código da Carteirinha ou CPF inválido!');
    }
    
    // se encontrou alguma carteirinha conforme o código digitado
    if ($this->identification_card) {
        $visitant = Visitant::where('id', $this->identification_card['visitant_id'])->get()->first();
    }
    
    // verifica se o cpf digitado pertence a mesma carterinha conforme o código digitado
    if ($visitant->cpf != $this->cpf) {
      return redirect('/visita')->with('error', 'Código da Carteirinha ou CPF inválido!');
    }

    // verifica se o cpf digitado pertence a mesma carterinha conforme o código digitado
    if ($this->identification_card['status'] == 'INATIVO') {
      return redirect('/visita')
        ->with('error', 'Sua carteirinha está suspensa, favor entrar em contato com a UTPRBG (Unidade de Tratamento Penal Regional Barra da Grota) para maiores esclarecimentos!');
    }
  
    // verifica se a carteirinha está vencida
    if ($this->identification_card['expiration_date'] < date("Y-m-d")) {
      return redirect('/visita')
      ->with('error', 'Sua carteirinha está VENCIDA, para continuar realizando as visitas você deve regularizá-la!');
    }

    // busca os dados do preso conforme a carteirinha
    $prisoner = Prisoner::where('id', $this->identification_card['prisoner_id'])
      ->with('unit_address')
      ->get()->first();
    
    // busca os dados da unidade prisional conforme os dados da carteirinha
    $unid_address = UnitAddress::orderBy('id', 'desc')->where('prisoner_id', $prisoner['id'])
      ->get()->first();
    
    // busca os dados do pavilhão conforme os dados da carteirinha
    $ward = Ward::where('id', $unid_address->ward_id)->get()->first();

    // verifica se está no dia do agendamento da visita
    $visit_date = VisitSchedulingDate::where('ward_id', $ward->id)
        ->where('start_date', '>=', $this->date)
        ->orderBy('start_date', 'asc')->first();

    if (empty($visit_date) OR $visit_date->start_date != $this->date) {
      return redirect('/visita')
      ->with('error', 'Fora da data de agendamento para o seu pavilhão');
    }

    // verifica se já foi realizado o agendamento da visita social
    if($this->type == 'SOCIAL'){
      $visit_schedulings = VisitScheduling::where('type', $this->type)
        ->where('created_at', '>', $this->date)
        ->where('prisoner_id', $prisoner['id'])
        ->get();
      
      // verifica se o presso já teve 3 agendamentos
      if($visit_schedulings->count() >= 3){
        return redirect('/visita')->with('error', 'O interno já possui 3 visitas agendadas!');
      }
      
      foreach($visit_schedulings as $visit_scheduling){
        if($visit_scheduling->visitant_id == $visitant->id){
          return redirect('/visita')->with('error', 'Visita social já agendada!');
        }
      }
    }
    // verifica se já foi realizado o agendamento da visita íntima
    if($this->type == 'ÍNTIMA'){
      // verifica se o visitante pode receber a visita íntima
      if($this->identification_card['type'] != 'ÍNTIMA / SOCIAL'){
        return redirect('/visita')->with('error', 'Você não está habilitado(a) para receber visita íntima!');
      }

      foreach($visit_schedulings as $visit_scheduling){
        if($visit_scheduling->visitant_id == $visitant->id){
          return redirect('/visita')->with('error', 'Visita íntima já agendada!');
        }
      }
    }

    $this->visit_controls = VisitControl::where('created_at', '>', $this->date )
      ->where('ward_id', $ward->id)
      ->get();
    if ($this->visit_controls->count() > 0) {
      // primeiro dia de agendamento
      $date1 = $this->visit_controls[0];

      // se existir o segundo dia de agendamento
      if(isset($this->visit_controls[1])){
        $date2 = $this->visit_controls[1];
      }

      // restringe o número de visitas do primeiro dia
      $day1 = VisitScheduling::where('type', $this->type)
      ->where('date_visit', $date1->date)
      ->get();

      if($day1->count() >= intval($date1->number_visit)){
        $this->visit_date1 = '';
      }else{
        $this->visit_date1 = $date1;
      }

      // restringe o número de visitas do segundo dia
      if(isset($this->visit_controls[1])){
        $day2 = VisitScheduling::where('type', $this->type)
          ->where('date_visit', $date2->date)
          ->get();
        if($day2->count() >= intval($date2->number_visit)){
          $this->visit_date2 = '';
        }
        else{
          $this->visit_date2 = $date2;
        }
      }else{$this->visit_date2 = '';}

      // quando o total de visitas agendadas for maior que o total de visitas disponibilizadas
      if($this->visit_date1 == '' && $this->visit_date2 == ''){
        return redirect('/visita')->with('error', 'Todas as vagas disponíveis para visitas já foram preenchidas para este mês!');
      }

    } else {
      return redirect('/visita')->with('error', 'Não existe disponibilidade de datas para agendamentos de visita!');
    }

    $this->render();
    $this->visibleForm = false;
  }
  public $visit_date1;
  public $visit_date2;

  public function schedule_visit()
  {
    
    $this->identification_card_id = $this->identification_card['id'];
    $this->user_create = $this->identification_card['visitant_id'];
    $this->prison_unit_id = $this->identification_card['prison_unit_id'];
    $this->prisoner_id = $this->identification_card['prisoner_id'];
    $this->visitant_id = $this->identification_card['visitant_id'];

    $data = $this->validate([
        'date_visit'                => 'required|max:10|min:10',
        'type'                      => 'required|max:255',
        'identification_card_id'    => 'required|max:10',
        'prisoner_id'               => 'required|max:255',
        'visitant_id'               => 'required|max:255',
        'user_create'               => 'required|max:10',
        'prison_unit_id'            => 'required|max:10',
    ]);

    $visit_scheduling = VisitScheduling::create($data);
    $this->clearFields();
    $this->redirectRoute('visit-completed.index', ['visit_completed_id' => $visit_scheduling->id]);
  }

  public function render()
  {
      return view('livewire.main.visit.visit-livewire');
  }
}
