@php #
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator|\App\Models\Haircut[]
 * @var bool $isForPackedHaircuts
 */
$isForPackedHaircuts = $isForPackedHaircuts ?? false;
$routePrefix = $isForPackedHaircuts ? 'admin.packed-haircuts' : 'admin.haircuts';
@endphp
@extends('admin.layout')

@section('content')
    <div class="page-title">
        <h3>Haircuts &nbsp;&nbsp;<a href="{{ \route("$routePrefix.create") }}" class="btn btn-primary">Add new</a></h3>
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
                                <th>
                                    @if ($isForPackedHaircuts)
                                        Pack
                                    @else
                                        Type
                                    @endif
                                </th>
                                <th>Description</th>
                                @if (!$isForPackedHaircuts)
                                    <th>Free</th>
                                @endif
                                <th>Wig image</th>
                                <th>Preview image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($haircuts as $haircut)
                                <tr>
                                    <td>
                                        <a href="{{ \route("$routePrefix.edit", ['haircut' => $haircut]) }}">
                                            {{ $haircut->name }} ({{ $haircut->type }})
                                        </a>
                                    </td>
                                    <td><span class="badge">
                                            {{ $isForPackedHaircuts ? $haircut->pack->name : $haircut->type }}
                                        </span></td>
                                    <td>{{ $haircut->description }}</td>
                                    @if (!$isForPackedHaircuts)
                                        <td>
                                            @if ($haircut->is_free)
                                                <span class="label label-success">Yes</span>
                                            @else
                                                <span class="label label-warning">No</span>
                                            @endif
                                        </td>
                                    @endif
                                    <td>
                                        <a href="{{ $haircut->getWigImage() }}" target="_blank">
                                            <img src="{{ $haircut->getWigImage('thumbnail') }}" alt="" style="max-width: 100px">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ $haircut->getPreviewImage() }}" target="_blank">
                                            <img src="{{ $haircut->getPreviewImage('thumbnail') }}" alt="" style="max-width: 100px">
                                        </a>
                                    </td>
                                    <td>
                                        <form
                                            action="{{ \route("$routePrefix.delete", ['haircut' => $haircut]) }}"
                                            method="POST"
                                            class="js-delete-form"
                                        >
                                            {!! \method_field('DELETE') !!}
                                            {!! \csrf_field() !!}
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
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

@section ('scripts')
    <script type="text/javascript">
        $('.js-delete-form').on('submit', function(event) {
            if (!confirm('Sure to delete')) {
                event.preventDefault()
            }
        });
    </script>
@endsection
