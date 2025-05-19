<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Breeze Admin</title>
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css" />
  <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css" />
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css" />
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" />
  <link rel="stylesheet" href="pagination.css">
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
        <a class="sidebar-brand brand-logo" href="index.html"><img src="assets/images/logo.svg" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
      </div>
      <ul class="nav">
        <li class="nav-item nav-profile">
          <a href="#" class="nav-link">
            <div class="nav-profile-image">
              <img src="assets/images/faces/face1.jpg" alt="profile" />
              <span class="login-status online"></span>
              <!--change to offline or busy as needed-->
            </div>
            <div class="nav-profile-text d-flex flex-column pr-3">
              <span class="font-weight-medium mb-2">Henry Klein</span>
              <span class="font-weight-normal">$8,753.00</span>
            </div>
            <span class="badge badge-danger text-white ml-3 rounded">3</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.html">
            <i class="mdi mdi-home menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            <span class="menu-title">Basic UI Elements</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pages/icons/mdi.html">
            <i class="mdi mdi-contacts menu-icon"></i>
            <span class="menu-title">Icons</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pages/forms/basic_elements.html">
            <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            <span class="menu-title">Forms</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pages/charts/chartjs.html">
            <i class="mdi mdi-chart-bar menu-icon"></i>
            <span class="menu-title">Charts</span>
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="pages/tables/basic-table.html">
            <i class="mdi mdi-table-large menu-icon"></i>
            <span class="menu-title">Tables</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/table">
            <i class="mdi mdi-table-large menu-icon"></i>
            <span class="menu-title">Tables 2</span>
          </a>
        </li>
        <li class="nav-item">
          <span class="nav-link" href="#">
            <span class="menu-title">Docs</span>
          </span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://www.bootstrapdash.com/demo/breeze-free/documentation/documentation.html">
            <i class="mdi mdi-file-document-box menu-icon"></i>
            <span class="menu-title">Documentation</span>
          </a>
        </li>
        <li class="nav-item sidebar-actions">
          <div class="nav-link">
            <div class="mt-4">
              <div class="border-none">
                <p class="text-black">Notification</p>
              </div>
              <ul class="mt-4 pl-0">
                <li>Sign Out</li>
              </ul>
            </div>
          </div>
        </li>
      </ul>
    </nav>
    <div class="container-fluid page-body-wrapper">
      <div id="theme-settings" class="settings-panel">
        <i class="settings-close mdi mdi-close"></i>
        <p class="settings-heading">SIDEBAR SKINS</p>
        <div class="sidebar-bg-options selected" id="sidebar-default-theme">
          <div class="img-ss rounded-circle bg-light border mr-3"></div> Default
        </div>
        <div class="sidebar-bg-options" id="sidebar-dark-theme">
          <div class="img-ss rounded-circle bg-dark border mr-3"></div> Dark
        </div>
        <p class="settings-heading mt-2">HEADER SKINS</p>
        <div class="color-tiles mx-0 px-4">
          <div class="tiles light"></div>
          <div class="tiles dark"></div>
        </div>
      </div>
      <nav class="navbar col-lg-12 col-12 p-lg-0 fixed-top d-flex flex-row">
        <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
          <a class="navbar-brand brand-logo-mini align-self-center d-lg-none" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
          <button class="navbar-toggler navbar-toggler align-self-center mr-2" type="button" data-toggle="minimize">
            <i class="mdi mdi-menu"></i>
          </button>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                <span class="count count-varient1">7</span>
              </a>
              <div class="dropdown-menu navbar-dropdown navbar-dropdown-large preview-list" aria-labelledby="notificationDropdown">
                <h6 class="p-3 mb-0">Notifications</h6>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/faces/face4.jpg" alt="" class="profile-pic" />
                  </div>
                  <div class="preview-item-content">
                    <p class="mb-0"> Dany Miles <span class="text-small text-muted">commented on your photo</span>
                    </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/faces/face3.jpg" alt="" class="profile-pic" />
                  </div>
                  <div class="preview-item-content">
                    <p class="mb-0"> James <span class="text-small text-muted">posted a photo on your wall</span>
                    </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/faces/face2.jpg" alt="" class="profile-pic" />
                  </div>
                  <div class="preview-item-content">
                    <p class="mb-0"> Alex <span class="text-small text-muted">just mentioned you in his post</span>
                    </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <p class="p-3 mb-0">View all activities</p>
              </div>
            </li>
            <li class="nav-item dropdown d-none d-sm-flex">
              <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-email-outline"></i>
                <span class="count count-varient2">5</span>
              </a>
              <div class="dropdown-menu navbar-dropdown navbar-dropdown-large preview-list" aria-labelledby="messageDropdown">
                <h6 class="p-3 mb-0">Messages</h6>
                <a class="dropdown-item preview-item">
                  <div class="preview-item-content flex-grow">
                    <span class="badge badge-pill badge-success">Request</span>
                    <p class="text-small text-muted ellipsis mb-0"> Suport needed for user123 </p>
                  </div>
                  <p class="text-small text-muted align-self-start"> 4:10 PM </p>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-item-content flex-grow">
                    <span class="badge badge-pill badge-warning">Invoices</span>
                    <p class="text-small text-muted ellipsis mb-0"> Invoice for order is mailed </p>
                  </div>
                  <p class="text-small text-muted align-self-start"> 4:10 PM </p>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-item-content flex-grow">
                    <span class="badge badge-pill badge-danger">Projects</span>
                    <p class="text-small text-muted ellipsis mb-0"> New project will start tomorrow </p>
                  </div>
                  <p class="text-small text-muted align-self-start"> 4:10 PM </p>
                </a>
                <h6 class="p-3 mb-0">See all activity</h6>
              </div>
            </li>
            <li class="nav-item nav-search border-0 ml-1 ml-md-3 ml-lg-5 d-none d-md-flex">
              <form class="nav-link form-inline mt-2 mt-md-0">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search" />
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <i class="mdi mdi-magnify"></i>
                    </span>
                  </div>
                </div>
              </form>
            </li>
          </ul>
          <ul class="navbar-nav navbar-nav-right ml-lg-auto">
            <li class="nav-item dropdown d-none d-xl-flex border-0">
              <a class="nav-link dropdown-toggle" id="languageDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-earth"></i> English </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">
                <a class="dropdown-item" href="#"> French </a>
                <a class="dropdown-item" href="#"> Spain </a>
                <a class="dropdown-item" href="#"> Latin </a>
                <a class="dropdown-item" href="#"> Japanese </a>
              </div>
            </li>
            <li class="nav-item nav-profile dropdown border-0">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown">
                <img class="nav-profile-img mr-2" alt="" src="assets/images/faces/face1.jpg" />
                <span class="profile-name">Henry Klein</span>
              </a>
              <div class="dropdown-menu navbar-dropdown w-100" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-cached mr-2 text-success"></i> Activity Log </a>
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <div class="container " style="margin-top: 100px">

        <h2>Striped Rows</h2>
        <p>The .table-striped class adds zebra-stripes to a table:</p>



        {{-- @if ($count)
            <p>{{$count}}</p>
        @endif --}}


        <form action="" method="GET">
          <div class="input-group input-navbar">

            <input type="text" name="search_email" class="form-control" placeholder="Enter Email" aria-label="Username" aria-describedby="icon-addon1">
            <input type="text" name="search_first_name" class="form-control" placeholder="Enter First Name" aria-label="Username" aria-describedby="icon-addon1">
            <input type="text" name="search_last_name" class="form-control" placeholder="Enter Last Name" aria-label="Username" aria-describedby="icon-addon1">
            <input type="text" name="search_company_name" class="form-control" placeholder="Enter Company Name" aria-label="Username" aria-describedby="icon-addon1">
            <input type="date" name="search_date" class="form-control" placeholder="Enter Date" aria-label="Username" aria-describedby="icon-addon1">
            <input type="text" name="search_country" class="form-control" placeholder="Enter Country" aria-label="Username" aria-describedby="icon-addon1">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>



        </form>


        <div class="container m-4">
          <div class="row">
            <div class="col-4">
              <!--		Show Numbers Of Rows 		-->
              <select class="form-control form-select" aria-label="Default select example" name="state" id="maxRows">
                <option value="5000">Show ALL Rows</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="70">70</option>
                <option value="100">100</option>
              </select>

            </div>
            <div class="col-4">
              <input type="text" name="" class="form-control" id="input_search" placeholder="Enter Search" aria-label="Username" aria-describedby="icon-addon1">

            </div>
            <div class="col-4">
              <a href="/genarate-pdf" class="btn btn-primary">Export PDf</a>
            </div>

          </div>
        </div>




        <table class="table table-striped" id="table-id">
          <thead>
            <tr>
              <th>S.N</th>
              <th>Email</th>
              <th>Firstname</th>
              <th>Lastname</th>
              <th>company</th>
              <th>created_at</th>
              <th>country</th>
            </tr>
          </thead>
          <tbody id="tablebody">
            @foreach ($getdata as $getdatas)
            <tr>
              <td>{{$loop->index+1}}</td>
              <td>{{$getdatas->email}}</td>
              <td>{{$getdatas->first}}</td>
              <td>{{$getdatas->last}}</td>
              <td>{{$getdatas->company}}</td>
              <td>{{$getdatas->created_at}}</td>
              <td>{{$getdatas->country}}</td>


            </tr>

            @endforeach

          </tbody>
          <tfoot>
            <tr>
              <td>Total</td>
              <td>$180</td>
              <td>$180</td>
              <td>$180</td>
              <td>$180</td>
              <td>$180</td>
              <td>$180</td>
            </tr>
          </tfoot>
        </table>


        <!--		Start Pagination -->
        <div class='pagination-container'>
          <nav>
            <ul class="pagination">

              <li data-page="prev" class="btn btn-primary">
                <span>
                  < <span class="sr-only">(current)
                </span></span>
              </li>
              <!--	Here the JS Function Will Add the Rows -->
              <li data-page="next" id="prev" class="btn btn-primary">
                <span> > <span class="sr-only">(current)</span></span>
              </li>
            </ul>
          </nav>
        </div>




      </div>

      <style>
        .w-5 {
          display: none;
        }
      </style>

      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets/vendors/chart.js/Chart.min.js"></script>
  <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="assets/vendors/flot/jquery.flot.js"></script>
  <script src="assets/vendors/flot/jquery.flot.resize.js"></script>
  <script src="assets/vendors/flot/jquery.flot.categories.js"></script>
  <script src="assets/vendors/flot/jquery.flot.fillbetween.js"></script>
  <script src="assets/vendors/flot/jquery.flot.stack.js"></script>
  <script src="assets/vendors/flot/jquery.flot.pie.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/misc.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="assets/js/dashboard.js"></script>
  <!-- End custom js for this page -->

  <script>
    $(document).ready(function() {

      $('#input_search').keyup(function() {
        var get_search_data = $(this).val().toLowerCase();
        $('#tablebody tr').filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(get_search_data) > -1)
        });
      });

    })
  </script>


  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/{{asset('assets/js/jquery/jquery.slim.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="js/vendor/jquery.sortelements.js" type="text/javascript"></script>
  <script src="js/jquery.bdt.min.js" type="text/javascript"></script>
  <script src="simplepagination.js"></script>



</body>

</html>