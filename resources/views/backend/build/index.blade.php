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
                <div class="card-header">ビルド管理</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <a class="btn btn-success" href="{{ route('build.create') }}" title="Create a product">
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
                                    <th scope="col">状態</th>
                                    <th scope="col">名前</th>
                                    <th scope="col">住所</th>
                                    <th scope="col">室数</th>
                                    <th scope="col">基本写真</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($builds as $build)
                                <tr>
                                    <td>{{$build->name}}</td>
                                    <td>{{$build->address}}</td>
                                    <td>{{$build->scale}}</td>
                                    <td>{{$build->room}}</td>
                                    <td>
                                        <img src="{{ $build->photo('main_photo') != null? $build->photo('main_photo')->getUrl() : '' }}" class="size50">
                                    </td>
                                    <td>
                                        <form id="build{{$build->id}}" name="build{{$build->id}}" action="{{ route('build.destroy',$build->id) }}" method="POST">
                                            <a class="btn btn-info" href="{{ route('build.show',$build->id) }}"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-primary" href="{{ route('build.edit',$build->id) }}"><i class="fa fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="removeFn({{$build->id}})"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        資料がありません。
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $builds->links('vendor.pagination.bootstrap-4') !!}
                        </div>
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
            console.log("build"+id);
            var form = document.getElementById("build"+id);
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
