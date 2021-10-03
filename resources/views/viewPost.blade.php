@extends('layouts.app-master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{ route('posts.post') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="card">
                            <div class="container-fliud">
                                <div class="wrapper row">
                                    <div class="details col-md-6">
                                        <h3 class="product-title">Post Ratings</h3>
                                        <div class="rating">
                                            <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $post->userAverageRating }}" data-size="xs">
                                            <input type="hidden" name="id" required="" value="{{ $post->id }}">
                                            @php ($total_reviews = 0 )
                                            @foreach($post->ratings as $rate)
                                            @php ($total_reviews =$total_reviews + $rate->rating)
                                            @endforeach
                                            <span class="review-no"> Total Reviews {{ $total_reviews }}</span>
                                            <br /><br />
                                            <button class="btn btn-lg btn-success">Submit Review &raquo;</button>
                                            <a class="btn btn-lg btn-primary" href="{{'/posts'}}" role="button">Back to all Posts </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#input-id").rating();
</script>
@endsection