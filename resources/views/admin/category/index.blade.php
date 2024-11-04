@extends('admin.layout.master')
@section('page-title')
  Manage Category
@endsection
@section('main-content')
<section class="content">
      
      <!-- /.row -->
 <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"> 
                <a id="active_all_status" class="btn btn-danger btn-xm"><i class="fa fa-eye"></i></a>
                <a id="deactive_all_status" class="btn btn-danger btn-xm"><i class="fa fa-eye-slash"></i></a>
                <a id="delete_all" class="btn btn-danger btn-xm"><i class="fa fa-trash"></i></a>
                <a href="{{ Route('category.create') }}" class="btn btn-default btn-xm"><i class="fa fa-plus"></i></a>
          </h3>
          <div class="box-tools">
            <form method="get" action="/admin/category">
              <div class="input-group input-group-sm" style="width: 250px;">
                <input type="text" name="s" class="form-control pull-right" placeholder="Search">

                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          @if($categories)
          <table class="table table-bordered">
            <form id="formView" name="formView">
              <thead style="background-color: #F8F8F8;">
                <tr>
                  <th width="4%"><input type="checkbox" name="" id="checkAll"></th>
                  <th width="70%">Title</th>
                  <th width="10%">Status</th>
                  <th width="10%">Manage</th>
                </tr>
              </thead>
              @foreach($categories as $category)
              <tr>
                <td><input type="checkbox" name="checkAll[]" value="{{ $category->id }}" class="checkSingle"></td>
                <td>{{ $category->title }}</td>
                <td>
                  @if($category->status == "DEACTIVE")
                  <a href="{{ Route('category.status', $category->id) }}" class="btn btn-danger btn-sm singleStatus"><i class="fa fa-thumbs-down"></i></a>
                  @else
                  <a href="{{ Route('category.status', $category->id) }}" class="btn btn-info btn-sm singleStatus"><i class="fa fa-thumbs-up"></i></a>
                  @endif
                </td>
                <td>
                    <a href="{{ Route('category.edit', $category->id) }}" class="btn btn-info btn-flat btn-sm"> <i class="fa fa-edit"></i></a>
                    <a href="{{ Route('category.destroy', $category->id) }}" class="btn btn-danger btn-flat btn-sm singleDelete"> <i class="fa fa-trash-o"></i></a>
                </td>
              </tr>
              @endforeach
            </form>
          </table>
        </div>
        <!-- /.box-body -->
          <div class="box-footer clearfix">
                    <div class="row">
                        <div class="col-sm-6">
                            <span style="display:block;font-size:15px;line-height:34px;margin:20px 0;">
                              <div>Showing {{($categories->currentpage()-1)*$categories->perpage()+1}} to {{$categories->currentpage()*$categories->perpage()}}
                              of  {{$categories->total()}} entries
                              </div>
                            </span>
                        </div>
                      <div class="col-sm-6 text-right">
                          {{ $categories->links() }}
                      </div>
                    </div>
                </div>
          @else
            <div class="alert alert-danger">No record found!</div>
          @endif
      </div>
        <!-- /.box-body -->
      </div>
</section>
@endsection
@section('scripts')
  <script>
    $(document).ready(function() {
      $(".singleStatus").on('click', function(event){
        event.preventDefault();

        var self = $(this);
        var href = self.attr('href');
        self.html('<img src="/assets/admin/dist/img/ajax-loader.gif">')
        $.get(href, function(response){
          if(response == 'ACTIVE'){
            self.closest('a').removeClass('btn btn-danger btn-sm');
            self.closest('a').addClass('btn btn-info btn-sm');
            self.html('<i class="fa fa-thumbs-up"></i>');
          }
          else{
            self.closest('a').removeClass('btn btn-info btn-sm');
            self.closest('a').addClass('btn btn-danger btn-sm');
            self.html('<i class="fa fa-thumbs-down"></i>');
          }
        })
      })

      $(".singleDelete").on('click', function(event) {
        event.preventDefault();

        if(confirm('Are you sure you want to delete this?')){
          var self = $(this);
          var href = self.attr('href');

          $.get(href, function(response) {
            if(response == 'true'){
              self.closest('tr').css('background-color', 'red').fadeOut(1000);
              self.remove();
            }
          })
        }
        else{
          return false;
        }
      })

      // ACTIVE ALL STATUS
      $('#active_all_status').on('click', function(event) {
            event.preventDefault();

            if($(".checkSingle:checked").length > 0) {
                var formSerials = $("#formView").serialize();
                
                $.get('{{ Route('category.active_all_status') }}', formSerials, function(data){
                    if(data > 0)
                        window.location.href = '/admin/category';
                })
            }
            else{
                alert("Check at least one!");
            }
      })

      $('#deactive_all_status').on('click', function(event) {
            event.preventDefault();

            if($(".checkSingle:checked").length > 0){
                var formSerials = $("#formView").serialize();

                $.get('{{ Route('category.deactive_all_status') }}', formSerials, function(data){
                    if(data > 0)
                        window.location.href = '/admin/category';
                })
            }
            else
                alert('Check at least one!')
      })

      $('#delete_all').on('click', function(event) {
            event.preventDefault();

            if($('.checkSingle:checked').length > 0){
                if(confirm('Are you sure you want to delete this?')){
                    var formSerials = $("#formView").serialize();

                    $.get('{{ Route('category.delete_all') }}', formSerials, function(data) {
                        if(data > 0){
                            window.location.href = '/admin/category';
                        }
                    })
                }
                else
                    return false;
            }
            else
            {
                alert('Select at least one!');
            }

        })
    })
  </script>
@endsection