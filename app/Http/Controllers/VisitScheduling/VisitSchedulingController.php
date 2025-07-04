<?php

namespace App\Http\Controllers\VisitScheduling;

use App\Http\Controllers\Controller;
use App\Http\Requests\VisitScheduling\VisitSchedulingRequest;
use App\Models\Admin\Ward;
use App\Models\Main\IdentificationCard;
use App\Models\Main\Prisoner;
use App\Models\Main\UnitAddress;
use App\Models\Main\Visit\VisitControl;
use App\Models\Main\Visit\VisitScheduling;
use App\Models\Main\Visit\VisitSchedulingDate;
use Illuminate\Http\Request;

class VisitSchedulingController extends Controller
{
  public function index()
  {
    $current_date = date("Y-m-d");
    $visit_scheduling_start_date = VisitSchedulingDate::where('start_date', '>=', $current_date)
      ->orderBy('start_date', 'asc')->first();
    $visit_scheduling_end_date = VisitSchedulingDate::where('start_date', '>=', $current_date)
      ->orderBy('start_date', 'desc')->first();
    $visit_types = ['SOCIAL', 'ÍNTIMA'];

    return view("visit-scheduling.index", compact(
      "current_date",
      "visit_scheduling_start_date",
      "visit_scheduling_end_date",
      "visit_types"
    ));
  }

  public function create(VisitSchedulingRequest $request)
  {
    $current_date = date("Y-m-d");

    // valida os dados enviados
    $validated = $request->validated();

    // busca os dados da carteirinha conforme os dados digitados
    $identification_card = IdentificationCard::with('visitant', 'prisoner')
      ->where('id', intval($validated['code']))->first();

    // verifica se existe carteirinha conforme o código digitado
    if (!$identification_card) {
      return redirect()->back()->with('error', 'Código da Carteirinha ou CPF inválido!');
    }

    // verifica se o cpf digitado pertence a mesma carterinha conforme o código digitado
    if ($identification_card->visitant->cpf != $validated['cpf']) {
      return redirect()->back()->with('error', 'Código da Carteirinha ou CPF inválido!');
    }

    // verifica se o cpf digitado pertence a mesma carterinha conforme o código digitado
    if ($identification_card['status'] == 'INATIVO') {
      return redirect()->back()
        ->with('error', 'Sua carteirinha está suspensa, favor entrar em contato com a UTPRBG (Unidade de Tratamento Penal Regional Barra da Grota) para maiores esclarecimentos!');
    }

    // verifica se a carteirinha está vencida
    if ($identification_card['expiration_date'] < date("Y-m-d")) {
      return redirect()->back()
        ->with('error', 'Sua carteirinha está VENCIDA, para continuar realizando as visitas você deve regularizá-la!');
    }


    // busca os dados do preso conforme a carteirinha
    $prisoner = Prisoner::where('id', $identification_card['prisoner_id'])
      ->with('unit_address')
      ->first();

    // busca os dados da unidade prisional conforme os dados da carteirinha
    $unid_address = UnitAddress::orderBy('id', 'desc')->where('prisoner_id', $prisoner['id'])
      ->first();

    // busca os dados do pavilhão conforme os dados da carteirinha
    $ward = Ward::where('id', $unid_address->ward_id)->get()->first();

    // verifica se está no dia do agendamento da visita
    $visit_date = VisitSchedulingDate::where('ward_id', $ward->id)
      ->where('start_date', '>=', $current_date)
      ->orderBy('start_date', 'asc')->first();
    if (empty($visit_date) or $visit_date->start_date != $current_date) {
      return redirect()->back()->with('error', 'Fora da data de agendamento para o seu pavilhão');
    }

    $visit_schedulings = VisitScheduling::where('type', $validated['type'])
      ->where('created_at', '>', $current_date)
      ->where('prisoner_id', $identification_card->prisoner_id)
      ->get();

    // verifica se já foi realizado o agendamento da visita social
    if ($validated['type'] == 'SOCIAL') {
      // verifica se o presso já teve 3 agendamentos
      if ($visit_schedulings->count() >= 3) {
        return redirect()->back()->with('error', 'O interno já possui 3 visitas agendadas!');
      }

      foreach ($visit_schedulings as $visit_scheduling) {
        if ($visit_scheduling->visitant_id == $identification_card->visitant_id) {
          return redirect()->back()->with('error', 'Visita social já agendada!');
        }
      }
    }

    // verifica se já foi realizado o agendamento da visita íntima
    if ($validated['type'] == 'ÍNTIMA') {
      // verifica se o visitante pode receber a visita íntima
      if ($identification_card['type'] != "ÍNTIMA / SOCIAL") {
        return redirect()->back()->with('error', 'Você não está habilitado(a) para receber visita íntima!');
      }

      foreach ($visit_schedulings as $visit_scheduling) {
        if ($visit_scheduling->visitant_id == $identification_card->visitant_id) {
          return redirect()->back()->with('error', 'Visita íntima já agendada!');
        }
      }
    }

    // busca os dados do controle de visita
    $visit_controls = VisitControl::where('date', '>', $current_date)
      ->where('visit_type', $request->type)
      ->where('ward_id', $ward->id)
      ->get();

    if ($visit_controls->count() > 0) {
      // primeiro dia de agendamento
      $date1 = $visit_controls[0];

      // se existir o segundo dia de agendamento
      if (isset($visit_controls[1])) {
        $date2 = $visit_controls[1];
      }

      // se existir o terceiro dia de agendamento
      if (isset($visit_controls[2])) {
        $date3 = $visit_controls[2];
      }

      // restringe o número de visitas do primeiro dia
      $day1 = VisitScheduling::where('type', $request->type)
        ->where('date_visit', $date1->date)
        ->get();

      if ($day1->count() >= intval($date1->number_visit)) {
        $visit_date1 = '';
      } else {
        $visit_date1 = $date1;
      }

      // restringe o número de visitas do segundo dia
      if (isset($visit_controls[1])) {
        $day2 = VisitScheduling::where('type', $request->type)
          ->where('date_visit', $date2->date)
          ->get();
        if ($day2->count() >= intval($date2->number_visit)) {
          $visit_date2 = '';
        } else {
          $visit_date2 = $date2;
        }
      } else {
        $visit_date2 = '';
      }

      // restringe o número de visitas do segundo dia
      if (isset($visit_controls[2])) {
        $day2 = VisitScheduling::where('type', $request->type)
          ->where('date_visit', $date3->date)
          ->get();
        if ($day2->count() >= intval($date3->number_visit)) {
          $visit_date3 = '';
        } else {
          $visit_date3 = $date3;
        }
      } else {
        $visit_date3 = '';
      }

      // quando o total de visitas agendadas for maior que o total de visitas disponibilizadas
      if ($visit_date1 == '' && $visit_date2 == '' && $visit_date3 == '') {
        return redirect()->back()->with('error', 'Todas as vagas disponíveis para visitas já foram preenchidas para este mês!');
      }

    } else {
      return redirect()->back()->with('error', 'Não existe disponibilidade de datas para agendamentos de visita!');
    }

    return view("visit-scheduling.create", [
      "identification_card" => $identification_card,
      "visit_date1" => $visit_date1,
      "visit_date2" => $visit_date2,
      "visit_date3" => $visit_date3,
      "type" => $request->type
    ]);
  }

  public function store(Request $request)
  {
    // se já exisitir um registro de visita duplicado com os mesmos dados
    $visit_scheduling = VisitScheduling::where('visitant_id', $request->visitant_id)
      ->where('date_visit', $request->date_visit)
      ->where('prisoner_id', $request->prisoner_id)
      ->where('identification_card_id', $request->identification_card_id)
      ->where('type', $request->type)
      ->first();
    if (!empty($visit_scheduling)) {
      return view("visit-scheduling.visit-completed", ["visit_completed" => $visit_scheduling]);
    }

    $data = $request->validate([
      'date_visit' => 'required|max:10|min:10',
      'type' => 'required|max:255',
      'identification_card_id' => 'required|max:10',
      'prisoner_id' => 'required|max:255',
      'visitant_id' => 'required|max:255',
      'user_create' => 'required|max:10',
      'prison_unit_id' => 'required|max:10',
    ]);
    $visit_completed = VisitScheduling::create($data);
    return view("visit-scheduling.visit-completed", ["visit_completed" => $visit_completed]);
  }
}
