@extends('admin.layout.masterlayout')

@section('content')
    <div class="container">
        <h5 class="overview-title mb-3 ps-0">
            <span class="border-3 border-bottom border-primary" data-id="list-header">List Data Buku</span>
        </h5>
        <!-- btn tambah buku -->
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-5">
            <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#tambahbuku" data-id="tambah-button">
                Tambah Data Buku
            </button>
        </div>

        <!-- list buku wrapper -->
        <div class="container-fluid overflow-auto" style="height: 35vw;">
            <div class="row justify-content-start">

                @foreach ($books as $book)
                    <!-- card-item-buku -->
                    <div class="col-auto">
                        <div class="card text-dark bg-light mb-3" style="max-width: 10rem;">
                            <div class="card-header">
                                <button class="btn btn-warning btn-sm" type="button" title="Detail" data-bs-toggle="modal"
                                    data-bs-target="#detailbuku{{ $book->id }}" data-id="modal-detail">
                                    <i class="las la-external-link-square-alt"></i>
                                </button>
                                <button class="btn btn-primary btn-sm" type="button" title="Edit" data-bs-toggle="modal"
                                    data-bs-target="#editbuku{{ $book->id }}" data-id="modal-edit">
                                    <i class="las la-edit"></i>
                                </button>
                                <form action="{{ route('kelolabuku.destroy', $book->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit" title="Hapus" data-id="modal-delete">
                                        <i class="las la-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="card-body  mx-auto" style="padding: 0 0 !important;">
                                @if ($book->cover_photo === null)
                                    <img src="/images/product-01.jpg" class="img-responsive" alt="Foto Buku"
                                        style="max-width: 150px;">
                                @else
                                    <img src="{{ asset('storage/' . $book->cover_photo) }}" class="img-responsive"
                                        alt="Foto Buku" style="max-width: 150px;">
                                @endif


                            </div>
                        </div>
                    </div>
                    <!-- card-item-buku end -->

                    <!-- Modal Detail data Buku -->
                    <div class="modal fade" id="detailbuku{{ $book->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="false">
                        <div class="modal-dialog  modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detail Data Buku</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="mb-3" style="max-width: 700px;">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img src="{{ asset('storage/' . $book->cover_photo) }}"
                                                    class="img-fluid rounded-start" alt="foto sampul" data-id="file-detail">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <div class="mb-3 row">
                                                        <label for="ISBNf" class="col-sm-5 col-form-label">ISBN</label>
                                                        <div class="col-sm-7">
                                                            <p data-id="isbn-detail">{{ $book->isbn }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="judulf" class="col-sm-5 col-form-label">Judul
                                                            Buku</label>
                                                        <div class="col-sm-7">
                                                            <p data-id="judul-detail">{{ $book->title }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="pengarangf"
                                                            class="col-sm-5 col-form-label">Pengarang</label>
                                                        <div class="col-sm-7">
                                                            <p data-id="pengarang-detail">{{ $book->author }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="penerbitf"
                                                            class="col-sm-5 col-form-label">penerbit</label>
                                                        <div class="col-sm-7">
                                                            <p data-id="penerbit-detail">{{ $book->publisher }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="hargaf" class="col-sm-5 col-form-label">harga</label>
                                                        <div class="col-sm-7">
                                                            <p data-id="harga-detail">{{ $book->price }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="stokf" class="col-sm-5 col-form-label">Stock</label>
                                                        <div class="col-sm-7">
                                                            <p data-id="stok-detail">{{ $book->stock }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="kategorif"
                                                            class="col-sm-5 col-form-label">kategori</label>
                                                        <div class="col-sm-7">
                                                            <p data-id="kategori-detail">{{ $book->category->category_name }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Detail data Buku -->

                    <!-- Modal edit data Buku -->
                    <div class="modal fade" id="editbuku{{ $book->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="false">
                        <div class="modal-dialog  modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Buku</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('kelolabuku.update', $book->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3 row">
                                            <label for="formFile" class="col-sm-5 col-form-label">Foto Sampul Buku</label>
                                            <div class="col-sm-7">
                                                <input class="form-control form-control-sm" type="file" id="formFile"
                                                    name="cover_photo" data-id="file-edit">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="ISBNf" class="col-sm-5 col-form-label">ISBN</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control form-control-sm" id="ISBNf"
                                                    required name="isbn" value="{{ $book->isbn }}" data-id="isbn-edit">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="judulf" class="col-sm-5 col-form-label">Judul Buku</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control form-control-sm" id="judulf"
                                                    required name="title" value="{{ $book->title }}" data-id="judul-edit">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="pengarangf" class="col-sm-5 col-form-label">Pengarang</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control form-control-sm"
                                                    id="pengarangf" required name="author"
                                                    value="{{ $book->author }}" data-id="pengarang-edit">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="penerbitf" class="col-sm-5 col-form-label">penerbit</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control form-control-sm" id="penerbitf"
                                                    required name="publisher" value="{{ $book->publisher }}" data-id="penerbit-edit">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="hargaf" class="col-sm-5 col-form-label">harga</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control form-control-sm" id="hargaf"
                                                    required name="price" value="{{ $book->price }}" data-id="harga-edit">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="stokf" class="col-sm-5 col-form-label">Stock</label>
                                            <div class="col-sm-7">
                                                <input type="number" class="form-control form-control-sm" id="stokf"
                                                    required name="stock" value="{{ $book->stock }}" data-id="stok-edit">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="hargaf" class="col-sm-5 col-form-label">Kategori</label>
                                            <div class="col-sm-7">
                                                <select class="form-select" aria-label="Default select example"
                                                    name="category_id" required data-id="kategori-edit">
                                                    <option value="{{ $book->category_id }}">
                                                        {{ $book->category->category_name }} </option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->category_name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success" data-id="simpan-edit">SIMPAN</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal edit data Buku -->
                @endforeach

            </div>
        </div>

    </div>

    <!-- Modal -->

    <!-- Modal Tambah data Buku -->
    <div class="modal fade" id="tambahbuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('kelolabuku.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="formFile" class="col-sm-5 col-form-label">Foto Sampul Buku</label>
                            <div class="col-sm-7">
                                <input class="form-control form-control-sm" type="file" id="formFile"
                                    name="cover_photo" required data-id="file-input">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="ISBNf" class="col-sm-5 col-form-label" >ISBN</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" id="ISBNf" required
                                    name="isbn" data-id="isbn">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="judulf" class="col-sm-5 col-form-label">Judul Buku</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" id="judulf" required
                                    name="title" data-id="judul">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="pengarangf" class="col-sm-5 col-form-label">Pengarang</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" id="pengarangf" required
                                    name="author" data-id="pengarang">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="penerbitf" class="col-sm-5 col-form-label">penerbit</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" id="penerbitf" required
                                    name="publisher" data-id="penerbit">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="hargaf" class="col-sm-5 col-form-label">harga</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" id="hargaf" required
                                    name="price" data-id="harga">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="stokf" class="col-sm-5 col-form-label">Stock</label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control form-control-sm" id="stokf" required
                                    name="stock" data-id="stok">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="hargaf" class="col-sm-5 col-form-label">Kategori</label>
                            <div class="col-sm-7">
                                <select class="form-select" aria-label="Default select example" name="category_id"
                                    required  data-id="kategori">
                                    <option> -- pilih kategori -- </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"> {{ $category->category_name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" data-id="simpan-create">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Tambah data Buku -->
@endsection
