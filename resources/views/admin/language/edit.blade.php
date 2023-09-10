@extends('admin.layouts.master')


@section('content');

<section class="section">
    <div class="section-header">
        <h1>{{ __('Languages') }}</h1>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4>{{ __('Edit Language') }}</h4>

        </div>
        <div class="card-body">
            <form action="{{ route('admin.language.update' ,$language->id ) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">{{ __('language') }}</label>
                    <select name="lang" id="language-select" class="form-control select2">
                        <option value="">--{{ __('select') }}--</option>
                        @foreach (config('language') as $key =>$lang )
                        <option
                            @if($language->lang == $key)
                                selected
                            @endif
                            value="{{ $key }}">{{ $lang['name'] }}
                        </option>
                        @endforeach
                    </select>
                    @error('lang')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">{{ __('name') }}</label>
                    <input readonly name="name" type="text" class="form-control" id="name" value="{{ $language->name }}">
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">{{ __('slug') }}</label>
                    <input readonly name="slug" type="text" class="form-control" id="slug" value="{{ $language->slug }}">
                    @error('slug')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">{{ __('is it default') }} ? </label>
                    <select name="default" id="" class="form-control">
                        <option {{ $language->default == 0 ? 'selected': '' }} value="0">{{ __('No') }}</option>
                        <option {{ $language->default == 1 ? 'selected': '' }} value="1">{{ __('Yes') }}</option>
                    </select>
                    @error('default')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">{{ __('status') }}</label>
                    <select name="status" id="" class="form-control">
                        <option {{ $language->status == 1 ? 'selected': '' }} value="1">{{ __('Active') }}</option>
                        <option {{ $language->status == 0 ? 'selected': '' }} value="0">{{ __('Inactive') }}</option>
                    </select>
                    @error('status')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">{{ __('update') }}</button>
            </form>

        </div>
    </div>

</section>


@endsection
@push('scripts')
<script>
    $(document).ready(function(){
       $('#language-select').on('change' , function(){
        let value = $(this).val();
        let name = $(this).children(':selected').text();
        $('#slug').val(value);
        $('#name').val(name);
       })
    })
</script>

@endpush
