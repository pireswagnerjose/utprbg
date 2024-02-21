<?php

namespace App\Livewire\Main\BookingVisit;

use App\Models\Main\BookingVisit;
use App\Models\Main\Family;
use App\Models\Main\Prisoner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class BookingVisitLivewire extends Component
{
    use WithPagination;
    public $prisoner_id;
    public $user_create;
    public $user_update;
    public $prison_unit_id;
    public $date;
    public $type;
    public $status;
    public $remark = '';
    public $family_id;
    public $families = [];
    public $statuses = ['MANTIDO', 'CANCELADO'];
    public $types = ['SOCIAL', 'ÍNTIMA'];

    public function mount()
    {
        $this->user_create    = Auth::user()->id;
        $this->user_update    = Auth::user()->id;
        $this->prison_unit_id = Auth::user()->prison_unit_id;
        $this->families       = Family::where('prisoner_id', $this->prisoner_id)
            ->where('status', 'ATIVO')
            ->get();
    }

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset('date', 'type', 'status', 'remark', 'family_id');
    }

    // CLOSE MODAL
    public function closeModal()
    {
        $this->openModalBookingVisitCreate = false;
        $this->openModalBookingVisitUpdate = false;
        $this->openModalBookingVisitDelete = false;
    }

    // Transforma os caracteres em maiusculos
    public function convertUppercase($dataValidated)
    {
        $dataValidated['remark'] = mb_strtoupper($dataValidated['remark'], 'utf-8');
        return $dataValidated;
    }

    // MODAL CREATE
    public $openModalBookingVisitCreate = false;
    public function modalBookingVisitCreate()
    {
        $this->openModalBookingVisitCreate = true;
    }
    // CREATE
    public function bookingVisitCreate()
    {
        $dataValidated = $this->validate(
            [
                'date'          => 'required|min:10|max:10',
                'type'          => 'required|max:10',
                'status'        => 'nullable|max:60',
                'remark'        => 'nullable',
                'user_create'   => 'required|max:10',
                'prison_unit_id' => 'required|max:10',
                'prisoner_id'   => 'required|max:10',
                'family_id'     => 'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        // grava os dados no banco
        BookingVisit::create($dataValidated);
        $this->closeModal();
        $this->clearFields();
        $this->resetPage();
    }

    // MODAL UPDATE
    public $openModalBookingVisitUpdate = false;
    public function modalBookingVisitUpdate(BookingVisit $booking_visit)
    {
        $this->date = $booking_visit->date;
        $this->type = $booking_visit->type;
        $this->status = $booking_visit->status;
        $this->remark = $booking_visit->remark;
        $this->user_create = $booking_visit->user_create;
        $this->prison_unit_id = $booking_visit->prison_unit_id;
        $this->prisoner_id = $booking_visit->prisoner_id;
        $this->family_id = $booking_visit->family_id;
        $this->openModalBookingVisitUpdate = $booking_visit->id;
    }
    // UPDATE
    public function bookingVisitUpdate(BookingVisit $booking_visit)
    {
        $dataValidated = $this->validate(
            [
                'date'          => 'required|min:10|max:10',
                'type'          => 'required|max:10',
                'status'        => 'nullable|max:60',
                'remark'        => 'nullable',
                'user_update'   => 'required|max:10',
                'family_id'     => 'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        // grava os dados no banco
        $booking_visit->update($dataValidated);
        $this->closeModal();
        $this->clearFields();
        $this->resetPage();
    }

    // MODAL DELETE
    public $openModalBookingVisitDelete = false;
    public function modalBookingVisitDelete($booking_visit_id)
    {
        $this->openModalBookingVisitDelete = $booking_visit_id;
    }
    // DELETE
    public function bookingVisitDelete(BookingVisit $booking_visit)
    {
        $booking_visit->delete();
        $this->closeModal();
        $this->clearFields();
    }

    public function render()
    {
        return view('livewire.main.booking-visit.booking-visit-livewire', [
            'booking_visits' => BookingVisit::where('prisoner_id', $this->prisoner_id)->orderBy('date', 'desc')->paginate(10)
        ]);
    }
}
