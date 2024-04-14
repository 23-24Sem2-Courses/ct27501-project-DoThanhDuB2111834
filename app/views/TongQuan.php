<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>
<?php $this->start("page_specific_css") ?>

<?php $this->stop() ?>
<?php $this->start("page") ?>
<div class="container">
    <div class="container-fluid mt-4  custom-border  p-4">
        <h4 class="font-weight-bold">Thống kê</h4>
        <div class="row">
            <!-- Sản phẩm -->
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <h3 class="mb-0">10,002</h3>
                                <p class="text-muted">Nhân sự</p>
                            </div>
                            <div class="col-4 text-center d-flex align-items-center">
                                <i class="fa-solid fa-user fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Đơn hàng -->
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <h3 class="mb-0">154</h3>
                                <p class="text-muted">Sản phẩm</p>
                            </div>
                            <div class="col-4 text-center d-flex align-items-center">
                                <i class="fa-solid fa-tag fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bình luận -->
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <h3 class="mb-0">96</h3>
                                <p class="text-muted">Đơn hàng</p>
                            </div>
                            <div class="col-4 text-center d-flex align-items-center">
                                <i class="fa-solid fa-cart-shopping fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thu nhập -->
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <h3 class="mb-0">30.000.000</h3>
                                <p class="text-muted">Doanh thu</p>
                            </div>
                            <div class="col-4 text-center d-flex align-items-center">
                                <i class="fa-solid fa-money-bill fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-4 mb-4 custom-border  p-4">
        <h4 class="font-weight-bold">Báo cáo</h4>
        <div class="row">
            <div class="col-10 d-flex flex-column justify-content-center align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" class="font-weight-bold h5">Top 4 bán chạy nhất</label>
                            <div class="card">
                                <canvas id="Best-seller"></canvas>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="" class="font-weight-bold h5">Doanh số 6 tháng gần đây</label>
                            <div class="card">
                                <canvas id="Recent-sales-Chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2 flex-column justify-content-center align-items-center">
                <ul class="list-group w-100">
                    <li class="list-group-item bg-info text-white font-weight-bold text-center border-dark">Nhân viên tích cực</li>
                    <li class="list-group-item text-center border-dark">Test 1</li>
                    <li class="list-group-item text-center border-dark">Test 2</li>
                    <li class="list-group-item text-center border-dark">Test 3</li>
                    <li class="list-group-item text-center border-dark">Test 4</li>
                    <li class="list-group-item text-center border-dark">Test 5</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<style>
    .custom-border {
        border: 1px solid rgba(0, 0, 0, 0.125);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>

<?php $this->stop() ?>
<?php $this->start("page_specific_js") ?>
<script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js"
      integrity="sha512-7U4rRB8aGAHGVad3u2jiC7GA5/1YhQcQjxKeaVms/bT66i3LVBMRcBI9KwABNWnxOSwulkuSXxZLGuyfvo7V1A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
      defer
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Raleway"
    />
<script>
    $(document).ready(function () {
  $("body").addClass("loaded");
  const data = [
    { month: 6, Sales: 30 },
    { month: 7, Sales: 50 },
    { month: 8, Sales: 60 },
    { month: 9, Sales: 40 },
    { month: 10, Sales: 100 },
    { month: 11, Sales: 150 },
  ];

  new Chart($("#Recent-sales-Chart"), {
    type: "bar",
    data: {
      labels: data.map((row) => row.month),
      datasets: [
        {
          label: "Doanh số",
          data: data.map((row) => row.Sales),
        },
      ],
    },
  });

  new Chart($("#Best-seller"), {
    type: "pie",
    data: {
      labels: [
        "Trà đào",
        "Trà sữa",
        "Hồng trà xanh",
        "Cafe",
      ],
      datasets: [
        {
          label: '',
          data: [300, 50, 100, 70],
          backgroundColor: [
            "rgb(255, 99, 132)",
            "rgb(54, 162, 235)",
            "rgb(255, 205, 86)",
            "rgb(50, 209, 50)",
          ],
          hoverOffset: 4,
        },
      ],
    },
  });
});
</script>
<?php $this->stop() ?>