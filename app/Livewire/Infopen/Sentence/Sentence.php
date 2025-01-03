<?php

namespace App\Livewire\Infopen\Sentence;

use App\Models\Main\Prison;
use App\Models\Main\Prisoner;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Pena")]
class Sentence extends Component
{
    use WithPagination;
    public $sentence = '';

    public $option = [];

    public function clearFieldes()
    {
        $this->reset('sentence', 'option');
        $this->resetPage();
        $this->redirectRoute('infopen.sentence', navigate: true);
    }

    public function sentence_fun()
    {
        $prisoners = Prisoner::where('status_prison_id', 1)
            ->orderBy('name', 'asc')
            ->get('id');
        
        $data_arr = [];
        foreach ($prisoners as $prisoner) {
            $data_arr [] = Prison::where('prisoner_id', $prisoner->id)
            ->where('prison_unit_id', Auth::user()->prison_unit_id)
            ->orderBy('entry_date', 'desc')
            ->first('id');
        }
        $array = implode(",",  $data_arr);
        $array = explode(",",  $array);
        $array = preg_replace(array('/"/', '/id:/', '/{/', '/}/'), array('', '', '', ''), $array);

        $prisons = Prison::whereIn('prisons.id', $array)->get();

        foreach ($prisons as $prison) {
            $sentence_all = explode('A', $prison['sentence']);
            $sentence_a = $sentence_all[0]; //pega o valor do ano
            
            if (!isset($sentence_all[1])) {
                $sentence_all_1 = 0;
            } else {
                $sentence_all_1 = explode('M', $sentence_all[1]);
            }

            if (!isset($sentence_all_1[0])) {
                $sentence_m = 0;
            } else {
                $sentence_m = $sentence_all_1[0]; // pega o valor do mês
            }

            if (!isset($sentence_all_1[1])) {
                $sentence_all_2 = 0;
            } else {
                $sentence_all_2 = $sentence_all_1[1];
            }
            
            $sentence_d = str_replace("D", "", $sentence_all_2);// pega o valor do dia

            $year = intval($sentence_a) * 365;
            $mount = intval($sentence_m) * 30;
            $day = intval($sentence_d);

            $sum = $year + $mount +  $day;

            $prison['sentence'] = $sum;
    
            $prison_sent = $prison;
            $prisons_modify[] = $prison_sent;
        }
        

        if ( $this->sentence == 1 ) {
            foreach ($prisons_modify as $key) {
                if ($key->sentence > 0 && $key->sentence < 180) {
                    $this->option [] = $key;
                }
            }
        }
        if ( $this->sentence == 2 ) {
            foreach ($prisons_modify as $key) {
                if ($key->sentence > 181 && $key->sentence < 365) {
                    $this->option [] = $key;
                }
            }
        }
        if ( $this->sentence == 3 ) {
            foreach ($prisons_modify as $key) {
                if ($key->sentence > 366 && $key->sentence < 730) {
                    $this->option [] = $key;
                }
            }
        }
        if ( $this->sentence == 4 ) {
            foreach ($prisons_modify as $key) {
                if ($key->sentence > 731 && $key->sentence < 1460) {
                    $this->option [] = $key;
                }
            }
        }
        if ( $this->sentence == 5 ) {
            foreach ($prisons_modify as $key) {
                if ($key->sentence > 1461 && $key->sentence < 2920) {
                    $this->option [] = $key;
                }
            }
        }
        if ( $this->sentence == 6 ) {
            foreach ($prisons_modify as $key) {
                if ($key->sentence > 2921 && $key->sentence < 5475) {
                    $this->option [] = $key;
                }
            }
        }
        if ( $this->sentence == 7 ) {
            foreach ($prisons_modify as $key) {
                if ($key->sentence > 5476 && $key->sentence < 7300) {
                    $this->option [] = $key;
                }
            }
        }
        if ( $this->sentence == 8 ) {
            foreach ($prisons_modify as $key) {
                if ($key->sentence > 7301 && $key->sentence < 10950) {
                    $this->option [] = $key;
                }
            }
        }
        if ( $this->sentence == 9 ) {
            foreach ($prisons_modify as $key) {
                if ($key->sentence > 10951 && $key->sentence < 18250) {
                    $this->option [] = $key;
                }
            }
        }
        if ( $this->sentence == 10 ) {
            foreach ($prisons_modify as $key) {
                if ($key->sentence > 18251 && $key->sentence < 36500) {
                    $this->option [] = $key;
                }
            }
        }
        if ( $this->sentence == 11 ) {
            foreach ($prisons_modify as $key) {
                if ($key->sentence > 36500) {
                    $this->option [] = $key;
                }
            }
        }
    }

    public function render()
    {
        $prisons_arr = [];
        foreach ( $this->option as $key) {
            $prisons_arr [] = $key->id;
        }
        $data = Prison::whereIn('prisons.id', $prisons_arr);
        $data = $data->select('prisons.*', 'prisoners.*')
            ->join('prisoners','prisons.prisoner_id','=','prisoners.id')
            ->orderBy('prisoners.name','asc');

        $prisons = $data->paginate(12);
        
        return view('livewire.infopen.sentence.sentence', compact('prisons'));
    }
}
