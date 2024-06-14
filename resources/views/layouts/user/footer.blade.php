<style>
    .ads {
        color: #FFFFFF;
    }

    .ads:hover {
        color: blueviolet;
    }
</style>

<div class="p-5" style="background-color: #253645;">
    <div class="">
        <div class="row text-white">
            <div class="col-lg-4">
                <ul style="list-style-type: none;" class="p-4">
                    <img src="{{asset('assets/img/logo/get-media-light.svg')}}" width="200px" alt="Image" />
                    <li></li>
                    <li>
                        <p class="copyright-text mt-4">
                            {{-- @if ($firstContact)
                            {{ $firstContact->slogan }}
                            @endif © --}}
                        </p>
                        <p class="copyright-text mt-4" style="font-size: 20px"><span>Get</span>Media berita terlengkap
                            dengan berita terbaru dan terpopuler.</p>
                    </li>
                    <li>
                        <ul style="list-style-type: none;" class="p-4">
                            <span style="color: #92989F; font-size: 15px;">Pengiklanan</span>
                            <li class="mb-2"><a href="{{route('user.ads.advertising')}}" class="ads">+
                                    Tentang
                                    Iklan</a>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>

            <div class="col-lg-2">

                <ul style="list-style-type: none;" class="p-4">
                    <span style="color: #92989F; font-size: 15px;">Halaman</span>
                    <li class="mb-2"><a href="/" style="color: #FFFFFF">Beranda</a></li>
                    <li class="mb-2"><a href="{{ route('about.us') }}" style="color: #FFFFFF">Tentang Kami</a></li>
                    <li class="mb-2"><a href="/contact-us" style="color: #FFFFFF">Hubungi Kami</a></li>
                    <li class="mb-2"><a href="{{ route('user.list.author') }}" style="color: #FFFFFF">Penulis</a></li>
                    <li class="mb-2"><a href="{{route('faq-list.user')}}" style="color: #FFFFFF">Faq</a></li>
                </ul>
            </div>

            <div class="col-lg-2">
                <ul style="list-style-type: none;" class="p-4">
                    <span style="color: #92989F; font-size: 15px;">Social Media</span>
                    <li class="mb-2"><a href="#" style="color: #FFFFFF">Facebook</a></li>
                    <li class="mb-2"><a href="#" style="color: #FFFFFF">Twitter</a></li>
                    <li class="mb-2"><a href="#" style="color: #FFFFFF">Instagram</a></li>
                    <li class="mb-2"><a href="#" style="color: #FFFFFF">Linkedin</a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <ul style="list-style-type: none;" class="p-4">
                    <span style="color: #92989F; font-size: 15px;">Kontak</span>
                    <li class="mb-2">
                        <p>getmedia@gmail.com</p>
                    </li>
                    <li class="mb-2">+62 *** **** **** </li>
                    {{-- <li class="mb-2"><span style="color: #92989F; font-size: 15px;">Berlangganaan</span></li> --}}
                </ul>
            </div>

            <div class="col-md-12 col-lg-12">
                <div class="d-flex justify-content-between">
                    <div class="d-flex justify-content-start">
                        <span style="color: #92989F; font-size: 12px;">Design By GetMedia Team</span>
                    </div>

                    <div class="d-flex justify-content-end">
                        <span style="color: #92989F; font-size: 12px;">Privacy Policy</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<button type="button" id="backtotop" class="position-fixed text-center border-0 p-0">
    <i cl ass="ri-arrow-up-line"></i>
</button>