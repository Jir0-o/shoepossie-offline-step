<!DOCTYPE html>
<html lang="en">
  <head>

    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="shortcut icon" href="assets/images/favicon.png" />

  </head>
  <body>
    <div class="container-scroller">

           <h1>Report Data</h1>

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
                  @foreach ($exceldata as $exceldatas)
                <tr>
                  <td>{{$loop->index+1}}</td>
                  <td>{{$exceldatas->email}}</td>
                  <td>{{$exceldatas->first}}</td>
                  <td>{{$exceldatas->last}}</td>
                  <td>{{$exceldatas->company}}</td>
                  <td>{{$exceldatas->created_at}}</td>
                  <td>{{$exceldatas->country}}</td>


                </tr>

                @endforeach

              </tbody>
            </table>






          </div>



  </body>
</html>
