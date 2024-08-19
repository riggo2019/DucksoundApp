@php
    use Illuminate\Support\Str;
@endphp
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>STT</th>
                <th style="width: 300px">Tên Quảng cáo</th>
                <th style="width: 400px">Mô tả</th>
                <th style="width: 150px">File quảng cáo</th>
                <th style="width: 130px">Ảnh quảng cáo</th>
                <th style="width: 130px">Công ty sở hữu</th>
                <th style="width: 50px">Sửa</th>
                <th style="width: 50px">Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($ads) && is_object($ads))
                @foreach ($ads as $ad)
                    <tr>
                        <td>
                            {{ ++$i }}
                        </td>
                        <td>
                            {{ $ad->ads_name }}
                        </td>
                        <td>
                            <p>{{ Str::limit($ad->description, 300) }}{{ strlen($ad->description) > 300 ? '...' : '' }}
                            </p>
                        </td>
                        <td>
                            {{ $ad->ads_file }}
                        </td>
                            <td>
                                @if ($ad->ads_image != null)
                                    <a href="{{ asset('images/ads/' . $ad->ads_image) }}"
                                        data-lightbox="roadtrip">
                                        <span class="avatar song_image m-0">
                                            <img src="{{ asset('images/ads/' . $ad->ads_image) }}"
                                                alt="Image">
                                        </span>
                                    </a>
                                @else
                                    <a href="{{ asset('images/ads/none.jpg') }}" data-lightbox="roadtrip">
                                        <span class="avatar song_image m-0">
                                            <img src="{{ asset('images/ads/none.jpg') }}" alt="Default Image">
                                        </span>
                                    </a>
                                @endif
                            </td>
                        
                        <td>
                            {{ $ad->owner_company }}
                        </td>
                        <td>
                            <a href="{{ route('ads.edit', ['id' => $ad->id]) }}" class="btn btn-warning btn-sm"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                        <td>
                            <form action="{{ route('ads.delete', ['id' => $ad->id]) }}" method="POST"
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
    {{ $ads->links('pagination::bootstrap-4') }}
</div>
<script>
    function confirmDelete() {
        return confirm('Bạn có chắc muốn xóa quảng cáo');
    }
</script>
