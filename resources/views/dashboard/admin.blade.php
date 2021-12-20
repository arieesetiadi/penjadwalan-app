{{-- Include header --}}
@include('layout.header')

<!--start content-->
<main class="page-content">
    {{-- main Content --}}
    @if (session('greeting'))
        <div
            class="alert border-0 border-success border-start border-4 bg-light-success alert-dismissible fade show py-2">
            <div class="d-flex align-items-center">
                <div class="fs-3 text-success"><i class="bi bi-check-circle-fill"></i>
                </div>
                <div class="ms-3">
                    <div class="text-success">{{ session('greeting') }}</div>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</main>
<!--end page main-->

{{-- Include footer --}}
@include('layout.footer')
