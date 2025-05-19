<!DOCTYPE html>
<html lang="en">
  <head>

    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        .page-break {
            page-break-after: always;
        }
        </style>
  </head>
  <body>
    <div class="container-scroller">



            <table class="table table-striped">
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
            </table>






          </div>



  </body>
</html>
