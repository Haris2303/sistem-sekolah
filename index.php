<?php require_once __DIR__ . '/template/navbar.php' ?>

<!-- Slider -->

<div id="carouselExample" class="carousel slide">
    <div class="carousel-inner" style="height: 35rem;">
        <div class="carousel-item active">
            <img src="img/slides/slide1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="img/slides/slide2.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="img/slides/slide3.jpg" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- End Slider -->


<!-- About -->

<section id="about" class="mt-5 py-5 mb-5">
    <div class="container">
        <div class="header-title">
            <h2>About</h2>
            <p>Mengenal Kami Lebih Dekat</p>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <p>
                    SMA Papua di Kota Sorong adalah salah satu sekolah menengah atas yang menjadi kebanggaan di wilayah Papua Barat Daya. Terletak di kota strategis yang merupakan pintu gerbang bagi daerah sekitar, sekolah ini menawarkan pendidikan yang tidak hanya fokus pada prestasi akademik, tetapi juga pengembangan karakter dan budaya lokal. Dengan latar belakang keindahan alam Papua yang menakjubkan, para siswa di SMA ini memiliki kesempatan untuk tumbuh dalam lingkungan yang kaya akan keragaman budaya.
                </p>
                <p>SMA Papua Kota Sorong juga sering kali menjadi pelopor dalam berbagai kegiatan olahraga dan seni, mencetak prestasi di tingkat regional maupun nasional. Selain itu, sekolah ini sangat mendukung pengembangan keterampilan teknologi dan inovasi, yang relevan dengan perkembangan zaman. Kombinasi antara pendidikan berkualitas, perhatian pada budaya lokal, dan semangat inovasi menjadikan SMA Papua Kota Sorong sebagai salah satu tempat terbaik bagi generasi muda untuk mempersiapkan masa depan mereka.</p>
            </div>
            <div class="col-lg-6">
                <img src="img/slides/slide1.jpg" alt="" style="width: 100%;">
            </div>
        </div>
    </div>
</section>

<!-- End About -->


<!-- Gallery -->

<section id="gallery" class="mt-5 p-5 bg-secondary">
    <div class="container">
        <div class="header-title text-end text-light">
            <h2>Gallery</h2>
            <p>Potret Momen Terbaik Kami</p>
        </div>

        <div class="row gy-4 justify-content-center">
            <div class="col-md-3">
                <img src="img/slides/slide1.jpg" alt="" class="img-thumbnail shadow">
            </div>
            <div class="col-md-3">
                <img src="img/slides/slide1.jpg" alt="" class="img-thumbnail shadow">
            </div>
            <div class="col-md-3">
                <img src="img/slides/slide1.jpg" alt="" class="img-thumbnail shadow">
            </div>
            <div class="col-md-3">
                <img src="img/slides/slide1.jpg" alt="" class="img-thumbnail shadow">
            </div>
            <div class="col-md-3">
                <img src="img/slides/slide1.jpg" alt="" class="img-thumbnail shadow">
            </div>
            <div class="col-md-3">
                <img src="img/slides/slide1.jpg" alt="" class="img-thumbnail shadow">
            </div>
            <div class="col-md-3">
                <img src="img/slides/slide1.jpg" alt="" class="img-thumbnail shadow">
            </div>
        </div>

    </div>
</section>

<!-- End Gallery -->


<!-- Contact -->

<section id="contact" style="padding-top: 7rem; margin-bottom: 10rem">
    <div class="container">
        <div class="header-title">
            <h2>Contact</h2>
            <p>Hubungi Kami untuk Informasi Lebih Lanjut</p>
        </div>

        <div class="container bg-secondary shadow-lg p-5 rounded-2 text-light">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Form</h3>
                    <hr>
                    <form id="whatsappForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea type="text" class="form-control" id="message" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-dark">Kirim</button>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div class="text-end">
                        <h3>Location</h3>
                        <hr>
                        <div class="mt-3">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2602.4019848215444!2d131.32877830797094!3d-0.9137569353232323!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d5bfe2607289f05%3A0xb555f3a1f44b3895!2sSMA%20Papua%20Kota%20Sorong!5e1!3m2!1sid!2sid!4v1727866157210!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('whatsappForm').addEventListener('submit', function(e) {
        e.preventDefault();

        var name = document.getElementById('name').value;
        var message = document.getElementById('message').value;
        var phoneNumber = '6281343398859'; // Ganti dengan nomor WhatsApp owner tanpa '+' dan spasi

        var url = 'https://wa.me/' + phoneNumber + '?text=' +
            encodeURIComponent('Halo, saya ' + name + '.\n\n' + message);

        window.open(url, '_blank');
    });
</script>

<!-- End Contact -->

<?php require_once __DIR__ . '/template/footer.php' ?>