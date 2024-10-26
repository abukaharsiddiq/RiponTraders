@extends('back-end.master')

@section('admin-title')
{{ $create }}
@endsection

@push('admin-styles')
<style>
    /* স্টাইল এখানে যুক্ত করা হবে */
</style>
@endpush

@section('admin-content')
<div class="row">
    <div class="col-12 form-area">
        <div class="col-md-8">
            <div class="card">
                <form class="form-horizontal" action="{{ $action }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method($method === 'POST' ? 'POST' : 'PATCH')
                    <div class="card-body">
                        <div class="row mb-4">
                            <h1 class="card-title">{{ $create }}</h1>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 control-label col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input
                                    type="text" name="name"
                                    class="form-control"
                                    id="name"
                                    placeholder="Name"
                                    value="{{ $info->name ?? '' }}"
                                />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-sm-3 control-label col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input
                                    type="text" name="address"
                                    class="form-control"
                                    id="address"
                                    placeholder="Address"
                                    value="{{ $info->address ?? '' }}"
                                />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-3 control-label col-form-label">E-Mail</label>
                            <div class="col-sm-9">
                                <input
                                    type="email" name="email"
                                    class="form-control"
                                    id="email"
                                    placeholder="E-Mail"
                                    value="{{ $info->email ?? '' }}"
                                />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-sm-3 control-label col-form-label">Phone No</label>
                            <div class="col-sm-9">
                                <input
                                    type="text" name="phone"
                                    class="form-control"
                                    id="phone"
                                    placeholder="Phone No"
                                    value="{{ $info->phone ?? '' }}"
                                />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="logo" class="col-sm-3 control-label col-form-label">Logo</label>
                            <div class="col-sm-9">
                                <input type="file" name="logo" class="form-control"/>
                                <img src="{{ asset('/') }}back-end/setting/{{ $info->logo ?? '' }}" style="width:100px;height: 100px;margin-top:10px;">
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary float-end">
                                <i class="fa fa-paper-plane"></i> {{ $btn_name }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
