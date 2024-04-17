<?php

use App\Models\Car;
use App\Livewire\Actions\Logout;
use function Livewire\Volt\{state, rules, usesFileUploads, updated};
usesFileUploads();

state([
  'cars' => fn () => Car::all(),
  'merk',
  'search',
  'model',
  'no_plat',
  'cost_per_day',
  'created_by',
  'image'
]);

rules([
  'merk' => 'required',
  'model' => 'required',
  'no_plat' => 'required',
  'cost_per_day' => 'required',
  'image' => 'required'
]);

updated([
  'search' => function ($value) {
    $this->cars = Car::where(function ($query) use ($value) {
                    $query->where('merk', 'like', '%' . $this->search . '%')
                      ->orWhere('model', 'like', '%' . $this->search . '%')
                      ->orWhere(function ($query) use($value) {
                          if ($value == 'tersedia') {
                            $query->where('available', true);
                          }
                      });
                  })->get();
  }
]);

$submit = function() {
  $validatedData = $this->validate();

  if (!empty($this->image)) {
    $image = $this->image->storePubliclyAs('/mobil', $this->image->getClientOriginalName(), 'public');
    $validatedData['image'] = $image;
  }

  $validatedData['created_by'] = auth()->id();
  Car::create($validatedData);

  return $this->redirect(route('dashboard'), navigate: true);
};

$logout = function(Logout $logout) {
  $logout();
  $this->redirect('/');
};

?>

<div>
  <livewire:layout.navbar/>

  <div x-data="{ activeTab: 'mobilSaya' }" class="content-section flex">
    <div class="mt-20 border max-w-[320px] rounded-[30px] py-[35px] h-[290px] w-full">
      <h3 class="text-lg pl-[28px] mb-4">Navigasi Profile</h3>
      <div class="flex flex-col gap-2">
        <div @click="activeTab = 'tambahMobil'" :class="{ 'bg-[#B5FFB0]': activeTab === 'tambahMobil' }" class="flex items-center gap-2 pl-[28px] cursor-pointer hover:bg-[#8f8f8f] py-2 hover:text-white">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>          
          Tambah Mobil
        </div>
        
        <div @click="activeTab = 'mobilSaya'" :class="{ 'bg-[#B5FFB0]': activeTab === 'mobilSaya' }" class="flex items-center gap-2 pl-[28px] cursor-pointer py-2">
          <svg width="20" height="20" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="19.9997" cy="11.6667" r="6.66667" stroke="black" stroke-width="3" stroke-linecap="round"/>
            <path d="M9.78163 27.5692C10.7494 24.8664 13.4381 23.3333 16.3089 23.3333H23.6904C26.5613 23.3333 29.2499 24.8664 30.2177 27.5692C30.8778 29.4127 31.4915 31.68 31.6349 34.0006C31.669 34.5518 31.2186 35 30.6663 35H9.33301C8.78072 35 8.33038 34.5518 8.36445 34.0006C8.50787 31.6801 9.12154 29.4127 9.78163 27.5692Z" stroke="black" stroke-width="3" stroke-linecap="round"/>
          </svg>
          Mobil Saya
        </div>

        <div class="flex items-center gap-2 pl-[28px] cursor-pointer hover:bg-[#8f8f8f] py-2 hover:text-white">
          <svg width="20" height="20" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16.9063 11.046C18.2173 7.77763 18.8728 6.14347 20 6.14347C21.1272 6.14347 21.7827 7.77763 23.0937 11.046L23.1548 11.1982C23.8954 13.0446 24.2657 13.9678 25.0205 14.529C25.7752 15.0901 26.766 15.1789 28.7475 15.3563L29.1058 15.3884C32.3488 15.6788 33.9703 15.8241 34.3173 16.8557C34.6642 17.8873 33.46 18.9829 31.0516 21.174L30.2478 21.9053C29.0286 23.0145 28.419 23.5691 28.1349 24.296C28.0819 24.4316 28.0379 24.5705 28.003 24.7119C27.8163 25.4696 27.9948 26.2742 28.3518 27.8833L28.4629 28.3842C29.119 31.3414 29.4471 32.82 28.8743 33.4578C28.6603 33.6961 28.3821 33.8677 28.0731 33.952C27.246 34.1777 26.0719 33.2209 23.7237 31.3075C22.1817 30.051 21.4107 29.4227 20.5256 29.2814C20.1774 29.2258 19.8226 29.2258 19.4744 29.2814C18.5892 29.4227 17.8183 30.051 16.2763 31.3075C13.9281 33.2209 12.7539 34.1777 11.9269 33.952C11.6179 33.8677 11.3397 33.6961 11.1257 33.4578C10.5529 32.82 10.8809 31.3414 11.5371 28.3842L11.6482 27.8833C12.0052 26.2742 12.1837 25.4696 11.997 24.7119C11.9621 24.5705 11.9181 24.4316 11.8651 24.296C11.5809 23.5691 10.9713 23.0145 9.75217 21.9053L8.94837 21.174C6.53996 18.9829 5.33576 17.8873 5.68272 16.8557C6.02969 15.8241 7.6512 15.6788 10.8942 15.3884L11.2525 15.3563C13.234 15.1789 14.2247 15.0901 14.9795 14.529C15.7342 13.9678 16.1046 13.0446 16.8452 11.1982L16.9063 11.046Z" stroke="black" stroke-width="3"/>
          </svg>                    
          Favorite
        </div>

        <div class="flex items-center gap-2 pl-[28px] cursor-pointer hover:bg-[#8f8f8f] py-2 hover:text-white">
          <svg width="20" height="20" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M25.833 8.33333C28.1738 8.33333 29.3442 8.33333 30.1849 8.8951C30.5489 9.1383 30.8614 9.4508 31.1046 9.81476C31.6663 10.6555 31.6663 11.8259 31.6663 14.1667V30C31.6663 33.1427 31.6663 34.714 30.69 35.6904C29.7137 36.6667 28.1424 36.6667 24.9997 36.6667H14.9997C11.857 36.6667 10.2856 36.6667 9.30932 35.6904C8.33301 34.714 8.33301 33.1427 8.33301 30V14.1667C8.33301 11.8259 8.33301 10.6555 8.89478 9.81476C9.13797 9.4508 9.45047 9.1383 9.81444 8.8951C10.6552 8.33333 11.8256 8.33333 14.1663 8.33333" stroke="black" stroke-width="3"/>
            <path d="M15 8.33333C15 6.49238 16.4924 5 18.3333 5H21.6667C23.5076 5 25 6.49238 25 8.33333C25 10.1743 23.5076 11.6667 21.6667 11.6667H18.3333C16.4924 11.6667 15 10.1743 15 8.33333Z" stroke="black" stroke-width="3"/>
            <path d="M15 20L25 20" stroke="black" stroke-width="3" stroke-linecap="round"/>
            <path d="M15 26.6667L21.6667 26.6667" stroke="black" stroke-width="3" stroke-linecap="round"/>
          </svg>            
          Riwayat Transaksi
        </div>
      </div>
    </div>

    {{-- list mobil --}}
    <div class="w-full mt-5">
      <h1 x-cloak x-show="activeTab == 'mobilSaya'" class="text-center text-lg">List Mobil Rental saya</h1>
      <div x-cloak x-show="activeTab == 'mobilSaya'" class="flex items-center mt-2 ml-10">
          <input wire:model.live.debounce.500ms="search" class="w-full rounded-[20px] bg-[#F0F0F0] border-[#F0F0F0]" type="text" placeholder="Silahkan Cari">
          <div class="relative">
              <svg class="absolute right-2 -top-2 cursor-pointer" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M8 4.00003C6.93913 4.00003 5.92172 4.42146 5.17157 5.17161C4.42143 5.92175 4 6.93917 4 8.00003C4 9.0609 4.42143 10.0783 5.17157 10.8285C5.92172 11.5786 6.93913 12 8 12C9.06087 12 10.0783 11.5786 10.8284 10.8285C11.5786 10.0783 12 9.0609 12 8.00003C12 6.93917 11.5786 5.92175 10.8284 5.17161C10.0783 4.42146 9.06087 4.00003 8 4.00003ZM2 8.00003C1.99988 7.05574 2.22264 6.12475 2.65017 5.28278C3.0777 4.4408 3.69792 3.71163 4.4604 3.15456C5.22287 2.59749 6.10606 2.22825 7.03815 2.07687C7.97023 1.92549 8.92488 1.99625 9.82446 2.28338C10.724 2.57052 11.5432 3.06594 12.2152 3.72933C12.8872 4.39272 13.3931 5.20537 13.6919 6.10117C13.9906 6.99697 14.0737 7.95063 13.9343 8.88459C13.795 9.81855 13.4372 10.7064 12.89 11.476L17.707 16.293C17.8892 16.4816 17.99 16.7342 17.9877 16.9964C17.9854 17.2586 17.8802 17.5094 17.6948 17.6949C17.5094 17.8803 17.2586 17.9854 16.9964 17.9877C16.7342 17.99 16.4816 17.8892 16.293 17.707L11.477 12.891C10.5794 13.5293 9.52335 13.9082 8.42468 13.9862C7.326 14.0641 6.22707 13.8381 5.2483 13.333C4.26953 12.8279 3.44869 12.0631 2.87572 11.1224C2.30276 10.1817 1.99979 9.10147 2 8.00003Z" fill="#979797"/>
              </svg>
          </div>
      </div>
      <div x-cloak x-show="activeTab == 'mobilSaya'" class="grid grid-cols-3">
        @forelse ($cars as $car)
          <div class="pt-[35px]">
            <div class="ml-10 border max-w-[312px] rounded-[30px]">
              <div class="text-center mt-2">
                <h3>{{ $car->merk }}</h3>
                <p>Rp. {{ number_format($car->cost_per_day, 0, ',', '.') }} / Hari</p>
              </div>
              <img class="w-[282px] h-[172px]" src="{{ asset('storage/' . $car->image) }}" alt="">
              <div class="ml-10">
                <ul style="list-style-type:disc">
                  <li>Model : {{ $car->model }}</li>
                  <li>Plat : {{ $car->no_plat }}</li>
                  <li>{{ $car->available ? 'Tersedia' : 'Tidak tersedia' }}</li>
                </ul>
              </div>
              <div class="my-4 w-full flex justify-center">
                <button class="py-1 border px-20 flex items-center justify-center bg-[#B5FFB0] rounded-md font-bold">Sewa</button>
              </div>
            </div>
          </div>
        @empty
          <div x-cloak x-show="activeTab == 'mobilSaya'" class="text-center w-full mt-20">Belum ada mobil tersedia!</div>
        @endforelse
      </div>

      {{-- tambah mobil --}}
      <h1 x-cloak x-show="activeTab == 'tambahMobil'" class="text-center text-lg">Tambah Mobil Sewa</h1>
      <div x-cloak x-show="activeTab == 'tambahMobil'">
        <form wire:submit="submit">
          <div class="pt-[35px]">
            <div class="ml-10 flex gap-4 w-full">
              <label>
                <span>Merek</span>
                <input type="text" wire:model="merk" placeholder="Merk" class="w-full mt-2" />
                @error('merk')
                    <p class="text-red-600 text-xs">{{ $message }}</p>
                @enderror
              </label>
  
              <label>
                <span>Model</span>
                <input type="text" wire:model="model" placeholder="Model" class="w-full mt-2" />
                @error('model')
                    <p class="text-red-600 text-xs">{{ $message }}</p>
                @enderror
              </label>
            </div>
  
            <div class="ml-10 flex gap-4 w-full mt-3">
              <label>
                <span>No Plat</span>
                <input type="text" wire:model="no_plat" placeholder="No plat" class="w-full mt-2" />
                @error('no_plat')
                    <p class="text-red-600 text-xs">{{ $message }}</p>
                @enderror
              </label>
  
              <label>
                <span>Tarif per Hari</span>
                <input type="text" placeholder="Rp" required type-currency="AIDR" class="input-currency my-2 h-[40px] input input-bordered w-full" />
                @script
                    <script>
                        document.querySelectorAll('input[type-currency="AIDR"]').forEach((element) => {
                            element.addEventListener('keyup', function(e) {
                                let cursorPostion = this.selectionStart;
                                let value = parseInt(this.value.replace(/[^,\d]/g, ''));
                                let originalLenght = this.value.length;
                                if (isNaN(value)) {
                                    this.value = "";
                                } else {    
                                    this.value = value.toLocaleString('id-ID', {
                                    currency: 'IDR',
                                    style: 'currency',
                                    minimumFractionDigits: 0
                                });
                                    cursorPostion = this.value.length - originalLenght + cursorPostion;
                                    this.setSelectionRange(cursorPostion, cursorPostion);

                                    @this.set('cost_per_day', value);
                                }
                            });
                        });

                        document.querySelectorAll('input[type-currency="AIDR"]').forEach((element) => {
                            element.addEventListener('input', function (e) {
                                let cursorPostion = this.selectionStart;
                                let value = parseInt(this.value.replace(/[^,\d]/g, ''));

                                if (isNaN(value)) {
                                    this.value = "";
                                } else {
                                    this.value = value;
                                    this.setSelectionRange(cursorPostion, cursorPostion);

                                    @this.set('cost_per_day', value);
                                }
                            });
                        });
                    </script>
                @endscript
              </label>
            </div>
  
            <div class="ml-10 flex gap-4 w-full mt-3">
              <label>
                <span>Photo</span>
                <input type="file" wire:model="image" class="w-full mt-2" />
                @error('image')
                    <p class="text-red-600 text-xs">{{ $message }}</p>
                @enderror
              </label>
            </div>
            @if (isset($image))
              <div class="ml-10 flex justify-center">
                <img class="w-[200px] h-[200px]" src="{{ $image->temporaryUrl() }}" alt="">
              </div>
            @endif
  
            <div class="my-4 ml-10 w-full flex justify-start">
              <button type="submit" class="py-1 border px-20 flex items-center justify-center bg-[#B5FFB0] rounded-md font-bold w-full">Submit</button>
            </div>
          </div>
			    <x-waiting-for target="submit" />
        </form>
      </div>
    </div>
  </div>
</div>
