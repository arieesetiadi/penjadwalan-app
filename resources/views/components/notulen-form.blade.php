<form action="{{ route('note.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="scheduleId" value="{{ $finish->id }}">
    <div class="modal-content">
        <div class="modal-body">
            <h5 class="modal-title mb-3" id="exampleModalLabel">
                Upload Notulen
            </h5>
            <div class="border-top">
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="pill" href="#primary-pills-home" role="tab"
                                aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bi bi-blockquote-left me-1"></i>
                                    </div>
                                    <div class="tab-title">Text</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="pill" href="#primary-pills-profile" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bi bi-card-image me-1"></i>
                                    </div>
                                    <div class="tab-title">Gambar</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="pill" href="#primary-pills-contact" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bi bi-file-earmark-arrow-up me-1"></i>
                                    </div>
                                    <div class="tab-title">File</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    {{-- Input title --}}
                    <div class="mb-4">
                        <label class="mb-2" for="title">Judul :</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-pen"></i>
                            </span>
                            <input name="title" id="title" type="text" class="form-control"
                                placeholder="Judul notulen" aria-label="title" required
                                value="Notulen {{ $finish->description }}">
                        </div>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="primary-pills-home" role="tabpanel">
                            {{-- Isi Notulen --}}
                            <div class="">
                                <label class="mb-2" for="contentText">Isi Notulen :</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-chat-square-text"></i>
                                    </span>
                                    <textarea rows="6" name="contentText" id="contentText" type="text" class="form-control" placeholder="Isi notulen"
                                        aria-label="contentText"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="primary-pills-profile" role="tabpanel">
                            {{-- Isi Notulen --}}
                            <div class="">
                                <label class="mb-2" for="contentImage">Foto / Gambar :</label>
                                <div class="input-group">
                                    <input name="contentImage" class="form-control" type="file" id="contentImage"
                                        accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="primary-pills-contact" role="tabpanel">
                            {{-- Isi Notulen --}}
                            <div class="">
                                <label class="mb-2" for="contentFile">File :</label>
                                <div class="input-group">
                                    <input name="contentFile" class="form-control" type="file" id="contentFile"
                                        accept=".pdf,.doc,.docx,.pptx,.xlsx,.txt">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">OK</button>
        </div>
    </div>
</form>
