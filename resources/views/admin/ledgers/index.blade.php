@extends('layouts.app')


@section('content')
@include('layouts.alerts')
<br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="page-title">
					Ledger
				</div>
			</div>
		</div>
@if(count($customers)>0)
<div class="row">
      <div class="col-8">
        <form action="{{route('ledger.search')}}" method="post" class="form-inline my-2 my-lg-0">
          @csrf
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="f">
                            <label for="search" class="">
                              <button class="btn btn-primary waves-effect waves-light rounded-pill">search</button>
                             </label>

         </form>
      </div>
</div>
@endif

		@if(count($customers)>0)
        @foreach($customers->chunk(4) as $chunk)
               <div class="row">


          @foreach($chunk as $customer)
          <div class="col-xl-3">
          <div class="card">

				  	                                <img src="{{asset('asset/images/'.$customer->profile_pic)}}" class="card-img-top img-card" alt="user image">
                                <div class="card-body">
                                  <h5 class="card-title">{{$customer->name}}</h5>
                                   <p>Balance:

                        @if(balance($customer->id) > 0)
                        <strong class="text-success"> Rs. {{balance($customer->id)}}</span> </strong>
                      @else
                       <strong class="text-danger"> Rs. {{(-1)*balance($customer->id)}} </span> </strong>
                      @endif</p>
                                    <a href="{{route('ledger.details',['id'=>$customer->id])}}" class="btn btn-primary waves-effect waves-light">Go Ledger</a>
                                </div>

            </div>
             </div>
             @endforeach


            </div>
        @endforeach
    @else
      <h4 class="text-center">No user found</h4>
		@endif

	</div>

@endsection
