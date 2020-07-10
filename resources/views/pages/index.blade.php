@extends('master')


@section('content')
<div class="row">
    <div class="col-12 col-md-3">
        <a href="#" class="btn btn-outline-success mb-3">Add Question</a>
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
