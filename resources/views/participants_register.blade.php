@extends('conference')

@section('content')
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-push-4 well" id="conferenceForm">
        <h5 class="text-center">Please, fill out the form</h5>
            @csrf
        <div class="buttons text-center">
            <button type="button" class="btn btn-sm btn-default pull-left add_row">Add Row</button>
            <a href="{{ route('participants_list') }}" type="button" class="btn btn-sm  btn-default">View List</a>
            <button type="submit" class="btn btn-sm btn-primary pull-right submit">Submit</button>
        </div>
    </div>
    @include('templates.user_info_card')
@endsection

@section('scripts')
    <script src="{{ asset('/js/app.js') }}"></script>
@endsection