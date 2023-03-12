@foreach($posts as $post)
    <x-post :post="$post" />
@endforeach
{{$posts->links('vendor.pagination.ajax')}}
