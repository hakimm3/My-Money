<div>
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <div
                        class="items-center my-4 mx-3 justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                        <div class="flex items-center mb-4 sm:mb-0">
                            <form class="sm:pr-3" action="#" method="GET">
                                <label for="products-search" class="sr-only">Search</label>
                                <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                                    <input type="search" name="email" id="products-search"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Search" wire:model="search">
                                </div>
                            </form>
                            <div class="flex items-center w-full sm:justify-end">
                                <div class="flex pl-2 space-x-1">
                                    <a href="#"
                                        class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                    <a href="#"
                                        class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                    <a href="#"
                                        class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                    <a href="#"
                                        class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <x-drawer.button-component id="createProductButton" text="Create" color="primary"
                            iconClass="fa-solid fa-plus" drawerId="drawer-create" />
                            
                    </div>
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                @if ($checkbox && $checkbox_side == 'left')
                                    @include('laravel-livewire-tables::checkbox-all2')
                                @endif

                                @foreach ($columns as $column)
                                    <th scope="col"
                                        class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400 {{ $this->thClass($column->attribute) }}">
                                        @if ($column->sortable)
                                            <span style="cursor: pointer;"
                                                wire:click="sort('{{ $column->attribute }}')">
                                                {{ $column->heading }}

                                                @if ($sort_attribute == $column->attribute)
                                                    <i
                                                        class="fa fa-sort-amount-{{ $sort_direction == 'asc' ? 'up-alt' : 'down' }}"></i>
                                                @else
                                                    <i class="fa fa-sort-amount-up-alt" style="opacity: .35;"></i>
                                                @endif
                                            </span>
                                        @else
                                            {{ $column->heading }}
                                        @endif
                                    </th>
                                @endforeach

                                @if ($checkbox && $checkbox_side == 'right')
                                    @include('laravel-livewire-tables::checkbox-all2')
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @if ($models->isEmpty())
                                <tr>
                                    <td colspan="{{ count($columns) + 1 }}">
                                        <h2 class="text-white text-xl p-4">There's nothing to show at the moment</h2>
                                    </td>
                                </tr>
                            @else
                                @foreach ($models as $model)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 {{ $this->trClass($model) }}">
                                        @if ($checkbox && $checkbox_side == 'left')
                                            @include('laravel-livewire-tables::checkbox-row2')
                                        @endif

                                        @foreach ($columns as $column)
                                            <td
                                                class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white {{ $this->tdClass($column->attribute, $value = Arr::get($model->toArray(), $column->attribute)) }}">
                                                @if ($column->view)
                                                    @include($column->view)
                                                @else
                                                    {{ $value }}
                                                @endif
                                            </td>
                                        @endforeach

                                        @if ($checkbox && $checkbox_side == 'right')
                                            @include('laravel-livewire-tables::checkbox-row2')
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $models->links() }}
</div>