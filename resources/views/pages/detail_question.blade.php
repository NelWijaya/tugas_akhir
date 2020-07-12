@extends('master')



@section('content')
<div class="card">
    <h5 class="card-header">Detail pertanyaan</h5>
    <div class="card-body">

        @foreach ($question as $key => $q)
        <div class="row">
            <!--
            <div class="col-4 col-md-2">
                <a href="#" class="btn btn-outline-primary mb-md-2" style="width: 90px; height: 80px; padding: 10px">
                    <span></span><br>
                    Up
                </a>
                <a href="#" class="btn btn-outline-primary  mb-md-2" style="width: 90px; height: 80px; padding: 10px">
                    <span>5</span><br>
                </a>
                <a href="#" class="btn btn-outline-primary" style="width: 90px; height: 80px; padding: 10px">
                    <span></span>
                    Down
                </a>
                
            </div> 
             -->
            <div class="col-8 col-md-10 ">
                <div class="row">
                    <div class="col">
                        <!-- Judul nya link, biar bisa menuju ke pertanyaannya secara detail -->
                        <a href="#"> <h5 class="card-title">{{$q->question_title}}</h5> </a>
                        <p class="card-text">{!!$q->question_content!!}</p><br>
                        <!-- Ini untuk tags, kalau di klik akan memunculkan pertanyaan yang punya tags -->
                        <div class="row">
                            <a href="#" class="btn btn-success mr-2">tags 1</a>
                            <a href="#" class="btn btn-success mr-2">tags 2</a><br>
                        </div>
                        <div class="row mt-5">
                            <form action="/pertanyaan/vote/{{$q->question_id}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input id="upvote" name="upvote" type="hidden" value="1">
                                <input id="downvote" name="downvote" type="hidden" value="0">
                                <input id="user_id" name="user_id" type="hidden" value="{{ Session('id') }}">
                                <input id="question_uid" name="question_uid" type="hidden" value="{{$q->user_id}}">
                                <input id="question_id" name="question_id" type="hidden" value="{{$q->question_id}}">
                                <button type="submit" class="btn btn-primary">UpVote</button>
                            </form>
                            <form action="/pertanyaan/vote/{{$q->question_id}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input id="upvote" name="upvote" type="hidden" value="0">
                                <input id="downvote" name="downvote" type="hidden" value="1">
                                <input id="user_id" name="user_id" type="hidden" value="{{ Session('id') }}">
                                <input id="question_uid" name="question_uid" type="hidden" value="{{$q->user_id}}">
                                <input id="question_id" name="question_id" type="hidden" value="{{$q->question_id}}">
                                <button type="submit" class="btn btn-danger">DownVote</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col">
                        <p><span>Total vote : {{$q->upvote_total - $q->downvote_total}}</span><br></p>
                        <p>Asked by : {{$q->name}}
                            <br><span>posted: {{$q->created_at}} <br> updated: {{$q->updated_at}}</span>
                            <!-- Pakai PHP jika memungkinkan --><br>
                        </p><br>
                        <!-- Pakai PHP jika memungkinkan -->
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="row">
            <div class="container-fluid">
                <h5><span>{{$ansqty}}</span> Answer</h5>
            </div>
        </div>
        <div class="row">
            <div class="container-fluid">

                <!-- Foreach -->
                @foreach ($answers as $key => $answer)
                <div class="card mt-md-3">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-12">
                            <p class="card-text">{!!$answer->answer_content!!}</p>
                            </div>
                        </div>
                        <div class="row mt-5 mb-3">
                            <div class="col-12 col-sm-3 col-lg-2">
                                <form action="/jawaban/vote/{{$answer->answer_id}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input id="upvote" name="upvote" type="hidden" value="1">
                                    <input id="downvote" name="downvote" type="hidden" value="0">
                                    <input id="user_id" name="user_id" type="hidden" value="{{ Session('id') }}">
                                    <input id="answer_uid" name="answer_uid" type="hidden" value="{{$answer->user_id}}">
                                    <input id="question_id" name="question_id" type="hidden" value="{{$answer->question_id}}">
                                    <button type="submit" class="btn btn-primary">UpVote</button>
                                </form>
                                <form action="/jawaban/vote/{{$answer->answer_id}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input id="upvote" name="upvote" type="hidden" value="0">
                                    <input id="downvote" name="downvote" type="hidden" value="1">
                                    <input id="user_id" name="user_id" type="hidden" value="{{ Session('id') }}">
                                    <input id="answer_uid" name="answer_uid" type="hidden" value="{{$answer->user_id}}">
                                    <input id="question_id" name="question_id" type="hidden" value="{{$answer->question_id}}">
                                    <button type="submit" class="btn btn-danger">DownVote</button>
                                </form>
                            </div>
                            <div class="col-12 mt-3 mt-sm-0 col-sm-4 col-lg-3">
                                <!-- Good Answer (ini tombol untuk pemilik pertanyaan) -->
                                @if ($answer->relevan == 1)
                                <a href="#" class="btn btn-success card-link">Relevant!</a>
                                @elseif ($question[0]->user_id == Session('id'))
                                <a href="/jawaban/relevant/{{$answer->answer_id}}" class="btn btn-outline-primary card-link">Good Answer</a>
                                @else
                                <a href="#" class="btn btn-outline-secondary card-link">Good Answer</a>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p style="font-size : small;" class=" float-md-right text-muted">
                                    <span>Total vote : {{$answer->upvote_total - $answer->downvote_total}}</span><br>
                                    <span>Answered by {{$answer->name}}</span><br>
                                    <span>posted: {{$answer->created_at}} <br> updated: {{$answer->updated_at}}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="card mt-md-3">
                    <div class="card-body ">
                        <form action="/jawaban/{{$id}}" method="POST">
                            @csrf
                            <label for="answer">Answer</label>
                            <textarea name="answer_content" class="form-control my-editor" id="answer" rows="10" style="width: 100%;"></textarea>
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
