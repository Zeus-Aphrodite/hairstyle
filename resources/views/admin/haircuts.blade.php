@php #
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator|\App\Models\Haircut[]
 */
@endphp
@extends('admin.layout')

@section('content')
    <div class="page-title">
        <h3>Haircuts</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="grid simple">
                <div class="grid-body no-border">
                    <h3></h3>
                    <table class="table no-more-tables">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Wig image</th>
                                <th>Preview image</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($haircuts as $haircut)
                                <tr>
                                    <td>{{ $haircut->name }} ({{ $haircut->type }})</td>
                                    <td><span class="badge">{{ $haircut->type }}</span></td>
                                    <td>
                                        <a href="{{ $haircut->getWigImage() }}" target="_blank">
                                            <img src="{{ $haircut->getWigImage('thumbnail') }}" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ $haircut->getPreviewImage() }}" target="_blank">
                                            <img src="{{ $haircut->getPreviewImage('thumbnail') }}" alt="">
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $haircuts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
