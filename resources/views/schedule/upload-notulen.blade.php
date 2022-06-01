{{-- Include header --}}
@include('layout.header')

<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
        <a href="{{ route('user.index') }}" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="bottom"
            title="Kembali">
            <i class="bi bi-chevron-left text-dark"></i>
        </a>
        <div class="breadcrumb-title mx-2 pe-3">JADWAL</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><i class="bx bx-home-alt"></i>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title ??= 'Title' }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    {{-- Alert set --}}
    @include('components.alert-set')

    {{-- form --}}
    <div class="card">
        <div class="card-body">
            <form action="{{ route('note.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-5">
                            {{-- Hidden ID --}}
                            <input type="hidden" name="scheduleId" value="{{ $scheduleId }}">

                            {{-- Input title --}}
                            <div class="mb-4">
                                <label class="mb-2" for="title">Judul :</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-pen"></i>
                                    </span>
                                    <input name="title" id="title" type="text" class="form-control"
                                        placeholder="Judul notulen" aria-label="title" required
                                        value="{{ $noteTitle }}">
                                </div>
                            </div>

                            <hr>
                            @if (session('noteEmpty'))
                                <div id="noteEmpty" class="mb-2">
                                    <small class="text-danger">
                                        {{ session('noteEmpty') }}
                                    </small>
                                </div>
                            @endif

                            {{-- Isi Notulen --}}
                            <div class="mb-4">
                                <label class="mb-2" for="contentText">Isi Notulen :</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-chat-square-text"></i>
                                    </span>
                                    <textarea rows="6" name="contentText" id="contentText" type="text" class="form-control" placeholder="Isi notulen"
                                        aria-label="contentText" oninput="removeNoteEmpty()"></textarea>
                                </div>
                            </div>

                            {{-- Gambar Notulen --}}
                            <div class="mb-4">
                                <label class="mb-2" for="image">Foto / Gambar :</label>
                                <div class="input-group">
                                    <input name="contentImage" class="form-control" type="file" id="image"
                                        accept="image/*" onchange="loadImage()">
                                </div>
                            </div>

                            {{-- File Notulen --}}
                            <div class="">
                                <label class="mb-2" for="contentFile">File :</label>
                                <div class="input-group">
                                    <input name="contentFile" class="form-control" type="file" id="contentFile"
                                        accept=".pdf,.doc,.docx,.pptx,.xlsx,.txt" onchange="removeNoteEmpty()">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7">
                            {{-- Preview --}}
                            <div class="row">
                                <div id="image-preview-container" class="d-none col-12">
                                    <label class="mb-2">Preview gambar :</label>
                                    <img id="image-preview" src="" alt="" class="w-100 rounded">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-primary my-3 mt-4">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- end form --}}

</main>
<!--end page main-->

<script>
    function removeNoteEmpty() {
        document.getElementById('noteEmpty').remove();
    }
</script>
{{-- Include footer --}}
@include('layout.footer')
