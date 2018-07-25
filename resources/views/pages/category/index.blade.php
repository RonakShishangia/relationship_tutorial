@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">List Category</div>
                <div class="panel-body">
                <table class="table small">
                    @if($categories->count()>0)
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @endif
                    <tbody id="tbody">
                        @forelse ($categories as $key => $category)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$category->name}}</td>
                                <td>
                                    <button onclick="deleteCategory({{$category->id}})" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" align="center">No Categories</td></tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Category</div>
                <div class="panel-body">
                    <form method="post" action="" id="category_form">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">Category Name:</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                        <div class="pull-right">
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
$('#category_form').on('submit',function(e){
    e.preventDefault();
    $.ajax({
        url: '{{route('category.store')}}',
        type: 'post',
        data: $('#category_form').serialize(),
        success: function(res){
            location.reload(); 
        }
    });
});

function deleteCategory(id) {
    console.log(id);
    $.ajax({
        url: '{{url("category")}}/'+id,
        type: 'DELETE',
        success: function (res) {
            location.reload();
        }
    });
}
</script>
@endsection