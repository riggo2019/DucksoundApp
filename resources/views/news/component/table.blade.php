@php
    use Illuminate\Support\Str;
@endphp
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>STT</th>
                <th style="width: 200px">Tên Tin tức</th>
                <th style="width: 900px">Nội dung</th>
                <th style="width: 50px">Ảnh bìa</th>
                <th style="width: 50px">Sửa</th>
                <th style="width: 50px">Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($news) && is_object($news))
                @foreach ($news as $new)
                    <tr>
                        <td>
                            {{ ++$i }}
                        </td>
                        <td>
                            {{ $new->title }}
                        </td>
                        <td>
                            <p>{{ Str::limit($new->description, 500) }}{{ strlen($new->description) > 500 ? '...' : '' }}
                            </p>
                        </td>
                        <td>
                            @if ($new->news_image != null)
                                <a href="{{ asset('images/news/' . $new->news_image) }}" data-lightbox="roadtrip">
                                    <span class="avatar song_image  m-0">
                                        <img src="{{ asset('images/news/' . $new->news_image) }}" alt="Image">
                                    </span>
                                </a>
                            @else
                                <a href="{{ asset('images/news/default-image.jpg') }}" data-lightbox="roadtrip">
                                    <span class="avatar song_image  m-0">
                                        <img src="{{ asset('images/news/default-image.jpg') }}" alt="Default Image">
                                    </span>
                                </a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('news.edit', ['id' => $new->id]) }}" class="btn btn-warning btn-sm"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                        <td>
                            <form action="{{ route('news.delete', ['id' => $new->id]) }}" method="POST"
                                onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i
                                        class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{ $news->links('pagination::bootstrap-4') }}
</div>
<script>
    function confirmDelete() {
        return confirm('Bạn có chắc muốn xóa tin tức');
    }
</script>
