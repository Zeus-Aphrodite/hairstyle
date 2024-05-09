@php #
/**
 * @var \App\Models\HaircutPack[] $packs
 * @var int $allSelectionsCount
 */
@endphp

@extends('admin.layout')

@section('content')
    <div class="page-title">
        <h3>Selection stats</h3>
    </div>
    <div class="row">
        @foreach ($packs as $pack)
            <div class="col-md-6">
                <div class="grid simple">
                    <div class="grid-body no-border">
                        @php $packPickings = $pack->getPickings(); @endphp
                        <h3>
                            {{ $pack->name }} (Total percentage of picking - {{ \round($packPickings / \max($allSelectionsCount, 1), 2) * 100 }}%,
                            picked {{ $packPickings }}/{{ $allSelectionsCount }})
                            <form
                                action="{{ \route('admin.pack-selections.reset', ['pack' => $pack]) }}"
                                method="POST"
                                class="js-delete-form"
                                style="display: inline-block"
                            >
                                {!! \method_field('DELETE') !!}
                                {!! \csrf_field() !!}
                                <button type="submit" class="btn btn-danger">Reset</button>
                            </form>
                        </h3>
                        <table class="table no-more-tables">
                            <thead>
                            <tr>
                                <th>Hairstyle</th>
                                <th>Times picked</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($pack->haircuts as $haircut)
                                <tr>
                                    <td>
                                        <a href="{{ \route('admin.packed-haircuts.edit', ['haircut' => $haircut]) }}" target="_blank">
                                            {{ $haircut->name }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $haircut->getTimesSelected() }} ({{ \round($haircut->getTimesSelected() / \max($allSelectionsCount, 1), 4) * 100 }})%
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section ('scripts')
    <script type="text/javascript">
        $('.js-delete-form').on('submit', function(event) {
            if (!confirm('Sure to reset?')) {
                event.preventDefault()
            }
        });
    </script>
@endsection
