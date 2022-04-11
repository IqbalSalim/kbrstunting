<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Rekapan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="h-full overflow-hidden bg-white shadow-md sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 ">
                    Rekapan
                </div>
                <div class="px-6 py-4">
                    <div class="flex flex-row items-end justify-center space-x-6">
                        <div class="flex flex-row space-x-8">
                            <div>
                                <x-label for="province" :value="__('Provinsi')" />
                                <select name="province" id="province" wire:model="province" wire:change='getDistrict'
                                    class="block w-full mt-1 text-sm capitalize border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option value="">-- Semua Provinsi --</option>
                                    @foreach ($provinces as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-label for="district" :value="__('Kabupaten')" />
                                <select name="district" id="district" wire:model="district" wire:change='getSubDistrict'
                                    class="block w-full mt-1 text-sm capitalize border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option value="">-- Semua Kabupaten --</option>
                                    @if (!empty($districts))
                                        @foreach ($districts as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div>
                                <x-label for="subDistrict" :value="__('Kecamatan')" />
                                <select name="subDistrict" id="subDistrict" wire:model="subDistrict"
                                    class="block w-full mt-1 text-sm capitalize border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option value="">-- Semua Kecamatan --</option>
                                    @if (!empty($subDistricts))
                                        @foreach ($subDistricts as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="flex flex-row px-8 py-4 space-x-8">
                    <div class="flex flex-col space-y-2">
                        <div class="flex flex-row items-center space-x-2">
                            <input id="baduta" wire:model='baduta' name="baduta" type="checkbox">
                            <label for="baduta" class="text-sm font-semibold">Baduta</label>
                        </div>
                        <div class="flex flex-row items-center space-x-2">
                            <input id="balita" value="reguler" wire:model='balita' name="balita" type="checkbox">
                            <label for="balita" class="text-sm font-semibold">Balita</label>
                        </div>
                        <div class="flex flex-row items-center space-x-2">
                            <input id="pusHamil" value="reguler" wire:model='pusHamil' name="pusHamil" type="checkbox">
                            <label for="pusHamil" class="text-sm font-semibold">PUS Hamil</label>
                        </div>
                        <div class="flex flex-row items-center space-x-2">
                            <input id="pus" wire:model='pus' name="pus" type="checkbox">
                            <label for="pus" class="text-sm font-semibold">PUS</label>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <div class="flex flex-row items-center space-x-2">
                            <input id="anakTidakSekolah" wire:model='anakTidakSekolah' name="anakTidakSekolah"
                                type="checkbox">
                            <label for="anakTidakSekolah" class="text-sm font-semibold">Anak Tidak Sekolah</label>
                        </div>
                        <div class="flex flex-row items-center space-x-2">
                            <input id="tidakMemilikiSumberPenghasilan" wire:model='tidakMemilikiSumberPenghasilan'
                                name="tidakMemilikiSumberPenghasilan" type="checkbox">
                            <label for="tidakMemilikiSumberPenghasilan" class="text-sm font-semibold">Tidak Memiliki
                                Sumber
                                Penghasilan</label>
                        </div>

                        <div class="flex flex-row items-center space-x-2">
                            <input id="lantaiTanah" wire:model='lantaiTanah' name="lantaiTanah" type="checkbox">
                            <label for="lantaiTanah" class="text-sm font-semibold">Lantai Tanah</label>
                        </div>
                        <div class="flex flex-row items-center space-x-2">
                            <input id="tidakMakan" wire:model='tidakMakan' name="tidakMakan" type="checkbox">
                            <label for="tidakMakan" class="text-sm font-semibold">Tidak Makan</label>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <div class="flex flex-row items-center space-x-2">
                            <input id="praSejahtera" wire:model='praSejahtera' name="praSejahtera" type="checkbox">
                            <label for="praSejahtera" class="text-sm font-semibold">Pra Sejahtera</label>
                        </div>

                        <div class="flex flex-row items-center space-x-2">
                            <input id="tidakMemilikiSumberAir" wire:model='tidakMemilikiSumberAir'
                                name="tidakMemilikiSumberAir" type="checkbox">
                            <label for="tidakMemilikiSumberAir" class="text-sm font-semibold">Tidak Memiliki Sumber
                                Air</label>
                        </div>
                        <div class="flex flex-row items-center space-x-2">
                            <input id="tidakMemilikiJamban" wire:model='tidakMemilikiJamban' name="tidakMemilikiJamban"
                                type="checkbox">
                            <label for="tidakMemilikiJamban" class="text-sm font-semibold">Tidak Memiliki Jamban</label>
                        </div>
                        <div class="flex flex-row items-center space-x-2">
                            <input id="tidakMemilikiRumah" wire:model='tidakMemilikiRumah' name="tidakMemilikiRumah"
                                type="checkbox">
                            <label for="tidakMemilikiRumah" class="text-sm font-semibold">Tidak Memiliki Rumah Layak
                                Huni</label>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <div class="flex flex-row items-center space-x-2">
                            <input id="pendidikanDibawah" wire:model='pendidikanDibawah' name="pendidikanDibawah"
                                type="checkbox">
                            <label for="pendidikanDibawah" class="text-sm font-semibold">Pendidikan Ibu di Bawah
                                SLTP</label>
                        </div>
                        <div class="flex flex-row items-center space-x-2">
                            <input id="terlaluMuda" wire:model='terlaluMuda' name="terlaluMuda" type="checkbox">
                            <label for="terlaluMuda" class="text-sm font-semibold">Terlalu Muda</label>
                        </div>
                        <div class="flex flex-row items-center space-x-2">
                            <input id="terlaluTua" wire:model='terlaluTua' name="terlaluTua" type="checkbox">
                            <label for="terlaluTua" class="text-sm font-semibold">Terlalu Tua</label>
                        </div>
                        <div class="flex flex-row items-center space-x-2">
                            <input id="terlaluDekat" wire:model='terlaluDekat' name="terlaluDekat" type="checkbox">
                            <label for="terlaluDekat" class="text-sm font-semibold">Terlalu Dekat</label>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <div class="flex flex-row items-center space-x-2">
                            <input id="terlaluBanyak" wire:model='terlaluBanyak' name="terlaluBanyak" type="checkbox">
                            <label for="terlaluBanyak" class="text-sm font-semibold">Terlalu Banyak</label>
                        </div>
                        <div class="flex flex-row items-center space-x-2">
                            <input id="kbrStunting" wire:model='kbrStunting' name="kbrStunting" type="checkbox">
                            <label for="kbrStunting" class="text-sm font-semibold">KBR Stunting</label>
                        </div>
                    </div>
                </div>
                <div id="chart">
                </div>
            </div>




        </div>
    </div>
    {{-- @push('chart') --}}
    <script>
        document.addEventListener("livewire:load", function(event) {
            window.addEventListener('chartChanged', (e) => {
                // console.log(e.detail.item.categories
                var options = {
                    chart: {
                        type: 'bar'
                    },
                    series: [{
                        name: 'KBRS',
                        data: e.detail.item.data
                    }],
                    xaxis: {
                        categories: e.detail.item.categories
                    }
                }

                var chart = new ApexCharts(document.querySelector("#chart"), options);

                chart.render();
            });

            @this.call('runningChart')
        });
    </script>
    {{-- @endpush --}}
</div>
