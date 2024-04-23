<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>User</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ url("/user/profile/$usr")}}">Look Book</a>

            <form action="{{ route('logout') }}" method="POST" class="d-flex">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>

          </div>
        </div>
      </nav>
      <div class="container">
        @if ($message = Session::get('success'))
        <div class="alert alert-info">
           <p>{{ $message }}</p>
        </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-warning">
                <ol>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ol>
            </div>
        @endif
        <h3>welcome,Dear {{ $usr->name }}</h3>
        <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="alertModalLabel">Alert</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Alert message content will be displayed here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="cancelBtn" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="confirmBtn">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-info fade show" id="messageAlert" role="alert" style="display: none; width:200px; " align="center">
        Successfully updated!
        </div>
        <div class="mt-3">
            <form method="POST" action="{{route('create')}}">
                @csrf
                <div class="input-group  mb-3">
                    <input type="text" name="body" class="form-control me-2" placeholder="To do ">
                    <input type="hidden" name="user_id" value="{{ $usr }}">
                    <button class="btn btn-outline-secondary" type="submit" value="Add List">Add</button>
                  </div>
            </form>

        </div>
        <div class="d-flex mb-3 justify-content-between">

            <div>
                <span class="badge bg-danger rounded-pill text-center">Tasks({{count($usr->articles)}})</span>
            </div>
            <div>
                <button class="btn btn-primary removeAll mb-3">Multi Delete</button>
            </div>
        </div>
        <hr>
        <table class="table table-striped">
            <thead>
                <tr>

                    <th>Status</th>
                    <th colspan="2">Task Name</th>


                    <th>Updated Date</th>
                    <th>Action</th>
                    <th><input type="checkbox" id="checkboxesMain"></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($usr->articles as $article)
                    <tr id="list_ids{{ $article->id}}">
                        <td class="item-id d-none">{{ $article->id }}</td>
                        <td class="form-check" style="display: table-cell; margin-left:auto; float:none">
                            <input style=" margin-left:auto;" class="form-check-input itemCheckbox" type="checkbox"
                            data-item-id="{{ $article->check_id }}"
                            {{  $article->check_id==1 ? 'checked': '' }}  id="status_{{ $article->check_id }}"/>
                         </td>

                        <td class="itemName" colspan="2">{{ $article->body }}</td>
                        {{-- <td>{{ $article->user_id }}</td> --}}
                        <td>{{ $article->created_at->diffForHumans() }}</td>
                         <td><a href="{{ url("/user/edit/$article->id")}}" class="btn btn-warning ">Edit</a>
                         <a href="{{ url("/user/destory/$article->id")}}" class="btn btn-danger">Delete</a></td>
                         <td><input type="checkbox" class="checkbox" data-id="{{$article->id}}"></td>

                        {{-- <td>{{ $item->check_id }}</td> --}}

                    </tr>

                @endforeach
            </tbody>
        </table>



        </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script src="{{asset('js/ajaxscript.js')}}"></script>
      <script type = "text/javascript" >
                  function getCsrfToken() {
            return $('meta[name="csrf-token"]').attr('content');
        }
          $(document).ready(function() {
              $('#checkboxesMain').on('click', function(e) {
                  if ($(this).is(':checked', true)) {
                      $(".checkbox").prop('checked', true);
                  } else {
                      $(".checkbox").prop('checked', false);
                  }
              });
              $('.checkbox').on('click', function() {
                  if ($('.checkbox:checked').length == $('.checkbox').length) {
                      $('#checkboxesMain').prop('checked', true);
                  } else {
                      $('#checkboxesMain').prop('checked', false);
                  }
              });
              $('.removeAll').on('click', function(e) {
                  var articleIdArr = [];
                  $(".checkbox:checked").each(function() {
                      articleIdArr.push($(this).attr('data-id'));
                  });
                  if (articleIdArr.length <= 0) {
                      alert("Choose min one item to remove.");
                  } else {
                      if (confirm("Are you sure you want to delete")) {
                          var arId = articleIdArr.join(",");
                          $.ajax({
                              url: "{{url('delete-all')}}",
                              type: 'DELETE',
                              headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                              },
                              data: 'ids=' + arId,
                              success: function(data) {
                                  if (data['status'] == true) {
                                      $(".checkbox:checked").each(function() {
                                          $(this).parents("tr").remove();
                                      });
                                      alert(data['message']);
                                  } else {
                                      alert('Error occured.');
                                  }
                              },
                              error: function(data) {
                                  alert(data.responseText);
                              }
                          });
                      }
                  }
              });

              $('.itemCheckbox').change(function() {
            //   alert('hi')

            var isChecked = $(this).is(':checked');
            var checkFlg = $(this).is(':checked')? 1:0;
            //itemId
            // var itemName = $(this).closest('tr').find('.itemName').text(); // Get the name of the item
            var itemId = $(this).closest('tr').find('.item-id').text();

  let tdl = {id :itemId,check_id : checkFlg};
// alert(tdl);
            $.ajax({
                url:  "{{url('/user/updateItem')}}" , //{ '/lists/updateItem'},
                type: 'POST',
                headers: {
                'X-CSRF-TOKEN': getCsrfToken()
            },
            dataType: 'json',
                data:
                    tdl
                   // id: itemId,
                    //  body: null,
                    //   user_id: 1,
                     //check_id: checkFlg,
                    //  updated_at: 1,
                ,
                success: function(response) {
                    //alert(response.success)

                    $('#messageAlert').fadeIn();
                    setTimeout(function() {  $('#messageAlert').fadeOut(); }, 3000);
                    //Handle success response
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                    // Handle error response
                }
            });
        });
    });

      </script>
</body>
</html>
