@extends('admin.layout.master')

@section('content')
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Register College</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{route('collegeList')}}" class="btn btn-info" >College List</a></div>
            </div>
          </div>
          <form method="post" action="{{route('storeCollege')}}">
            @csrf
                <div class="section-body">
                    <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <div class="form-group">
                            <label>College Name</label>
                            <input type="text" class="form-control" name="college_name">
                            </div>
                            <div class="form-group">
                            <label>College Abbreviation</label>
                            <input type="text" class="form-control" name="college_abbrivation">
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </form>


    </section>
@endsection
