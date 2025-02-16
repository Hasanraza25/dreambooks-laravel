@extends('admin.layout.master')
@section('page-title')
  Create Books
@endsection
@section('main-content')
<section class="content">

  <!-- SELECT2 EXAMPLE -->
  <!-- form start -->
  <form id="formCreate" name="formCreate" method="POST" action="{{ Route('book.store') }}" enctype="multipart/form-data">
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
                  <div class="form-group @error('category_id') has-error @enderror">
                    <label>Category <span class="text text-red">*</span></label>
                    <select class="form-control" name="category_id" id="category_id" style="width: 100%;">
                      <option value="0">-- Select Category --</option>
                      @foreach($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->title }}</option>
                      @endforeach
                    </select>
                    @error('category_id')
                    <div class="label label-danger">Please Select an category</div>
                    @enderror
                  </div>
                  <div class="form-group @error('author_id') has-error @enderror">
                    <label>Author <span class="text text-red">*</span></label>
                    <select class="form-control" name="author_id" id="author_id" style="width: 100%;">
                      <option value="0">-- Select Author --</option>
                      @foreach($authors as $author)
                      <option value="{{ $author->id }}">{{ $author->title }}</option>
                      @endforeach
                    </select>
                     @error('author_id')
                    <div class="label label-danger">Please Select an author</div>
                    @enderror
                  </div>
                  <div class="form-group @error('availability') has-error @enderror">
                    <label for="availability">Availability <span class="text text-red">*</span></label>
                    <input type="text" class="form-control" name="availability" id="availability" placeholder="Availability">
                     @error('availability')
                    <div class="label label-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group @error('price') has-error @enderror">
                    <label for="price">Price: <span class="text text-red">*</span></label> 
                    <input type="text" class="form-control" name="price" id="price" placeholder="Price">
                     @error('price')
                    <div class="label label-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="rating">Rating: <span class="text text-red">*</span></label> 
                    <input type="text" class="form-control" name="rating" id="rating" placeholder="Price">
                  </div>
                <div class="form-group">
                  <label for="publisher">Publisher</label>
                  <input type="text" class="form-control" name="publisher" id="publisher" placeholder="Publisher">
                </div>
                <div class="form-group">
                  <label>Country of Publisher <span class="text text-red">*</span></label>
                  <select class="form-control select2" name="country_of_publisher" id="country_of_publisher" style="width: 100%;">
                    <option value="none"> -- Select Country -- </option>
                    @foreach($countries as $country)
                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="isbn">ISBN</label>
                  <input type="text" class="form-control" name="isbn" id="isbn" placeholder="ISBN">
                </div>

                  <div class="form-group">
                    <label for="isbn_10">ISBN-10</label>
                    <input type="text" class="form-control" name="isbn_10" id="isbn_10" placeholder="ISBN-10">
                  </div>
              </div>
               
              <div class="col-xs-6">
                  <div class="form-group">
                    <label for="book_img">Book Image</label>
                    <input type="file" class="form-control" name="book_img" id="book_img" >
                    <small class="label label-warning">Cover Photo will be uploaded</small>
                  </div>
                  <div class="form-group">
                    <label for="book_upload">Book Upload</label>
                    <input type="file" class="form-control" name="book_upload" id="book_upload" >
                    <small class="label label-warning">Book (PDF) will be uploaded </small>
                  </div>
                <div class="form-group">
                    <label for="audience">Audience</label>
                    <input type="text" class="form-control" name="audience" id="audience" placeholder="Audience">
                  </div>

                  <div class="form-group">
                    <label for="format">Format</label>
                    <input type="text" class="form-control" name="format" id="format" placeholder="Format">
                  </div>

                  <div class="form-group">
                    <label for="language">Language</label>
                    <input type="text" class="form-control" name="language" id="language" placeholder="Language">
                  </div>
                  <div class="form-group">
                    <label for="total_pages">Total Pages</label>
                    <input type="text" class="form-control" name="total_pages" id="total_pages" placeholder="Total Pages">
                  </div>
                  <div class="form-group">
                    <label for="edition_number">Edition Number</label>
                    <input type="text" class="form-control" name="edition_number" id="edition_number" placeholder="Edition Number">
                  </div>

                  <div class="form-group">
                    <label>Downloaded</label>
                    <select class="form-control" name="downloaded" id="downloaded" style="width: 100%;">
                      <option value="none">-- Select Downloaded --</option>
                      <option value="1">Downloaded</option>
                      <option value="0">Not Downloaded</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Recommended</label>
                    <select class="form-control" name="recommended" id="recommended" style="width: 100%;">
                      <option value="none">-- Select Recomended --</option>
                      <option value="1">Recommended</option>
                      <option value="0">Not Recommended</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="description">Description <span class="text text-red">*</span></label>
                    <textarea class="form-control" name="description" rows="5" id="description" placeholder="Description"></textarea>
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