@extends('layouts.student')
@section('content')
<section>
        <div class="main">
            <div class="row sidebar">

            @include('layouts.partials.side-bar')

                <!--end of side-->
                <div class="col-xl-8 col-md-7 col-sm-6">
                  <div class="card">
                      @if(session('message'))
                          <div class="alert alert-success alert-dismissible w-4/5  m-10 p-10">
                              <p class="">
                                  {{ session('message') }}
                              </p>
                          </div>
                      @endif
                    <div class="card-header"><i class="fas fa-align-left"></i> {{ __('STUDENT REQUEST FORM') }}</div>
                        <div class="card-body">
                            <form action="{{route('request.update')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                  <div class="mb-5">
                                    <label for="exampleInputEmail1" class="form-label">Check the Document that are successfully finished.</label>
                                    @foreach( $user->documents as $docs)
                                        @if($docs->pivot->status == 0)
                                          <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{$docs->pivot->id}}" id="flexCheckDefault" name="documents[]">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{$docs->document_name}}
                                            </label>
                                          </div>
                                          @endif
                                    @endforeach
                                  </div>
                                  <div class="mt-3 mb-5">
                                    <label for="date">Receiving at:</label>
                                    <input type="date" id="date" name="date" class="form-control" required>  
                                  </div>
                                    <div class="footer">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Confirm</button>
                                    </div>
                                </form>
                            </div>
                          </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('scripts')
 <script type="text/javascript">
    $(function () {
    $('#datetimepicker1').datetimepicker();
    });

    jQuery(document).ready(function($) {
    if (window.jQuery().datetimepicker) {
        $('.datetimepicker1').datetimepicker({
            // Formats
            // follow MomentJS docs: https://momentjs.com/docs/#/displaying/format/
            format: 'DD-MM-YYYY hh:mm A',

            // Your Icons
            // as Bootstrap 4 is not using Glyphicons anymore
            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-check',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
        });
    }
});
</script>
@endsection
