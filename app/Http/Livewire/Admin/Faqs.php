<?php

namespace App\Http\Livewire\Admin;

use App\Models\Faq;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Faqs extends Component
{
    public $faq, $question, $answers = [], $url, $files = [], $sort;

    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected function rules()
    {
        return [
            'question' => 'required',
            'sort' => 'required|integer',
            'answers' => 'required',
            'url' => 'sometimes|nullable|url',
            'files' => 'sometimes|nullable',
        ];
    }

    public function mount()
    {
        $this->answers[] = [
            ''
        ];
    }

    public function addAnswer()
    {
        $this->answers[] = [
            ''
        ];
    }

    public function removeAnswer($index)
    {
        unset($this->answers[$index]);
        $this->answers = array_values($this->answers);
    }

    public function edit(Faq $faq)
    {
        $this->question = $faq->question;
        $this->sort = $faq->sort;
        $this->answers = $faq->answers;
        $this->url = $faq->url;
        $this->faq = $faq;
    }
    public function save()
    {
        $data = $this->validate();

        unset($data['files']);

        if (!empty($this->files)) {

            foreach ($this->files as $file) {

                $files[] = store_file($file, 'faqs');
            }

            $data['files'] = json_encode($files);
        }

        if ($this->faq) {
            $this->faq->update($data);
        } else {
            Faq::create($data);
        }
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    }
    public function delete(Faq $faq)
    {
        $faq->delete();

        if ($faq->files) {
            $files = json_decode($faq->files, true);
            foreach ($files as $index => $file) {
                delete_file($file);
            }
        }

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }

    public function render()
    {
        $faqs = Faq::orderBy('sort')->paginate(10);

        return view('livewire.admin.faqs', compact('faqs'));
    }
}
