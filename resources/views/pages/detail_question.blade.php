@extends('master')

@section('content')
<div class="card">
    <h5 class="card-header">Detail pertanyaan</h5>
    <div class="card-body">
        <div class="row">
            <!-- <div class="col-4 col-md-2">
                <a href="#" class="btn btn-outline-primary mb-md-2" style="width: 90px; height: 80px; padding: 10px">
                    <span>5</span><br>
                    Answer
                </a>
                <a href="#" class="btn btn-outline-primary" style="width: 90px; height: 80px; padding: 10px">
                    <span>5</span><br>
                    Votes
                </a>
            </div> -->
            <div class="col-8 col-md-10 ">
                <div class="row">
                    <div class="col">
                        <!-- Judul nya link, biar bisa menuju ke pertanyaannya secara detail -->
                        <a href="#"> <h5 class="card-title">Judul</h5> </a>
                        <p class="card-text">Isi pertanyaan</p><br>
                        <!-- Ini untuk tags, kalau di klik akan memunculkan pertanyaan yang punya tags -->
                        <div class="row">
                            <a href="#" class="btn btn-success mr-2">tags 1</a>
                            <a href="#" class="btn btn-success mr-2">tags 2</a><br>
                        </div>
                        <div class="row mt-5">
                            <a href="#" class="btn btn-primary mr-3">UpVote</a><a href="#" class="btn btn-danger">DownVote</a>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col">
                        <p>Asked by : Nama Pengguna yang bertanya
                            <br><span>posted: Jam posted <br> updated: Jam updated</span>
                            <!-- Pakai PHP jika memungkinkan --><br>
                        </p><br>
                        <!-- Pakai PHP jika memungkinkan -->
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="container-fluid">
                <h5>Answer <span>5</span></h5>
            </div>
        </div>
        <div class="row">
            <div class="container-fluid">
                <!-- Foreach -->
                <div class="card mt-md-3">
                    <div class="card-body">
                    <div class="row">
                            <div class="col-12">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                        <div class="row mt-5 mb-3">
                            <div class="col-12 col-sm-3 col-lg-2">
                                <a href="#" class="btn btn-outline-primary card-link">Comment</a>
                            </div>
                            <div class="col-12 mt-3 mt-sm-0 col-sm-4 col-lg-3">
                                <!-- Good Answer (ini tombol untuk pemilik pertanyaan) -->
                                <a href="#" class="btn btn-outline-primary card-link">Good Answer</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p style="font-size : small;" class=" float-md-right text-muted">Answered:
                                    <span>Nama Penjawab</span><br>
                                    <span>posted: Jam posted <br> updated: Jam updated</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-md-3">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-12">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                        <div class="row mt-5 mb-3">
                            <div class="col-12 col-sm-3 col-lg-2">
                                <a href="#" class="btn btn-outline-primary card-link">Comment</a>
                            </div>
                            <div class="col-12 mt-3 mt-sm-0 col-sm-4 col-lg-3">
                                <!-- Good Answer (ini tombol untuk pemilik pertanyaan) -->
                                <a href="#" class="btn btn-outline-primary card-link">Good Answer</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p style="font-size : small;" class=" float-md-right text-muted">Answered:
                                    <span>Nama Penjawab</span><br>
                                    <span>posted: Jam posted <br> updated: Jam updated</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-md-3">
                    <div class="card-body ">
                        <form action="#" method="POST">
                            <label for="answer">Answer</label>
                            <textarea name="content" class="form-control my-editor" id="answer" rows="10" style="width: 100%;"></textarea>
                            <button type="submit" class="btn btn-success mt-3"> Submit Answer</button>
                        </form>
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
