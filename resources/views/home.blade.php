<x-layout>
    <x-slot:title>January's Report</x-slot:title>
    <a href="/income/{{ Auth::user()->username }}" class="hidden sm:inline-flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 
    focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 
    focus:outline-none dark:focus:ring-primary-800">
      View Detail Income
    </a>
    <x-slot:title>January's Report</x-slot:title>
    <a href="/outcome/{{ Auth::user()->username }}" class="hidden sm:inline-flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 
    focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 
    focus:outline-none dark:focus:ring-primary-800">
      View Detail Outcome
    </a>
</x-layout>
