@extends('admin.layout.master')
@section('page-title')
  Edit Category
@endsection
@section('main-content')
<section class="content">

  <!-- SELECT2 EXAMPLE -->
  <!-- form start -->
  <div class="category-update-pass"></div>
  <form name="formEdit" id="formEdit" method="POST" action="{{ Route('category.update', $category->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="box box-primary">
      <!-- /.box-header -->
      <div class="box-body">
        <!-- row start -->
        <div class="row"> 
              <div class="col-xs-6">
                
                <div class="form-group">
                  <label for="title">Title <span class="text text-red">*</span></label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ $category->title }}">
                  </div>

                  <div class="form-group">
                  <label for="slug">Slug <span class="text text-red">*</span></label>
                    <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" value="{{ $category->slug }}">
                  </div>
                  <div class="form-group">
                  <label>Description</label>
                  <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter ...">{{ $category->description }}</textarea>
                </div>
              </div>
          </div>
            <!-- row end -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
          <button type="submit" class="btn btn-primary category_update">Update</button>
          <button type="reset" class="btn btn-danger">Cancel</button>
        </div>
    </div>
  </form>
  <!-- /.box -->

  <!-- form end -->
</section>
@endsection
@section('scripts')
<script>
  $(document).ready(function() {
    $("body").on('click', '.category_update', function(e){
      e.preventDefault();

      var self = $(this);
      var form = self.closest('form');

      $.ajax({
        url: form.attr('action'),
        type: 'POST',
        dataType: 'json',
        data: form.serialize(),
        success: function(data){
        window.location.href = '/admin/category';
      },
      error: function(xhr){
        $(".category-update-pass").html('<div class="alert alert-danger">' + xhr.responseJSON.message + '</div>');
      },
      complete: function(){
        console.log("Complete");
      }
    })
      
    })
  })
</script>
@endsection