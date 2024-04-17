<?php

// use App\Models\Produk;
use App\Livewire\Actions\Logout;
use function Livewire\Volt\{state, rules, usesFileUploads};
usesFileUploads();

state([
  'nama_produk',
  'foto_produk',
  'harga',
  'stok'
]);

rules([
  'nama_produk' => 'required',
  'foto_produk' => 'required',
  'harga' => 'required',
  'stok' => 'required'
]);

// $simpan = function() {
//   $validatedData = $this->validate();

//   $foto = $this->foto_produk->storePubliclyAs('/foto-produk', $this->foto_produk->getClientOriginalName());
//   // $validatedData['foto_procduk'] = $foto;

//   Produk::create($validatedData);
//   return $this->redirectRoute('dashboard', navigate:true);
// };

$logout = function(Logout $logout) {
  $logout();
  $this->redirect('/');
};

?>

<div>
  <div class="page">

      <livewire:layout.navbar/>

      <div class="content-section flex flex-col">
        {{-- <livewire:list-produk /> --}}
      </div>
</div>
