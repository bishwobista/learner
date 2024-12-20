<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Card') }}
        </h2>
        <div class=" float-right mb-6">
            <a href="{{ route('sample.download') }}" class="text-blue-500 hover:underline">Download Sample CSV</a>
        </div>
        <form action="{{route('cards.import')}}" method="POST" enctype="multipart/form-data" class="max-w-sm mx-auto">
            @csrf
        
            <div class="flex items-center justify-center space-x-4">
                <div class="mb-4">
                    <label for="csv-file" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Import CSV</label>
                    <input type="file" name="file" id="file"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                
                <div class="mb-4">
                    <label for="deck_id" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Select Deck</label>
                    <select name="deck_id" id="deck_id" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled>Choose a deck</option>
                        @foreach($decks as $deck)
                            <option value="{{ $deck->id }}">{{ $deck->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        
            <button type="submit"
                class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
       
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
                <form action="{{route('cards.store')}}" method="POST" class="max-w-sm mx-auto">
                    @csrf
            
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                    <select name="type" rquired id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option disabled >Choose a type</option>
                        <option selected value="basic">Basic</option>
                        <option  disabled value="again">Again</option>
                    </select>

                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deck</label>
                    <select name="deckId" required id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled>Choose a deck</option>
                        @foreach($decks as $deck)
                            <option value="{{$deck->id}}">{{$deck->name}}</option>
                        @endforeach
                    </select>

                    <div class="mb-6">
                        <label for="question-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">question input</label>
                        <input required name="question" type="text" id="question-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-6">
                        <label for="answer-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">answer input</label>
                        <input required name="answer" type="text" id="answer-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    
                    <div class="mt-6">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>

