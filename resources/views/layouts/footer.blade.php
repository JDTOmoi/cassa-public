<div class="container-fluid" style="background-color:aliceblue" >
    <footer>
        
        <div class="d-flex justify-content-evenly row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 border-top mx-auto">
            
            <div class="col mb-3 text-center">
            <h5>Contact info</h5>
            <p>
            (031) 99141069<br>
            0811-320564 (Mr Sugianto)<br>
            0811-335203 (Mr Irwan)<br>
            contactus.casa@gmail.com<br>
            </p>
            </div>
        
            <div class="col text-center mb-3">
                <h5>Navigation</h5>

                <ul class="nav flex-column">
                    @if(Auth::user() && Auth::user()->isAdmin() !== null && Auth::user()->isAdmin())
                    <li class="nav-item mb-2"><a href="{{route('admin.daftarproduk')}}" class="footer-link nav-link p-0 text-muted">Produk</a></li>
                    <li class="nav-item mb-2"><a href="{{route('admin.daftarbrand')}}" class="footer-link nav-link p-0 text-muted">Brand</a></li>
                    <li class="nav-item mb-2"><a href="{{route('admin.daftarcategory')}}" class="footer-link nav-link p-0 text-muted">Kategori</a></li>
                    <li class="nav-item mb-2"><a href="{{route('admin.daftarorder')}}" class="footer-link nav-link p-0 text-muted">Daftar Order</a></li>
                    <li class="nav-item mb-2"><a href="{{route('tambahorder')}}" class="footer-link nav-link p-0 text-muted">Order</a></li>
                    <li class="nav-item mb-2"><a href="{{route('admin.kirimtransaksi')}}" class="footer-link nav-link p-0 text-muted">Send Transaction</a></li>
                    <li class="nav-item mb-2"><a href="{{route('admin.portofolio')}}" class="footer-link nav-link p-0 text-muted">Portofolio</a></li>
                    <li class="nav-item mb-2"><a href="{{route('admin.berita')}}" class="footer-link nav-link p-0 text-muted">Berita</a></li>
                    @else
                    <li class="nav-item mb-2"><a href="{{route('produk')}}" class="footer-link nav-link p-0 text-muted">Produk</a></li>
                    <li class="nav-item mb-2"><a href="{{route('tambahorder')}}" class="footer-link nav-link p-0 text-muted">Order</a></li>
                    <li class="nav-item mb-2"><a href="{{route('portofolio')}}" class="footer-link nav-link p-0 text-muted">Portofolio</a></li>
                    <li class="nav-item mb-2"><a href="{{route('berita')}}" class="footer-link nav-link p-0 text-muted">Berita</a></li>
                    @endif
                    <li class="nav-item mb-2"><a href="{{route('contact')}}" class="footer-link nav-link p-0 text-muted">Kontak</a></li>
                </ul>
            </div>
        </div>
        <div class="col mb-3 text-center py-1 ">
                <p>Copyright 2023</p>
            </div>

    </footer>
    
</div>