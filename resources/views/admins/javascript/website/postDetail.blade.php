<script type="text/javascript">
$(function () {
  $('#body').summernote({
    placeholder: 'Body of Article',
    tabsize: 2,
    height: 100
  })

  $('#category').select2()
  $('#tag').select2()
})

$(function(){
  $('#postForm').validator().on('submit', function (e) {
    var id = $('#id').val();
    if (!e.isDefaultPrevented()){
      url = "{{route('admin.website.post.store') }}";
      $('input[name=_method]').val('POST');
      $.ajax({
        url : url,
        type : "POST",
        data : $('#postForm').serialize(),
        beforeSend : function(){
          $(document).find('span.error-text').text('');
          $('#btnPublish').attr('disabled',true);
        },
        success : function(data) {
          console.log(data);
          toastr.success(data.stat, data.message);
          $('#btnPublish').attr('disabled',false);
        },
        error : function(data){
          if(data.status == 422){
            if(data.responseJSON.errors.title !== undefined){
              $('span.title_error').text(data.responseJSON.errors.title[0]);
            }
            if(data.responseJSON.errors.subtitle !== undefined){
              $('span.subtitle_error').text(data.responseJSON.errors.subtitle[0]);
            }
            if(data.responseJSON.errors.slug !== undefined){
              $('span.slug_error').text(data.responseJSON.errors.slug[0]);
            }
            if(data.responseJSON.errors.futureImage !== undefined){
              $('span.futureImage_error').text(data.responseJSON.errors.futureImage[0]);
            }
            if(data.responseJSON.errors.category !== undefined){
              $('span.category_error').text(data.responseJSON.errors.category[0]);
            }
            if(data.responseJSON.errors.tag !== undefined){
              $('span.tag_error').text(data.responseJSON.errors.tag[0]);
            }
            if(data.responseJSON.errors.meta_desc !== undefined){
              $('span.meta_desc_error').text(data.responseJSON.errors.meta_desc[0]);
            }
            if(data.responseJSON.errors.meta_keyword !== undefined){
              $('span.meta_keyword_error').text(data.responseJSON.errors.meta_keyword[0]);
            }
            $('#btnPublish').attr('disabled',false);
          }
          toastr.error('Error', 'Oops! Something Error! Try to reload your page first...');
        }
      });
      return false;
    }
  });
});

function changeImage_icon() {
  $('#file_image').click();
}
$('#file_image').change(function () {
  if ($(this).val() != '') {
    upload(this, "futureImage");
  }
});
function upload(img, file) {
  const form_data = new FormData();
  form_data.append('file', img.files[0]);
  form_data.append('_token', '{{csrf_token()}}');
  $('#loading').css('display', 'block');
  $.ajax({
    url: "{{url('post-image-upload')}}",
    data: form_data,
    type: 'POST',
    contentType: false,
    processData: false,
    success: function (data) {
      if (data.fail) {
        $('#preview_image').attr('src', '{{asset('assets/img/news/img012.jpg')}}');
        alert(data.errors['file']);
      }
      else {
        if(file == "futureImage"){
          $('#futureImage').val(data);
          $('#preview_image_icon').attr('src', '{{asset('storage/image')}}/' + data);
        }
      }
      $('#loading').css('display', 'none');
    },
    error: function (xhr, status, error) {
      alert(xhr.responseText);
      if(file == "futureImage"){
        $('#preview_image_icon').attr('src', '{{asset('assets/img/news/img01.jpg')}}');
      }
    }
  });
}
function removeFile_icon() {
  if ($('#futureImage').val() != ''){
    if (confirm('Are you sure want to remove Future Image?')) {
      $('#loading_desktop').css('display', 'block');
      const form_data = new FormData();
      form_data.append('_method', 'DELETE');
      form_data.append('_token', '{{csrf_token()}}');
      $.ajax({
        url: "{{url('post-remove-image')}}/" + $('#futureImage').val(),
        data: form_data,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function (data) {
          $('#preview_image_icon').attr('src', '{{asset('assets/img/news/img01.jpg')}}');
          $('#futureImage').val('');
          document.getElementById("file_image").value=null; 
          $('#loading_desktop').css('display', 'none');
        },
        error: function (xhr, status, error) {
          alert(xhr.responseText);
        }
      });
    }
  }
}
</script>
