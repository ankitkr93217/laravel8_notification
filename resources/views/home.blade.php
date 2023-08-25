@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <?php
                    //  echo"<pre>";
                    // print_r($notifications);
                    // echo"</pre>";
                    
                    ?>
                    @if(auth()->user()->role==1)
                        @forelse($notifications as $notification)
                            <div class="alert alert-success " style="font-weight: bold;" role="alert">
                                [{{ $notification->created_at }}] Order {{ $notification->data['category'] }} where amount is <span style="color:red">{{ $notification->data['amount'] }}</span> has just Created.
                                <button class="float-right btn btn-warning mark-as-read" data-id="{{ $notification->id }}">
                                    Mark as read
                                </button>
                            </div>

                            @if($loop->last)
                                <button class="btn btn-danger" id="mark-all">
                                    Mark all as read
                                </button>
                            @endif
                        @empty
                            <div class='alert alert-warning'>There are no new notifications</div>
                        @endforelse
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>

    

    @if(auth()->user()->role==1)
    <script>

        $(document).ready(function(){
            // e.preventDefault();
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
 
            $('.mark-as-read').on('click',function(e) {
                // $(this).parent().remove();
                target = e.target;
                $.ajax({ 
                    url:"{{route('markNotification')}}",
                    method:'POST',
                    data:{
                        id:$(this).data('id')
                    },
                    success:function(res){
                            
                        if (res == 1) {
                            $(target).parent('div.alert').remove(); 
                        }
                        
                    }
                });
            });
            $('#mark-all').on('click',function(e) {
             
                target = e.target;
                $.ajax({ 
                    url:"{{route('markNotification')}}",
                    method:'POST',
                    success:function(res){
                         
                        if (res == 1) {

                            $('div.alert').remove();
                            $('#mark-all').remove();
                            
                        }
                     
                    }
                });
            });
             
        });
    </script>
    @endif

@endsection


