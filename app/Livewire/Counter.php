<?php

namespace App\Livewire;

use App\Models\Counter as ModelsCounter;
use Livewire\Component;
use Livewire\WithPagination;

class Counter extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $nama;
    public $email;
    public $updateData = false;
    public $data_id;

    public function render()
    {
        $data = ModelsCounter::orderBy('nama', 'asc')->paginate(3);
        return view('livewire.counter', ['datauser'=>$data]);
    }

    public function store()
    {
        $rules = [
            'nama' => 'required',
            'email' => 'required|email',
        ];

        $pesan = [
            'nama.required' => 'Nama Harus Diisi',
            'email.required' => 'Email Harus Diisi',
            'email.email' => 'Email tidak sesui format'
        ];

        $validated = $this->validate($rules, $pesan);
        ModelsCounter::create($validated);
        session()->flash('message', 'Data Berhasil Disimpan');

        $this->clear();
    }

    public function edit($id)
    {
        $data = ModelsCounter::find($id);
        $this->nama = $data->nama;
        $this->email = $data->email;

        $this->updateData = true;
        $this->data_id = $id;
    }

    public function update()
    {
        $rules = [
            'nama' => 'required',
            'email' => 'required|email',
        ];

        $pesan = [
            'nama.required' => 'Nama Harus Diisi',
            'email.required' => 'Email Harus Diisi',
            'email.email' => 'Email tidak sesui format'
        ];

        $validated = $this->validate($rules, $pesan);
        $data = ModelsCounter::find($this->data_id);
        $data -> update($validated);
        session()->flash('message', 'Data Berhasil Diupdate');

        $this->clear();
    }

    public function clear()
    {
        $this->nama = '';
        $this->email = '';

        $this->updateData = false;
        $this->data_id = '';
    }

    public function delete()
    {
        $data = ModelsCounter::find($this->data_id);
        if ($data) {
            $data->delete();
            session()->flash('message', 'Data Berhasil Dihapus');
        } else {
            session()->flash('message', 'Data Tidak Ditemukan');
        }
        $this->clear();
    }


    public function delete_confirm($id)
    {
        $this->data_id = $id;
    }
}
