@extends('layouts.app', ['page' => __('Cập nhật thông tin địa điểm')])
@php
    use App\Diadiem;
    $diadiem = Diadiem::where('objectid', $objectid)->first();
    $n=$diadiem->name;
    $l=$diadiem->loai;
@endphp
<style>
    /* input{
        background-color:transparent;
        border-color:#555;
    } */
    option{
        background-color:darkslategray;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#submitBtn').on('click', function() {
            var oid = $('#oid').val();
            var name = $('#name').val();
            var loai = $('#loai').val();
            $.ajax({
                url: '/submit'
                , method: 'post'
                , data: {
                    oid: oid
                    , name: name
                    , loai: loai
                    , _token: '{{csrf_token()}}'
                }
                , success: function(response) {
                    alert("Success!");
                    window.close();
                }
                , error: function(xhr, status, error) {
                    alert("Error!!!");
                }
            , })

        })
    });

</script>
@section('content')
{{-- <div class="card-body"> --}}
    {{-- <div class="table-responsive">
        <table class="table tablesorter " id="">
            <thead class=" text-primary">
                <tr>
                    <th>
                        ObjectID
                    </th>
                    <th>
                        Tên
                    </th>
                    <th>
                        Loại
                    </th>
                </tr>
            </thead>
            <tr>
                <td>
                    <input type="text" value="{{$objectid}}" id="oid" disabled>
                </td>
                <td>
                    <input type="text" value="{{$n}}" id="name">
                </td>
                <td>
                    <select name="" id="loai">
                        <option value="1" @if ($l=="1" ) selected @endif>Trường học</option>
                        <option value="2" @if ($l=="2" ) selected @endif>Bệnh viện</option>
                    </select>
                </td>
                <td>
                    <input type="button" value="Lưu" id="submitBtn" class="btn btn-fill btn-primary">
                </td>
            </tr>

        </table>
    </div> --}}

    <div class="card">
        <div class="card-body">
          <form>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>ObjectID: </label>
                    <input type="text" value="{{$objectid}}" id="oid" disabled  class="form-control">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Tên: </label>
                    <input type="text" value="{{$n}}" id="name"  class="form-control">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Loại: </label>
                    <select name="" id="loai"  class="form-control">
                        <option value="1" @if ($l=="1" ) selected @endif>Trường học</option>
                        <option value="2" @if ($l=="2" ) selected @endif>Bệnh viện</option>
                    </select>
                  </div>
            </div>
            <input type="button" value="Lưu" id="submitBtn" class="btn btn-fill btn-primary">
          </form>
        </div>
      </div>
{{-- </div> --}}
@endsection
