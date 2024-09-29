<?php require_once __DIR__ . '/template/navbar.php' ?>

<div class="container" style="margin-top: 7rem;">
    <!-- title -->
    <div class="text-center">
        <h1>Gallery</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, incidunt?</p>
    </div>

    <!-- content -->
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

    <!-- pagination -->
    <div class="mt-5">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<?php require_once __DIR__ . '/template/footer.php' ?>