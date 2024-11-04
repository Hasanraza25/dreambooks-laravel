@extends('admin.layout.master')
@section('page-title')
  Create Media
@endsection
@section('main-content')
<section class="content">

  <!-- SELECT2 EXAMPLE -->
  <!-- form start -->
  <form name="formCreate" id="formCreate" method="POST" action="{{ Route('media.store') }}" enctype="multipart/form-data">
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
                    <div class="label label-warning">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group @error('slug') has-error @enderror">
                  <label for="slug">Slug <span class="text text-red">*</span></label>
                    <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug">
                    @error('slug')
                    <div class="label label-warning">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Media Type <span class="text text-red">*</span></label>
                    <select name="media_type" id="media_type" class="form-control" style="width: 100%;">
                      <option value="none">-- Select Media Type --</option>
                      @foreach($mediaTypes as $mediaType)
                      <option value="{{ $mediaType->media_type }}">{{ $mediaType->media_type }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
               
              <div class="col-xs-6">
                 <div class="form-group">
                    <label for="media_img">Media Image <span class="text text-red">*</span></label>
                    <input type="file" name="media_img" class="form-control" id="media_img">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter ..."></textarea>
                   </div>
                </div>
          </div>

            <!-- row end -->

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-danger">Cancel</button>
        </div>
    </div>
  </form>
  <!-- /.box -->

  <!-- form end -->
</section>
@endsection