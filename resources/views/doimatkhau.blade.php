@extends('layout.layout')
@section('noidung')
<div class="row ">

  <div class="col-12">

    <div class="d-flex justify-content-between">
    
      <div class="container">
      <h4 class=" mt-3">Đổi mật khẩu</h4>
          @if($error)
            <h6 class="mt-3 text-danger">{{$error}}</h6>
          @endif
        <form action="/doimatkhau" method="POST">
        @csrf
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          <div class="form-group">
            <label for="oldPassword">Mật khẩu cũ </label>
            <input type="password" class="form-control w-50" name="oldPassword">
          </div>
          <div class="form-group">
            <label for="newPassword">Mật khẩu cũ mới </label>
            <input type="password" class="form-control w-50" name="newPassword" >
          </div>
          <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection