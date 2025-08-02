<?php

namespace App\Http\Livewire;

use App\Models\PatientFile;
use Livewire\Component;

class TestForm extends Component
{
    public $file, $animal_test;

    public function mount(PatientFile $file)
    {
        $this->file = $file;
    }

    public function submit()
    {
        $this->file->animal_test = $this->animal_test;
        $this->file->save();
        $this->resetExcept('file');
        $this->dispatchBrowserEvent('alert',['type'=>'success','message'=>'تم الحفظ بنجاح']);
    }
    public function render()
    {
        $params = [
            'wbcs',
            'lym',
            'mon',
            'neut',
            'eos',
            'rbcs',
            'hgb',
            'hct',
            'mcv',
            'mch',
            'mchc',
            'plt_count',
            'calcium',
            'iron',
            'phos',
            'ck',
            'gulcose',
            'ast',
            'alt',
            'ggt',
            'albumin',
            'protein',
            'creatinine',
            'urea',
        ];
        $additional =[
            'trypanosoma_blood',
            'anapisma_blood',
            'babesia_blood',
            'thieleria_blood',

            'nematodes_intestinal',
            'cestodes_intestinal',
            'pin_worms_intestinal',
            'balantidium_coli_trophozoites_intestinal',
            'others_intestinal'
        ];

        return view('livewire.test-form', compact('params','additional'))->extends('front.layouts.front')->section('content');
    }
}
