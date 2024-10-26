@extends('layouts.app')

@section('content')
  <div class="container mt-5">
        <h2 class="text-center mb-4">Leaderboard</h2>
        <div class="mb-3 d-flex justify-content-between">
            <div class="form-group">
                <input type="text" name="search" id="search" placeholder="Search User ID"/>
                <button type="button" id="filter_btn" class="btn btn-primary ms-2">Apply Filters</button>
            </div>
            <a href="javascript:void(0)" type="button" class="btn btn-secondary" data-url="{{ route('leader-board.recalculate')}}" id="recalculate">Recalculate</a>
        </div>
        <table class="table table-striped table-bordered" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Score</th>
                    <th>Rank</th>
                </tr>
            </thead>
            <tbody id="users_list">
                @foreach($users as $key=>$user)
                    <tr id="{{$key+1}}_user">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->total_score }}</td>
                        <td>{{ $user->rank }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on("click","#recalculate",function(e){
        $.ajax({
            url: $(this).data('url'),
            type: "GET",
            success: function(data) {
                if (data.success) {
                    alert(data.message);
                }
                window.location.reload()
            },
            error: function(xhr, status, error) {
                console.error("Error: ", error); 
                alert("Something went wrong.");
            }
        });
    });

    $(document).on("click","#filter_btn",function(e){
        e.preventDefault()
        var search = $("#search").val();
        $('#users_list tr').removeClass('bg-success')
        if($("#"+search+"_user").length > 0){
            $("#"+search+"_user").addClass("bg-success");
        }else{
            alert("Invalid User Id")
        }
    });
</script>
