@extends('layouts.app')

@section('content')


<form action="{{ route('search') }}" method="get">
    
    @csrf

    <div class="container text-center">
        <div class="row">
            <div class="col">
                <h3>AEMET con Laravel</h3>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col col-lg-4">
                <input class="form-control" list="datalistOptions" id="city" name="city" placeholder="Escribe el nombre de la ciudad...">
                <datalist id="datalistOptions">
                    <option value="Águilas">
                    @foreach($arrayStationName as $key => $value)
                        <option value="{{ $value }}">
                    @endforeach
                </datalist>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success mt-3">Consultar</button>
            </div>
        </div>
        @error($cityNotFound)
        <div class="row">
                <div class="alert alert-danger mt-3" role="alert">
                    {{ $message }}
                </div>
        </div>
        @enderror

        <div class="row">
            @isset($cityNotFound)
                <div class="alert alert-danger mt-3" role="alert">
                    {{ $cityNotFound }}
                </div>
            @endisset
        </div>

        <div class="row justify-content-md-center">
            <div class="card" style="width: 48rem;">
                <img src="https://images.pexels.com/photos/794566/pexels-photo-794566.jpeg" class="card-img-top" alt="Temporal..">
                <div class="card-body">
                  <h5 class="card-title">{{ $city }}</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><strong>{{ $temperatureMax }}ºC</strong></li>
                  <li class="list-group-item">Min: {{ $temperatureNow }} ºC</li>
                  <li class="list-group-item">Max: {{ $temperatureMin }} ºC</li>
                </ul>
                <div class="card-body">
                  <a href="#" class="card-link">Website1</a>
                  <a href="#" class="card-link">Website2</a>
                </div>
              </div>
        </div>
    </div>
</form>


@endsection
