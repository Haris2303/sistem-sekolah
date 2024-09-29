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
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, eos culpa? Omnis, necessitatibus minima rem dicta voluptatum optio porro error corrupti impedit, saepe repellat quis nihil officia aliquid quae amet?</p>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit error expedita cum quidem placeat, ipsam atque maxime eos, nam repudiandae voluptate, ut sit! Officia maiores corrupti doloribus dicta non ex natus in ipsa laudantium placeat voluptate ipsum odio quae quisquam eius officiis molestiae quas animi recusandae, facilis fugit ullam? Maiores.
                </p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae maxime fugiat, eligendi perferendis consequatur cum facere mollitia optio maiores qui id earum doloribus incidunt sapiente iusto harum enim similique consectetur aut ducimus molestiae dolorem quos! Quia voluptates consequatur optio ex sint, maiores dignissimos repellat eligendi expedita suscipit quo consequuntur numquam magni. Ab ea reiciendis excepturi velit delectus. Iste, minima cum fugit exercitationem temporibus harum beatae molestiae totam, voluptates modi error similique vero a voluptate ex minus laudantium dolorem architecto consequatur corrupti tempore adipisci sit mollitia? Perferendis eveniet quasi debitis harum et repellat dolorum asperiores nihil, ea, aspernatur recusandae veritatis hic!</p>
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
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, incidunt?</p>
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

        <div class="mt-5 text-center">
            <a href="#" class="btn btn-dark">Lihat Semua</a>
        </div>
    </div>
</section>

<!-- End Gallery -->


<!-- Contact -->

<section id="contact" style="padding-top: 7rem; margin-bottom: 10rem">
    <div class="container">
        <div class="header-title">
            <h2>Contact</h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugiat, ipsam.</p>
        </div>

        <div class="container bg-secondary shadow-lg p-5 rounded-2 text-light">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Form</h3>
                    <hr>
                    <form action="">
                        <div class="mb-3">
                            <label for="name-text" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name-text" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="pesan-text" class="form-label">Pesan</label>
                            <textarea type="text" class="form-control" id="pesan-text" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div class="text-end">
                        <h3>Location</h3>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- End Contact -->

<?php require_once __DIR__ . '/template/footer.php' ?>