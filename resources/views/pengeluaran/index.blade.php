@extends('layout.app')
@section('content')
    <x-heading-component>
        <x-slot name="breadcrumb">
            <x-breadcrumb.main-component>
                <x-slot name="items">
                    <x-breadcrumb.active-component text="Spending" />
                </x-slot>
            </x-breadcrumb.main-component>
        </x-slot>
        <x-slot name="title">
            All Spending
        </x-slot>
    </x-heading-component>



    @livewire('spending-table')

<!-- Edit Product Drawer -->
        <x-drawer.main-component id="drawer-update" title="Update Item">
            <x-slot name="body">
                <form action="{{ route('spending.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="id" id="id">

                    <div class="space-y-4">
                        <div>
                            <x-form.label-component for="date-update" text="Date" />
                            <x-form.input type="date" name="date" id="date-update" placeholder="Date" additionalAttributes="required" />
                        </div>

                        <div>
                            <x-form.label-component for="description-update" text="Description" />
                            <x-form.input type="text" name="description" id="description-update" placeholder="Description" additionalAttributes="required" />
                        </div>

                        <div>
                            <x-form.label-component for="category-update" text="Category" />
                            <x-form.select-component name="category_id" id="category-update" placeholder="Category" additionalAttributes="required" :options="$categories" />
                        </div>

                        <div>
                            <x-form.label-component for="amount-update" text="Amount" />
                            <x-form.input type="number" name="amount" id="amount-update" placeholder="Amount" additionalAttributes="required" />
                        </div>
                    </div>
                    <div class="bottom-0 left-0 flex justify-center w-full pb-4 mt-4 space-x-4 sm:absolute sm:px-4 sm:mt-0">
                        <button type="submit" class="w-full justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Update
                        </button>
                        <button type="button" data-drawer-dismiss="drawer-update"
                            aria-controls="drawer-update"
                            class="inline-flex w-full justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            <svg aria-hidden="true" class="w-5 h-5 -ml-1 sm:mr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                            Cancel
                        </button>
                    </div>
                </form>
            </x-slot>
        </x-drawer.main-component>


               <!-- Delete Product Drawer -->
        <x-drawer.main-component id="drawer-delete" title="Delete Item">
            <x-slot name="body">
                <svg class="w-10 h-10 mt-8 mb-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
               
                <h3 class="mb-6 text-lg text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
               
                <button onclick="performDelete()" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2.5 text-center mr-2 dark:focus:ring-red-900">
                    Yes, I'm sure
                </button>

                <a href="#" class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-sm px-3 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700" 
                    data-drawer-hide="drawer-delete">
                    No, cancel
                </a>
            </x-slot>
        </x-drawer.main-component>


        <!-- Create Product Drawer -->
        <x-drawer.main-component id="drawer-create" title="New Spending">
            <x-slot name="body">
                <form action="{{ route('spending.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
    
                    <div class="space-y-4">
                        <div>
                            <x-form.label-component for="date-create" text="Date" />
                            <x-form.input type="date" name="date" id="date-create" placeholder="Date" additionalAttributes="required" />
                        </div>
    
                        <div>
                            <x-form.label-component for="description-create" text="Description" />
                            <x-form.input type="text" name="description" id="description-create" placeholder="Description" additionalAttributes="required" />
                        </div>
    
                        <div>
                            <x-form.label-component for="category-create" text="Category" />
                            <x-form.select-component name="category_id" id="category-create" placeholder="Category" additionalAttributes="required" :options="$categories" />
                        </div>
    
                        <div>
                            <x-form.label-component for="amount-create" text="Amount" />
                            <x-form.input type="number" name="amount" id="amount-create" placeholder="Amount" additionalAttributes="required" />
                        </div>
                        <div class="bottom-0 left-0 flex justify-center w-full pb-4 space-x-4 md:px-4 md:absolute">
                            <x-form.button-component type="submit" text="Add Spending" />
                            <button type="button" data-drawer-dismiss="drawer-create"
                                aria-controls="drawer-create"
                                class="inline-flex w-full justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                <svg aria-hidden="true" class="w-5 h-5 -ml-1 sm:mr-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                                    </path>
                                </svg>
                                Cancel
                            </button>
                        </div>
                </form>
            </x-slot>
        </x-drawer.main-component>

    </main>
    
  </div>

</div>
@endsection
@include('pengeluaran.script')
