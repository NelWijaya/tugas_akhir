@extends('master')


@section('content')
<div class="row">
    <div class="col-12 col-md-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-success mb-3" data-toggle="modal" data-target="#addquestion">
            Add Question
        </button>
        <!-- Modal -->
        <div class="modal fade" id="addquestion" tabindex="-1" role="dialog" aria-labelledby="addquestionLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addquestionLabel">Add Question</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="#" method="post">
                        <div class="modal-body">
                            <input type="text" class=" mb-2" placeholder="Title" required>
                            <textarea name="content" class="form-control my-editor" id="answer" rows="10" style="width: 100%;"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Add Question</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-9">
        <form class="form-inline my-2 my-lg-0" method="POST" action="#">
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Search Question">
                <div class="input-group-append">
                    <button class="input-group-text" id="basic-addon2"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card mt-5">
  <h5 class="card-header">Detail pertanyaan</h5>
  <div class="card-body">
        <div class="row">
            <div class="col-12 mb-4 mb-sm-0 col-sm-3 col-lg-2">
                <a href="#" class="btn btn-outline-primary mb-md-2" style="width: 90px; height: 80px; padding: 10px">
                    <span>5</span><br>
                    Answer
                </a>
                <a href="#" class="btn btn-outline-primary" style="width: 90px; height: 80px; padding: 10px">
                    <span>5</span><br>
                    Votes
                </a>
            </div>
            <div class="col-12 col-sm-9 col-lg-10">
                <div class="row">
                    <div class="col">
                        <!-- Judul nya link, biar bisa menuju ke pertanyaannya secara detail -->
                        <a href="#"> <h5 class="card-title">Judul</h5> </a>
                        <p class="card-text">Isi pertanyaan</p><br>
                        <!-- Ini untuk tags, kalau di klik akan memunculkan pertanyaan yang punya tags -->
                        <a href="#" class="btn btn-success">tags 1</a> <a href="#" class="btn btn-success">tags 2</a>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col">
                        <p>Asked by : Nama Pengguna yang bertanya
                            <br><span>Jam posted - Jam updated</span>
                        </p>
                    </div>
                </div>

            </div>
        </div>


  </div>
</div>
@endsection
@push('script')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
  var editor_config = {
    path_absolute : "/",
    selector: "textarea.my-editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>
@endpush
