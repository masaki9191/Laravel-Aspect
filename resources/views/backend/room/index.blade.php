@extends('backend.layout.app')
@section('css')
<style>
.size50  {
    width:50px;
    height:50px;
}
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">所在階管理</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <a class="btn btn-success" href="{{ route('room.create') }}" title="Create a product">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                            <div class="pull-right">

                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th scope="col">ビルド</th>
                                    <th scope="col">所在階</th>
                                    <th scope="col">賃料</th>
                                    <th scope="col">賃室規模</th>
                                    <th scope="col">面積</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($rooms as $room)
                                <tr>
                                    <td>{{$room->build->name}}</td>
                                    <td>{{$room->no}}</td>
                                    <td>{{$room->price}}</td>
                                    <td>{{$room->rent_size}}</td>
                                    <td>
                                        <img src="{{ $room->photo('design_photo') != null? $room->photo('design_photo')->getUrl() : '' }}" class="size50">
                                    </td>
                                    <td>
                                        <form id="room{{$room->id}}" name="room{{$room->id}}" action="{{ route('room.destroy',$room->id) }}" method="POST">
                                            <a class="btn btn-info" href="{{ route('room.show',$room->id) }}"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-primary" href="{{ route('room.edit',$room->id) }}"><i class="fa fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="removeFn({{$room->id}})"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        資料がありません。
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {!! $rooms->links('vendor.pagination.bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="confirmModal" role="dialog" data-id="">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="py-4">本当に削除しますか？</div>
                <div class="">
                    <button type="button" class="btn btn-primary mr-2" id="okBtn">はい</button>
                    <button type="button" class="btn btn-primary ml-2" data-dismiss="modal">いいえ</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $("#okBtn").click(function(){
            var id = $("#confirmModal").attr("data-id");
            console.log("room"+id);
            var form = document.getElementById("room"+id);
            form.submit();
        });
    });
    function removeFn(id) {
        $("#confirmModal").modal("toggle");
        $("#confirmModal").modal("show");
        $("#confirmModal").attr("data-id", id);
    }
</script>
@endsection
