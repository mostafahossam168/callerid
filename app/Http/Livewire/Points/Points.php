<?php

namespace App\Http\Livewire\Points;

use App\Models\PointOffer;
use App\Models\Setting;
use Livewire\Component;

class Points extends Component
{
    public $points_per_amount,$point_value,$points,$description,$offer;
    protected function rules()
    {
        return [
            'points'=>'required',
            'description'=>'required',
        ];
    }
    public function updateSettings(){
        $data=$this->validate([
            'points_per_amount'=>'required',
            'point_value'=>'required'
        ]);
        setting()->update($data);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' =>'تم التعديل بنجاح']);
    }


    public function edit(PointOffer $offer){
        $this->description=$offer->description;
        $this->points=$offer->points;
        $this->offer=$offer;
    }
    public function save(){
        $data=$this->validate();
        if($this->offer){
            $this->offer->update($data);
        }else{
            PointOffer::create($data);
        }
        $this->reset('description','points');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    }
    public function delete(PointOffer $offer){
        $offer->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }

    public function mount(){
        $this->point_value=setting()->point_value;
        $this->points_per_amount=setting()->points_per_amount;
    }
    public function render()
    {
        $offers=PointOffer::latest('id')->paginate();
        return view('livewire.points.points',compact('offers'));
    }
}
