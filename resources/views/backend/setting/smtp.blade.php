@extends('backend.layouts.master')

@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="block-header">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h2><a href="javascript:void(0)" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                            class="fa fa-arrow-left"></i></a>Edit Setting</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-lg-12">
                            @include('backend.layouts.notification')
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <form action="{{ route('smtp.update') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <input type="hidden" name="types[]" value="MAIL_DRIVER">
                            <div class="form-group col-md-12">
                                <label for="type">Type</label>
                                <select name="MAIL_DRIVER" id="" class="form-control" onchange="checkMailDriver()">
                                    <option value="sendmail" @if (env('MAIL_DRIVER') == 'sendmail') selected @endif>SendMail
                                    </option>
                                    <option value="smtp" @if (env('MAIL_DRIVER') == 'smtp') selected @endif>SMTP</option>
                                    <option value="mailgun" @if (env('MAIL_DRIVER') == 'mailgun') selected @endif>Mailgun
                                    </option>
                                </select>
                            </div>
                            <div id="smtp">
                                <div class="form-group col-md-12">
                                    <input type="hidden" name="types[]" value="MAIL_HOST">
                                    <label for="mail_host">Mail Host</label>
                                    <input type="text" class="form-control" name="MAIL_HOST"
                                        value="{{ env('MAIL_HOST') }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="hidden" name="types[]" value="MAIL_PORT">
                                    <label for="mail_port">Mail Port</label>
                                    <input type="text" class="form-control" name="MAIL_PORT"
                                        value="{{ env('MAIL_PORT') }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="hidden" name="types[]" value="MAIL_USERNAME">
                                    <label for="mail_username">Mail Username</label>
                                    <input type="text" class="form-control" name="MAIL_USERNAME"
                                        value="{{ env('MAIL_USERNAME') }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                                    <label for="mail_password">Mail Password</label>
                                    <input type="text" class="form-control" name="MAIL_PASSWORD"
                                        value="{{ env('MAIL_PASSWORD') }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">
                                    <label for="mail_encription">Mail Encription</label>
                                    <input type="text" class="form-control" name="MAIL_ENCRYPTION"
                                        value="{{ env('MAIL_ENCRYPTION') }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
                                    <label for="mail_address">Mail Address</label>
                                    <input type="text" class="form-control" name="MAIL_FROM_ADDRESS"
                                        value="{{ env('MAIL_FROM_ADDRESS') }}">
                                </div>
                            </div>
                            <div id="mailgun">
                                <div class="form-group col-md-12">
                                    <input type="hidden" name="types[]" value="MAILGUN_DOMAIN">
                                    <label for="mailgun_domain">Mailgun Domain</label>
                                    <input type="text" class="form-control" name="MAILGUN_DOMAIN"
                                        value="{{ env('MAILGUN_DOMAIN') }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="hidden" name="types[]" value="MAILGUN_SECRET">
                                    <label for="mailgun_secret">Mailgun Secret</label>
                                    <input type="text" class="form-control" name="MAILGUN_SECRET"
                                        value="{{ env('MAILGUN_SECRET') }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $(document).ready(function() {
            checkMailDriver();
        });

        function checkMailDriver() {
            if ($('select[name=MAIL_DRIVER]').val() == 'mailgun') {
                $('#mailgun').show();
                $('#smtp').hide();
            } else {
                $('#mailgun').hide();
                $('#smtp').show();
            }
        }
    </script>
@endsection
