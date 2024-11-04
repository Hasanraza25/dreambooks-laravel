@extends('admin.layout.master')
@section('page-title')
  Create Category
@endsection
@section('main-content')
<section class="content">

  <!-- SELECT2 EXAMPLE -->
  <!-- form start -->
  <div class="category-pass"></div>
  <form name="formCreate" id="formCreate" method="POST" action="{{ Route('category.store') }}">   
  @csrf 
    <div class="box box-primary">
      <!-- /.box-header -->
      <div class="box-body">
        <!-- row start -->
        <div class="row"> 
              <div class="col-xs-6">
                
                <div class="form-group @error('title') has-error @enderror">
                  <label for="title">Title <span class="text text-red">*</span></label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                    @error('title')
                    <div class="label label-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group @error('slug') has-error @enderror">
                  <label for="slug">Slug <span class="text text-red">*</span></label>
                    <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug">
                    @error('slug')
                    <div class="label label-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group @error('description') has-error @enderror">
                  <label>Description</label>
                  <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter ..."></textarea>
                  @error('description')
                  <div class="label label-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
          </div>
            <!-- row end -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
          <button type="submit" class="btn btn-primary create_category">Submit</button>
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
  $('body').on('click', '.create_category', function(e) {
    e.preventDefault();

    var self = $(this);
    var form = self.closest('form');

    $.ajax({
      url: form.attr('action'),  
      type: 'POST',
      dataType: 'json',
      data: form.serialize(),    
      success: function(data) {
        if (data.status) {
          window.location.href = '/admin/category'; 
        }
      },
      error: function(xhr) {
        // Handle errors
        $(".category-pass").html('<div class="alert alert-danger">' + xhr.responseJSON.message + '</div>');
      },
      complete: function() {
        console.log("Complete");
      }
    });
  });
});

</script>
@endsection