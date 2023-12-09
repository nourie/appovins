<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="row"> {{ __('Dashboard') }} </div>
            <br>
            <div class="row"> <a class="nav-link" href="{{ route('ovins.index') }}"> تتبع القطيع</a></div>

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
      
            <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<div class="row">
<div class="col-2 p-3 mb-2 bg-primary text-white">.bg-primary</div>
<div class="col-2 p-3 mb-2 bg-secondary text-white">.bg-secondary</div>
<div class="col-2 p-3 mb-2 bg-success text-white">.bg-success</div>
</div>
<div class="row">
    <div class="contoner"></div>
<div class="col-2 p-3 mb-2 bg-danger text-white">.bg-danger</div>
<div class="col-2 p-3 mb-2 bg-warning text-dark">.bg-warning</div>
<div class="col-2 p-3 mb-2 bg-info text-white">.bg-info</div>
</div>
<div class="row">
<div class="col-2 p-3 mb-2 bg-light text-dark">.bg-light</div>
<div class="col-2 p-3 mb-2 bg-dark text-white">.bg-dark</div>
<div class="col-2 p-3 mb-2 bg-white text-dark">.bg-white</div>
</div>
            
            <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout>