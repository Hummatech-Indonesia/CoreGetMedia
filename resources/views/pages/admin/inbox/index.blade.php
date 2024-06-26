@extends('layouts.admin.app')

@section('style')
<style>
    .card-table {
        background-color: #fff;
        padding: 25px;
        border-radius: 10px;
    }
    .nav-underline .nav-link.active,
.nav-underline .show>.nav-link {
    font-weight: 500;
    color: #175A95;
    border-bottom-color: currentcolor;
    padding-left: 15px;
    padding-right: 15px;
}
</style>
@endsection

<head>
    <title>Admin | Notification-List</title>
</head>

@section('content')
<div>
    <ul class="nav nav-underline" id="myTab" role="tablist">
        <li class="nav-item ms-2">
            <a class="nav-link active" id="artikel-tab" style="padding-right: 15px; padding-left: 15px;" data-bs-toggle="tab" href="#artikel" role="tab"
                aria-controls="artikel">
                <span>artikel</span>
            </a>
        </li>
        <li class="nav-item ms-2">
            <a class="nav-link" id="komentar-tab" style="padding-right: 15px; padding-left: 15px;" data-bs-toggle="tab" href="#komentar" role="tab"
                aria-controls="komentar">
                <span>Komentar</span>
            </a>
        </li>
    </ul>
</div>

<div class="tab-content tabcontent-border p-3" id="myTabContent">
    <div role="tabpanel" class="tab-pane fade show active" id="artikel" aria-labelledby="active-tab">
        <div class="table-responsive rounded-2">
            <table class="table border text-nowrap customize-table mb-0 align-middle ">
                <thead>
                    <tr>
                        <th style="background-color: #D9D9D9;">Pelapor</th>
                        <th style="background-color: #D9D9D9;">Dilaporkan</th>
                        <th style="background-color: #D9D9D9;">Isi Laporan</th>
                        <th style="background-color: #D9D9D9;">Bukti</th>
                        <th style="background-color: #D9D9D9;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($articles as $article)
                        <tr>
                            <td>
                                @if ($article->user->image != null && Storage::disk('public')->exists($article->user->image))
                                    <img src="{{ asset('storage/'. $article->user->image)}}" class="rounded-circle me-2 user-profile" style="object-fit: cover" width="35" height="35" alt="" />
                                @else
                                    <img src="{{ asset('default.png') }}" class="rounded-circle me-2 user-profile" style="object-fit: cover" width="35" height="35" alt="" />
                                @endif
                                {{ $article->user->name }}
                            </td>
                            <td>
                                @if ($article->news->image != null && Storage::disk('public')->exists($article->news->image))
                                <img src="{{ asset('storage/' . $article->news->image) }}" width="100px"
                                    height="90px" class="w-100" style="width: 100%; object-fit:cover;" />
                                @else
                                <img src="{{ asset('assets/blank-img.jpg') }}" width="100px"
                                    height="90px" class="w-100" style="width: 100%; object-fit:cover;" />
                                @endif
                            </td>
                            <td>{{ Str::limit($article->description, 20, '...') }}</td>
                            <td>
                                @if ($article->proof != null && Storage::disk('public')->exists($article->proof))
                                <img src="{{ asset('storage/' . $article->proof) }}" width="100px"
                                    height="90px" class="w-100" style="width: 100%; object-fit:cover;" />
                                @else
                                <img src="{{ asset('assets/blank-img.jpg') }}" width="100px"
                                    height="90px" class="w-100" style="width: 100%; object-fit:cover;" />
                                @endif
                            </td>
                            <td>
                                <button data-bs-toggle="tooltip" title="Detail" class="btn btn-sm btn-detail btn-primary me-2" style="background-color:#5D87FF">
                                    <i><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M12 6.5a9.77 9.77 0 0 1 8.82 5.5c-1.65 3.37-5.02 5.5-8.82 5.5S4.83 15.37 3.18 12A9.77 9.77 0 0 1 12 6.5m0-2C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5m0 5a2.5 2.5 0 0 1 0 5a2.5 2.5 0 0 1 0-5m0-2c-2.48 0-4.5 2.02-4.5 4.5s2.02 4.5 4.5 4.5s4.5-2.02 4.5-4.5s-2.02-4.5-4.5-4.5" />
                                        </svg></i>
                                </button>
            
                                <button type="submit" style="background-color: #EF6E6E" class="btn btn-sm text-white btn-delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                                        <path fill="#ffffff" d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5t.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5t-.288.713T19 6v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zm-7 11q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8t-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8t-.712.288T13 9v7q0 .425.288.713T14 17M7 6v13z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="text-center mt-5">
                                    <img src="{{ asset('assets/Empty-cuate.png') }}" alt="" width="200px">
                                    <p>Tidak ada berita</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="komentar" role="tabpanel" aria-labelledby="komentar-tab">
        <div class="table-responsive rounded-2">
            <table class="table border text-nowrap customize-table mb-0 align-middle ">
                <thead>
                    <tr>
                        <th style="background-color: #D9D9D9;">Pelapor</th>
                        <th style="background-color: #D9D9D9;">Dilaporkan</th>
                        <th style="background-color: #D9D9D9;">Isi Laporan</th>
                        <th style="background-color: #D9D9D9;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                   @forelse ($comments as $comment)
                        <tr>
                            <td>
                                @if ($comment->user->image != null && Storage::disk('public')->exists($comment->user->image))
                                <img src="{{ asset('storage/'. $comment->user->image)}}" class="rounded-circle me-2 user-profile" style="object-fit: cover" width="35" height="35" alt="" />
                                @else
                                    <img src="{{ asset('default.png') }}" class="rounded-circle me-2 user-profile" style="object-fit: cover" width="35" height="35" alt="" />
                                @endif
                                {{ $comment->user->name }}
                            </td>
                            <td>{{ Str::limit($comment->comment->description, 30, '...') }}</td>
                            <td>{{ Str::limit($comment->description, 40, '...') }}</td>
                            <td>
                                <button data-bs-toggle="tooltip" title="Detail" class="btn btn-sm btn-detail btn-primary me-2" style="background-color:#5D87FF">
                                    <i><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M12 6.5a9.77 9.77 0 0 1 8.82 5.5c-1.65 3.37-5.02 5.5-8.82 5.5S4.83 15.37 3.18 12A9.77 9.77 0 0 1 12 6.5m0-2C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5m0 5a2.5 2.5 0 0 1 0 5a2.5 2.5 0 0 1 0-5m0-2c-2.48 0-4.5 2.02-4.5 4.5s2.02 4.5 4.5 4.5s4.5-2.02 4.5-4.5s-2.02-4.5-4.5-4.5" />
                                        </svg></i>
                                </button>
            
                                <button type="submit" style="background-color: #EF6E6E" class="btn btn-sm text-white btn-delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                                        <path fill="#ffffff" d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5t.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5t-.288.713T19 6v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zm-7 11q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8t-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8t-.712.288T13 9v7q0 .425.288.713T14 17M7 6v13z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                   @empty
                        <tr>
                            <td colspan="4">
                                <div class="text-center mt-5">
                                    <img src="{{ asset('assets/Empty-cuate.png') }}" alt="" width="200px">
                                    <p>Tidak ada berita</p>
                                </div>
                            </td>
                        </tr>
                   @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                
            </div>
        </div>
    </div>
</div>
@endsection