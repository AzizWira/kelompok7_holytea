@extends('user.layout')

@section('title', 'Detail Menu - HolyTea Indonesia')

@section('page_css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
@endsection

@section('nav_links')
    <ul class="nav_link">
        <li class="hover-underline-animation">
            <a href="{{ url('/user') }}">Beranda</a>
        </li>
        <li class="hover-underline-animation">
            <a href="{{ url('/user/menu') }}">Menu</a>
        </li>
    </ul>
@endsection

@section('content')
    <main class="detail-wrap">
        <div class="top-actions">
            <a href="{{ url('/user/menu') }}" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali ke Menu
            </a>
        </div>

        <section class="hero">
            <div class="hero-media">
                <img src="{{ asset('assets/tea-series/lemon-tea.svg') }}" alt="Lemon Tea" class="drink-image" />
                <div class="badge">
                    <i class="fa-solid fa-fire"></i>
                    Best Seller
                </div>
            </div>

            <div class="hero-info">
                <p class="category">AUTHENTIC TEA SERIES</p>
                <h1 class="title">Lemon Tea</h1>

                <div class="meta">
                    <div class="rating">
                        <span class="stars" aria-label="rating 4.8 dari 5">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                        </span>
                        <span class="rating-text">4.8 (128 ulasan)</span>
                    </div>
                    <div class="price">Rp 5.000</div>
                </div>

                <p class="desc">
                    Kombinasi teh rebus asli dengan rasa lemon yang segar. Cocok diminum
                    saat cuaca panas. Manisnya bisa kamu atur (less sugar / normal).
                </p>

                <div class="quick-spec">
                    <div class="spec">
                        <div class="spec-title">Ukuran</div>
                        <div class="spec-value">Regular (350ml)</div>
                    </div>
                    <div class="spec">
                        <div class="spec-title">Es</div>
                        <div class="spec-value">Ice / Less Ice</div>
                    </div>
                    <div class="spec">
                        <div class="spec-title">Gula</div>
                        <div class="spec-value">Normal / Less Sugar</div>
                    </div>
                </div>

                <div class="cta">
                    <a class="cta-btn gojek" href="https://gofood.link/a/FPu5BLq" target="_blank" rel="noopener">
                        <i class="fa-solid fa-motorcycle"></i> GoFood
                    </a>
                    <a class="cta-btn grab"
                        href="https://grab.onelink.me/2695613898?pid=inappsharing&c=6-C3EYAEWXWAUHA6&is_retargeting=true&af_dp=grab%3A%2F%2Fopen%3FscreenType%3DGRABFOOD%26sourceID%3DA4pcqCZkS4%26merchantIDs%3D6-C3EYAEWXWAUHA6&af_force_deeplink=true"
                        target="_blank" rel="noopener">
                        <i class="fa-solid fa-bag-shopping"></i> GrabFood
                    </a>
                    <a class="cta-btn shopee"
                        href="https://shopee.co.id/universal-link/now-food/shop/20939777?deep_and_deferred=1&shareChannel=copy_link"
                        target="_blank" rel="noopener">
                        <i class="fa-solid fa-store"></i> ShopeeFood
                    </a>
                </div>

                <div class="note">
                    <i class="fa-solid fa-circle-info"></i>
                    Informasi nutrisi bersifat estimasi per porsi.
                </div>
            </div>
        </section>

        <section class="section">
            <div class="section-head">
                <h2 class="section-title">Informasi Nutrisi</h2>
                <p class="section-subtitle">Estimasi nutrisi untuk 1 porsi (Regular).</p>
            </div>

            <div class="nutrition-grid">
                <div class="nutri-card">
                    <div class="nutri-top">
                        <span class="nutri-label">Kalori</span>
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <div class="nutri-value">110 <span>kcal</span></div>
                    <div class="nutri-foot">Energi total</div>
                </div>

                <div class="nutri-card">
                    <div class="nutri-top">
                        <span class="nutri-label">Gula</span>
                        <i class="fa-solid fa-cube"></i>
                    </div>
                    <div class="nutri-value">18 <span>g</span></div>
                    <div class="nutri-foot">Per porsi (Normal)</div>
                </div>

                <div class="nutri-card">
                    <div class="nutri-top">
                        <span class="nutri-label">Protein</span>
                        <i class="fa-solid fa-dumbbell"></i>
                    </div>
                    <div class="nutri-value">0 <span>g</span></div>
                    <div class="nutri-foot">Kandungan protein</div>
                </div>

                <div class="nutri-card">
                    <div class="nutri-top">
                        <span class="nutri-label">Lemak</span>
                        <i class="fa-solid fa-droplet"></i>
                    </div>
                    <div class="nutri-value">0 <span>g</span></div>
                    <div class="nutri-foot">Total lemak</div>
                </div>
            </div>

            <div class="nutrition-note">
                <div class="pill"><i class="fa-solid fa-leaf"></i> Teh rebus asli</div>
                <div class="pill"><i class="fa-solid fa-snowflake"></i> Segar diminum dingin</div>
                <div class="pill"><i class="fa-solid fa-thumbs-up"></i> Bisa request less sugar</div>
            </div>
        </section>

        <section class="section section-feedback" id="feedback">
            <div class="section-head">
                <h2 class="section-title">Testimoni</h2>
                <p class="section-subtitle">Apa kata mereka tentang menu ini</p>
            </div>

            <div class="feedback">
                <button class="fb-nav fb-prev" aria-label="Sebelumnya">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <div class="fb-track">
                    <article class="fb-card active">
                        <div class="fb-top">
                            <div class="avatar">RA</div>
                            <div class="who">
                                <div class="name">Rani</div>
                                <div class="stars-mini">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                        class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                        class="fa-solid fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="fb-text">Lemon tea-nya seger banget, manisnya pas. Jadi favorit kalau lagi panas!</p>
                        <div class="fb-foot">2 hari lalu</div>
                    </article>

                    <article class="fb-card">
                        <div class="fb-top">
                            <div class="avatar">AD</div>
                            <div class="who">
                                <div class="name">Adi</div>
                                <div class="stars-mini">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                        class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                        class="fa-solid fa-star-half-stroke"></i>
                                </div>
                            </div>
                        </div>
                        <p class="fb-text">Enak, rasanya ringan. Cocok buat yang nggak suka terlalu manis, minta less sugar.
                        </p>
                        <div class="fb-foot">1 minggu lalu</div>
                    </article>

                    <article class="fb-card">
                        <div class="fb-top">
                            <div class="avatar">FK</div>
                            <div class="who">
                                <div class="name">Fika</div>
                                <div class="stars-mini">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                        class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                        class="fa-solid fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="fb-text">Packaging rapih, minuman tetep dingin sampai rumah. Rekomen!</p>
                        <div class="fb-foot">3 minggu lalu</div>
                    </article>
                </div>

                <button class="fb-nav fb-next" aria-label="Berikutnya">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>

            <div class="fb-dots" aria-label="indikator testimoni">
                <span class="dot active" data-index="0"></span>
                <span class="dot" data-index="1"></span>
                <span class="dot" data-index="2"></span>
            </div>
        </section>
    </main>
@endsection

@section('page_js')
    <script src="{{ asset('js/detail.dynamic.js') }}"></script>
@endsection