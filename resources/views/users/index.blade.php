@extends('layouts.master', ['title' => 'Master User'])

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Data User Active</h4>
    </div>
    <div class="card-body">
        <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary mb-3"> Tambah User</a>

        <div class="table-responsive">
            <table class="table-bordered table-striped table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No</th>
                        <th>Photo</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="avatar avatar-l">
                                <img src="{{ asset('/storage/'. $user->photo) }}" alt="{{ $user->photo }}">
                            </div>
                        </td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@push('script')
<script>
    $(document).ready(function() {
        var table = $('.table').DataTable({
            responsive: {
                details: {
                    type: 'column'
                }
            },
            columnDefs: [{
                    className: 'dtr-control',
                    responsivePriority: 1,
                    targets: 0
                },
                {
                    responsivePriority: 2,
                    targets: 1
                }
            ]
        });

        new $.fn.dataTable.FixedHeader(table);
    });
</script>
@endpush