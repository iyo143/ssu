@extends('layouts.student')

@section('content')
    <section>
        <div class="main">
            <div class="row sidebar">
                @include('layouts.partials.side-bar')
                <!--end of side-->
                <div class="col-xl-8 col-md-7 col-sm-6">
                    <div class="card">
                        <div class="card-header"><i class="fas fa-plus-square"></i> {{ __('Edit Documents') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('update.document', $documents->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Document Name') }}</label>
                                    <div class="col-md-6">
                                        <input  type="text" class="form-control @error('doc_name') is-invalid @enderror" name="doc_name" value="{{$documents->document_name}}" required autocomplete="doc_name" autofocus>
                                        @error('doc_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Price(₱)') }}</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="doc_price" value="{{$documents->price}}" required autocomplete="name" autofocus>
                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Requisit Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($documents->requirements as $requirement)
                                        <tr>
                                            <th scope="row"></th>
                                            <td>{{$requirement->doc_description}}</td>
                                           
                                            <td><a href="{{route('detached.requirement', [$requirement->id, $documents->id])}}" class="btn btn-danger deleteUser" >Delete</a></td>  
                                      
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Update Document') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
