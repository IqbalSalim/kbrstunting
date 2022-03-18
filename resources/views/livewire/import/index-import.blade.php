<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Import') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-md sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Import
                </div>
                <form wire:submit.prevent='store' novalidate class="px-4 py-2">
                    <div>
                        <x-label for="file" :value="__('File KBR-Stunting')" />

                        <input wire:model.defer='file' id="file" class="block w-full py-1 pl-2 mt-1 border text-md"
                            type="file" />
                        <span class="text-sm text-red-600">
                            @error('file')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mt-2">
                        <button type="submit"
                            class="px-4 py-2 text-xs font-semibold text-white bg-indigo-400 border border-indigo-500 rounded-md shadow-sm">Submit</button>
                    </div>
                </form>

                <hr>
                <div class="px-4">
                    <div class="w-full overflow-x-auto md:overflow-hidden">
                        <table class="min-w-full mt-2 divide-y divide-gray-200 table-auto">
                            <thead class="bg-gray-50">
                                <tr class="">
                                    <th scope="col"
                                        class="w-1/12 px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                        #
                                    </th>
                                    <th scope="col"
                                        class="px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                        Desa/Kelurahan
                                    </th>
                                    <th scope="col"
                                        class="px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                        Kecamatan
                                    </th>
                                    <th scope="col"
                                        class="px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                        Kabupaten/Kota
                                    </th>
                                    <th scope="col"
                                        class="px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                        Provinsi
                                    </th>
                                    <th scope="col"
                                        class="px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase ">
                                        <span class="sr-only">Hapus</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($keluarga as $row)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-500 md:px-6 whitespace-nowrap">
                                            {{ $no++ }}
                                        </td>
                                        <td class="px-2 py-4 text-sm md:px-6">
                                            {{ $row->desa_kelurahan }}
                                        </td>
                                        <td class="px-2 py-4 text-sm md:px-6">
                                            {{ $row->kecamatan }}
                                        </td>
                                        <td class="px-2 py-4 text-sm md:px-6">
                                            {{ $row->kabupaten_kota }}
                                        </td>
                                        <td class="px-2 py-4 text-sm md:px-6">
                                            {{ $row->provinsi }}
                                        </td>
                                        <td class="px-2 text-sm md:px-6">
                                            <div class="flex flex-row items-center space-x-4">
                                                <button
                                                    wire:click.prevent="alertConfirm('{{ $row->desa_kelurahan }}','{{ $row->kecamatan }}','{{ $row->kabupaten_kota }}','{{ $row->provinsi }}')"
                                                    type="button"
                                                    class="px-4 py-2 text-xs font-semibold text-white bg-red-600 border border-red-600 rounded-md shadow-sm">Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- More people... -->
                                {{-- {{ $row->desa_kelurahan }}, {{ $row->kecamatan }}, {{ $row->kabupaten_kota }}, {{ $row->provinsi }}) --}}
                            </tbody>
                        </table>
                        {{-- {{ $rkps->links() }} --}}
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
