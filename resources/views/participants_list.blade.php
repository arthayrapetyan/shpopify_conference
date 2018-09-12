@extends('conference')
@section('content')
    <h2 class="text-center">Conference Participants</h2>
    <a href="{{ route('conference_form') }}" class="btn btn-default btn-sm pull-left">Back</a>
    <div class="col-md-5 col-lg-6 col-md-push-3 list_container">
        @foreach($participantGroups as $group)
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Role</th>
                </tr>
                </thead>
                <tbody>
                @foreach($group as $participant)
                    <tr class="{{ $participant->role ? 'active' : '' }}">
                        <td>{{ $participant->name }}</td>
                        <td>{{ $participant->country ?: '-' }}</td>
                        <td>{{ $participant->role ? 'leader' : 'guest' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
@endsection