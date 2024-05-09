@php #
/**
 * @var \App\Models\Haircut $haircut
 * @var bool $isPackedHaircut
 * @var array $availablePacks
 */
$haircut = $haircut ?? null;
$method = $haircut ? 'PUT' : 'POST';
$types = [
    'short' => 'Short',
    'medium' => 'Medium',
    'long' => 'Long',
];
$createRoute = $isPackedHaircut ? 'admin.packed-haircuts.store' : 'admin.haircuts.store';
$updateRoute = $isPackedHaircut ? 'admin.packed-haircuts.update' : 'admin.haircuts.update';
@endphp
@extends('admin.layout')

@section('content')
    <div class="page-title">
        @if ($haircut)
            <h3>Update haircut <b>{{ $haircut->name }}</b></h3>
        @else
            <h3>Create haircut</h3>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="grid simple">
                <div class="grid-body no-border" style="padding-top: 20px">
                    <div class="col-md-8 col-sm-8 col-xs-8">
                        <form
                            @if ($haircut)
                                action="{{ \route($updateRoute, ['haircut' => $haircut]) }}"
                            @else
                                action="{{ \route($createRoute) }}"
                            @endif
                            method="POST"
                            id="form"
                        >
                            {!! \csrf_field() !!}
                            {!! method_field($method) !!}
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <span class="help">e.g Quiff, Pompadour</span>
                                <div class="controls">
                                    <input type="text" class="form-control" required name="name" value="{{ $haircut->name ?? '' }}">
                                </div>
                            </div>
                            @if (!$isPackedHaircut)
                                <div class="form-group">
                                    <div class="checkbox check-primary checkbox-circle">
                                        <input id="checkbox9" name="is_free" type="checkbox" value="1" @if ($haircut->is_free ?? false) checked @endif>
                                        <label for="checkbox9">Is free haircut (if this is checked haircut won't require payment in the app)</label>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group">
                                <label class="form-label">Description @if ($isPackedHaircut) (optionally) @endif</label>
                                <span class="help">e.g Pixie, Wavy</span>
                                <div class="controls">
                                    <input type="text" class="form-control" @if(!$isPackedHaircut) required @endif name="description" value="{{ $haircut->description ?? '' }}">
                                </div>
                            </div>
                            @if (!$isPackedHaircut)
                                <div class="form-group">
                                    <label class="form-label">Type</label>
                                    <div class="controls">
                                        <select id="source" style="width:100%" required name="type">
                                            @foreach ($types as $type => $label)
                                                <option value="{{ $type }}" @if (($haircut->type ?? '') == $type) selected @endif>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

                            @if ($isPackedHaircut)
                                <div class="form-group">
                                    <label class="form-label">Pack</label>
                                    <div class="controls">
                                        <select id="source" style="width:100%" required name="pack">
                                            @foreach ($availablePacks as $pack => $label)
                                                <option value="{{ $pack }}" @if (($haircut->pack->id ?? '') == $pack) selected @endif>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <label class="form-label">Wig image</label>
                                <span class="help">
                                    <a
                                        href="http://res.cloudinary.com/jordi20/image/upload/c_fit/v1/haircuts/long/long1.png"
                                        target="_blank"
                                    >
                                        Example
                                    </a>
                                </span>
                                <div class="controls">
                                    <input type="text" class="form-control upload_widget_opener" readonly value="{{ $haircut->wig_cloudinary_id ?? ''}}">
                                    <input type="hidden" name="wig_image" value="{{ $haircut->wig_cloudinary_id ?? ''}}">
                                    <img class="cloudinary-preview" style="max-width: 100%;" @if ($haircut) src="{{ $haircut->getWigImage() }}" @endif/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Preview image</label>
                                <span class="help">
                                    <a
                                        href="http://res.cloudinary.com/jordi20/image/upload/c_fit/v1/haircuts/long/long1-thumb.png"
                                        target="_blank"
                                    >
                                        Example
                                    </a>
                                </span>
                                <div class="controls">
                                    <input type="text" class="form-control upload_widget_opener" readonly value="{{ $haircut->preview_cloudinary_id ?? ''}}">
                                    <input type="hidden" name="preview_image" value="{{ $haircut->preview_cloudinary_id ?? ''}}">
                                    <img class="cloudinary-preview" style="max-width: 100%;" @if ($haircut) src="{{ $haircut->getPreviewImage() }}" @endif/>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="//widget.cloudinary.com/global/all.js" type="text/javascript"></script>

    <script type="text/javascript">
        $('.upload_widget_opener').on('click', function () {
            var clickedInput = $(this);
            cloudinary.openUploadWidget({
                    cloud_name: "{{ \config('cloudder.cloudName') }}",
                    upload_preset: "{{ \config('cloudder.uploadPreset') }}",
                    folder: 'haircuts',
                },
                function (error, result) {
                    clickedInput.val(result[0].original_filename + '.' + result[0].format);
                    clickedInput.parent().find('input[type=hidden]').val(result[0].public_id);
                    clickedInput.parent().find('.cloudinary-preview').attr('src', result[0].url);
                }
            );
        });
        $('#form').on('submit', function(event) {
            if ($("input[name='preview_image']").val() == '' || $("input[name='wig_image']").val() == '') {
                event.preventDefault();
                alert('Please upload wig and preview images!');
            }
        });
    </script>
@endsection
