@extends('layouts.app')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <!-- /.col -->
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Inbox</h3>


                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">

                        <div class="table-responsive mailbox-messages" style="height: 90vh">
                            <table class="table table-hover table-striped  table-head-fixed text-nowrap">
                                <tbody id="nortificationtable">



                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    @endsection
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script type="text/javascript">
        $(document).ready(function() {


            $.ajax({
                url: "{{ route('fetch_nortification_all') }}",
                type: 'GET',
                dataType: 'json',

                success: function(data) {


                    var i = 0;
                    while (i < data.nortifications.length) {
                        nortification = data.nortifications[i];
                        index = i + 1;


                        $('#nortificationtable').append(
                            " <tr><td><div class='icheck-primary'>" +   index +
                             " </div> </td><td class='mailbox-star'><a href='#'><iclass='fas fa-star text-warning'></iclass=></a></td><td class='mailbox-name'><h5  ><small >"+
                                  nortification.title +
                            "</small></h5></td> <td class='mailbox-subject'>" +
                            nortification.message +
                            "</td><td class='mailbox-attachment'></td><td class='mailbox-date'>" +
                            nortification.action + " </td><td class='mailbox-date'>" +
                            timeSince(new Date(nortification.created_at)) + " ago </td></tr>"
                        );



                        i++;

                    }





                }
            });




        });


        function timeSince(date) {

            var seconds = Math.floor((new Date() - date) / 1000);

            var interval = seconds / 31536000;

            if (interval > 1) {
                return Math.floor(interval) + " years";
            }
            interval = seconds / 2592000;
            if (interval > 1) {
                return Math.floor(interval) + " months";
            }
            interval = seconds / 86400;
            if (interval > 1) {
                return Math.floor(interval) + " days ";
            }
            interval = seconds / 3600;
            if (interval > 1) {
                return Math.floor(interval) + " hours";
            }
            interval = seconds / 60;
            if (interval > 1) {
                return Math.floor(interval) + " minutes";
            }
            return Math.floor(seconds) + " seconds";
        }
    </script>
