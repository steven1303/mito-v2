<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Post Detail</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form role="form" id="postForm" method="POST">
            {{ csrf_field() }} {{ method_field('POST') }}
            <input type="hidden" id="id" name="id">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Create New Post</h3>
                            <div class="card-tools">
                                <button type="button" onclick="ajaxLoad('{{route('admin.website.post.index')}}')" class="btn btn-sm btn-primary">Back</button>
                                @empty($post)<button type="submit" id="btnPublish" class="btn btn-sm btn-primary">Publish</button>@endempty
                                @isset($post) <button type="submit" id="btnPublish" class="btn btn-sm btn-primary">Updated</button> @endisset
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" name="title" id="title" placeholder="Title" @isset($post->title) value="{{$post->title}}" @endisset>
                                        <span class="text-danger error-text title_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="Slug">Slug</label>
                                        <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" @isset($post->slug) value="{{$post->slug}}" @endisset>
                                        <span class="text-danger error-text slug_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="subtitle">Sub Title</label>
                                        <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="subtitle" @isset($post->subtitle) value="{{$post->subtitle}}" @endisset>
                                        <span class="text-danger error-text subtitle_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Future Image</label><br>
                                        <label>Rekomendasi ukuran 400px x 200px</label>
                                        <div id="image">
                                            <img width="100%" height="100%" id="preview_image_icon" @isset($post->image) src="{{asset('storage/image').'/'.$post->image}}"  @endisset  @empty($post) src="{{asset('assets/img/news/img01.jpg')}}" @endempty />
                                            <i id="loading_desktop" class="fa fa-spinner fa-spin fa-3x fa-fw" style="position: absolute;left: 40%;top: 40%;display: none"></i>
                                        </div>
                                        <p>
                                            <a href="javascript:changeImage_icon()" style="text-decoration: none;">
                                            <i class="glyphicon glyphicon-edit"></i> Change
                                            </a>&nbsp;&nbsp;
                                            <a href="javascript:removeFile_icon()" style="color: red;text-decoration: none;">
                                            <i class="glyphicon glyphicon-trash"></i> Remove
                                            </a>
                                        </p>
                                        <input type="file" id="file_image" style="display: none"/>
                                        <input type="hidden" id="futureImage" name="futureImage" @isset($post->image) value="{{$post->image}}"  @endisset/>
                                        <span class="text-danger error-text futureImage_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Minimal</label>
                                                <select class="form-control select2bs4" name="category" id="category" style="width: 100%;">
                                                    <option>cat1</option>
                                                    <option>cat2</option>
                                                </select>
                                                <span class="text-danger error-text category_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Multiple</label>
                                                <select class="select2" multiple="multiple" data-placeholder="Select a State" name="tag[]" id="tag" style="width: 100%;">
                                                    <option>tag1</option>
                                                    <option>tag2</option>
                                                    <option>tag3</option>
                                                </select>
                                                <span class="text-danger error-text tag_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="Slug">Meta Keyword</label>
                                                <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" placeholder="Keyword 1, Keyword 2" @isset($post->meta_keyword) value="{{$post->meta_keyword}}" @endisset>
                                                <span class="text-danger error-text meta_keyword_error"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="Slug">Meta Description</label>
                                                <input type="text" class="form-control" name="meta_desc" id="meta_desc" placeholder="Description" @isset($post->meta_description) value="{{$post->meta_description}}" @endisset>
                                                <span class="text-danger error-text meta_desc_error"></span>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="draft" name="draft">
                                                <label class="form-check-label" for="exampleCheck1">Save as draft</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                Body
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <textarea id="body" name="body">
                                @isset($post->body) {!!$post->body!!} @endisset
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- /.content -->

@include('admins.javascript.website.postDetail')