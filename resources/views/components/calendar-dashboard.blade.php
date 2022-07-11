<section>
    <div class="card container">
        <div class="card-header row">
            <div class="col-4 offset-4">
                <h6 class="text-center text-dark mt-2">Kalender</h6>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <div class="mx-5 mt-2">
                    <a href="{{ route('change-month', ['current' => $current->format('Y-m-d'), 'counter' => -1]) }}">
                        <i class="bi bi-caret-left-square-fill text-dark"></i>
                    </a>
                    <span class="d-block-inline mx-4">{{ $current->isoFormat('MMMM Y') }}</span>
                    <a href="{{ route('change-month', ['current' => $current->format('Y-m-d'), 'counter' => 1]) }}">
                        <i class="bi bi-caret-right-square-fill text-dark"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    {{-- Looping nama hari sebagai header --}}
                    @foreach ($daysName as $dayName)
                        <div class="col-7 pb-3">
                            <span class="d-block text-center fw-bold">{{ $dayName }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    {{-- Looping blank --}}
                    @for ($i = 0; $i < $offset; $i++)
                        <div class="col-7">
                            <div class="w-100">
                                <span class="d-block font-24 text-center my-2">-</span>
                            </div>
                        </div>
                    @endfor

                    {{-- Looping / tampilkan seluruh tanggal di bulan ini --}}
                    @foreach ($datesOfMonth as $i => $dateOfMonth)
                        <div class="col-7 mb-3">
                            {{-- Tombol date --}}
                            <div
                                class="shadow-sm rounded border py-1 {{ isToday($dateOfMonth) ? 'bg-primary rounded text-white' : '' }} {{ isPass($dateOfMonth) ? 'bg-light text-secondary shadow-none' : '' }} w-100 position-relative">
                                <span class="d-block text-center my-2">{{ $dateOfMonth->isoFormat('D') }}</span>
                                <a href="#" class="{{ count($dataInMonth[$i]) <= 0 ? 'd-none' : '' }}"
                                    data-bs-toggle="modal" data-bs-target="#modal-data-in-date-{{ $i }}">
                                    <span class="position-absolute top-0 start-100 translate-middle">
                                        <i class="bi bi-info-circle-fill text-dark"></i>
                                    </span>
                                </a>
                            </div>

                            {{-- Modal data jadwal --}}
                            <div class="modal fade" id="modal-data-in-date-{{ $i }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <form action="#" method="post">
                                        <div class="modal-content rounded">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    Jadwal pada
                                                    <strong>{{ $dateOfMonth->isoFormat('dddd, D MMMM Y') }}</strong>
                                                </h5>
                                            </div>
                                            <div class="modal-body">
                                                @if (count($dataInMonth[$i]) > 0)
                                                    {{-- Tabel jadwal --}}
                                                    <div id="schedule-table-wrapper" class="table-responsive">
                                                        <table id="schedule-table" class="table align-middle">
                                                            <tr>
                                                                <td>#</td>
                                                                <td>Ruangan</td>
                                                                <td>Peminjam</td>
                                                                <td>Tanggal</td>
                                                                <td>Mulai</td>
                                                                <td>Selesai</td>
                                                                <td>Keterangan</td>
                                                                <td>Status</td>
                                                            </tr>

                                                            {{-- Content --}}
                                                            @foreach ($dataInMonth[$i] as $i => $data)
                                                                <tr>
                                                                    <td>{{ $i + 1 }}</td>
                                                                    <td>{{ $data->room->name }}</td>
                                                                    <td>{{ $data->borrower->name }}</td>
                                                                    <td>{{ dateFormat($data->date) }}
                                                                    </td>
                                                                    <td>{{ timeFormat($data->start) }}
                                                                    </td>
                                                                    <td>{{ timeFormat($data->end) }}</td>
                                                                    <td>{{ $data->description }}</td>

                                                                    {{-- Status --}}
                                                                    <td>
                                                                        {!! makeStatus($data->status) !!}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                @else
                                                    <h6>Tidak ada jadwal yang terdaftar.</h6>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</section>
