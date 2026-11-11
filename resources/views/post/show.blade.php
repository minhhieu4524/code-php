<div class="comments-section mt-5">
    <h4>Bình luận</h4>

    {{-- Form gửi bình luận (Chỉ hiển thị khi đã đăng nhập) --}}
    @auth
        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mb-4">
            @csrf
            <div class="form-group">
                <textarea name="content" rows="3" class="form-control @error('content') is-invalid @enderror" placeholder="Viết bình luận của bạn..." required></textarea>
                @error('content')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Gửi bình luận</button>
        </form>
    @else
        <p>Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để tham gia bình luận.</p>
    @endauth

    {{-- Danh sách hiển thị bình luận --}}
    <hr>
    @isset($post->comments)
        @foreach($post->comments as $comment)
            <div class="media mb-3 border-bottom pb-3">
                <div class="media-body">
                    <h5 class="mt-0 font-weight-bold" style="font-size: 15px;">
                        {{ $comment->user->name ?? 'Người dùng' }} 
                        <small class="text-muted font-weight-normal" style="font-size: 12px;">{{ $comment->created_at->diffForHumans() }}</small>
                    </h5>
                    <p class="mb-1">{{ $comment->content }}</p>

                    {{-- Nút xóa bình luận (Chỉ hiện nếu là chủ bình luận, chủ bài viết hoặc admin) --}}
                    @auth
                        @if($comment->user_id === Auth::id() || $post->user_id === Auth::id() || (Auth::user()->role ?? '') === 'admin')
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa bình luận này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger btn-sm p-0" style="font-size: 13px;">Xóa</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        @endforeach
    @endisset
</div>