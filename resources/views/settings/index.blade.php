@extends('layouts.master')
@section('setting-active', 'nav-link active')
@section('header', 'Settings')
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.css" />
@endsection
@section('content')
    <div class="card p-4">
        <div class="col-6">
            <form action="{{ route('setting.save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Upload Logo</label>
                    <input type="file" name="logo" class="form-control">
                    <img src="{{ asset('/images/' . $setting->logo) }}" class="img-thumbnail" style="width: 100px"
                        alt="">
                </div>
                @error('logo')
                    <span class="badge badge-danger">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="">Tax Percent</label>
                    <input type="number" name="tax" value="{{ $setting->tax }}" class="form-control">
                </div>
                @error('tax')
                    <span class="badge badge-danger">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="">Select Theme Color</label>
                    <br>
                    <input type="text" name="hex_code" value="{{ $setting->hex_code }}" data-coloris
                        class="form-control">
                </div>
                @error('hex_code')
                    <span class="badge badge-danger">{{ $message }}</span>
                @enderror

                <button class="btn btn-dark float-right">Save</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.js"></script>

    {{-- <script>
        jscolor.presets.default = {
            width: 141, // make the picker a little narrower
            position: 'right', // position it to the right of the target
            previewPosition: 'right', // display color preview on the right
            previewSize: 40, // make the color preview bigger
            palette: [
                '#000000', '#7d7d7d', '#870014', '#ec1c23', '#ff7e26',
                '#fef100', '#22b14b', '#00a1e7', '#3f47cc', '#a349a4',
                '#ffffff', '#c3c3c3', '#b87957', '#feaec9', '#ffc80d',
                '#eee3af', '#b5e61d', '#99d9ea', '#7092be', '#c8bfe7',
            ],
        };
    </script> --}}
@endsection
